<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvisEtoile extends Model
{
    protected $fillable = ['auteur_id', 'logement_id', 'note'];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function logement()
    {
    return $this->belongsTo(Logement::class);
    }

}
