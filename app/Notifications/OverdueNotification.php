<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;

class OverdueNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $borrowRecord;

    // Constructor accepts BorrowRecord object
    public function __construct($borrowRecord)
    {
        $this->borrowRecord = $borrowRecord;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // Access the borrow record details directly
        $borrowRecord = $this->borrowRecord;
        $asset = $borrowRecord->asset; // Eager-loaded asset
        $borrowDate = Carbon::parse($borrowRecord->borrow_date); // Convert borrow_date to Carbon instance

        return (new MailMessage)
            ->subject('Overdue Asset Return Reminder')
            ->line("The asset **{$asset->item_name}** (Asset No. {$asset->asset_no}) is overdue for return.")
            ->line("Borrowed By: {$borrowRecord->borrowed_by}")
            ->line("Borrow Date: {$borrowDate->format('Y-m-d')}")
            ->action('Return Asset Now', route('departments.return', ['department' => $asset->department->id, 'asset_id' => $asset->id]))
            ->line('Please return the asset as soon as possible to avoid further delays.');
    }
}
