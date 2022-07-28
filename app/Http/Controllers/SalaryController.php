<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AssetModel;
use App\EmployeeSalary;
use Validator;
use PDF;
use App\BankAccount;
use App\Payment;
use App\Department;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalaryExpot;
use Mail;
class SalaryController extends Controller
{

       public function  __construct() {
       
          $this->middleware('CheckSession');
          $this->middleware('CheckPermission');


       }

       public function Index(Request $request)
       {     $emp_assets=EmployeeSalary::with('employee')->orderBy('id','DESC')->paginate(10);
             $employee=User::where('status',1)->get();
             return view('salary',compact('emp_assets','employee'));
       }

        public function SalarySlip(Request $request,$id=null)
        {     
                $emp_payments=Payment::with('employee','employee.emp_details')->where('id',$id)->first();
                $salry_details=EmployeeSalary::where('emp_id',$emp_payments['emp_id'])->first();
                $employee=User::where('id',$emp_payments['emp_id'])->first();
                $department=Department::where('id',$emp_payments->employee->emp_details[0]['department'])->first();
                $emp_bank_details=BankAccount::where('emp_id',$emp_payments['emp_id'])->first();
                
                $total_leave=$emp_payments['leave_without_pay'];
                $gross_salary=$salry_details['emp_salary'];
                $one_daysalary=$gross_salary/26; 
                $total_detuction=number_format($total_leave*$one_daysalary+$salry_details['tds']+$salry_details['pf']+$salry_details['esic']+$emp_payments['other_deduction']+$emp_payments['loan'],2);

                $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('salary_slip',compact('emp_payments','department','salry_details','emp_bank_details','total_detuction'));
                return $pdf->download($employee['name'].' '.date('F Y',strtotime($emp_payments['month'])).' salary slip.pdf');
        }

        public function EmployeeSalary(Request $request)
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
                'basic_salary'=>'required|numeric',
                'hra'=>'required|numeric',
                'mix_allowance'=>'required|numeric',
                // 'mobile_expenses'=>'required|numeric',
                // 'pf'=>'required|numeric',
                'emp_salary'=>'required|numeric',
            
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'error' => $validate->messages()->first(),
                    'status' => 400,
                ]);
            }
            try{
            $data=$request->all();
            EmployeeSalary::create($data);
            $last_data=AssetModel::with('employee')->orderBy('id','DESC')->first();
            return response()->json(['status'=>200,'last_data'=>$last_data,'success'=>'Assets Assigned Successfully']);
            }
            catch(\Exception $e){
                return response()->json(['status'=>400,'error'=>$e->getMessage()]);
        
            }
        } 
        public function ModalForUpdate(Request $request)
        {
 
         $emp_assets=EmployeeSalary::with('employee')->where('id',$request->id)->first();
         $employee=User::get();
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
                 <input class='form-control' type='number' name='emp_salary' min='1' value='$emp_assets->emp_salary' placeholder='Gross Salary'>
             </div>
         </div>
         <div class='form-group'>
             <div class='input-group mb-3'>
                 <input class='form-control' type='number' name='basic_salary' min='1' value='$emp_assets->basic_salary' placeholder='Basic Salary'>
             </div>
         </div>
         <div class='form-group'>
             <div class='input-group mb-3'>
                 <input class='form-control' type='number' name='hra' min='1' value='$emp_assets->hra' placeholder='House Rent Allowance'>
             </div>
         </div>
         <div class='form-group'>
            <div class='input-group mb-3'>
                <input class='form-control' type='number' name='medical_allowance' min='1' value='$emp_assets->medical_allowance' placeholder='Medical Allowance'>
            </div>
         </div>
        <div class='form-group'>
            <div class='input-group mb-3'>
                <input class='form-control' type='number' name='conveyance' min='1' value='$emp_assets->conveyance' placeholder='Conveyance'>
            </div>
        </div>
         <div class='form-group'>
             <div class='input-group mb-3'>
                 <input class='form-control' type='number' name='mix_allowance' min='1' value='$emp_assets->mix_allowance' placeholder='Other Allowance'>
             </div>
         </div>
         <div class='form-group'>
         <div class='input-group mb-3'>
             <input class='form-control' type='number' name='tds' min='1' value='$emp_assets->tds' placeholder='TDS'>
         </div>
     </div>
     <div class='form-group'>
     <div class='input-group mb-3'>
         <input class='form-control' type='number' name='pf' min='1' value='$emp_assets->pf' placeholder='PF'>
     </div>
    </div>
    <div class='form-group'>
     <div class='input-group mb-3'>
         <input class='form-control' type='number' name='esic' min='1' value='$emp_assets->esic' placeholder='ESIC'>
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
       return response()->json( ['html'=>$returnHTML]);    
            
        }


        public function UpdateSalary(Request $request)
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
                'basic_salary'=>'required|numeric',
                'hra'=>'required|numeric',
                'mix_allowance'=>'required|numeric',
                // 'mobile_expenses'=>'required|numeric',
                // 'tds'=>'required|numeric',
                // 'pf'=>'required|numeric',
                'emp_salary'=>'required|numeric',
             
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'error' => $validate->messages()->first(),
                     'status' => 400,
                ]);
            }
            try{
            $data=$request->except('id','_');
            EmployeeSalary::where('id',$request->id)->update($data);
            return response()->json(['status'=>200,'success'=>'Assets Updated Successfully']);
            }
            catch(\Exception $e){
                return response()->json(['status'=>400,'error'=>$e->getMessage()]);
        
            }
        }
           
             public function GenerateSalaryReport(Request $request)
        {   
              
             $emp_id= $request->emp_id;
            //  $from= date('Y-m-d',strtotime($request->from));
            //  $to= date('Y-m-d',strtotime($request->to));
           
            return Excel::download(new SalaryExpot($emp_id), 'salary.xlsx');
            
        }
        public function SendOnEmailSalarySlip(Request $request,$id=null)
        {
            $emp_payments=Payment::with('employee','employee.emp_details')->where('id',$id)->first();
            $salry_details=EmployeeSalary::where('emp_id',$emp_payments['emp_id'])->first();
            $employee=User::where('id',$emp_payments['emp_id'])->first();
            $department=Department::where('id',$emp_payments->employee->emp_details[0]['department'])->first();
            $emp_bank_details=BankAccount::where('emp_id',$emp_payments['emp_id'])->first();
            
            $total_leave=$emp_payments['leave_without_pay'];
            $gross_salary=$salry_details['emp_salary'];
            $one_daysalary=$gross_salary/26; 
            $total_detuction=number_format($total_leave*$one_daysalary+$salry_details['tds']+$salry_details['pf']+$salry_details['esic']+$emp_payments['other_deduction']+$emp_payments['loan'],2);
             
            $salarymonth=date('M Y',strtotime($emp_payments['month']));
            // dd($salarymonth);

            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('salary_slip',compact('emp_payments','department','salry_details','emp_bank_details','total_detuction'));
            $data=array('employee'=>$employee,'salarymonth'=>$salarymonth);
            Mail::send('salary_slip_email',$data,function($message) use ($pdf,$salarymonth,$employee) {
                $message->to($employee['email'])->subject('salary slip of '.$salarymonth);
                $message->from('hr@besthawk.com','Best Hawk');
                $message->attachData($pdf->output(), "salary_slip.pdf");
                });
            Payment::where('id',$id)->update(['email_sent'=>1]);
            return back()->with('success','salary slip send successfully');
            
            // return $pdf->download($employee['name'].' '.date('F Y',strtotime($emp_payments['month'])).' salary slip.pdf');
        }
        
 

}
