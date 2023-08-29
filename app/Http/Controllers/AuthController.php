<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FrontendUser;


class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('frontend')->attempt($credentials)) {
            // Authentication passed for frontend users, redirect accordingly
            return redirect()->intended('/index');
        } else {
            // Authentication failed, redirect back with an error message
            return back()->with('error', 'Invalid login credentials');
        }
    }

    public function register(Request $request)
    {
        $frontendUser = new FrontendUser();
        $frontendUser->firstname = $request->input('firstname');
        $frontendUser->lastname = $request->input('lastname');
        $frontendUser->email = $request->input('email'); // Utilisez le nom correct du champ email
        $frontendUser->phone = $request->input('phone');
        $frontendUser->gender = $request->input('gender');
        $frontendUser->password =  Hash::make($request->input('password'));
        dd($frontendUser); 
        try {
            // Vérifiez si la méthode save() est exécutée sans erreur
            $frontendUser->save();
        } catch (\Exception $e) {
            // Gérez l'exception, enregistrez-la ou renvoyez une réponse d'erreur
            return redirect()->back()->withErrors(['message' => 'Erreur lors de l\'enregistrement de l\'utilisateur']);
        }
        
        return redirect('/index');
        

    } 
}
