<?php
namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Logement;
use Illuminate\Http\Request;
use App\Notifications\NouvelAvis;

class AvisController extends Controller
{
    // Afficher le formulaire pour donner un avis
    public function showForm($logement_id)
    {
        $logement = Logement::findOrFail($logement_id);
        return view('etudiants.logements.avis.avis', compact('logement'));
    }

    // Stocker l'avis
    public function store(Request $request, $logementId)
    {
        $request->validate([
            'commentaire' => 'required|string|max:255',
        ]);

        $logement = Logement::findOrFail($logementId);

        $avis = Avis::create([
            'auteur_id' => auth()->user()->id,
            'logement_id' => $logement->id,
            'commentaire' => $request->commentaire,
            'verifie' => false,
        ]);

        // Notifier le propriétaire
        if ($logement->proprietaire) {
            $logement->proprietaire->notify(new NouvelAvis($avis));
        }

        return redirect()->back()->with('success', "Merci pour votre avis !");
    }



    // Lister les avis d'un logement
    public function liste($logement_id)
    {
        $avis = Avis::with('auteur')
                    ->where('logement_id', $logement_id)
                    ->latest()
                    ->get();

        return view('avis.index', compact('avis'));
    }
    
}
