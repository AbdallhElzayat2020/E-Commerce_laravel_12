<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
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
        $resetUrl = route('dashboard.password.show-reset-password-form', [
            'email' => $notifiable->email,
            'token' => $this->token
        ]);

        return (new MailMessage)
            ->subject('Password Reset - Dashboard')
            ->greeting('Hello ' . $notifiable->name)
            ->line('You have requested a password reset for your account.')
            ->line('If you did not request a password reset, you can ignore this email.')
            ->action('Reset Password', $resetUrl)
            ->line('This link is valid for 60 minutes only.')
            ->line('If you cannot click the button, you can copy and paste the following link into your browser:')
            ->line($resetUrl)
            ->salutation('Thank you');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'token' => $this->token,
            'email' => $notifiable->email,
        ];
    }
}
