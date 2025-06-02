<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Avis;

class AvisController extends Controller
{
    // public function index()
    // {
    //     $avis = Avis::with(['auteur', 'logement.proprietaire'])
    //         ->latest()
    //         ->get();

    //     return view('admin.avis.index', compact('avis'));
    // }

    public function index()
    {
        $avis = Avis::select('avis.*')
            ->join('logements', 'avis.logement_id', '=', 'logements.id')
            ->join('users as proprietaires', 'logements.proprietaire_id', '=', 'proprietaires.id')
            ->with(['auteur', 'logement.proprietaire'])
            ->orderBy('proprietaires.name')
            ->paginate(15);

        return view('admin.avis.index', compact('avis'));
    }

    public function verifier(Avis $avis)
    {
        $avis->update([
            'verifie' => true,
        ]);

        return back()->with('success', 'Avis marqué comme vérifié.');
    }
}
