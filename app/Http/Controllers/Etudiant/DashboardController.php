<?php
namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use App\Models\Logement;

class DashboardController extends Controller
{
    public function index()
    {
        $logements = Logement::where('valide', true)
            ->with('photos')
            ->latest()
            ->paginate(12);

        return view('dashboard', compact('logements'));
    }
}
