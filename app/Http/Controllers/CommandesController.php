<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commandes;
use App\Models\Client;
use App\Models\Ligne_commande;
use App\Models\Reference;
use App\Models\Produit;
use App\Models\Tailles;

use Dompdf\Dompdf;

class CommandesController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        
        // Récupérer uniquement les commandes avec origine = 'siteWeb'
        $commandes = Commandes::with('client')
            ->where('origine', 'siteWeb')
            ->paginate(6)->onEachSide(0);

        $commandesAvecMontantTotal = [];
        foreach ($commandes as $commande) {
            $montantTotal = $commande->prixTotal + $commande->prix_livraison;
            $commandesAvecMontantTotal[] = [
                'commande' => $commande,
                'montantTotal' => $montantTotal,
            ];
        }

        return view('/orders', ['commandesAvecMontantTotal' => $commandesAvecMontantTotal, 'clients' => $clients,'commandes'=>$commandes]);
    }

public function updateStatut($id)
{
    $commande = Commandes::findOrFail($id);
    $commande->update(['statut_commande' => 'traité']);

    return response()->json(['message' => 'Statut mis à jour avec succès']);
}
public function updateStatutLivraison($id)
{
    $commande = Commandes::findOrFail($id);
    $commande->update(['statut_livraison' => 'livré']);

    return response()->json(['message' => 'Statut mis à jour avec succès']);
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
    public function detailCommande($id)
    {    
        $commandes = Commandes::findOrFail($id);
        $ligneCommandeData = ligne_Commande::where('idCommande', $id)->get(); 
        $produits = [];
        $totalProduits = 0;
        $prixTotal = 0;
        foreach ($ligneCommandeData as $ligneCommande) {
            $reference = Reference::with('produit')->find($ligneCommande->idR);
            
            if ($reference) {
                $produit = $reference->produit;
                  // Vérifier si la ligne de commande a une taille associée
            $taille = null;
            $tailleObject = Tailles::find($ligneCommande->idT);
            if ($tailleObject) {
                $taille = $tailleObject->taille;
            }
                $produits[] = [
                    'reference' => $reference->referenceP,
                    'prix_unitaire' => $produit->prixP,
                    'quantite' => $ligneCommande->quantite,
                    'tailleL' => $taille, // Remplacez par la colonne appropriée
                    'couleur' => $reference->couleur,
                    'image' => $reference->urlPhoto,
                ];
    
                $totalProduits += $ligneCommande->quantite;
                $prixTotal += $produit->prixP * $ligneCommande->quantite;
            }
        }
    
        return view('detailCommande', [
            'ligneCommandeData' => $ligneCommandeData,
            'produits' => $produits,
            'totalProduits' => $totalProduits,
            'prixTotal' => $prixTotal,
            'idCommande'=>$id,
        ]);
    }
  

public function updateValidation(Request $request, $id)
{
    $commande = Commandes::findOrFail($id);
    $nouvelleValidation = $request->input('validation'); // Récupère la nouvelle valeur de validation depuis le formulaire
    $commande->validation = $nouvelleValidation; // Met à jour la valeur de validation dans l'objet Commandes

    // Enregistre les modifications dans la base de données
    $commande->save();

    return redirect()->back()->with('success', 'Validation mise à jour avec succès');
}

}
