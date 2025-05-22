<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'reservation_id',
        'montant',
        'type',
        'taxe',
        'methode',
        'reference',
        'statut',
        'quittance',
    ];


    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
