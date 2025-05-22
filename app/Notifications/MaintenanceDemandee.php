<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Maintenance;


class MaintenanceDemandee extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $maintenance;

    // Constructeur
    // pour initialiser la notification avec la demande de maintenance
    public function __construct(Maintenance $maintenance)
    {
        $this->maintenance = $maintenance;
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
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouvelle demande de maintenance')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Une nouvelle demande de maintenance a été soumise.')
            ->line('Logement : ' . $this->maintenance->logement->titre)
            ->line('Étudiant : ' . $this->maintenance->etudiant->name)
            ->line('Urgence : ' . $this->maintenance->urgence)
            ->line('Description : ' . $this->maintenance->description)
            ->action('Voir les demandes', route('proprietaire.maintenances.index'));
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



