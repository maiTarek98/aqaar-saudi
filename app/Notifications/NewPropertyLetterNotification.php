<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\ProductLetter;

class NewPropertyLetterNotification extends Notification
{
    use Queueable;

    public $letter;

    public function __construct(ProductLetter $letter)
    {
        $this->letter = $letter;
    }

    public function via($notifiable)
    {
        return ['database']; // أو ['mail', 'daلو فيه إيميل
    }

    public function toDatabase($notifiable)
    {
        $tokens = [];
        $types  = [];
        $user1 = \App\Models\User::find($this->letter->sender_id);
        $user2 = \App\Models\User::find($this->letter->receiver_id);
                        
        $this->body_data=
       [
                'title' => 'تم إرسال خطاب جديد',
                'body' => 'تم إرسال خطاب جديد بخصوص العقار رقم #' . $this->letter->product_id,
                'url'   => 'letter/' . $this->letter?->product_id.'/'.$user1->id.'/'.$user2->id, // عدلي الرابط حسب اللينك عندك
            ];    
        return $this->body_data;
    }
}
