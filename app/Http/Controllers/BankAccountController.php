<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeSalary;
use App\BankAccount;
use App\User;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BankAccountDetailsExport;
class BankAccountController extends Controller
{
    public function  __construct()
    {
        $this->middleware('CheckSession');
        $this->middleware('CheckPermission');

    }

    public function Index(Request $request)
    {     $emp_assets=BankAccount::with('employee')->orderBy('id','DESC')->paginate(10);
          $employee=User::where('status',1)->get();
          return view('bank_account',compact('emp_assets','employee'));
    }

    public function UploadBankAccount(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'emp_id'=>'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'error' => 'Please Select Employee',
                'status' => 400,
            ]);
        }

        $validate=Validator::make($request->all(),[
            'account_full_name'=>'required',
            'bank_account_no'=>'required|unique:emp_bank_account,bank_account_no',
            'ifsc_code'=>'required',
            'branch_name'=>'required',
            'bank_name'=>'required',
            'address'=>'required',
            'pan_card_no'=>'required|unique:emp_bank_account,pan_card_no',
        
        ]);
        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->messages()->first(),
                'status' => 400,
            ]);
        }
        try{
        $already=BankAccount::where('emp_id',$request->emp_id)->first();
        $emp=User::where('id',$request->emp_id)->where('status',1)->first();
        if(!empty($already)){
            return response()->json(['status'=>400,'error'=>$emp['name'].' Bank Account Details Already Added']);
        }
        $data=$request->all();
        BankAccount::create($data);
        $last_data=BankAccount::with('employee')->orderBy('id','DESC')->first();
        return response()->json(['status'=>200,'last_data'=>$last_data,'success'=>'Bank Account Details Added']);
        }
        catch(\Exception $e){
            return response()->json(['status'=>400,'error'=>$e->getMessage()]);
    
        }
    } 


    public function ModalUpdateBankAccount(Request $request)
    {

     $emp_assets=BankAccount::with('employee')->where('id',$request->id)->first();
     $employee=User::where('status',1)->get();
     $list="";
     $selected="";
     foreach($employee as $values){
         if($values->id == $emp_assets->emp_id)
         {
              $selected='selected';
              $list .= "<option value='$values->id' $selected >".$values->name."</option>";     
         }else{
             $list .= "<option value='$values->id' >".$values->name."</option>";     
         }
     }
     $returnHTML="<div class='modal-body style-add-modal'>
     <button type='button' class='close' data-dismiss='modal'>&times;</button>
     <h4 class='modal-title mb-3'>Update assets to employee</h4>
    <form   method='POST'  id='update_form$emp_assets->id'> 
        <input type='hidden' name='id' value='$emp_assets->id' id='id'>
     <div class='form-group'>
         <div class='input-group mb-3'>
         <select class='form-control select'  id='emp_id' name='emp_id'>
         <option value=''>Select  Employee </option>"
         .$list."</select>
         </div>
     </div>
     <div class='form-group'>
         <div class='input-group mb-3'>
             <input class='form-control' type='text' name='account_full_name' min='1' value='$emp_assets->account_full_name' placeholder='Account Full Name'>
         </div>
     </div>
     <div class='form-group'>
         <div class='input-group mb-3'>
             <input class='form-control' type='number' name='bank_account_no' min='1' value='$emp_assets->bank_account_no' placeholder='Bank Account No'>
         </div>
     </div>
     <div class='form-group'>
         <div class='input-group mb-3'>
             <input class='form-control ifsc_code' type='text' name='ifsc_code' min='1' value='$emp_assets->ifsc_code' placeholder='IFSC Code'>
         </div>
     </div>
     <div class='form-group'>
        <div class='input-group mb-3'>
            <input class='form-control branch_name' type='text' name='branch_name' min='1' value='$emp_assets->branch_name' placeholder='Branch name'>
        </div>
     </div>
     <div class='form-group'>
     <div class='input-group mb-3'>
         <input class='form-control bank_name' type='text' name='bank_name' min='1' value='$emp_assets->bank_name' placeholder='Bank name'>
     </div>
  </div>
     <div class='form-group'>
     <div class='input-group mb-3'>
         <input class='form-control address' type='text' name='address' min='1' value='$emp_assets->address' placeholder='Branch name'>
     </div>
  </div>
    <div class='form-group'>
        <div class='input-group mb-3'>
            <input class='form-control' type='text' name='pan_card_no' min='1' value='$emp_assets->pan_card_no' placeholder='Pan Card No'>
        </div>
    </div>
    <div class='form-group'>
 <div class='input-group mb-3'>
     <input class='form-control' type='text' name='pf_or_uan_no' min='1' value='$emp_assets->pf_or_uan_no' placeholder='PF/UAN'>
 </div>
</div>
     <div class='form-group'>
         <div class='input-group mb-3'>
             <input class='form-control' type='text' name='esic_no' min='1' value='$emp_assets->esic_no' placeholder='ESIC No'>
         </div>
     </div>
     <button type='button' class='btn btn-danger text-white ctm-border-radius' float-right ml-3' data-dismiss='modal'>Cancel</button>
     <button type='button' type='submit' class='btn btn-theme ctm-border-radius text-white float-right button-1 update_assets'  data-asset_id='$emp_assets->id'>Update</button>
   </form>
 </div>";
   return response()->json( ['html'=>$returnHTML]);    
        
    }

    public function UpdateBankAccount(Request $request)
    {
         $validate=Validator::make($request->all(),[
               'emp_id'=>'required',
         ]);
         if ($validate->fails()) {
             return response()->json([
                 'error' => 'Please Select Employee',
                  'status' => 400,
             ]);
         }

        $validate=Validator::make($request->all(),[
            'account_full_name'=>'required',
            'bank_account_no'=>'required',
            'ifsc_code'=>'required',
            'branch_name'=>'required',
            'bank_name'=>'required',
            'address'=>'required',
            'pan_card_no'=>'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->messages()->first(),
                 'status' => 400,
            ]);
        }
        try{
            $already=BankAccount::where('emp_id',$request->emp_id)->get();
            $emp=User::where('id',$request->emp_id)->where('status',1)->first();
            if(count($already)<=0){
                return response()->json(['status'=>400,'error'=>'Please Add this Employee Bank Account Details and then  update']);
            }
        $data=$request->except('id','_');
        BankAccount::where('id',$request->id)->update($data);
        return response()->json(['status'=>200,'success'=>' Bank Account Details Updated']);
        }
        catch(\Exception $e){
            return response()->json(['status'=>400,'error'=>$e->getMessage()]);
    
        }
    }
     public function GenerateBankDetailsReport(Request $request)
    {   
          
        $emp_id= $request->emp_id;
        return Excel::download(new BankAccountDetailsExport($emp_id), 'salary.xlsx');
        
      }

}
