<?php
namespace App\Http\Controllers\Proprietaire;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use Illuminate\Support\Facades\Auth;

class MaintenancesController extends Controller
{
    public function index()
    {
        $demandes = Maintenance::with(['logement', 'etudiant'])
            ->whereHas('logement', function ($query) {
                $query->where('proprietaire_id', Auth::id());
            })
            ->latest()
            ->get();

        return view('proprietaire.maintenances.index', compact('demandes'));
    }

    public function updateStatus(Maintenance $maintenance)
    {
        $maintenance->update([
            'statut' => request('statut'),
        ]);

        return back()->with('success', 'Statut mis à jour.');
    }
}
