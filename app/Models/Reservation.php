<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    // Propriétés assignables
    protected $fillable = [
        'logement_id', 'etudiant_id', 'date_debut', 'date_fin', 'statut', 'contrat', 'contrat_signe'
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

}
