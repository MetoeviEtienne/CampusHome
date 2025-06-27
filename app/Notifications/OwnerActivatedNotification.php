<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OwnerActivatedNotification extends Notification
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
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Votre compte CampusHome est ré-activé')
            ->greeting('Bonjour '.$notifiable->name.',')
            ->line('Bonne nouvelle ! Votre compte vient d’être **ré-activé**. Vous pouvez à nouveau vous connecter.')
            ->salutation('L’équipe CampusHome');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
       return ['title' => 'Compte ré-activé', 'message' => 'Votre compte est de nouveau actif.'];
    }
}
