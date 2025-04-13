<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Request;
use App\Http\Traits\FcmFirebase;

class NotifyWorkshopRequestsNotification extends Notification
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
    
    public function __construct(Request $msg)
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
                'title'     =>  'لديك إشعار جديد خاص بالحجوزات',
                'text'      =>  'تم طلب خدمة '. $this->msg->request_no .' من ورشة '. $this->msg->vendor->name . ' بواسطة '. $this->msg->user->name ,
                'redirect'  =>  'requests',
                'data'      =>  [ 
                    'notification_type' => 5,
                    'request_id'        => $this->msg->id,
                    'request_no'        => $this->msg->request_no,
                    'user_name'         => $this->msg->user->name,
                    'vendor_name'       => $this->msg->vendor->name,
                    'status'            => $this->msg->status,
                    ],
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
    }
}
