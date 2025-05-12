<?php
namespace App\Http\Controllers\Proprietaire;

use App\Http\Controllers\Controller;
use App\Models\Logement;
use App\Models\Reservation;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        // Assurez-vous que l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Récupérer les logements publiés par le propriétaire connecté
        $logements = Logement::where('proprietaire_id', Auth::id())->get();

        // Récupérer le nombre de réservations en attente pour les logements du propriétaire
        $reservationsEnAttente = DB::table('reservations')
            ->join('logements', 'reservations.logement_id', '=', 'logements.id')
            ->where('logements.proprietaire_id', Auth::id())
            ->where('reservations.statut', 'en_attente')
            ->count();

        // Récupérer le nombre de notifications non lues
        $notifications = Notification::where('user_id', Auth::id())
                                     ->where('status', 'non_lu')
                                     ->count();

        // Récupérer les notifications récentes
        $notificationsMessages = Notification::where('user_id', Auth::id())
                                             ->orderBy('created_at', 'desc')
                                             ->take(5)
                                             ->get();
    
        // Récupérer les logements validés, en attente et non validés
        $logementsValides = Logement::where('valide', true)->get();  // Logements validés
        $logementsEnAttente = Logement::whereNull('valide')->get();  // Logements en attente (valide = null)
        $logementsNonValidés = Logement::where('valide', false)->get();  // Logements non validés                                   

        // Passer les données à la vue
        return view('proprietaire.dashboard', [
            'logements' => $logements,
            'reservationsEnAttente' => $reservationsEnAttente,
            'notifications' => $notifications,
            'notificationsMessages' => $notificationsMessages,
            'logementsValides' => $logementsValides,
            'logementsEnAttente' => $logementsNonValidés,
            'logementsNonValidés' => $logementsEnAttente,
        ]);
    }
}
