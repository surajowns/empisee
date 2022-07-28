<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\AssetExport;
use Maatwebsite\Excel\Facades\Excel;
use App\AssetModel;
use App\User;
use Validator;
use DB;
use Auth;
class AssetsController extends Controller
{
    public function  __construct()
    {
        $this->middleware('CheckSession');
        $this->middleware('CheckPermission');

    }

    public function Index(Request $request)
    {
        $emp_assets = AssetModel::with('employee')->orderBy('id', 'DESC')->paginate(10);
        $asset_status=DB::table('assets_status')->get();
        $employee = User::where('status',1)->get();
        return view('assets', compact('emp_assets', 'employee','asset_status'));
    }

    public function AssignAssets(Request $request)
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
            'product_name' => 'required',
            'quantity' => 'required',
            'allotted_date' => 'required',

        ]);
        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->messages()->first(),
                'status' => 400,
            ]);
        }
        try {
            $data = $request->all();
            $data['status']=1;
            
            AssetModel::create($data);
            $last_data = AssetModel::with('employee')->orderBy('id', 'DESC')->first();
            $user = Auth::user();
            $employee_details=User::with('emp_details')->where('id',$request->emp_id)->where('status',1)->first();
            AssetsEmail($user,$last_data,$employee_details);
            return response()->json(['status' => 200, 'last_data' => $last_data, 'success' => 'Assets Assigned Successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'error' => $e->getMessage()]);
        }
    }

    public function UpdateAssets(Request $request)
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
            'product_name' => 'required',
            'quantity' => 'required',
            'allotted_date' => 'required',

        ]);
        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->messages()->first(),
                'status' => 400,
            ]);
        }
        try {
            $data = $request->except('id', '_');
            AssetModel::where('id', $request->id)->update($data);
            return response()->json(['status' => 200, 'success' => 'Assets Updated Successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'error' => $e->getMessage()]);
        }
    }



    public function AssetModalForUpdate(Request $request)
    {

        $emp_assets = AssetModel::with('employee')->where('id', $request->id)->first();
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
        <h4 class='modal-title mb-3'>Update assets to employee</h4>
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
        <input class='form-control' type='text' name='product_name' value='$emp_assets->product_name' placeholder='Product Name'>
        </div>
        </div>
        <div class='form-group'>
        <div class='input-group mb-3'>
        <input class='form-control' type='number' name='quantity' min='1' value='$emp_assets->quantity' placeholder='Quantity'>
        </div>
        </div>
        <div class='form-group'>
        <div class='input-group mb-3'>
        <input class='form-control' type='text' onfocus=(this.type='date') onblur=(this.type='text') name='allotted_date' value='$emp_assets->allotted_date' placeholder='Allotted Date'>
        </div>
        </div>
        <div class='form-group'>
        <div class='input-group mb-3'>
        <input class='form-control' type='text' name='model_no' value='$emp_assets->model_no' placeholder='Model Number'>
        </div>
        </div>
        <div class='form-group'>
        <div class='input-group mb-3'>
        <input class='form-control' type='text' onfocus=(this.type='date') onblur=(this.type='text') name='return_date' value='$emp_assets->return_date' placeholder='Return Date'>
        </div>
        </div>
        <div class='form-group'>
        <div class='input-group mb-3'>
        <input class='form-control' type='text' name='remarks' value='$emp_assets->remarks' placeholder='Remarks'>
        </div>
        </div>
        <button type='button' class='btn btn-danger text-white ctm-border-radius' float-right ml-3' data-dismiss='modal'>Cancel</button>
        <button type='button' type='submit' class='btn btn-theme ctm-border-radius text-white float-right button-1 update_assets'  data-asset_id='$emp_assets->id'>Update</button>
        </form>
        </div>";
        return response()->json(['html' => $returnHTML]);
    }

    public function DeleteAssets(Request $request)
    {
        try {
            AssetModel::where('id', $request->assets_id)->delete();
            return response()->json(['status' => 200, 'success' => 'Assets Deleted Successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'error' => $e->getMessage()]);
        }
    }
    public function updatestatus(Request $request)
    {
        $user = Auth::user();
        $result =DB::table('assets')->where('id', $request->assets_id)->update(['status' => $request->status_change, 'action_by' => $user['name']]);
        if ($result) {
            return back()->with('success', 'Status Updated successfull');
        }
    }

     public function GenerateAssetsReport(Request $request)
    {   
          
         $emp_id= $request->emp_id;
         $from= date('Y-m-d',strtotime($request->from));
         $to= date('Y-m-d',strtotime($request->to));
        return Excel::download(new AssetExport($emp_id,$from,$to), 'assets.xlsx');
        
    }

}
