<?php
namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use App\Models\Logement;

class LogementController extends Controller
{
    public function index()
    {
        $logements = Logement::where('valide', true)
            ->with('photos', 'proprietaire')
            ->latest()
            ->paginate(12);

        return view('logements.index', compact('logements'));
    }

    public function show(Logement $logement)
    {
        abort_unless($logement->valide, 404);
        return view('logements.show', compact('logement'));
    }
}
