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
        'quartier',
        'type',
        'numChambre',
        // 'nombre_chambres',
        'superficie',
        'loyer',
        'numMaison',
        // 'charges',
        'description',
        'piece_identite_path',
        'titre_propriete_path',
        'disponibilite',
        'proprietaire_id',
        'valide',
        'validateur_id',
        'etat',
        'valide_le',
    ];
    

    // Relation avec le modèle User
    public function reservations()
        {
            return $this->hasMany(\App\Models\Reservation::class, 'logement_id');
        }

   public function estReserveOuLoue()
    {
        return $this->reservations()
            ->whereIn('statut', ['en_attente', 'approuvée'])
            ->where('date_fin', '>=', now())
            ->exists();
    }

        // Relation avec le modèle User

    public function photos()
        {
            return $this->hasMany(\App\Models\PhotoLogement::class);
        }
    // Relation avec le propriétaire (users)
    public function proprietaire()
        {
            return $this->belongsTo(User::class, 'proprietaire_id');
        } 

    public function validateur()
        {
            return $this->belongsTo(User::class, 'validateur_id');
        }
            
    // // Relation avec le modèle User
    // public function user()
    //     {
    //         return $this->belongsTo(User::class);
    //     }
    // Relation avec le logement
    // public function logements()
    //     {
    //         return $this->hasMany(Logement::class);
    //     }    
    
    // Relation avec le modèle Avis
    public function avis()
        {
            return $this->hasMany(Avis::class);
        }
    
    // Relation de l''avis etoile
    public function avisEtoiles()
    {
        return $this->hasMany(\App\Models\AvisEtoile::class);
    }

    public function chambres()
    {
        return $this->hasMany(Chambre::class);
    }
}





// class Logement extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'titre',
//         'adresse',
//         'type',
//         'nombre_chambres',
//         'superficie',
//         'loyer',
//         'charges',
//         'description',
//         'piece_identite_path',
//         'titre_propriete_path',
//         'disponibilite',
//         'proprietaire_id',
//         'valide',
//         'validateur_id',
//         'etat',
//         'valide_le',
//     ];
    

//     // Relation avec le modèle User
//     public function reservations()
//         {
//             return $this->hasMany(\App\Models\Reservation::class, 'logement_id');
//         }

//    public function estReserveOuLoue()
//     {
//         return $this->reservations()
//             ->whereIn('statut', ['en_attente', 'approuvée'])
//             ->where('date_fin', '>=', now())
//             ->exists();
//     }

//         // Relation avec le modèle User

//     public function photos()
//         {
//             return $this->hasMany(\App\Models\PhotoLogement::class);
//         }
//     // Relation avec le propriétaire (users)
//     public function proprietaire()
//         {
//             return $this->belongsTo(User::class, 'proprietaire_id');
//         } 

//     public function validateur()
//         {
//             return $this->belongsTo(User::class, 'validateur_id');
//         }
            
//     // // Relation avec le modèle User
//     // public function user()
//     //     {
//     //         return $this->belongsTo(User::class);
//     //     }
//     // Relation avec le logement
//     // public function logements()
//     //     {
//     //         return $this->hasMany(Logement::class);
//     //     }    
    
//     // Relation avec le modèle Avis
//     public function avis()
//         {
//             return $this->hasMany(Avis::class);
//         }
    
//     // Relation de l''avis etoile
//     public function avisEtoiles()
//     {
//         return $this->hasMany(\App\Models\AvisEtoile::class);
//     }

// }
