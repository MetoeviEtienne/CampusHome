<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;

class ContratController extends Controller
{
    public function index()
    {
        // Récupérer toutes les réservations avec contrat (signé ou non)
        $reservations = Reservation::whereNotNull('contrat')->with(['etudiant', 'logement'])->paginate(10);

        return view('admin.contrats.index', compact('reservations'));
    }
}
