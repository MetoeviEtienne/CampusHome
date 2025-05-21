<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Reservation;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NouvelleReservation extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
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
    public function toMail(object $notifiable): MailMessage
    {
        $etudiant = $this->reservation->etudiant;
        $logement = $this->reservation->logement;

        return (new MailMessage)
            ->subject('Nouvelle demande de réservation')
            ->greeting('Bonjour ' . $notifiable->nom)
            ->line("Une nouvelle demande a été envoyée pour votre logement : \"{$logement->titre}\".")
            ->line("Étudiant : {$etudiant->name}")
            ->line("Période : du {$this->reservation->date_debut} au {$this->reservation->date_fin}")
            ->action('Voir les réservations', url('/proprietaire/reservations'))
            ->line('Merci d’utiliser CampusHome.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'reservation_id' => $this->reservation->id,
            'etudiant' => $this->reservation->etudiant->name,
            'logement' => $this->reservation->logement->titre,
            'message' => 'Nouvelle demande de réservation reçue',
        ];
    }
}
