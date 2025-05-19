<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'reservation_id',
        'montant',
        'taxe',
        'methode',
        'reference',
        'quittance',
        'statut',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
