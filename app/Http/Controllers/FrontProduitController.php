<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Marque;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Materiel;
use App\Models\Reference;
use App\Models\Tailles;
use App\Models\Stock;
use App\Models\Panier;
use App\Models\Commentaire;
use ColorJizz\ColorJizz;
use ColorJizz\Formats\RGB;

class FrontProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marques = Marque::all();
        $categories = Categorie::all();
        $materiels = Materiel::all();
        $produitsPublies = Produit::with('marque', 'categorie', 'materiel')
            ->where('statutP', 'publié') // Filtrer les produits publiés
        ->paginate(10)
        ->onEachSide(0);
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
        return view('frontend.index', [
            'produitsPublies' => $produitsPublies,
            'marques' => $marques,
            'categories' => $categories,
            'materiels' => $materiels,
            'paniersCount'=>$paniersCount,
        ]);
    }

    
    public function show($id)
{
    $marques = Marque::all();
    $categories = Categorie::all();
    $materiels = Materiel::all();
    $commentaires = Commentaire::where('idP', $id)
    ->where('statut', 1)
    ->get();
    $produitsPublies = Produit::with('marque', 'categorie', 'materiel')
        ->where('statutP', 'publié')
        ->findOrFail($id);

    // Récupérer les références associées au produit
    $references = Reference::where('idP', $id)->get();
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

    $stock = Stock::where('idP', $id)->first();
    $stockAvailable = false;

    if ($stock) {
        if ($stock->quantite_disponible > 0) {
            $stockAvailable = true;
        }
    }
    
    return view('frontend.product', [
        'produitsPublies' => $produitsPublies,
        'marques' => $marques,
        'categories' => $categories,
        'materiels' => $materiels,
        'references' => $references,
        'paniersCount'=>$paniersCount,
        'stockAvailable'=>$stockAvailable,
        'commentaires'=>$commentaires,
    ]);
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function storeCommentaire(Request $request)
{
    // Validez les données du formulaire ici si nécessaire

    // Créez un nouveau commentaire
    $commentaire = new Commentaire;
    $commentaire->id = auth()->user()->id; // ID de l'utilisateur connecté
    $commentaire->idP = $request->input('productId');
    $commentaire->commentaire = $request->input('comment');
    $commentaire->save();

    // Redirigez l'utilisateur vers la page appropriée après avoir soumis le commentaire
    return redirect()->back()->with('success', 'Commentaire ajouté avec succès.');
}
public function showCommentaires()
    {
        // Récupérez tous les commentaires depuis la base de données
        $commentaires = Commentaire::all();

        // Passez les commentaires à la vue
        return view('commentaire', [
            'commentaires' => $commentaires,
            
        ]);
    }

    public function changer(Request $request, Commentaire $commentaire)
    {
        // Inversez le statut du commentaire
        $commentaire->update(['statut' => !$request->input('statut')]);
    
        // Redirigez l'utilisateur avec un message de confirmation
        $message = $commentaire->statut ? 'Commentaire autorisé.' : 'Commentaire bloqué.';
        return redirect()->back()->with('success', $message);
    }
  
    public function supprimerCommentairesBloques(){
        try {
            // Supprimez les commandes avec validation "annulée" et origine "siteWeb"
            Commentaire::where('statut', '0')->delete();
            
            // Redirigez l'utilisateur vers la page des commandes (ou une autre page de votre choix)
            return redirect()->route('commentaires.index');
            
        } catch (\Exception $e) {
            // Gérez les erreurs ici (par exemple, journalisez-les ou affichez un message d'erreur)
            return redirect()->route('commentaires.index')->with('error', 'Une erreur s\'est produite lors de la suppression des commentaires.');
        }
    }
     
}
