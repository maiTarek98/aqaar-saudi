<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Offer;

class NotifyWorkshopOfferNotification extends Notification
{
    use Queueable;

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
      return [
                'title'     =>  'لديك إشعار جديد عن  عروض الورش',
                'text'      =>  'تم إضافة عرض جديد  '. $this->msg->offer_title .' خاص بورشة ' .$this->msg->user->name ,
                'redirect'  => 'offers/'.$this->msg->id,
                'data'      => [ 
                    'coupon_id'  => $this->msg->id,
                    'offer_title'  => $this->msg->offer_title,
                    'username'  => $this->msg->user->name,
                    'coupon_status'  => $this->msg->coupon_status,
                    ],
                'user_id'    =>  $this->msg->user_id,
                'created_at' => $this->msg->created_at,
            ];    
        
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
