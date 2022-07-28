<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [

        //register your command
        Commands\cronAttendence::class,
        Commands\BirthdayEmail::class,
        Commands\EventCron::class,
        Commands\LogoutCron::class,

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        

           $schedule->command('Attendence:cron')->dailyAt('21:00');
           $schedule->command('Logout:cron')->dailyAt('20:00');
           $schedule->command('Event:cron')->dailyAt('1:00');




    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
