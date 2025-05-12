<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    // Les propriétés qui sont assignables en masse
    protected $fillable = [
        'logement_id', 'etudiant_id', 'date_debut', 'date_fin', 'statut', 'contrat', 'contrat_signe'
    ];

    // Relation avec le logement
    public function logement()
    {
        return $this->belongsTo(Logement::class);
    }

    // Relation avec l'étudiant (l'utilisateur qui fait la réservation)
    public function etudiant()
    {
        return $this->belongsTo(User::class, 'etudiant_id');
    }
}
