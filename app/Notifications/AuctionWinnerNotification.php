<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AuctionWinnerNotification extends Notification
{
    use Queueable;

    protected $propertyTitle;
    protected $winningAmount;

    public function __construct($propertyTitle, $winningAmount)
    {
        $this->propertyTitle = $propertyTitle;
        $this->winningAmount = $winningAmount;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'مبروك! لقد فزت بالمزاد',
            'body' => 'لقد فزت بمزاد العقار "' . $this->propertyTitle . '" بمبلغ ' . number_format($this->winningAmount) . ' ريال.',
        ];
    }
}

