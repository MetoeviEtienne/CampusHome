<?php
namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ReservationApproved extends Notification
{
    use Queueable;

    public $reservation;

    /**
     * Créer une nouvelle instance.
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Définir les canaux de notification.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Contenu du mail.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Votre réservation a été approuvée')
            ->line('Bonne nouvelle ! Votre réservation pour le logement "' . $this->reservation->logement->titre . '" a été approuvée.')
            ->action('Voir les détails', url('/reservations/' . $this->reservation->id)) // URL à adapter
            ->line('Merci d’utiliser notre plateforme pour votre logement étudiant.');
    }

    /**
     * Représentation en tableau (facultatif).
     */
    public function toArray(object $notifiable): array
    {
        return [
            'reservation_id' => $this->reservation->id,
            'logement' => $this->reservation->logement->titre,
            'statut' => 'approuvee',
        ];
    }
}
