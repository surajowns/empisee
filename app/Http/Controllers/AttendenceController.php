<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\AttendenceExport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use App\User;
use App\ClockInOut;
use DB;

class AttendenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckSession');
        $this->middleware('CheckPermission');

    }
    public function Index(Request $request)
    {
    //    dd();
        $employee = User::with('emp_details')->where('role', '!=', 1)->where('status',1)->orderBy('id', 'DESC')->get()->toArray();
        return view('attendence', compact('employee'));
    }

    public function attendenceReport(Request $request, $emp_id = null)
    {
        $employee = User::where('id', $emp_id)->first();
        $report = ClockInOut::with('attendence_status')->where('emp_id', $emp_id)->orderBy('created_at', 'DESC')->get();
        $attendencestatus = DB::table('attendence_status')->get();
        return view('attendence_report', compact('report', 'employee', 'attendencestatus'));
    }


    public function GenerateAttendenceReport(Request $request)
    {   
          
         $emp_id= $request->emp_id;
         $from= date('Y-m-d',strtotime($request->from));
         $to= date('Y-m-d',strtotime($request->to));
       
        return Excel::download(new AttendenceExport($emp_id,$from,$to), 'attendence.xlsx');
     

        // $user=Auth::user();
        // $employee=User::where('id',$user['id'])->first();
        // $report=ClockInOut::where('emp_id',$user['id'])->get();
        // return view('attendence_report',compact('report','employee'));    
    }

    public function AttendenceStatus(Request $request)
    {

        $result = ClockInOut::where('id', $request->clock_id)->update(['status' => $request->status_change]);
        if ($result) {
            return back()->with('success', 'Status Updated successfull');
        }
    }
}
