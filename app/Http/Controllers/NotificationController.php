<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NotificationModel;
use App\Leave;
use Auth;
class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckSession');
        
    }
    public function Index(Request $request)
    {   
        try{
            $notification=NotificationModel::where('trash',0)->orderBy('id','DESC')->paginate(10);
            foreach($notification as $val){
                $seen_by[]=$val['seen_by'];
            }
            $emp_id=Auth::user()->id;
            return view('notification',compact('notification','emp_id'));
            }
        catch(\Exception $e){
            dd($e->getMessage);
        }
    }
    public function NotificationDetails(Request $request,$id=null)
    {
        $leave=Leave::with('employee')->where('id',$id)->first();
        $seen_by_id=Auth::user()->id;
        $seen_by=NotificationModel::where('type',$id)->first();
        $a=json_decode($seen_by['seen_by']);
        array_push($a,$seen_by_id);
        NotificationModel::where('type',$id)->update(['seen_by'=>json_encode(array_unique($a))]);
        return view('notification_details',compact('leave'));
    }
}
