<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioSmsMessage;

class SendCode extends Notification
{
    use Queueable;

    public $code = null;
    public $password = null;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($code, $password)
    {
        $this->code = $code;
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TwilioChannel::class];
        // return ['nexmo'];
    }

    public function toTwilio($notifiable)
    {
        return (new TwilioSmsMessage())
            ->content('Welcome to iView App, your entry Code is: ' . $this->code . ' and Password is: ' . $this->password);
    }

    /**
     * Get the Nexmo / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
                    ->content('Welcome to iView App, your entry Code is: ' . $this->code . ' and Password is: ' . $this->password);
    }

}
