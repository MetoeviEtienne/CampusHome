<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoLogement extends Model
{
    use HasFactory;

    protected $table = 'photos_logements'; // ✅ Correction ici

    protected $fillable = [
        'chemin',
        'logement_id',
        'ordre',
    ];
}
