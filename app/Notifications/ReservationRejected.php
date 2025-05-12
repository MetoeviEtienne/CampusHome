<?php
namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ReservationRejected extends Notification
{
    use Queueable;

    public $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Réservation rejetée')
            ->line('Nous sommes désolés, votre réservation pour le logement "' . $this->reservation->logement->titre . '" a été rejetée par le propriétaire.')
            ->line('N’hésitez pas à rechercher d’autres logements sur la plateforme.')
            ->action('Voir d’autres logements', url('/logements')) // à adapter si nécessaire
            ->line('Merci pour votre compréhension.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'reservation_id' => $this->reservation->id,
            'logement' => $this->reservation->logement->titre,
            'statut' => 'rejetee',
        ];
    }
}
