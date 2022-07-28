<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use validator;
use DB;
use App\ClockInOut;
use Auth;
use Carbon\Carbon;

class ClockInOutController extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckSession');
        $this->middleware('CheckPermission');

    }
    public function EmpClockIn(Request $request)
    {  
        try{

            $user=Auth::user();
            $time=date('H:i:s',time());
            $clockintime =date('H', time());
            if($clockintime > 9 && $clockintime < 12){
                $status=5;
            }elseif($clockintime>12){
                $status=6;
            }else{
                $status=1;
            }

            $clock_in=new  ClockInOut; 
            $clock_in->emp_id=$user['id'];
            $clock_in->clock_in=$time;
            $clock_in->comment=$request->comment;
            $clock_in->is_clock_in=1;
            $clock_in->status=$status;
            $clock_in->save();
            $data=ClockInout::where('emp_id',$user['id'])->orderBy('id','DESC')->first();
             $title="Clock In Successfully";
            sendLoginNotification($user,$title);
            return response()->json(['success'=>'Clock in Successfully','status'=>200,]);

        }
          catch(Exception $e){
              return response()->json(['error'=>$e->getMessage(),'status'=>400]);
          }
         
          

    }

    public function EmpClockOut(Request $request)
    {
        try{

            $user=Auth::user();
            $clock_out=date('H:i');
            $clock_in=ClockInOut::where('emp_id',$user['id'])->orderBy('id','DESC')->first();
            ClockInOut::where('id',$clock_in['id'])->where('emp_id',$clock_in['emp_id'])->update(['clock_out'=>$clock_out,'is_clock_in'=>'0']); 
             $title="Clock Out Successfully";
            sendLoginNotification($user,$title);
            return response()->json(['success'=>'Clock  Out Successfully','status'=>200,]);

        }
          catch(Exception $e){
              return response()->json(['error'=>$e->getMessage(),'status'=>400]);
          }
    }

    public function export(Request $request)
    {
       return Excel::download(new UsersExport, 'attendence.xlsx');

    }
}
