<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Marque;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Materiel;
use App\Models\Reference;
use App\Models\Tailles;
use App\Models\Stock;
use App\Models\Panier;
use App\Models\User;
use App\Models\Client;
use App\Models\Commandes;
use App\Models\Ligne_commande;
use App\Models\Livraison;

use Carbon\Carbon;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Récupérer les paramètres de l'URL
        $productId = $request->get('product_id');
        $referenceId = $request->get('reference_id');
    
        // Récupérer les informations du produit et de la référence
        $product = Produit::find($productId); // Modifier le modèle et la relation en conséquence
        $reference = Reference::find($referenceId); // Modifier le modèle et la relation en conséquence
    
        // Récupérer la taille et la quantité depuis les données de la requête
        $selectedTaille = $request->get('selected_taille');
        $selectedQuantite = $request->get('selected_quantite');
        if (Auth::check()) {
            // Récupérez l'utilisateur connecté
            $user = Auth::user();
        
            // Ensuite, récupérez le nombre d'articles dans son panier
            $paniersCount = Panier::where('user_id', $user->id)->count();
        
            // Maintenant, $paniersCount contient le nombre d'articles dans le panier de l'utilisateur connecté
        } else {
            // Aucun utilisateur n'est connecté, gérez-le en conséquence
            $paniersCount = 0; // Par exemple, si personne n'est connecté, le panier est vide
        }
        return view('frontend.cart', compact('product', 'reference',  'selectedTaille', 'selectedQuantite','paniersCount'));
    }

   
    public function store(Request $request)
{
    $isAuthenticated = auth()->check();
    $quantite = $request->input('quantite');
    $product_id = $request->input('product_id');
    $reference_id = $request->input('reference_id');
    $taille_id = $request->input('selected_taille');
    $quantiteP = $request->input('selected_quantite');
    $user_id = auth()->user()->id;
  // Récupérer les informations de la taille en fonction de l'ID de référence et de l'ID de taille
    $taille = Tailles::where('idR', $reference_id)
    ->where('taille', $taille_id)
    ->first();
        // Rechercher un enregistrement similaire dans le panier
    $existingCartItem = Panier::where('user_id', $user_id)
    ->where('idP', $product_id)
    ->where('idR', $reference_id)
    ->where('idT', $taille->idT)
    ->first();
  
    if (Auth::check()) {
        // Récupérez l'utilisateur connecté
        $user = Auth::user();
    
        // Ensuite, récupérez le nombre d'articles dans son panier
        $paniersCount = Panier::where('user_id', $user->id)->count();
    
        // Maintenant, $paniersCount contient le nombre d'articles dans le panier de l'utilisateur connecté
    } else {
        // Aucun utilisateur n'est connecté, gérez-le en conséquence
        $paniersCount = 0; // Par exemple, si personne n'est connecté, le panier est vide
    }
    // Calculer la nouvelle quantité en stock
    //$nouvelleQuantiteStock = $taille->quantiteT - $quantite;

    // Mettre à jour la quantité en stock dans la table "Tailles"
    //$taille->quantiteT = $nouvelleQuantiteStock;
    //$taille->save();


if ($existingCartItem) {
// L'enregistrement similaire existe déjà, affichez un message d'erreur
return redirect()->route('summary')->with('error', 'Les détails de ce produit sont déjà choisis.');
}
    // Créer une instance du modèle "Panier"
    $panier = new Panier();

    // Remplir les champs nécessaires
    $panier->user_id = $user_id;
    $panier->idP = $product_id;
    $panier->idR = $reference_id;
    $panier->idT = $taille->idT; // Assurez-vous que cela correspond à la colonne appropriée dans la table "paniers"
    $panier->quantiteP = $quantite;

    // Enregistrer les données dans la table "panier"
    $panier->save();

    session()->flash('success', 'Le produit a été ajouté au panier.');
    return redirect()->route('summary');
}

   
    public function summary()
{
    // Obtenez l'ID de l'utilisateur connecté
    $user_id = auth()->user()->id;
$livraison=Livraison::where('prix', '<>', '0')->get();
    // Récupérez tous les éléments du panier de l'utilisateur connecté avec leurs données associées
    $paniers = Panier::with('produit', 'reference', 'taille')
        ->where('user_id', $user_id)
        ->get();

    // Vous pouvez également ajouter d'autres opérations si nécessaire, comme le calcul du total, etc.
    if (Auth::check()) {
        // Récupérez l'utilisateur connecté
        $user = Auth::user();
    
        // Ensuite, récupérez le nombre d'articles dans son panier
        $paniersCount = Panier::where('user_id', $user->id)->count();
    
        // Maintenant, $paniersCount contient le nombre d'articles dans le panier de l'utilisateur connecté
    } else {
        // Aucun utilisateur n'est connecté, gérez-le en conséquence
        $paniersCount = 0; // Par exemple, si personne n'est connecté, le panier est vide
    }
    // Vous devrez peut-être récupérer les informations du produit ici
    // par exemple, si vous voulez obtenir le premier panier (car les produits devraient être les mêmes)
    // et accéder au produit à partir de là
    $produit = null;
    if ($paniers->isNotEmpty()) {
        $produit = $paniers->first()->produit;
    }

    // Retournez la vue "frontend.summary" avec les données
    return view('frontend.summary', [
        'paniers' => $paniers,
        'produit' => $produit,'paniersCount'=>$paniersCount,'livraison'=>$livraison,
        // Ajoutez d'autres données si nécessaire
    ]);
}

