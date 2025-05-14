<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidationLogementController extends Controller
{
    // Affiche la liste des logements à valider
    public function index()
    {
        $logements = Logement::where('valide', false)
            ->where(function ($query) {
                $query->whereNull('etat')
                    ->orWhere('etat', '!=', 'rejeté');
            })
            ->with('proprietaire')
            ->latest()
            ->paginate(10);
        return view('admin.logements.index', compact('logements'));
    }

    // Affiche le formulaire de validation d'un logement
    public function valider(Logement $logement)
    {
        $logement->update([
            'valide' => true,
            'validateur_id' => Auth::id(),
            'valide_le' => now(),
        ]);

        return redirect()->back()->with('success', 'Logement validé avec succès.');
    }

    // public function rejecter(Logement $logement)
    //     {
    //         // Soit on supprime, soit on met à jour un champ "rejeté"
    //         $logement->delete(); // ou $logement->update(['valide' => false, ...]);

    //         return redirect()->back()->with('success', 'Logement rejeté avec succès.');
    //     }
   // Méthode pour rejeter un logement
    public function rejeter(Logement $logement)
        {
            $logement->update([
                'valide' => false,
                'etat' => 'rejeté',
                'validateur_id' => Auth::id(),
                'valide_le' => now(),
            ]);

            return redirect()->route('admin.logements.index')->with('error', 'Le logement a été rejeté.');
        }
    
    // Affiche l'historique des logements validés
    public function historique()
        {
            // Charger tous les logements validés ou rejetés avec leur propriétaire
            $proprietaires = \App\Models\User::whereHas('logements', function ($query) {
                $query->where('valide', true)
                      ->orWhere('etat', 'rejeté');
            })->with(['logements' => function ($query) {
                $query->where('valide', true)
                      ->orWhere('etat', 'rejeté')
                      ->with('photos');
            }])->get();
        
            return view('admin.logements.historique', compact('proprietaires'));
        }   
}
