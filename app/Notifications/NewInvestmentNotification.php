<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewInvestmentNotification extends Notification
{
    use Queueable;

    protected $amount;
    protected $propertyTitle;

    public function __construct($amount, $propertyTitle)
    {
        $this->amount = $amount;
        $this->propertyTitle = $propertyTitle;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'مشاركة جديدة',
            'body' => 'تمت إضافة مشاركة جديدة بمبلغ ' . number_format($this->amount) . ' ريال في العقار ' . $this->propertyTitle,
        ];
    }
}
