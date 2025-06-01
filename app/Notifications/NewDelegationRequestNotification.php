<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Product;
use App\Http\Traits\FcmFirebase;
use App\Models\User;

class NewDelegationRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Product $property, public User $agent) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'طلب تفويض جديد',
            'body' => "الوكيل {$this->agent->name} طلب تفويض على العقار رقم {$this->property->listing_number}",
            'url' => route('property.show', $this->property->listing_number),
        ];
    }
}
