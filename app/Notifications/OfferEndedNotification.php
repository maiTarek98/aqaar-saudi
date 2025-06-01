<?php

namespace App\Notifications;

use App\Models\PropertyAccessLink;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OfferEndedNotification extends Notification
{
    use Queueable;

    public $link;

    public function __construct(PropertyAccessLink $link)
    {
        $this->link = $link;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'شكرا لتوثيقكم.. انتهي العرض',
            'body' => 'تم إنهاء العرض الخاص بالعقار الذي تتابعه.',
            'url'  => 'propertys/' . $this->link?->property?->listing_number, // عدّل حسب اللينك الصحيح
        ];
    }
}
