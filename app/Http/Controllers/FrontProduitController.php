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
}
