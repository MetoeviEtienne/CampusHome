<?php

namespace App\Http\Controllers\Proprietaire;

use App\Http\Controllers\Controller;
use App\Models\Logement;
use Illuminate\Http\Request;
use App\Models\PhotoLogement;
use App\Notifications\LogementCreeNotification;

class LogementController extends Controller
{
    // Afficher la liste des logements
    // public function index()
    // {
    //     $logements = auth()->user()->logements()->with('photos')->get();
        
    //     return view('proprietaire.logements.index', compact('logements'));
    // }

    public function index()
        {
            // Vérifier que l'utilisateur est connecté et est un propriétaire
            if (!auth()->check() || auth()->user()->role !== 'owner') {
                return redirect()->route('login')->with('error', 'Accès réservé aux propriétaires.');
            }

            $logements = auth()->user()->logements()->with('photos')->get();
            return view('proprietaire.logements.index', compact('logements'));
        }


    // creer un logement
    public function create()
    {
        return view('proprietaire.logements.create');
    }
    
    // Enregistrer un nouveau logement
     public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'adresse' => 'required|string',
            'quartier' => 'required|string',
            'type' => 'required|in:entrée couchée,chambre',
            // 'type' => 'required|in:studio,appartement,chambre,colocation',
            'numChambre' => 'required|integer|min:1',
            // 'nombre_chambres' => 'required|integer|min:1',
            'superficie' => 'required|numeric|min:10',
            'loyer' => 'required|numeric|min:0',
            'numMaison' => 'required|string',
            // 'charges' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'disponibilite' => 'required|date',
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'piece_identite' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'titre_propriete' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        // Upload des fichiers pièce d'identité et titre de propriété
        $pieceIdentitePath = $request->file('piece_identite')->store('documents', 'public');
        $titreProprietePath = $request->file('titre_propriete')->store('documents', 'public');

        // Ajout des chemins dans les données validées pour la création
        $validated['piece_identite_path'] = $pieceIdentitePath;
        $validated['titre_propriete_path'] = $titreProprietePath;

        $logement = auth()->user()->logements()->create($validated);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('logements/photos', 'public');
                $logement->photos()->create(['chemin' => $path]);
            }
        }

        // ✅ Notification par mail
        auth()->user()->notify(new LogementCreeNotification());

        return redirect()->route('proprietaire.logements.index')->with('success', 'Logement créé avec succès! En attente de validation.');
    }

    // Editer un logement
    public function edit(Logement $logement)
    {
    if ($logement->proprietaire_id !== auth()->id()) {
        abort(403, 'Accès non autorisé');
    }

    return view('proprietaire.logements.edit', compact('logement'));
    }

    // Mettre à jour un logement
    public function update(Request $request, Logement $logement)
    {
    if ($logement->proprietaire_id !== auth()->id())
     {
        abort(403, 'Accès non autorisé');
        }

    $validated = $request->validate([
        'titre' => 'required|string|max:255',
        'adresse' => 'required|string',
        'quartier' => 'required|string',
        'type' => 'required|in:entrée couchée,chambre',
        // 'type' => 'required|in:studio,appartement,chambre,colocation',
        'numChambre' => 'required|integer|min:1',
        // 'nombre_chambres' => 'required|integer|min:1',
        'superficie' => 'required|numeric|min:10',
        'loyer' => 'required|numeric|min:0',
        'numMaison' => 'required|string',
        // 'charges' => 'nullable|numeric|min:0',
        'description' => 'nullable|string',
        'disponibilite' => 'required|date',
        'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $logement->update($validated);

    // Gestion des nouvelles photos
    if ($request->hasFile('photos')) 
        {
        foreach ($logement->photos as $photo)
         {
            \Storage::disk('public')->delete($photo->chemin);
            $photo->delete();
            }

        foreach ($request->file('photos') as $photo) 
            {
            $path = $photo->store('logements/photos', 'public');
            $logement->photos()->create(['chemin' => $path]);
            }
        }

        return redirect()->route('proprietaire.logements.index')->with('success', 'Logement mis à jour avec succès.');
    }


    // Supprimer un logement
    public function destroy(Logement $logement)
    {
        if ($logement->proprietaire_id !== auth()->id()) {
            abort(403, 'Accès non autorisé');
        }
    
        foreach ($logement->photos as $photo) {
            \Storage::disk('public')->delete($photo->chemin);
            $photo->delete();
        }
    
        $logement->delete();
    
        return redirect()->route('proprietaire.logements.index')->with('success', 'Logement supprimé.');
    }

    // Afficher les détails d'un logement
    // public function show($id)
    //     {
    //         $logement = Logement::with(['photos', 'proprietaire'])->findOrFail($id);

    //         return view('etudiants.logements.show', compact('logement'));
    //     }

    // Methode pour afficher les avis e commentaire
    public function show($id)
    {
        $logement = Logement::with(['photos', 'proprietaire'])->findOrFail($id);

        $reservation = $logement->reservations()
            ->where('etudiant_id', auth()->id())
            ->latest()
            ->first();

        $avancePayee = $reservation && $reservation->paiements
            ->where('type', 'avance')
            ->where('statut', 'payé')
            ->isNotEmpty();

        // Charger les avis avec les auteurs
        $avis = $logement->avis()->with('auteur')->latest()->get();

        return view('etudiants.logements.show', compact('logement', 'reservation', 'avancePayee', 'avis'));
    }

}


