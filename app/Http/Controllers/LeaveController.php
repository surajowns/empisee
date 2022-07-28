<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Leave;
use Auth;
use Validator;
use DB;
use Carbon;
use Session;
use App\Event;
use App\NotificationModel;
use App\LeaveDetails;
use App\User;


class LeaveController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('CheckSession');
        $this->middleware('CheckPermission');

    }


    public function Index(Request $request)
    {

        // $totalleaves=Leave::get();
        $date = date('Y-m-d');
        $totalleaves = DB::table('leaves')
            ->whereDate('from_date', '<=', $date)
            ->whereDate('to_date', '>=', $date)
            ->selectRaw('count(emp_id) as total')
            ->selectRaw("count(case when leave_day = 'Full Day' then 1 end) as fullday")
            ->selectRaw("count(case when leave_day = 'First Half ' then 1 end) as firsthalf")
            ->selectRaw("count(case when leave_day = 'Second Half' then 1 end) as secondhalf")
            ->selectRaw("count(case when status = '2' then 1 end) as  not_approved")
            ->selectRaw("count(case when status = '3' then 1 end) as approved")
            ->first();
        $leavestatus = DB::table('leave_status')->get();
        $empleaves = Leave::with(['employee','leavetype'])->orderBy('id', 'DESC')->limit(10)->get()->toArray();
        return view('leave', compact('totalleaves', 'empleaves', 'leavestatus'));
    }

    public function ApplyLeave(Request  $request)
    {
        $validator = Validator::make($request->all(), [
            'leave_type' => 'required',
            'leave_day' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'leave_reason' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages()->first(),
                'status' => 400,
            ]);
        }
        DB::beginTransaction();
        try {
            $seen_by=array();
            $emp_id = Auth::User();
            $data = $request->except('_token');
            $data['from_date'] = date('Y-m-d', strtotime($request->from_date));
            $data['to_date'] = date('Y-m-d', strtotime($request->to_date));
            $data['emp_id'] = $emp_id['id'];
            $applied = Leave::create($data);
            $leave_id = Leave::orderBy('id', 'DESC')->first();

            $notification = new NotificationModel;
            $notification->emp_id = $emp_id['id'];
            $notification->content = $emp_id['name'] . ' Applied For Leave';
            $notification->type = $leave_id['id'];
            $notification->seen_by=json_encode($seen_by);
            $notification->save();
            DB::commit();


            if (!empty($applied)) {
                $user = Auth::user();
                LeaveMail($user);
                return response()->json(['data' => $applied, 'success' => 'Leave Applied successfully', 'status' => 200]);
            }
        } catch (\Exception $e) {
            // dd($e->getMessage());
            DB::rollBack();
            return response()->json(['error' => $e->getMessage(), 'status' => 400]);
        }
    }


    public function updatestatus(Request $request)
    {
        $user = Auth::user();
        $result = Leave::where('id', $request->leave_id)->update(['status' => $request->status_change, 'approved_by' => $user['name']]);
        if ($result) {
            return back()->with('success', 'Status Updated successfull');
        }
    }
    public function EmployeeLeave(Request $request, $emp_id = null)
    {
        $date = date('Y-m-d');
        $leavestatus = DB::table('leave_status')->get();
        $empleaves = Leave::with('employee')->where('emp_id', Session::get('emp_id'))->orderBy('id', 'DESC')->get()->toArray();
        $upcommingholidays = Event::where('start', '>', $date)->get();
        $holidayhistory = Event::where('start', '<', $date)->get();


        return view('employee_leave', compact('empleaves', 'leavestatus', 'upcommingholidays', 'holidayhistory'));
    }
    public function EmployeeLeaveDetails(Request $request)
    {
        
        $emp_assets = LeaveDetails::with('employee')->orderBy('id', 'DESC')->paginate(10);
        $asset_status=DB::table('assets_status')->get();
        $employee = User::where('status',1)->get();
        return view('employee_leave_details', compact('emp_assets', 'employee','asset_status'));

    }


    public function AssignLeave(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'emp_id' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'error' => 'Please Select Employee',
                'status' => 400,
            ]);
        }

        $validate = Validator::make($request->all(), [
            'casual_leave' => 'required',
            'sick_leave' => 'required',

        ]);
        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->messages()->first(),
                'status' => 400,
            ]);
        }
        try {
            $data = $request->all();
            $data['total_leave']=$request->casual_leave +$request->sick_leave;
            LeaveDetails::create($data);
            $last_data = LeaveDetails::with('employee')->orderBy('id', 'DESC')->first();
            $user = Auth::user();
            $employee_details=User::with('emp_details')->where('id',$request->emp_id)->where('status',1)->first();
            // AssetsEmail($user,$last_data,$employee_details);
            return response()->json(['status' => 200, 'last_data' => $last_data, 'success' => 'Leave Assigned Successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'error' =>'Something Went Wrong']);
        }
    }


    public function LeaveModalForUpdate(Request $request)
    {

        $emp_assets = LeaveDetails::with('employee')->where('id', $request->id)->first();
        $employee = User::where('status',1)->get();
        $list = "";
        $selected = "";
        foreach ($employee as $values) {
            if ($values->id == $emp_assets->emp_id) {
                $selected = 'selected';
                $list .= "<option value='$values->id' $selected >" . $values->name . "</option>";
            } else {
                $list .= "<option value='$values->id' >" . $values->name . "</option>";
            }
        }
        $returnHTML = "<div class='modal-body style-add-modal'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h4 class='modal-title mb-3'>Update Employee Leave</h4>
       <form   method='POST'  id='update_form$emp_assets->id'> 
           <input type='hidden' name='id' value='$emp_assets->id' id='id'>
        <div class='form-group'>
            <div class='input-group mb-3'>
            <select class='form-control select'  id='emp_id' name='emp_id'>
            <option value=''>Select  Employee </option>"
            . $list . "</select>
            </div>
        </div>
        <div class='form-group'>
            <div class='input-group mb-3'>
                <input class='form-control' type='number' name='casual_leave' value='$emp_assets->casual_leave' placeholder='Casual Leave'>
            </div>
        </div>
        <div class='form-group'>
            <div class='input-group mb-3'>
                <input class='form-control' type='number' name='sick_leave' min='1' value='$emp_assets->sick_leave' placeholder='Sick Leave'>
            </div>
        </div>
        
        <div class='form-group'>
            <div class='input-group mb-3'>
                <input class='form-control' type='number' name='cl_taken' value='$emp_assets->cl_taken' placeholder='Casual Leave In Bucket'>
            </div>
        </div>
       
        <div class='form-group'>
            <div class='input-group mb-3'>
                <input class='form-control' type='number' name='ml_taken' value='$emp_assets->ml_taken' placeholder='Sick Leave In Bucket'>
            </div>
        </div>
        <button type='button' class='btn btn-danger text-white ctm-border-radius' float-right ml-3' data-dismiss='modal'>Cancel</button>
        <button type='button' type='submit' class='btn btn-theme ctm-border-radius text-white float-right button-1 update_assets'  data-asset_id='$emp_assets->id'>Update</button>
      </form>
    </div>";
        return response()->json(['html' => $returnHTML]);
    }


    public function UpdateLeave(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'emp_id' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'error' => 'Please Select Employee',
                'status' => 400,
            ]);
        }

        $validate = Validator::make($request->all(), [
            'casual_leave' => 'required',
            'sick_leave' => 'required',

        ]);
        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->messages()->first(),
                'status' => 400,
            ]);
        }
        try {
            $data = $request->except('id', '_');
            $data['total_leave']=$request->casual_leave +$request->sick_leave;
            LeaveDetails::where('id', $request->id)->update($data);
            return response()->json(['status' => 200, 'success' => 'Leave Updated Successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'error' => $e->getMessage()]);
        }
    }


    public function DeleteLeaves(Request $request)
    {
        try {
            LeaveDetails::where('id', $request->assets_id)->delete();
            return response()->json(['status' => 200, 'success' => 'Leave Deleted Successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'error' => $e->getMessage()]);
        }
    }
}
