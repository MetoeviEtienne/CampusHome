<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LogementRejeteNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
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
    public function toMail($notifiable):MailMessage
        {
            return (new MailMessage)
                ->subject('Logement rejeté')
                ->greeting('Bonjour ' . $notifiable->name)
                ->line('Votre logement a été rejeté. Veuillez vérifier les informations ou contacter l’administration.')
                ->action('Modifier le logement', url('/proprietaire/logements'))
                ->line('Merci de votre compréhension.');
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