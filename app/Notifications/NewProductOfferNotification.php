<?php

namespace App\Notifications;

use App\Models\ProductOffer;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

class NewProductOfferNotification extends Notification
{
    use Queueable;

    public $offer;

    public function __construct(ProductOffer $offer)
    {
        $this->offer = $offer;
    }

    public function via($notifiable)
    {
        return ['database']; // لو حابب تضيف mail ضيفها هنا
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'عرض جديد على العقار',
            'body' => 'قام ' . $this->offer->user->name . ' بتقديم عرض على عقارك بقيمة ' . number_format($this->offer->amount) . ' ريال.',
            'url'   => 'propertys/' . $this->offer?->product->listing_number, // عدلي الرابط حسب اللينك عندك
        ];
    }
}
