<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanierController extends Controller
{
    public function addToCart(Request $request)
{
    // Récupérer les informations du produit à ajouter au panier depuis la requête
    $product_id = $request->input('product_id');
    $reference_id = $request->input('reference_id');
    $taille = $request->input('selected_taille');
    $quantite = $request->input('selected_quantite');
    
    // Récupérer l'utilisateur connecté (vous devrez peut-être ajuster ceci en fonction de votre authentification)
    $user_id = auth()->user()->id; // À adapter en fonction de votre logique d'authentification
    
    // Ajouter les informations au panier
    $panier = new Panier([
        'user_id' => $user_id,
        'product_id' => $product_id,
        'reference_id' => $reference_id,
        'tailleP' => $taille,
        'quantiteP' => $quantite,
    ]);
    
    $panier->save();
    
    // Rediriger ou effectuer toute autre action après l'ajout au panier
    return redirect()->route('accueil')->with('success', 'Le produit a été ajouté au panier.');
}
}
