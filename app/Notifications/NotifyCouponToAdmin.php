<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Coupon;

class NotifyCouponToAdmin extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $msg;
    public function __construct(Coupon $msg)
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
                'title'      =>  'لديك إشعار جديد خاص بكوبونات الخصم',
                'text'       =>  'تم إضافة كوبون خصم جديد من قبل  '. $this->msg->admin?->name ,
                'redirect'   => 'coupons/'. $this->msg->id,
                'added_by'    =>  $this->msg->added_by,
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
