<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logement extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'adresse',
        'type',
        'nombre_chambres',
        'superficie',
        'loyer',
        'charges',
        'description',
        'disponibilite',
        'proprietaire_id',
    ];

    // Relation avec le modèle User
    public function reservations()
        {
            return $this->hasMany(\App\Models\Reservation::class, 'logement_id');
        }
        // Relation avec le modèle User

    public function photos()
        {
            return $this->hasMany(\App\Models\PhotoLogement::class);
        }
    // Relation avec le modèle User
    public function proprietaire()
        {
            return $this->belongsTo(User::class, 'proprietaire_id');
        } 
    // Relation avec le modèle User
    public function user()
        {
            return $this->belongsTo(User::class);
        }
        public function logements()
        {
            return $this->hasMany(Logement::class);
        }        
}
