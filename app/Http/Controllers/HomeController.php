<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marque;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Commandes;
use App\Models\Reference;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
        $totalProduits = Produit::count(); // Récupère le nombre total de produits
        $totalMarques = Marque::count();
        $totalCategories = Categorie::count();
        $totalCommandes = Commandes::count();
        $totalReferences = Reference::count();
        $totalUsers = User::count();
        return 
        view('master', 
        compact('totalProduits',
        'totalMarques',
        'totalCategories',
        'totalCommandes',
        'totalReferences',
        'totalUsers',
        )
        );
    }

    

public function indexUsers()
{
    $users = User::paginate(5)->onEachSide(0); // Récupérer tous les utilisateurs

    return view('users', [
        'users' => $users, // Passer les utilisateurs à la vue
    ]);
}
}
