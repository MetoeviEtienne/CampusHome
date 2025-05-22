<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class RecuPaiementNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $paiement;
    public $user;

    public function __construct($paiement, $user)
    {
        $this->paiement = $paiement;
        $this->user = $user;
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
        $reservation = $this->paiement->reservation;
        $logement = $reservation->logement;
        $etudiant = $reservation->etudiant;
        $proprietaire = $logement->proprietaire;

        $pdf = Pdf::loadView('pdf.recu', [
            'paiement' => $this->paiement,
            'transactionId' => $this->paiement->reference,
            'montant' => $this->paiement->montant,
            'taxe' => $this->paiement->taxe,
            'type' => $this->paiement->type,
            'etudiant' => $etudiant,
            'proprietaire' => $proprietaire,
            'logement' => $logement,
        ]);

        $nomFichier = 'recu-'.$this->paiement->id.'.pdf';

        return (new MailMessage)
            ->subject('Reçu de paiement - CampusHome')
            ->greeting('Bonjour '.$this->user->name)
            ->line('Merci pour votre paiement.')
            ->line('Vous trouverez en pièce jointe votre reçu de paiement.')
            ->attachData($pdf->output(), $nomFichier, [
                'mime' => 'application/pdf',
            ])
            ->salutation('Cordialement, L’équipe CampusHome');
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



