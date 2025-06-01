<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AuctionEndedNotification extends Notification
{
    use Queueable;

    protected $propertyTitle;

    public function __construct($propertyTitle)
    {
        $this->propertyTitle = $propertyTitle;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'تم إغلاق المزاد',
            'body'  => 'تم إغلاق مزاد "' . $this->propertyTitle . '". شكراً لمشاركتك!',
        ];
    }
}
