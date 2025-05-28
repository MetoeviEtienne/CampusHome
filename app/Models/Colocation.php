<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
    protected $fillable = [
        'reservation_id', 
        'description', 
        'nombre_places', 
        'telephone'];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

}
