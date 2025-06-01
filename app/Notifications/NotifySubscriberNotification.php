<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Subscriber;
use App\Http\Traits\FcmFirebase;
use Illuminate\Broadcasting\Channel;

class NotifySubscriberNotification extends Notification implements ShouldQueue
{
    use Queueable;
    use FcmFirebase;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $msg;
    public function __construct(Subscriber $msg)
    {
        $this->msg=$msg;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {  
        $tokens = [];
        $types  = [];
        
        $this->body_data =[
                'title'     =>  'لديك إشعار جديد خاص بالنشرة البريدية ',
                'text'      =>  'تم إرسال رسالة من   '. $this->msg->email ,
                'redirect'  => 'subscribers/#td-'.$this->msg->id,
                'created_at' => $this->msg->created_at,
                'data'       =>  [
                    'notification_type' => 2,
                    'id'                => $this->msg->id,
                ]
            ];    
            
        if($notifiable->is_notify == 'yes'){
            // foreach ($notifiable as $device) {
                $tokens[] = $notifiable->fcm_id ; 
            // }
            $this->sendFcmNotification( $tokens ,$this->body_data) ;
        }
        
      return $this->body_data;   

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
