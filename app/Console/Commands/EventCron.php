<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Event;
use Mail;

class EventCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Event:cron';

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
        $date=date('Y-m-d');
        $events=Event::whereDate('start',$date)->get()->toArray();

       if(!empty($events)){
        foreach($events as $value){
            // sendEventNotification($value);
                $data = array('events'=>$value);
                Mail::send('eventemail', $data, function($message) use ($value){
                $message->to('all@besthawk.com')->subject($value['title']);
                $message->from('hr@besthawk.com','Best Hawk');
            });
                sendEventNotification($value);
          }
        }
        
    }
}
