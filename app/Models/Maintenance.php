<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = [
        'logement_id', 'etudiant_id', 'description', 'urgence', 'statut'
    ];

    public function logement()
    {
        return $this->belongsTo(Logement::class);
    }

    public function etudiant()
    {
        return $this->belongsTo(User::class, 'etudiant_id');
    }
}
