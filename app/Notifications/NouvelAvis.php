<?php

namespace App\Notifications;

use App\Models\Avis;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Notifications\NouvelAvis;

class NouvelAvis extends Notification 
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $avis;

    public function __construct(Avis $avis)
    {
        $this->avis = $avis;
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
            ->subject('Nouveau avis reçu')
            ->greeting('Bonjour ' . $notifiable->name)
            ->line('Vous avez reçu un nouvel avis concernant votre logement : "' . ($this->avis->logement->titre ?? 'Logement supprimé') . '".')
            ->line('Commentaire : "' . $this->avis->commentaire . '"')
            ->action('Voir les avis', route('proprietaire.avis.index'))
            ->line('Merci d’utiliser CampusHome !');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'Vous avez reçu un nouvel avis sur l’un de vos logements.',
            'logement_id' => $this->avis->logement_id,
            'avis_id' => $this->avis->id,
        ];
    }
}