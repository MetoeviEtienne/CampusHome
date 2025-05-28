<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AvisEtoile;
use App\Models\Logement;
use Illuminate\Http\JsonResponse;

class AvisEtoileController extends Controller
{
    // public function noter(Request $request, $logementId)
    // {
    //     $request->validate([
    //         'note' => 'required|integer|min:1|max:5',
    //     ]);

    //     $logement = Logement::findOrFail($logementId);

    //     AvisEtoile::create([
    //         'auteur_id' => auth()->id(),
    //         'logement_id' => $logement->id,
    //         'note' => $request->note,
    //     ]);

    //     return redirect()->back()->with('success', 'Merci pour votre note !');
    // }

    public function noter(Request $request, $logementId)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
        ]);

        $logement = Logement::findOrFail($logementId);

        // Empêcher plusieurs avis du même auteur pour le même logement
        $avis = AvisEtoile::firstOrNew([
            'auteur_id' => auth()->id(),
            'logement_id' => $logement->id,
        ]);

        $avis->note = $request->note;
        $avis->save();

        $moyenne = number_format(
            AvisEtoile::where('logement_id', $logementId)->avg('note'),
            1
        );
        $total = AvisEtoile::where('logement_id', $logementId)->count();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'note_moyenne' => $moyenne,
                'total' => $total,
            ]);
        }

        return redirect()->back()->with('success', 'Merci pour votre note !');
    }
}
