<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        return view('owner.dashboard');  // Vue pour le tableau de bord du propriétaire
    }
}
