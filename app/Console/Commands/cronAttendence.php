<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\ClockInOut;
use Carbon\Carbon;
use App\Leave;
use App\Event;
class cronAttendence extends Command
{
/**
* The name and signature of the console command.
*
* @var string
*/
protected $signature = 'Attendence:cron';

/**
* The console command description.
*
* @var string
*/
protected $description = 'Command description';

/**
* Create a new command instance.
*
* @return void
*/
public function __construct()
{
  parent::__construct();
}

/**
* Execute the console command.
*
* @return mixed
*/
public function handle()
{

  $user=User::where('status',1)->get();
  $date = date('Y-m-d');
  foreach($user as $emp){
    $attendence=ClockInOut::where('emp_id',$emp->id)->whereDate('created_at',$date)->orderBy('id','DESC')->first();
    if(empty($attendence)){
      $date=date('Y-m-d');
      $events=Event::whereDate('start','<=',$date)->whereDate('end','>=',$date)->first();
      $checkleave=Leave::where('emp_id',$emp->id)->whereDate('from_date','<=',$date)->whereDate('to_date','>=',$date)->where('status',3)->first();
      if(!empty($checkleave)){
        $status=3;
      }else if(!empty($events) || date('D') == 'Sun'){
        $status=4;
      }
      else{
        $status=2;
      }
      $clock_in= new  ClockInOut;
      $clock_in->emp_id=$emp->id;
      $clock_in->status=$status;
      $clock_in->save();
    }
  }
}
}
