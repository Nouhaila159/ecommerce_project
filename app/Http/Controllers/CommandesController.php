<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Commandes;
use App\Models\Stock;
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
            ->paginate(5)->onEachSide(0);

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

    public function search(Request $request)
    {
        $query = $request->input('query');
    
        $clients = Client::all();
            
        // Récupérer uniquement les commandes avec origine = 'siteWeb' et qui correspondent à la recherche
        $commandes = Commandes::with('client')
            ->where('origine', 'siteWeb')
            ->where(function ($q) use ($query) {
                $q->where('idCommande', 'like', "%$query%")
                  ->orWhere('date_commande', 'like', "%$query%")
                  ->orWhere('date_livraison', 'like', "%$query%")
                  ->orWhere('adresse_livraison', 'like', "%$query%")
                  ->orWhere('prix_livraison', 'like', "%$query%")
                  ->orWhere('statut_commande', 'like', "%$query%")
                  ->orWhere('statut_livraison', 'like', "%$query%")
                  ->orWhere('validation', 'like', "%$query%")
                  ->orWhereHas('client', function ($clientQuery) use ($query) {
                      $clientQuery->where('nomC', 'like', "%$query%")
                                  ->orWhere('prenomC', 'like', "%$query%")
                                  ->orWhere('telC', 'like', "%$query%");
                  });
            })
            ->paginate(5)->onEachSide(0);
    
        $commandesAvecMontantTotal = [];
        foreach ($commandes as $commande) {
            $montantTotal = $commande->prixTotal + $commande->prix_livraison;
            $commandesAvecMontantTotal[] = [
                'commande' => $commande,
                'montantTotal' => $montantTotal,
            ];
        }
    
        return view('/orders', [
            'commandesAvecMontantTotal' => $commandesAvecMontantTotal,
            'clients' => $clients,
            'commandes' => $commandes,
        ]);
    }
    
    public function supprimerCommandesAnnulees()
    {
        try {
            // Supprimez les commandes avec validation "annulée" et origine "siteWeb"
            Commandes::where('validation', 'annulée')->where('origine', 'siteWeb')->delete();
            
            // Redirigez l'utilisateur vers la page des commandes (ou une autre page de votre choix)
            return redirect()->route('orders.index');
            
        } catch (\Exception $e) {
            // Gérez les erreurs ici (par exemple, journalisez-les ou affichez un message d'erreur)
            return redirect()->route('orders.index')->with('error', 'Une erreur s\'est produite lors de la suppression des commandes.');
        }
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
                $prixTotal += ($produit->prixP- ($produit->reductionP * $produit->prixP) / 100) * $ligneCommande->quantite;
            }
            $prixTotal =$prixTotal +($commandes->prix_livraison);
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
        
        if($nouvelleValidation=='annulée'){
            $ligneCommandes = ligne_Commande::where('idCommande', $id)->get(); 

            if (!$ligneCommandes) {
                return response()->json(['success' => false, 'message' => 'Détail introuvable']);
            }
        
            foreach ($ligneCommandes as $ligneCommande) {    
                $idR = $ligneCommande->idR;
                $tailleL = $ligneCommande->idT;
                $quantite = $ligneCommande->quantite;
            
            
                //$ligneCommande->delete();
            
                // Appeler une nouvelle méthode pour mettre à jour la quantité dans la table de référence
                $this->mettreAJourQuantiteReference($idR,$tailleL, $quantite);
            }

        }
            return redirect()->back()->with('success', 'Validation mise à jour avec succès');

    }
    private function mettreAJourQuantiteReference($idR, $tailleL, $quantite)
    {
        // Utiliser une transaction pour gérer les opérations atomiques
        DB::beginTransaction();

        try {
        // Mettre à jour la quantité dans la table des tailles
        $taille = Tailles::where('idR', $idR)
            ->where('idT', $tailleL)
            ->lockForUpdate() // Verrouille la ligne pour éviter les conflits de concurrence
            ->first();

        if (!$taille) {
            throw new \Exception('Taille introuvable');
        }

        $taille->quantiteT += $quantite;
        $taille->save();

        // Mettre à jour la quantité totale de référence
        $reference = Reference::find($idR);
        $reference->quantiteR = Tailles::where('idR', $reference->idR)->sum('quantiteT');
        $reference->save();

        // Recalculer et mettre à jour les quantités de stock
        $stock = Stock::where('idP', $reference->idP)->first();
        if ($stock) {
            $stock->quantite_disponible = Reference::where('idP', $reference->idP)->sum('quantiteR');
            $stock->save();
        }

        // Valider et enregistrer les changements
        DB::commit();
        return 0;

        } catch (\Exception $e) {
            // En cas d'erreur, annuler les modifications
            DB::rollback();

            // Gérer l'erreur (redirection, réponse JSON d'erreur, message d'erreur, etc.)
        }
    }

}