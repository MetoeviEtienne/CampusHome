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

    public function lire($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        return redirect()->back();
    }
}
