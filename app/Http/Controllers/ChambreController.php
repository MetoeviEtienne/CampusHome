<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChambreController extends Controller
 {

    public function index(Logement $logement)
{
    $chambres = $logement->chambres;
    return view('proprietaire.chambres.index', compact('logement', 'chambres'));
}

public function create(Logement $logement)
{
    return view('proprietaire.chambres.create', compact('logement'));
}

public function store(Request $request, Logement $logement)
{
    $validated = $request->validate([
        'numero' => 'required|string|max:255',
        'superficie' => 'required|numeric|min:0',
        'loyer' => 'required|numeric|min:0',
        'disponibilite' => 'required|date',
    ]);

    $logement->chambres()->create($validated);

    return redirect()->route('proprietaire.chambres.index', $logement)->with('success', 'Chambre ajoutée avec succès.');
}

public function edit(Logement $logement, Chambre $chambre)
{
    return view('proprietaire.chambres.edit', compact('logement', 'chambre'));
}

public function update(Request $request, Logement $logement, Chambre $chambre)
{
    $validated = $request->validate([
        'numero' => 'required|string|max:255',
        'superficie' => 'required|numeric|min:0',
        'loyer' => 'required|numeric|min:0',
        'disponibilite' => 'required|date',
    ]);

    $chambre->update($validated);

    return redirect()->route('proprietaire.chambres.index', $logement)->with('success', 'Chambre mise à jour avec succès.');
}

public function destroy(Logement $logement, Chambre $chambre)
{
    $chambre->delete();

    return redirect()->route('proprietaire.chambres.index', $logement)->with('success', 'Chambre supprimée avec succès.');
}

//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         //
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         //
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
//     {
//         //
//     }

//     /**
//      * Display the specified resource.
//      */
//     public function show(string $id)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(string $id)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, string $id)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(string $id)
//     {
//         //
//     }
}
