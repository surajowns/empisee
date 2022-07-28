<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\EmployeeDetails;
use Mail;
class BirthdayEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Birthday:cron';

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
         $date=date('y-m-d');
         $todaybirthay=EmployeeDetails::where('d_o_b',$date)->get();
      
       foreach($todaybirthay as $value){
  
        $user=User::where('id',$value->emp_id)->first();    
            $to_name  =  $user['name'];
            $to_email =$user['email'];
            $data = array('user'=>$user);
            Mail::send('leave_mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Happy Birthday '. $to_name);
            $message->from('pramodbit254@gmail.com','Best Hawk');
        });

    }

       
    }
}
