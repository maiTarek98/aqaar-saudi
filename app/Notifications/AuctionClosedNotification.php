<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AuctionClosedNotification extends Notification
{
    use Queueable;

    protected $propertyTitle;
    protected $winningAmount;
    protected $winnerName;

    public function __construct($propertyTitle, $winningAmount = null, $winnerName = null)
    {
        $this->propertyTitle   = $propertyTitle;
        $this->winningAmount   = $winningAmount;
        $this->winnerName      = $winnerName;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        if ($this->winningAmount && $this->winnerName) {
            $body = 'تم إغلاق مزاد "' . $this->propertyTitle . '"، والفائز هو: ' . $this->winnerName . ' بمبلغ ' . number_format($this->winningAmount) . ' ريال.';
        } else {
            $body = 'تم إغلاق مزاد "' . $this->propertyTitle . '" دون وجود أي مزايدات.';
        }

        return [
            'title' => 'تم إغلاق المزاد',
            'body' => $body,
        ];
    }
}
