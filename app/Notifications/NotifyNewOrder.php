<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;
use App\Http\Traits\FcmFirebase;

class NotifyNewOrder extends Notification
{
    use Queueable;
    use FcmFirebase;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $msg;
    private $body_data;
    
    public function __construct(Reservation $msg)
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
                'title'     =>  'لديك إشعار جديد خاص بالطلبات',
                'text'      =>  'طلب جديد برقم  '. $this->msg->order_no .' ملاحظة : '. $this->msg->notes ,
                'redirect'  => 'orders/'. $this->msg->id,
                'data'      => [ 
                    'notification_type' => 3,
                    'order_id'          => $this->msg->id,
                    'order_no'          => $this->msg->order_no,
                    'user_name'         => $this->msg->user->name,
                    'store_name'        => $this->msg->store->name,
                    'status'            => $this->msg->status,
                    ],
                'created_at' => $this->msg->created_at,
            ];    
            
        if($notifiable){
            // foreach ($notifiable as $device) {
                $tokens[] = $notifiable->fcm_id ; 
            // }
            // $this->sendFcmNotification( $tokens ,$this->body_data) ;
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
    }
}
