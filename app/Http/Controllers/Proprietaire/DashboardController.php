<?php
namespace App\Http\Controllers\Proprietaire;

use App\Http\Controllers\Controller;
use App\Models\Logement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Maintenance;
use App\Models\Avis;


class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Récupérer les logements publiés par ce propriétaire
        $logements = Logement::where('proprietaire_id', $user->id)->get();

        // Réservations en attente
        $reservationsEnAttente = DB::table('reservations')
            ->join('logements', 'reservations.logement_id', '=', 'logements.id')
            ->where('logements.proprietaire_id', $user->id)
            ->where('reservations.statut', 'en_attente')
            ->count();
        
        // Récupérer les demandes de maintenance pour les logements du propriétaire
        $demandesMaintenance = Maintenance::with(['logement', 'etudiant'])
            ->whereHas('logement', function ($query) {
                $query->where('proprietaire_id', Auth::id());
                })
            ->latest()
            ->take(5)
            ->get();

        // Nombre de notifications non lues via système natif
        $notificationsNonLues = $user->unreadNotifications()->count();

        // 5 dernières notifications
        $notificationsMessages = $user->notifications()->latest()->take(5)->get();

        // Logements classés
        $logementsValides = Logement::where('proprietaire_id', $user->id)->where('valide', true)->get();
        $logementsEnAttente = Logement::where('proprietaire_id', $user->id)->where('valide', false)->get();
        $logementsNonValidés = Logement::where('proprietaire_id', $user->id)->where('valide')->get();
        
        // Récupérer les avis sur les logements
        $avis = Avis::whereIn('logement_id', $logements->pluck('id'))->get();

        // Passer à la vue
        return view('proprietaire.dashboard', [
            'logements' => $logements,
            'reservationsEnAttente' => $reservationsEnAttente,
            'demandesMaintenance' => $demandesMaintenance,
            'notifications' => $notificationsNonLues,
            'notificationsMessages' => $notificationsMessages,
            'logementsValides' => $logementsValides,
            'logementsEnAttente' => $logementsEnAttente,
            'logementsNonValidés' => $logementsNonValidés,
            'avis' => $avis,  
        ]);
    }
}
