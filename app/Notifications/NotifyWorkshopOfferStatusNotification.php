<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Offer;
use App\Http\Traits\FcmFirebase;

class NotifyWorkshopOfferStatusNotification extends Notification
{
    use Queueable;
    use FcmFirebase;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $msg;
    public function __construct(Offer $msg)
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
                'title'      =>  'لديك إشعار جديد عن العروض',
                'text'       =>  'تم تحديث حالة العرض  '. $this->msg->offer_title .' إلى '.  status_offers_trans($this->msg->offer_status),
                'created_at' => $this->msg->created_at,
                'data'       => [ 
                    'notification_type' => 4,
                    'id'                => $this->msg->id,
                    'offer_title'       => $this->msg->offer_title,
                    'user_name'         => $this->msg->user->name,
                    'status'            => status_offers_trans($this->msg->offer_status),
                    ],
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
