<?php

namespace App\Console;

use App\Http\Controllers\copy;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Sykez\CronlessScheduler\CronlessSchedule;
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
       $schedule->command('app:copy_com')->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected $commands = [

        Commands\copy_com::class,
     
     ];
     protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    
}
