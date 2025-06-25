<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VisiteRejetee extends Notification
{
    use Queueable;

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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // app/Notifications/VisiteRejetee.php

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Votre visite a été rejetée')
            ->greeting('Bonjour ' . $notifiable->name)
            ->line("La visite pour le logement \"{$this->reservation->logement->titre}\" a été rejetée par le propriétaire.")
            ->action('Voir les détails', url('/etudiant/reservations'))
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
