<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:student,owner'], // Validation du rôle
            'ville' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^\+22901\d{8}$/'],
            // 'phone' => ['nullable', 'string', 'max:20'],
            // 'status' => $request->role === 'owner' ? 'active' : null,
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'ville' => $request['ville'],
            'role' => $request->role, // Enregistrement du rôle
            'phone' => $request['phone'] ?? null,
            'status' => $request->role === 'owner' ? 'active' : null,
        ]);

        event(new Registered($user));
        Auth::login($user);

        if ($user->isOwner()) {
            return redirect()->route('proprietaire.dashboard');
        } else {
            return redirect()->route('dashboard');
        }
    }
}
