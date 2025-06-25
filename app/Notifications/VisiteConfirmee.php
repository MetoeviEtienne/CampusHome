<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;


class VisiteConfirmee extends Notification 
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
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //         ->line('The introduction to the notification.')
    //         ->action('Notification Action', url('/'))
    //         ->line('Thank you for using our application!');
    // }


    public function toMail($notifiable)
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Votre visite a été confirmée')
            ->greeting('Bonjour ' . $notifiable->name)
            ->line("La visite de votre réservation pour le logement \"{$this->reservation->logement->titre}\" a été confirmée.")
            ->line("📅 Date : " . \Carbon\Carbon::parse($this->reservation->visite_date)->format('d/m/Y') .
                " à " . \Carbon\Carbon::parse($this->reservation->visite_heure)->format('H:i'))
            ->action('Voir votre réservation', url('/etudiant/reservations'))
            ->line('Merci d’utiliser CampusHome !');
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
