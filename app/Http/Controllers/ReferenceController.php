<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Reference;
use App\Models\Tailles;
use App\Models\Stock;
use App\Models\Ligne_commande;
use Illuminate\Http\RedirectResponse;




class ReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return view('addDetailProduit', compact('id'));
    }

    public function ajouterReference(Request $request)
    {
        $request->validate([
            'reference' => 'required|unique:reference,referenceP', // Ajoutez ici la règle unique avec un message personnalisé
            'couleur' => 'required',
            'image' => 'required|image',
            // ...
        ], [
            'reference.unique' => 'La référence est déjà utilisée.', // Message personnalisé pour la règle unique
        ]);
    
        $reference = new Reference();
        $reference->idP = $request->input('idProduit'); // Récupérer l'ID du produit
        $reference->referenceP = $request->input('reference');
        $reference->couleur = $request->input('couleur');
    
        // Gestion de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $reference->urlPhoto = $imagePath;
        }
        
        $reference->save();

            // Enregistrez les tailles et quantités associées
        $tailles = $request->input('tailles');
        $quantites = $request->input('quantites');

        // Calculer la somme totale des quantités

        $totalQuantite = array_sum($quantites);

        $reference->quantiteR+= $totalQuantite;
        $reference->save();

        foreach ($tailles as $index => $taille) {
            $existingTaille = Tailles::where('idR', $reference->idR)->where('taille', $taille)->first();
            if ($existingTaille) {
                $existingTaille->quantiteT += $quantites[$index];
                $existingTaille->save();
            } else {
                Tailles::create([
                    'idR' => $reference->idR,
                    'taille' => $taille,
                    'quantiteT' => $quantites[$index],
                ]);
            }
        }

        // Mettre à jour la quantité disponible dans la table Stock
        $stock = Stock::where('idP', $reference->idP)->first();
        if ($stock) {
            $stock->quantite_disponible += $totalQuantite;
            $stock->save();
        } else {
            Stock::create([
                'idP' => $reference->idP,
                'quantite_disponible' => $totalQuantite,
            ]);
        }

        $id = $reference->idP;
        return redirect()->route('produits.detail', ['id' => $id])->with('success', 'Référence ajoutée avec succès.');
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
    public function editReference($idR, $idP)
    {
        $reference = Reference::findOrFail($idR);
        $sizesAndQuantities = Tailles::where('idR', $idR)->get();
            // Fetch other related data if needed
        
            return view('updateReference', [
                'reference' => $reference,
                'sizesAndQuantities' => $sizesAndQuantities,
                'id' => $idP,
            ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateReference(Request $request, $idR)
{
    $reference = Reference::findOrFail($idR);
    $idP = $request->input('idProduit');
    $quantites = $request->input('quantites');

    // Update reference data
    $reference->referenceP = $request->input('reference');
    $reference->couleur = $request->input('couleur');
    // Update image if provided
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
        $reference->urlPhoto = $imagePath;
    }
    
    // Enregistrez les tailles et quantités associées
    $tailles = $request->input('tailles');
    $quantites = $request->input('quantites');


    // Mettre à jour les tailles existantes et ajouter les nouvelles tailles avec leurs quantités
    foreach ($tailles as $index => $taille) {
        $existingTaille = Tailles::where('idR', $reference->idR)
                                  ->where('taille', $taille)
                                  ->first();
       
        if ($existingTaille) {
            // Mettre à jour la quantité de la taille existante
            $existingTaille->quantiteT = $quantites[$index];
            $existingTaille->save();
        } else {
            // Créer une nouvelle taille avec sa quantité
            $newTaille = Tailles::create([
                'idR' => $reference->idR,
                'taille' => $taille,
                'quantiteT' => $quantites[$index],
            ]);
        }
    }
    $existingSizes = Tailles::where('idR', $reference->idR)->pluck('taille')->toArray();


    $usedSizesIds = Ligne_commande::where('idR', $reference->idR)
    ->whereIn('idT', function ($query) use ($reference) {
        $query->select('idT')
            ->from('tailles')
            ->where('idR', $reference->idR);
    })
    ->pluck('idT')
    ->toArray();

    foreach ($existingSizes as $existingSize) {
        if (!in_array($existingSize, $tailles)) {
            if (!in_array($existingSize, $usedSizesIds)) {
                Tailles::where('idR', $reference->idR)
                       ->where('taille', $existingSize)
                       ->delete();
            } else {
                $errorMessage = "La taille {$existingSize} ne peut pas être supprimée car elle est utilisée dans des lignes de commande.";
                return back()->with('error', $errorMessage);
            }
        }
    }
    

    // Recalculate and update reference and stock quantities
    $totalQuantite = array_sum($quantites);
    $reference->quantiteR = $totalQuantite;
    $reference->save();
    
    $references = Reference::where('idP', $reference->idP)->get();
    $totalQuantite = $references->sum('quantiteR');

    $stock = Stock::where('idP', $idP)->first();
    if ($stock) {
        $stock->quantite_disponible = $totalQuantite;
        $stock->save();
    }

    return redirect()->route('produits.detail', ['id' => $idP])->with('success', 'Référence modifiée avec succès.');
}

    

    public function supprimerReference($id) {
        $reference = Reference::find($id);
    
        if (!$reference) {
            return response()->json(['success' => false, 'message' => 'Référence introuvable']);
        }
    
        // Mettre à jour la quantité disponible dans la table Stock
        $stock = Stock::where('idP', $reference->idP)->first();
        if ($stock) {
            $stock->quantite_disponible -= $reference->quantiteR; // Décrémenter la quantité disponible
            $stock->save();
        }
    
        // Suppression de la référence
        $reference->delete();
    
        return response()->json(['success' => true, 'message' => 'Référence supprimée avec succès']);
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
