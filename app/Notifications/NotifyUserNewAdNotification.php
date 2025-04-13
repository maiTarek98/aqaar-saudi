<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Ad;

class NotifyUserNewAdNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $msg;
    public function __construct(Ad $msg)
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
                'title'     =>  'لديك إشعار جديد بإعلانات المستخدمين',
                'text'      =>  'تم إضافة إعلان جديد '. $this->msg->ad_name .' من قبل  '. $this->msg->user->name ,
                'redirect' => 'ads/'.$this->msg->id,
                'data'      => [ 
                    'id'              => $this->msg->id,
                    'user_name'       => $this->msg->user->name,
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
