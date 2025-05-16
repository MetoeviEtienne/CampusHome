<?php
namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use App\Models\Logement;
use Illuminate\Http\Request;

class LogementController extends Controller
{
    //Fonction pour rechercher les logements
    public function index(Request $request)
        {
            $query = \App\Models\Logement::where('valide', true);

            if ($request->filled('search')) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('adresse', 'like', "%$search%");
                    
                    if (is_numeric($search)) {
                        $q->orWhere('loyer', $search);
                    }
                });
            }

            $logements = $query->latest()->paginate(10);

            return view('/dashboard', compact('logements'));
        }
}
