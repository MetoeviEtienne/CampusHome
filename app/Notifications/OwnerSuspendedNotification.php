<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OwnerSuspendedNotification extends Notification
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
            ->subject('Votre compte CampusHome est suspendu')
            ->greeting('Bonjour '.$notifiable->name.',')
            ->line('Votre compte a été **suspendu** par l’équipe d’administration.')
            ->line('Vous ne pourrez plus accéder à votre tableau de bord tant que votre compte restera suspendu.')
            ->line('Pour toute question, répondez directement à ce courriel.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
       return ['title' => 'Compte suspendu', 'message' => 'Votre compte est suspendu.'];
    }
    
}
