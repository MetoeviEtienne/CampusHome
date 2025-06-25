<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'ville',
        'id_document'
    ];
  
    public function isOwner()
        {
            return $this->role === 'owner';
        }
    
    public function isStudent()
        {
            return $this->role === 'student';
        }

    //logique de la publication de logement

    public function logements()
        {
            return $this->hasMany(Logement::class, 'proprietaire_id');
        }
    // Réservations faites en tant qu'étudiant
    public function reservationsEtudiant()
        {
            return $this->hasMany(\App\Models\Reservation::class, 'etudiant_id');
        }

    // Réservations reçues en tant que propriétaire (via les logements)
    public function reservationsProprietaire()
        {
            return $this->hasManyThrough(Reservation::class, Logement::class, 'proprietaire_id', 'logement_id');
        }

    // Relation pour les messages envoyés par l'utilisateur
    public function messagesEnvoyes()
        {
            return $this->hasMany(Message::class, 'expediteur_id');
        }
    // Relation pour les messages reçus par l'utilisateur
    public function messagesRecus()
        {
            return $this->hasMany(Message::class, 'destinataire_id');
        }
    
        // Relation pour les demandes de reservation
    public function reservations()
        {
            return $this->hasMany(\App\Models\Reservation::class, 'etudiant_id');
        }
        
    // Relatio pour les avis laissés par l'utilisateur
    public function avis()
        {
            return $this->hasMany(Avis::class, 'auteur_id');
        }

        
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    // SMS
    public function routeNotificationForTwilio()
    {
        return $this->phone; // suppose que le numéro est stocké dans `phone`
    }

}
