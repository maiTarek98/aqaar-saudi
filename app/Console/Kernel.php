<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Subscription;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        \App\Console\Commands\DeleteUncompletedSellForm::class,


    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('notify:deleteuncompleted')->daily();
        // $schedule->call(function () {
        //     // Get subscriptions that have expired and set status to inactive
        //     Subscription::where('status', 'active')
        //         ->where('next_payment_date', '<=', now())
        //         ->each(function ($subscription) {
        //             $subscription->status = 'inactive';
        //             $subscription->save();
        //         });
        // })->daily(); // Run daily to check for expired subscriptions
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
