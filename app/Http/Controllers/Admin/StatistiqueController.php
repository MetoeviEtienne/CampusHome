<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logement;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Paiement;
use Illuminate\Support\Facades\DB;

class StatistiqueController extends Controller
{

public function index()
{
    $nbLogementsTotal = Logement::count();
    $nbChambresPubliees = Logement::where('type', 'chambre')->count();
    $nbEntreesCoucheesPubliees = Logement::where('type', 'entrée couchée')->count();

    // IDs des réservations ayant un paiement (logements loués)
    $reservationIdsAvecPaiement = Paiement::distinct()->pluck('reservation_id');
    // Nombre de logements loués (distinct par logement_id)
    $nbLogementsLoue = Reservation::whereIn('id', $reservationIdsAvecPaiement)->distinct('logement_id')->count();

    // Réservations approuvées sans paiement (logements réservés)
    $reservationIdsAvecPaiement = Paiement::pluck('reservation_id');
    $nbLogementsReserve = Reservation::where('statut', 'approuvée')
        ->whereNotIn('id', $reservationIdsAvecPaiement)
        ->distinct('logement_id')
        ->count();

    // Total logements loués ou réservés
    $nbLogementsLoueOuReserve = $nbLogementsLoue + $nbLogementsReserve;

    // Statistiques par type (logements loués ou réservés)
    $nbChambresLoueOuReserve = Logement::where('type', 'chambre')->whereHas('reservations')->count();
    $nbEntreesCoucheesLoueOuReserve = Logement::where('type', 'entrée couchée')->whereHas('reservations')->count();

    $nbUtilisateurs = User::count();
    $nbProprietaires = User::where('role', 'owner')->count();
    $nbEtudiants = User::where('role', 'student')->count();
    $nbPaiementsAvance = Paiement::where('type', 'avance')->count();
    $nbPaiementsMensuel = Paiement::where('type', 'mensuel')->count();


    // Montant total encaissé (tous paiements)
    $montantTotalEncaisse = Paiement::sum('montant');

    // Montant total des taxes (commission plateforme)
    $montantTotalTaxes = Paiement::sum('taxe');

    // Montant reversé aux propriétaires
    $montantReverséProprietaires = $montantTotalEncaisse - $montantTotalTaxes;
    // --- Nouvelles données pour graphiques par mois ---

    // Import DB facade si ce n’est pas déjà fait : use Illuminate\Support\Facades\DB;

    // Répartition des réservations par mois (année en cours)
    $reservationsParMois = Reservation::select(
        DB::raw('MONTH(created_at) as mois'),
        DB::raw('COUNT(*) as total')
    )
    ->whereYear('created_at', date('Y'))
    ->groupBy('mois')
    ->orderBy('mois')
    ->pluck('total', 'mois')
    ->toArray();

    // Montant total encaissé par mois (paiements payés, année en cours)
    $paiementsParMois = Paiement::select(
        DB::raw('MONTH(created_at) as mois'),
        DB::raw('SUM(montant) as total')
    )
    ->whereYear('created_at', date('Y'))
    ->where('statut', 'payé')
    ->groupBy('mois')
    ->orderBy('mois')
    ->pluck('total', 'mois')
    ->toArray();

    // Préparer un tableau pour 12 mois, avec zéro par défaut
    $moisLabels = range(1, 12);
    $reservationsData = [];
    $paiementsData = [];

    foreach ($moisLabels as $mois) {
        $reservationsData[] = $reservationsParMois[$mois] ?? 0;
        $paiementsData[] = $paiementsParMois[$mois] ?? 0;
    }

    return view('admin.statistiques.index', compact(
        'nbLogementsTotal',
        'nbChambresPubliees',
        'nbEntreesCoucheesPubliees',
        'nbLogementsLoue',
        'nbLogementsReserve',
        'nbLogementsLoueOuReserve',
        'nbChambresLoueOuReserve',
        'nbEntreesCoucheesLoueOuReserve',
        'nbUtilisateurs',
        'nbProprietaires',
        'nbEtudiants',
        'nbPaiementsAvance',
        'nbPaiementsMensuel',
        'reservationsData',
        'paiementsData',
         'montantTotalEncaisse',
        'montantTotalTaxes',
        'montantReverséProprietaires'
    ));
}


}
