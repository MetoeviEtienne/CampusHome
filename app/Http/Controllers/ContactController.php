<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Affiche le formulaire de contact
    public function create()
    {
        return view('contact');
    }

    // Enregistre les données du formulaire
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'sujet' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($request->all());

        return redirect()->back()->with('success', 'Votre message a été envoyé avec succès.');
    }

      // Affiche le formulaire de contact
    public function index()
        {
            return view('contact.index'); 
        }
}
