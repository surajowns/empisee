<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\ClockInOut;

class LogoutCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Logout:cron';

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
        $time=date('H:i:s'); 
        foreach($user as $emp){
            $attendence=ClockInOut::where('emp_id',$emp->id)->where('clock_in','!=',null)->where('is_clock_in',1)->whereDate('created_at',$date)->orderBy('id','DESC')->first();
            if(!empty($attendence)){
                
                  ClockInOut::where('emp_id',$attendence['emp_id'])->whereDate('created_at',$date)->update(['is_clock_in'=>0,'clock_out'=> $time]);

                    $title="Clock Out Successfully";
                    $user=User::where('id',$attendence['emp_id'])->first();
                    sendLoginNotification($user,$title);
                 
            }
        }


    }
}
