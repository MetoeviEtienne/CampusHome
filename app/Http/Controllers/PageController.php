<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Methode pour afficher la page de documentation de la plateforme
    public function aSavoir()
    {
        return view('a-savoir');
    }

}
