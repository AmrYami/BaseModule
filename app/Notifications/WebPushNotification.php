<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Http\Request;

class WebPushNotification extends Notification
{

    use Queueable;


    /**
     * @var Request
     */
    private $data;

    public function __construct(Request $data)
    {

        $this->data = $data;
    }

    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable = [], $notification = [])
    {
        return (new WebPushMessage)
            ->title($this->data->title)
            ->icon($this->data->icon)
            ->body($this->data->body)
            ->action('View App', 'notification_action');
    }

}
