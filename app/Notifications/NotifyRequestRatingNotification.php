<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Rating;
use App\Http\Traits\FcmFirebase;

class NotifyRequestRatingNotification extends Notification
{
    use Queueable;
    use FcmFirebase;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $msg;
    public function __construct(Rating $msg)
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
        
        $this->body_data = [
                'title'     =>  'لديك إشعار جديد خاص بالتقييمات',
                'text'      =>  'تم تقييم الحجز رقم '. $this->msg->request->request_no .' من  '. $this->msg->user->name ,
                'redirect'  => 'users/show_overall_rate/'. $this->msg->vendor_id,
                'data'      => [ 
                    'notification_type' => 2,
                    'request_id'        => $this->msg->request_id,
                    'request_no'        => $this->msg->request->request_no,
                    'user_name'         => $this->msg->user->name,
                    'vendor_name'       => $this->msg->vendor->name,
                    ],
                'user_id'    =>  $this->msg->user_id,
                'created_at' => $this->msg->created_at,
            ];  
            
        if($notifiable){
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
