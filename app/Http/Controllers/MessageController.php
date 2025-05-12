<?php
namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Afficher les messages du propriétaire
    public function index()
    {
        // Récupérer les messages où le propriétaire est le destinataire
        $messages = Message::where('destinataire_id', Auth::id())
                           ->orderBy('created_at', 'desc')
                           ->get();

        return view('proprietaire.messages.index', compact('messages'));
    }

    // Envoyer un message
    public function store(Request $request)
    {
        $request->validate([
            'contenu' => 'required|string|max:500',
            'destinataire_id' => 'required|exists:users,id', // Assurer que le destinataire existe
        ]);

        // Créer le message
        Message::create([
            'expediteur_id' => Auth::id(),
            'destinataire_id' => $request->destinataire_id,
            'contenu' => $request->contenu,
            'lu' => false, // Le message est par défaut marqué comme non lu
        ]);

        return redirect()->route('proprietaire.messages')->with('success', 'Message envoyé avec succès!');
    }
}
