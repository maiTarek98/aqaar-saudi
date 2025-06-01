<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\ProductLetter;
use App\Http\Traits\FcmFirebase;

class AdminPendingLetterNotification extends Notification
{
    use Queueable, FcmFirebase;

    private $letter;

    public function __construct(ProductLetter $letter)
    {
        $this->letter = $letter;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $tokens = [];

        $this->body_data = [
            'title'      => 'خطاب جديد في انتظار المراجعة',
            'text'       => 'تم إرسال خطاب جديد بخصوص العقار: ' . $this->letter->product->title,
            'redirect'   => 'products/' . $this->letter->product_id.'/letters',
            'created_at' => $this->letter->created_at,
            'data'       => [
                'notification_type' => 'pending_letter',
                'letter_id'         => $this->letter->id,
                'product_id'        => $this->letter->product_id,
                'sender_name'       => $this->letter->sender->name ?? '',
                'type'              => $this->letter->type,
                'message'           => $this->letter->message,
            ]
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
