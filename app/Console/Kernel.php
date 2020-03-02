<?php

namespace App\Console;

use DB;
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

    'App\Console\Commands\AnouncedWinner',
    'App\Console\Commands\UserNotification'

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        

        $schedule->command('Anounced:Winner')->dailyAt('8:50');
        $schedule->command('User:Notification')->dailyAt('8:50');



    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {

       // $this->load(__DIR__.'/Commands');


        require base_path('routes/console.php');
    }
}
