<?php

namespace App\Http\Controllers\Proprietaire;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use Illuminate\Http\Request;

class AvisController extends Controller
{
    public function index()
    {
        // Vérifier que l'utilisateur est connecté et est un propriétaire
        if (!auth()->check() || auth()->user()->role !== 'owner') {
            return redirect()->route('login')->with('error', 'Accès réservé aux propriétaires.');
        }

        // Récupérer les avis des logements appartenant à ce propriétaire
        $avis = Avis::whereHas('logement', function ($query) {
            $query->where('proprietaire_id', auth()->id());
        })->get();

        return view('proprietaire.avis.index', compact('avis'));
    }
}
