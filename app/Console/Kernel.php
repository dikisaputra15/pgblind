<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\AutoStatistik::class,
        \App\Console\Commands\Incident::class,
        \App\Console\Commands\Subincident::class,
        \App\Console\Commands\Socialconflict::class,
        \App\Console\Commands\Weapon::class,
        \App\Console\Commands\Explosive::class,
        \App\Console\Commands\Actor::class,
        \App\Console\Commands\Actortype::class,
        \App\Console\Commands\Subactortype::class,
        \App\Console\Commands\Target::class,
        \App\Console\Commands\Targettype::class,
        \App\Console\Commands\Tanggal::class,
        \App\Console\Commands\Violence::class,
    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('task:runcategory')->everyTenMinutes();;

        $schedule->command('task:runincident')->everyFifteenMinutes();

        $schedule->command('task:runsubincident')->everyFifteenMinutes();

        $schedule->command('task:runsocialconflict')->everyFifteenMinutes();

        $schedule->command('task:runweapon')->everyFifteenMinutes();

        $schedule->command('task:runactor')->everyFifteenMinutes();

        $schedule->command('task:runactortype')->everyFifteenMinutes();

        $schedule->command('task:runtarget')->everyFifteenMinutes();

        $schedule->command('task:runtargettype')->everyFifteenMinutes();

        $schedule->command('task:runtanggal')->everyFifteenMinutes();

        $schedule->command('task:runsubactortype')->everyFifteenMinutes();

        $schedule->command('task:runexplosive')->everyFifteenMinutes();

        $schedule->command('task:runviolence')->everyFifteenMinutes();
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
