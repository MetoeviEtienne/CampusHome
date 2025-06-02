<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact; //
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Methode pour la récupération des messages de contact
    public function index()
    {
         $contacts = Contact::latest()->get(); 
    return view('admin.contact', compact('contacts'));
    }

    // Methode pour supprimer un message de contact
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->back()->with('success', 'Message supprimé avec succès.');
    }

}
