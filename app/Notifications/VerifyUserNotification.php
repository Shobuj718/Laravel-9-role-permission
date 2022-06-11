<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyUserNotification extends Notification
{
    use Queueable;

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->line(trans('global.verifyYourUser'))
            ->action(trans('global.clickHereToVerify'), route('userVerification', $this->user->verification_token))
            ->line(trans('global.thankYouForUsingOurApplication'));
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
