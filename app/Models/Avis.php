<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;

    protected $fillable = [
        'auteur_id', 'logement_id', 'note', 'commentaire', 'verifie',
    ];

    // Relation avec l'utilisateur (auteur de l'avis)
    public function auteur()
        {
            return $this->belongsTo(User::class, 'auteur_id');
        }

    // Relation avec le logement
    public function logement()
        {
            return $this->belongsTo(Logement::class, 'logement_id');
        }

    // // Relation avec la réservation
    // public function reservation()
    //     {
    //         return $this->belongsTo(Reservation::class, 'reservation_id');
    //     }
}
