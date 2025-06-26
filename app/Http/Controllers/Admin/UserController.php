<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\OwnerSuspendedNotification;
use App\Notifications\OwnerActivatedNotification; 

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', ['student', 'owner'])->get();
        return view('admin.users.index', compact('users'));
    }

    public function suspend(User $user)
    {
        // Vérifie si l'utilisateur est déjà suspendu
        $user->update(['status' => User::STATUS_SUSPENDED]);
        // Envoie une notification au propriétaire suspendu
        $user->notify(new OwnerSuspendedNotification());

        return back()->with('success', 'Propriétaire suspendu.');
    }

    public function activate(User $user)
    {
        // Vérifie si l'utilisateur est déjà actif
        $user->update(['status' => User::STATUS_ACTIVE]);
        // Envoie une notification au propriétaire ré-activé
        $user->notify(new OwnerActivatedNotification());
        
        return back()->with('success', 'Propriétaire ré-activé.');
    }

    // public function edit(User $user)
    // {
    //     return view('admin.users.edit', compact('user'));
    // }

    // public function update(Request $request, User $user)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users,email,'.$user->id,
    //         'role' => 'required|in:student,owner',
    //         'ville' => 'required',
    //     ]);

    //     $user->update($request->only('name', 'email', 'role', 'ville', 'phone'));

    //     return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour.');
    // }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé.');
    }
}
