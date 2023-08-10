<?php

namespace App\Console;

use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\PaymentDataHandling;
use App\Models\User;



class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */


 
    protected function schedule(Schedule $schedule): void
    {
       
        $schedule->command('demo:cron')
        ->dailyAt('16:35');;
        $schedule->command('register:document')->dailyAt('16:35');;
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');


       

        
    }
}