public function calculateTotalPrice(Request $request)
{
    // Récupérez le montant des frais de livraison depuis la requête
    $selectedCity = $request->input('selected_city');
    $deliveryCharge = (float) $request->input('delivery-price');
    
    // Obtenez l'ID de l'utilisateur connecté
    $user_id = auth()->user()->id;

    // Récupérez tous les éléments du panier de l'utilisateur connecté avec leurs données associées
    $paniers = Panier::with('produit', 'reference', 'taille')
        ->where('user_id', $user_id)
        ->get();

    $totalPrice = 0; // Initialisez le total à zéro

    foreach ($paniers as $panier) {
        // Calcul du prix pour ce produit dans le panier
        $prixProduit = $panier->produit->prixP - ($panier->produit->reductionP * $panier->produit->prixP) / 100;

        // Multiplication par la quantité dans le panier
        $prixTotalProduit = $prixProduit * $panier->quantiteP;

        // Ajoutez le prix total de ce produit au total général
        $totalPrice += $prixTotalProduit;
    }

    // Ajoutez les frais de livraison sélectionnés au prix total
    $totalPrice += $deliveryCharge;

    // Stockez le nom de la ville et le montant de la livraison dans la session
    $request->session()->put('selected_city', $selectedCity);
    $request->session()->put('delivery-charge', $deliveryCharge);
    // Redirigez vers la page avec le nouveau prix total
    return redirect()->route('summary')->with('totalPrice', $totalPrice,);
}


public function update(Request $request, $idPaniers)
{
    // Retrieve the shopping cart item
    $panier = Panier::findOrFail($idPaniers);
    if (Auth::check()) {
        // Récupérez l'utilisateur connecté
        $user = Auth::user();
    
        // Ensuite, récupérez le nombre d'articles dans son panier
        $paniersCount = Panier::where('user_id', $user->id)->count();
    
        // Maintenant, $paniersCount contient le nombre d'articles dans le panier de l'utilisateur connecté
    } else {
        // Aucun utilisateur n'est connecté, gérez-le en conséquence
        $paniersCount = 0; // Par exemple, si personne n'est connecté, le panier est vide
    }
    // Retrieve the selected size and its available stock quantity
    $selectedSize = Tailles::findOrFail($panier->idT);
    $availableStock = $selectedSize->quantiteT;

    // Get the entered quantity from the request
    $enteredQuantity = $request->input('quantiteP');

    // Check if the entered quantity exceeds the available stock quantity
   // Check if the entered quantity exceeds the available stock quantity
if ($enteredQuantity > $availableStock) {
    return redirect()->back()->with('error', 'La quantité dépasse la quantité en stock (' . $availableStock . '). Veuillez saisir une quantité valide.');
}


    // Update the cart item with the new quantity
    $panier->quantiteP = $enteredQuantity;
    $panier->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Cart item updated successfully.');
}



