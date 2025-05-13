<?php
namespace App\Http\Controllers\Proprietaire;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use Illuminate\Http\Request;

class AvisController extends Controller
{
    public function index()
    {
        // Récupérer tous les avis associés aux logements du propriétaire connecté
        $avis = Avis::whereHas('logement', function ($query) {
            $query->where('proprietaire_id', auth()->user()->id); // Lier les avis au propriétaire via le logement
        })->get();

        // Passer les avis à la vue
        return view('proprietaire.avis.index', compact('avis'));
    }
}
