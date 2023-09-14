<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marque;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Materiel;
use App\Models\Reference;
use App\Models\Tailles;
use App\Models\Stock;


class ProduitController extends Controller
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
        $produits = Produit::with('marque', 'categorie', 'materiel')->paginate(6)->onEachSide(0);
    
        return view('produit', [
            'produits' => $produits,
            'marques' => $marques,
            'categories' => $categories,
            'materiels' => $materiels,
        ]);
    }
    
    public function search(Request $request)
    {
        $query = $request->input('query');
    
        $produits = Produit::where('nomP', 'like', "%$query%")
                            ->orWhere('descriptionP', 'like', "%$query%")
                            ->orWhere('prixP', 'like', "%$query%")
                            ->orWhere('reductionP', 'like', "%$query%")
                            ->orWhere('statutP', 'like', "%$query%")
                            ->orWhereHas('marque', function ($marqueQuery) use ($query) {
                                $marqueQuery->where('marque', 'like', "%$query%");
                            })
                            ->orWhereHas('categorie', function ($categorieQuery) use ($query) {
                                $categorieQuery->where('categorie', 'like', "%$query%");
                            })
                            ->orWhereHas('materiel', function ($materielQuery) use ($query) {
                                $materielQuery->where('materiel', 'like', "%$query%");
                            })
                            ->paginate(6)
                            ->onEachSide(0);
    
                            $marques = Marque::all();
                            $categories = Categorie::all();
                            $materiels = Materiel::all();
                        
                            return view('produit', compact('produits', 'marques', 'categories', 'materiels'));
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
        $produit = new Produit();
        $produit->nomP = $request->input('NomP');
        $produit->idCategorie = $request->input('product_category');
        $produit->idMateriel = $request->input('product_materiel');
        $produit->idMarque = $request->input('product_brand');
        $produit->descriptionP = $request->input('product-description');
        $produit->prixP = $request->input('product_price');
        $produit->reductionP = $request->input('product_reduction');
        
        $produit->save();

        Stock::create([
            'idP' => $produit->idP,
            'quantite_disponible' => 0,
        ]);
        return redirect()->route('produits.index')->with('success', 'La commande a été ajoutée avec succès.');
        
    }

    public function updateStatut($id)
{
    $produit = Produit::findOrFail($id);
    $produit->update(['statutP' => 'publié']);

    return response()->json(['message' => 'Statut mis à jour avec succès']);
}

public function editProduit($id)
{
    $produit = Produit::findOrFail($id); // Remplacez Produit par le modèle de votre élément
    $marques = Marque::all();
    $categories = Categorie::all();
    $materiels = Materiel::all();
    return view('updateProduit', [
        'produit' => $produit,
        'marques' => $marques,
        'categories' => $categories,
        'materiels' => $materiels,
    ]); 
}

public function detailProduit($id)
{
    $produit = Produit::findOrFail($id); // Remplacez Produit par le modèle de votre élément

    // Récupérer toutes les références avec le même idP que le produit
    $references = Reference::where('idP', $produit->idP)->get();

    $tailles = [];
    foreach ($references as $reference) {
        $tailles[$reference->idR] = Tailles::where('idR', $reference->idR)->get();

    }
  // Récupérer les données de stock pour le produit s'il existe
  $stock = Stock::where('idP', $produit->idP)->first();
  $totalQuantiteProduit = $stock ? $stock->quantite_disponible : 0;

    return view('detailProduit', [
        'produit' => $produit,
        'references' => $references,
        'tailles' => $tailles,
        'totalQuantiteProduit' => $totalQuantiteProduit,
    ]);
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
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $produit = Produit::findOrFail($id);
    
    $produit->nomP = $request->input('NomP');
    $produit->idCategorie = $request->input('product_category');
    $produit->idMateriel = $request->input('product_materiel');
    $produit->idMarque = $request->input('product_brand');
    $produit->descriptionP = $request->input('product-description');
    $produit->prixP = $request->input('product_price');
    $produit->reductionP = $request->input('product_reduction');
    
    $produit->save();

    return redirect('/produit')->with('success', 'Produit mis à jour avec succès');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    $produit = Produit::findOrFail($id);

    // Supprimez les références et tailles associées (cascading delete) si configuré en base de données

    $produit->delete();

    return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès');
}



}
