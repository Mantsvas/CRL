<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\UpdateCWResults;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\UpdateCWResults'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command(UpdateCWResults::class)->everyTenMinutes();
        $schedule->command(UpdateClanPlayers::class)->twiceDaily(10, 22)->timezone('Europe/Vilnius');
        $schedule->command(UpdateRiverRaceLog::class)->weeklyOn(1, '13:00')->timezone('Europe/Vilnius');
        $schedule->command(UpateLocations::class)->quarterly()->timezone('Europe/Vilnius');
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
