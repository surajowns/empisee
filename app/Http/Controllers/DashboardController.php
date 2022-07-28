<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
use Validator;
use App\User;
use App\Leave;
use App\EmployeeDetails;
use App\Event;
use App\Department;
use App\ClockInOut;
use App\Expense;
use App\LeaveDetails;

class DashboardController extends Controller
{
  public function __construct()
  {
    $this->middleware('CheckSession');
  }

  public function Dashboard(Request $request)
  {
    $date = date('Y-m-d');
    $employee = User::get();
    $todaybirthday = EmployeeDetails::with('emp_details')->whereDay('d_o_b', date('d'))->whereMonth('d_o_b', date('m'))->get()->toArray();
    $totalleave = Leave::with(['employee','leavetype'])->whereDate('from_date', '<=', $date)->whereDate('to_date', '>=', $date)->get()->toArray();
    $upcomingevent = Event::whereDate('start', '>', $date)->orderBy('start','ASC')->get();

    $total_clockin = ClockInOut::distinct('emp_id')->where('is_clock_in',1)->whereDate('created_at', $date)->count('emp_id');
    $Clockinemployee = ClockInOut::with('emp_details')->whereDate('created_at', $date)->where('is_clock_in',1)->get()->toArray();
       $todayevent = Event::whereDate('start', $date)->get();



    $todayexpense = Expense::with('employee')->whereDate('created_at', $date)->get()->toArray();



    $expensetatus = DB::table('expnse_status')->get();
    $leavestatus = DB::table('leave_status')->get();
    $empleaves = Leave::with(['employee','leavetype'])->orderBy('id', 'DESC')->limit(10)->get()->toArray();

    $teamlead = EmployeeDetails::with('emp_details', 'departments')->where('role', 7)->get();
     // dd($todayevent);
    return view('index', compact('employee', 'totalleave', 'todaybirthday','leavestatus','empleaves','upcomingevent', 'teamlead', 'Clockinemployee', 'total_clockin', 'todayexpense', 'expensetatus','todayevent'));
  }

  public function EmployeeDashboard(Request $request)
  {

    $date = date('Y-m-d');
    $employee = User::get();
    $todaybirthday = EmployeeDetails::with('emp_details')->whereDay('d_o_b', date('d'))->whereMonth('d_o_b', date('m'))->get()->toArray();
    $totalleave = Leave::with('employee','leavetype')->where('from_date', '<=', $date)->where('to_date', '>=', $date)->get()->toArray();
    $cl=0;
    $ml=0;
    $taken_leave=0;
    $cl_remaining=0;
    $ml_remaining=0;
    $leavetaken = Leave::where('emp_id', Auth::user()->id)->groupBy('leave_type')->selectRaw('count(*) as total,leave_type')->get();
    //  dd($leavetaken);
    $leavedetails=LeaveDetails::where('emp_id', Auth::user()->id)->first();

    $cl=$leavedetails['casual_leave'];
    $ml=$leavedetails['sick_leave'];
    $cl_remaining=$leavedetails['cl_taken'];
    $ml_remaining=$leavedetails['ml_taken'];
    $total_leave=$leavedetails['total_leave'];
    
    $total_Remaining= $cl_remaining+ $ml_remaining;

    $todayevent = Event::whereDate('start', $date)->get();


    $upcomingevent = Event::where('start', '>', $date)->get();
    // dd($upcomingevent);
    $teamlead = EmployeeDetails::with('emp_details', 'departments')->where('role', 7)->get();

    return view('emp_dashboard', compact('employee', 'totalleave', 'todaybirthday', 'upcomingevent', 'teamlead', 'leavetaken','cl','ml','total_leave','cl_remaining','ml_remaining','total_Remaining','todayevent'));
  }


  public function ChartData(Request $request)
  {
    $departmemt_list = Department::pluck('name');
    $departmemt_count = DB::table('employee_details')
      ->select('department', DB::raw('count(*) as total'))
      ->groupBy('department')
      ->get()->pluck('total');
    //  dd($emp_list);
    return response()->json(['success' => 'chart data', 'department_list' => $departmemt_list, 'departmemt_count' => $departmemt_count]);
  }
}
