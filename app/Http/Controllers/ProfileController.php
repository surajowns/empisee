<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Department;
use Validator;
use Session;
use App\Sidebar;
use App\ClockInOut;
use DB;
use App\Leave;
use App\Event;
use App\Document;
use App\BankAccount;
use App\EmployeeSalary;
use App\Payment;
class ProfileController extends Controller
{
   public function __construct()
    {
        $this->middleware('CheckSession');
        $this->middleware('CheckPermission');

    }
     public function Index(Request $request)
     {
        $user=Auth::user();
        $data=User::with('emp_details')->where('id',$user['id'])->first()->toArray();
        $department=Department::where('id',$data['emp_details'][0]['department'])->first();
        $department_name=$department['name'];
        Session::put('emp_id',$user->id);
        return view('profile',compact('data','department_name'));

     }
     public function YourProfile(Request $request)
     {  
         Session::forget('emp_id');
        
         $id=Auth::user()->id;
         $side_bar=Sidebar::with(['sidebar_permission'=>function($query) use ($id)
         {
            $query->select('*')->where('emp_id',);
         }])->where('parent_id',0)->get()->toArray();

         $employee=User::with('roles')->where('id',$id)->first();

         $other_permission=Sidebar::with(['sidebar_permission'=>function($query) use ($id)
         {
            $query->select('*')->where('emp_id',$id);
         }])->where('parent_id','!=',0)->get()->toArray();



      $user=Auth::user();
      $data=User::with('emp_details','last_comapny_details')->where('id',$user['id'])->first()->toArray();
      $department=Department::where('id',$data['emp_details'][0]['department'])->first();
      $department_name=$department['name'];

      // $employee=User::where('id',$id)->first();
      $report=ClockInOut::with('attendence_status')->where('emp_id',$id)->orderBy('id','DESC')->get();
      $attendencestatus=DB::table('attendence_status')->get();


      $date=date('Y-m-d');
      $leavestatus=DB::table('leave_status')->get();
      $empleaves=Leave::with('employee')->where('emp_id',$id)->orderBy('id','DESC')->get()->toArray();
      $upcommingholidays=Event::where('start','>',$date)->get();
      $holidayhistory=Event::where('start','<',$date)->get();


      $document=Document::where('emp_id',$id)->get()->toArray();

      $emp_bank_account=BankAccount::where('emp_id',$id)->first();
      $emp_salary=EmployeeSalary::where('emp_id',$id)->first();
      $emp_payment=Payment::where('emp_id',$id)->get();

// dd($emp_bank_account);

      $emp_id=Auth::user()->id;

      return view('emp_profile',compact('data','department_name','side_bar','emp_id','employee','other_permission','report','attendencestatus','leavestatus','empleaves','upcommingholidays','holidayhistory','document','emp_bank_account','emp_salary','emp_payment'));

     }

     public function ProfileSetting(Request $request,$id=null)
     {
           
           $user=Auth::user();
           $data=User::with('emp_details')->where('id',isset($id)?$id:$user['id'])->first()->toArray();
           return view('profile_setting',compact('data'));

      //   return back()->with(['success'=>'profile update Succussfully']);

     }

     public function updateProfile(Request $request)
     {
            $validate=Validator::make($request->all(),[
                   "name"=>'required',
                   "email"=>'required',
                   "mobile"=>'required',
              ]);

              if($validate->fails()){
               return response()->json([
                  'error' => $validate->messages()->first(),
                   'status' =>400,
                 ]);
              }

              try{
                 if(Session::get('emp_id')){
                  $emp_id=Session::get('emp_id');

                 }else{
                  $emp_id=Auth::user()->id;

                 }

               $data=$request->only(['name','email','mobile']);

               $check_email=User::where('id','!=',$emp_id)->where('email',$data['email'])->first();
               if($check_email){
                  return response()->json([
                     'error' => "Email already in use ",
                      'status' =>400,
                    ]);
               }
               $check_mobile=User::where('id','!=',$emp_id)->where('mobile',$data['mobile'])->first();
               if($check_mobile){
                  return response()->json([
                     'error' => "Mobile no Already in use ",
                      'status' =>400,
                    ]);
               }
               // dd($data);
               User::where('id',$emp_id)->update($data);
               return response()->json(['success'=>'Profile Updated Successfully','status'=>200,]);
              }
             catch(Exception $e){
                 return response()->json(['error'=>$e->getMessage(),'status'=>400]);
             }
              
     }

     public function updatePassword(Request $request)
     {

            $validate=Validator::make($request->all(),[
               "current_password"=>'required',
               "password"=>'required',
               "repeat_password"=>'required|same:password',
         ]);

         if($validate->fails()){
         return response()->json([
            'error' => $validate->messages()->first(),
               'status' =>400,
            ]);
         }

            try{
           
            if(Session::get('emp_id')){
               $emp_id=Session::get('emp_id');
            }else{
               $emp_id=Auth::user()->id;
            }
            $data=$request->only('password');
            $password=bcrypt($data['password']);
            User::where('id',$emp_id)->update(['password'=>$password]);
            return response()->json(['success'=>'Password Updated Successfully','status'=>200,]);
            }
            catch(Exception $e){
               return response()->json(['error'=>$e->getMessage(),'status'=>400]);
            }

     }


     public function updateImage(Request $request)
     {
     
      $validate=Validator::make($request->all(),[
         "profile_image"=>'required|mimes:jpeg,jpg,png',
       ]);

      if($validate->fails()){
      return response()->json([
         'error' => $validate->messages()->first(),
            'status' =>400,
         ]);
      }
      try{
      $user=Auth::user();
      if(Session::get('emp_id')){
         $emp_id=Session::get('emp_id');
      }else{
         $emp_id=$user->id;
      }
      $data=$request->only('profile_image');
      if($request->hasFile('profile_image')){
         $image = $request->file('profile_image');
         $name = time().'.'.$request->file('profile_image')->getClientOriginalExtension();
         $destinationPath = public_path('/profile');
         $image->move($destinationPath, $name);
         $deletefile=User::where('id',$emp_id)->first();
           if($deletefile['profile_image']){
             unlink(public_path('profile/'.$deletefile['profile_image']));
           }
     }
     

      User::where('id',$emp_id)->update(['profile_image'=>$name]);
      return response()->json(['success'=>'Profile Updated Successfully','status'=>200,]);
      }
      catch(Exception $e){
         return response()->json(['error'=>$e->getMessage(),'status'=>400]);
      }
     }

}
