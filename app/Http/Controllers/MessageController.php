<?php
namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Page messagerie pour le propriétaire
    public function proprietaireIndex()
    {
        $user = Auth::user();

        // Récupérer les messages où le propriétaire est expéditeur ou destinataire (discussion)
        $messages = Message::where(function ($query) use ($user) {
            $query->where('expediteur_id', $user->id)
                  ->orWhere('destinataire_id', $user->id);
        })->orderBy('created_at', 'desc')->get();

        // Destinataires possibles : uniquement étudiants
        $destinataires = User::where('role', 'student')->get();

        return view('proprietaire.messages.index', compact('messages', 'destinataires'));
    }

    // Page messagerie pour l'étudiant
    public function etudiantIndex()
    {
        $user = Auth::user();

        // Récupérer les messages où l'étudiant est expéditeur ou destinataire
        $messages = Message::where(function ($query) use ($user) {
            $query->where('expediteur_id', $user->id)
                  ->orWhere('destinataire_id', $user->id);
        })->orderBy('created_at', 'desc')->get();

        // Destinataires possibles : uniquement propriétaires
        $destinataires = User::where('role', 'owner')->get();

        return view('etudiants.messages.index', compact('messages', 'destinataires'));
    }

    // Envoi du message (commun aux deux)
    public function store(Request $request)
    {
        $request->validate([
            'contenu' => 'required|string|max:500',
            'destinataire_id' => 'required|exists:users,id',
        ]);

        Message::create([
            'expediteur_id' => Auth::id(),
            'destinataire_id' => $request->destinataire_id,
            'contenu' => $request->contenu,
            'lu' => false,
        ]);

        // Rediriger selon le rôle pour garder sur la bonne page
        if (Auth::user()->role === 'owner') {
            return redirect()->route('proprietaire.messages')->with('success', 'Message envoyé avec succès!');
        } else {
            return redirect()->route('etudiants.messages')->with('success', 'Message envoyé avec succès!');
        }
    }
    public function conversation($proprietaireId)
{
    $etudiant = auth()->user();
    $proprietaire = User::findOrFail($proprietaireId);

    // Récupérer tous les messages entre l'étudiant et ce propriétaire
    $messages = Message::where(function ($query) use ($etudiant, $proprietaire) {
        $query->where('expediteur_id', $etudiant->id)
              ->where('destinataire_id', $proprietaire->id);
    })->orWhere(function ($query) use ($etudiant, $proprietaire) {
        $query->where('expediteur_id', $proprietaire->id)
              ->where('destinataire_id', $etudiant->id);
    })->orderBy('created_at')->get();

    return view('etudiants.messages.index', compact('messages', 'proprietaire'));
}

public function conversationEtudiant($etudiantId)
    {
        $proprietaire = auth()->user();
        $etudiant = User::findOrFail($etudiantId);

        $messages = Message::where(function ($query) use ($proprietaire, $etudiant) {
            $query->where('expediteur_id', $proprietaire->id)->where('destinataire_id', $etudiant->id)
                ->orWhere('expediteur_id', $etudiant->id)->where('destinataire_id', $proprietaire->id);
        })->orderBy('created_at', 'asc')->get();

        return view('proprietaire.messages.index', compact('etudiant', 'messages'));
    }

    public function index($proprietaireId)
{
    $proprietaire = User::findOrFail($proprietaireId); // ou Proprietaire::findOrFail($id)
    $messages = Message::where(function ($query) use ($proprietaireId) {
        $query->where('expediteur_id', auth()->id())
              ->where('destinataire_id', $proprietaireId);
    })->orWhere(function ($query) use ($proprietaireId) {
        $query->where('expediteur_id', $proprietaireId)
              ->where('destinataire_id', auth()->id());
    })->with('expediteur')->get();

    return view('etudiants.messages.index', [
        'messages' => $messages,
        'proprietaire' => $proprietaire,
    ]);
}

}
