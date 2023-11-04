<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerificationMail extends Notification
{
    use Queueable;

    protected $user;

    protected $hash;

    protected $guard;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $hash, $guard)
    {
        $this->user = $user;
        $this->hash = $hash;
        $this->guard = $guard;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Click the button below to verify your email address:')
            ->action('Verify Email', config('app.frontend_url').'/verifyEmail?email='.$this->user->email.'&hash='.$this->hash.'&guard='.$this->guard)
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
