<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class InvestmentCompletedNotification extends Notification
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
            'title' => 'اكتمل الاستثمار',
            'body' => 'تم اكتمال الاستثمار في العقار ' . $this->propertyTitle . '. شكرًا لمشاركتك!',
        ];
    }
}
