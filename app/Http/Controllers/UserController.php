<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function store(Request $request)
{
    // Validez les données du formulaire
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6',
    ]);

    // Créez un nouvel utilisateur
    $user = new User();
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->roleId = 1;
    $user->password = bcrypt($request->input('password')); // Vous devriez hasher le mot de passe
    $user->save();

    // Redirigez l'utilisateur ou renvoyez une réponse appropriée
    return redirect('/users');
}

public function blocked(Request $request, $userId)
{
    {
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('users')->with('error', 'Utilisateur introuvable.');
        }

        // Vérifiez si l'utilisateur est actuellement bloqué ou non
        if ($user->is_blocked==1) {
            $user->is_blocked = false;
            $user->save();
            return redirect('/users')->with('success', 'Utilisateur bloqué.');

        } else {
            // Si l'utilisateur n'est pas bloqué, vous pouvez le bloquer ici
            $user->is_blocked = true;
            $user->save();
            return redirect('/users')->with('success', 'Utilisateur bloqué.');
        }

    }
}


}
