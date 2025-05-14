<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;

class MaintenanceController extends Controller
{
    public function index()
    {
        $demandes = Maintenance::with(['logement.proprietaire', 'etudiant'])
            ->latest()
            ->get();

        return view('admin.maintenances.index', compact('demandes'));
    }

    public function updateStatus(Maintenance $maintenance)
    {
        $maintenance->update([
            'statut' => request('statut'),
        ]);

        return back()->with('success', 'Statut mis à jour.');
    }
}
