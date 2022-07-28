<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Payment;
use Validator;
class PaymentController extends Controller
{
    public function  __construct() {
       
        $this->middleware('CheckSession');
        $this->middleware('CheckPermission');


     }

     public function Index(Request $request)
     {     $emp_assets=Payment::with('employee')->orderBy('id','DESC')->paginate(10);
           $employee=User::where('status',1)->get();
           return view('payment',compact('emp_assets','employee'));
     }


     public function UploadPayment(Request $request)
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
             'net_pay'=>'required|numeric',
             'month'=>'required',
         
         ]);
         if ($validate->fails()) {
             return response()->json([
                 'error' => $validate->messages()->first(),
                 'status' => 400,
             ]);
         }
         try{
         $data=$request->all();
         Payment::create($data);
         $last_data=Payment::with('employee')->orderBy('id','DESC')->first();
         return response()->json(['status'=>200,'last_data'=>$last_data,'success'=>'Payment Uploaded Successfully']);
         }
         catch(\Exception $e){
             return response()->json(['status'=>400,'error'=>$e->getMessage()]);
     
         }
     }
     

     public function UpdatePaymentModal(Request $request)
     {

      $emp_assets=Payment::with('employee')->where('id',$request->id)->first();
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
              <input class='form-control' type='number' name='net_pay' min='1' value='$emp_assets->net_pay' placeholder='Net Payable'>
          </div>
      </div>
      <div class='form-group'>
          <div class='input-group mb-3'>
              <input class='form-control' type='number' name='bonus' min='1' value='$emp_assets->bonus' placeholder='Bonus'>
          </div>
      </div>
      <div class='form-group'>
          <div class='input-group mb-3'>
              <input class='form-control' type='number' name='leave_without_pay' min='1' value='$emp_assets->leave_without_pay' placeholder='Leave Without Pay'>
          </div>
      </div>
      <div class='form-group'>
         <div class='input-group mb-3'>
             <input class='form-control' type='number' name='loan' min='1' value='$emp_assets->loan' placeholder='Loan'>
         </div>
      </div>
     <div class='form-group'>
         <div class='input-group mb-3'>
             <input class='form-control' type='number' name='other_deduction' min='1' value='$emp_assets->other_deduction' placeholder='other Deduction'>
         </div>
     </div>
      <div class='form-group'>
          <div class='input-group mb-3'>
              <input class='form-control' type='date' name='month'  value='$emp_assets->month' placeholder='Month'>
          </div>
      </div>
      <button type='button' class='btn btn-danger text-white ctm-border-radius' float-right ml-3' data-dismiss='modal'>Cancel</button>
      <button type='button' type='submit' class='btn btn-theme ctm-border-radius text-white float-right button-1 update_assets'  data-asset_id='$emp_assets->id'>Update</button>
    </form>
  </div>";
    return response()->json( ['html'=>$returnHTML]);    
         
     }


     public function UpdatePayment(Request $request)
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
            'net_pay'=>'required|numeric',
            'month'=>'required',
         ]);
         if ($validate->fails()) {
             return response()->json([
                 'error' => $validate->messages()->first(),
                  'status' => 400,
             ]);
         }
         try{
         $data=$request->except('id','_');
         Payment::where('id',$request->id)->update($data);
         return response()->json(['status'=>200,'success'=>'Payment Updated Successfully']);
         }
         catch(\Exception $e){
             return response()->json(['status'=>400,'error'=>$e->getMessage()]);
     
         }
     }



}
