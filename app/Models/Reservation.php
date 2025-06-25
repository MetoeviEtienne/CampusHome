<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    // Propriétés assignables
   protected $fillable = [
        'etudiant_id',
        'logement_id',
        'date_debut',
        'date_fin',
        'universite',
        'inscription_pdf',
        'autre_universite',
        'statut',
        'contrat',
        'contrat_signe',
        'visite_date',      
        'visite_heure',
        'visite_confirmee',
        'visite_rejetee',
    ];

    // Relation avec le logement
    public function logement()
        {
            return $this->belongsTo(\App\Models\Logement::class);
        }

    // Relation avec l'étudiant
    public function etudiant()
        {
            return $this->belongsTo(\App\Models\User::class, 'etudiant_id');
        }
        // Relation pour les réservations
    public function reservations()
        {
            return $this->hasMany(\App\Models\Reservation::class, 'etudiant_id');
        }
    // Relation avec le paiement
    public function paiements()
        {
            return $this->hasMany(Paiement::class);
        }

    // Méthode pour vérifier si l’avance est payée
    public function aPayeAvance()
    {
        return $this->paiements()->where('type', 'avance')->exists();
    }
    
    // relation d'annonce
    public function colocation()
    {
        return $this->hasOne(Colocation::class);
    }

}