public function destroy(Panier $panier)
{    $quantiteSupprimee = $panier->quantiteP;
    $tailleId = $panier->idT;
    if (Auth::check()) {
        // Récupérez l'utilisateur connecté
        $user = Auth::user();
    
        // Ensuite, récupérez le nombre d'articles dans son panier
        $paniersCount = Panier::where('user_id', $user->id)->count();
    
        // Maintenant, $paniersCount contient le nombre d'articles dans le panier de l'utilisateur connecté
    } else {
        // Aucun utilisateur n'est connecté, gérez-le en conséquence
        $paniersCount = 0; // Par exemple, si personne n'est connecté, le panier est vide
    }
    // Supprimez le panier
    $panier->delete();

// Utilisez redirect() pour rediriger vers la vue "summary"
    return redirect()->route('summary');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    public function storeC(Request $request)
{
    $user = Auth::user();
    // Validez les données du formulaire ici si nécessaire

    // Créez un nouvel enregistrement Client avec les données du formulaire
    $client = new Client();
    $client->nomC = $request->input('nomC');
    $client->prenomC = $request->input('prenomC');
    $client->telC = $request->input('telC');
    $client->adresseC = $request->input('adresseC');
    $client->villeC = $request->input('villeC');
    $client->emailC = $request->input('emailC'); 
    $client->origine = 'siteWeb'; 


    // Ajoutez d'autres champs du formulaire ici
    $client->save();
    $latestClient = Client::latest()->first();
      

    $commande = new Commandes();
    $commande->idC = $latestClient->idC;
    $commande->id = $user->id;
    $commande->date_commande = Carbon::now();
    $commande->adresse_livraison = $request->input('adresse_livraison');
    $commande->date_livraison = $request->input('date_livraison');
    $commande->prix_livraison = $request->input('prix_livraison');

    // Ajoutez d'autres champs de la commande ici
    $commande->save();
    $paniers = Panier::all(); // Récupérez tous les enregistrements de la table paniers

    foreach ($paniers as $panier) {
        $ligneCommande = new Ligne_commande();
        $ligneCommande->idCommande = $commande->idCommande; // Utilisez l'ID de la commande créée précédemment
        $ligneCommande->idR = $panier->idR;
        $ligneCommande->quantite = $panier->quantiteP;
        $ligneCommande->idT = $panier->idT;
        $ligneCommande->save();
    }

    foreach ($paniers as $panier) {
        // Récupérez la taille associée au panier
        $taille = Tailles::find($panier->idT);
        
        if ($taille) {
            // Décrémentez la quantité dans la table "Tailles"
            $taille->quantiteT -= $panier->quantiteP;
            $taille->save();
    
        // Récupérer la nouvelle référence
        $reference = Reference::find($taille->idR);
        
        $tailles_new = Tailles::where('idR', $taille->idR)->get();
        $totalQuantiteR_new= $tailles_new->sum('quantiteT');
        // Mettre à jour la quantité totale de référence
        $reference->quantiteR = $totalQuantiteR_new;
        $reference->save();

        // Recalculer et mettre à jour les quantités de Produit
        $references = Reference::where('idP', $reference->idP)->get();
        $totalQuantite_new = $references->sum('quantiteR');

        // Recalculer et mettre à jour les quantités de stock
        $stock_new = Stock::where('idP', $reference->idP)->first();
        if ($stock_new) {
            $stock_new->quantite_disponible = $totalQuantite_new;
            $stock_new->save();
        }
    }

    }

    // Supprimez tous les enregistrements de panier pour cet utilisateur
    $user = Auth::user();

    // Supprimez tous les enregistrements de panier pour cet utilisateur
    Panier::where('user_id', $user->id)->delete();


    // Redirigez l'utilisateur vers une page de confirmation ou une autre action
    return redirect()->route('summary', ['success' => 'Votre commande a été envoyée avec succès. Nous vous contacterons bientôt.']);
}

public function historiqueCommandes()
{
    // Récupérez l'utilisateur connecté
    $user = Auth::user();
    if (Auth::check()) {
        // Récupérez l'utilisateur connecté
        $user = Auth::user();
    
        // Ensuite, récupérez le nombre d'articles dans son panier
        $paniersCount = Panier::where('user_id', $user->id)->count();
    
        // Maintenant, $paniersCount contient le nombre d'articles dans le panier de l'utilisateur connecté
    } else {
        // Aucun utilisateur n'est connecté, gérez-le en conséquence
        $paniersCount = 0; // Par exemple, si personne n'est connecté, le panier est vide
    }
    // Récupérez le client associé à l'email de l'utilisateur
    $ConnectedUser = User::where('id', $user->id)->first();
    $cnt = 0; 
    if ($ConnectedUser) {
        $clients = Client::all();
        // Récupérez toutes les commandes du client en fonction de son idC
        $commandes = Commandes::where('id', $ConnectedUser->id)->get();

        $lignesCommande = [];

        // Parcourez chaque commande pour récupérer ses lignes de commande
        foreach ($commandes as $commande) {
            // Récupérez les lignes de commande pour cette commande spécifique
            $lignes = Ligne_commande::where('idCommande', $commande->idCommande)->get();
            
            // Ajoutez les lignes de commande à un tableau associatif avec la clé étant l'id de la commande
            $lignesCommande[$commande->idCommande] = $lignes;
        }

        // Renvoyez la vue après avoir récupéré toutes les lignes de commande
        return view('frontend.historique', ['commandes' => $commandes, 'lignesCommande' => $lignesCommande,'cnt'=>$cnt,'paniersCount'=>$paniersCount]);
    }
    else
     return view('frontend.historique');

}




}
