<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status', 'message'];  // Ajoute les champs que tu souhaites remplir

    // Définit la relation inverse si tu veux accéder à l'utilisateur à partir de la notification
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
