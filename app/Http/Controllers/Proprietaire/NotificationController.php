<?php
namespace App\Http\Controllers\Proprietaire;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $notificationsMessages = $user->notifications()->latest()->get();

        return view('proprietaire.notifications.index', compact('notificationsMessages'));
    }
    // Lire une commentaire
    public function lire($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        return redirect()->back();
    }

    // Lire tous les commentaires comme marqué lu
    public function toutesLues()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'Toutes les notifications ont été marquées comme lues.');
    }

}
