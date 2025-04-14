<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Notifications\OverdueNotification;  

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $overdueRecords = \App\Models\BorrowRecord::whereNull('return_date')
                ->where('borrow_date', '<', now()->subDays(7))
                ->get();

            foreach ($overdueRecords as $record) {
                // Assuming each borrower has an associated User model for notifications
                $user = \App\Models\User::where('name', $record->borrowed_by)->first();
                if ($user) {
                    $user->notify(new OverdueNotification($record));
                }

            }
        })->daily();
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
