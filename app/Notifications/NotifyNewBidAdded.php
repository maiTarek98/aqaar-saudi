<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Traits\FcmFirebase;

class NotifyNewBidAdded extends Notification
{
    use Queueable;
    use FcmFirebase;

    private $property;
    private $amount;

    public function __construct(Product $property, $amount)
    {
        $this->property = $property;
        $this->amount = $amount;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $tokens = [];

        $this->body_data = [
            'title'      => 'تمت إضافة مزايدة جديدة',
            'body'       => 'تم تقديم عرض جديد على العقار: ' . $this->property->title . ' بقيمة ' . $this->amount,
            'url'   => 'propertys/' . $this->property->listing_number, // عدلي الرابط حسب اللينك عندك
        ];

        if ($notifiable && $notifiable->fcm_id) {
            // $tokens[] = $notifiable->fcm_id;
            // $this->sendFcmNotification($tokens, $this->body_data);
        }

        return $this->body_data;
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
