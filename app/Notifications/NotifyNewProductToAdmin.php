<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Product;

class NotifyNewProductToAdmin extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $msg;
    public function __construct(Product $msg)
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

 
     public function toDatabase($notifiable)
    {
        $tokens = [];
        $types  = [];
        
         $this->body_data = [
                'title'     =>  'لديك إشعار جديد خاص بإضافة عقار جديد',
                'text'      =>  'تم إضافة عقار جديد  '.$this->msg->title .' ونوع النظام '. __('main.products.'.$this->msg->type) ,
                'redirect'  => 'products/'.$this->msg->id,
                'data'      => [ 
                    'notification_type'     => 3,
                    'product_id'            => $this->msg->id,
                    'listing_number'        => $this->msg->listing_number,
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
        return [
            //
        ];
    }
}
