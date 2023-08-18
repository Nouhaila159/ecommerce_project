<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Commandes;
use App\Models\Client;
use App\Models\Ligne_commande;
use App\Models\Reference;
use App\Models\Produit;
use App\Models\Tailles;
use App\Models\Stock;
use Dompdf\Dompdf;

class VenteController extends Controller
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
        ->where('origine', '<>', 'siteWeb')
        ->paginate(2)->onEachSide(0);

    $commandesAvecMontantTotal = [];
    foreach ($commandes as $commande) {
        $montantTotal = $commande->prixTotal + $commande->prix_livraison;
        $commandesAvecMontantTotal[] = [
            'commande' => $commande,
            'montantTotal' => $montantTotal,
        ];
    }

    return view('/vente', ['commandesAvecMontantTotal' => $commandesAvecMontantTotal, 'clients' => $clients,'commandes'=>$commandes]);
}

public function detailVente($id)
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
                'idLigne' => $ligneCommande->idLigneC,
                'idR'=> $reference->idR,
                'reference' => $reference->referenceP,
                'prix_unitaire' => $produit->prixP,
                'quantite' => $ligneCommande->quantite,
                'tailleL' => $taille,
                'couleur' => $reference->couleur,
                'image' => $reference->urlPhoto,
            ];

            $totalProduits += $ligneCommande->quantite;
            $prixTotal += $produit->prixP * $ligneCommande->quantite;
        }
    }

    return view('detailVente', [
        'commandes'=>$commandes,
        'ligneCommandeData' => $ligneCommandeData,
        'produits' => $produits,
        'totalProduits' => $totalProduits,
        'prixTotal' => $prixTotal,
        'idCommande'=>$id,
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
    $commande = Commandes::findOrFail($id);

    // Récupérer l'ID du client associé à la commande
    $idC = $commande->idC;

    // Supprimer la commande
    $commande->delete();

    return redirect()->route('vente')->with('success', 'La commande et le client ont été supprimés avec succès.');
}
    public function updateValidationV(Request $request, $id)
{
    $commande = Commandes::findOrFail($id);
    $nouvelleValidation = $request->input('validation'); // Récupère la nouvelle valeur de validation depuis le formulaire
    $commande->validation = $nouvelleValidation; // Met à jour la valeur de validation dans l'objet Commandes

    // Enregistre les modifications dans la base de données
    $commande->save();
    return redirect()->back()->with('success', 'Validation mise à jour avec succès');

}

public function updateStatutV($id)
{
    $commande = Commandes::findOrFail($id);
    $commande->update(['statut_commande' => 'traitée']);

    return response()->json(['message' => 'Statut mis à jour avec succès']);
}
public function updateStatutLivraisonV($id)
{
    $commande = Commandes::findOrFail($id);
    $commande->update(['statut_livraison' => 'livrée']);

    return response()->json(['message' => 'Statut mis à jour avec succès']);
}

public function genererFactureV($id){
    $ligneCommandeData = Ligne_commande::where('idCommande', $id)->get();
    $commande = Commandes::findOrFail($id); // Fetch the specific commande
    $client = Client::findOrFail($commande->idC); // Fetch the associated client
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
                'tailleL' => $taille,
                'couleur' => $reference->couleur,
                'image' => $reference->urlPhoto,
            ];
    
            $totalProduits += $ligneCommande->quantite;
            $prixTotal += $produit->prixP * $ligneCommande->quantite;
        }
    }
    
    return view('facture', [
        'idCommande' => $id,
        'commande' => $commande, // Pass the specific commande
        'client' => $client, // Pass the associated client
        'produits' => $produits,
        'totalProduits' => $totalProduits,
        'prixTotal' => $prixTotal,
    ]);
}
public function telechargerFactureV($id)
{
    try {
        // ... le reste du code

        // Rendre le PDF
        $pdf->render();

        // Télécharger le PDF avec un nom de fichier personnalisé
        return response()->download($pdf->output(), 'facture_'.$id.'.pdf');
    } catch (\Exception $e) {
        return back()->with('error', 'Une erreur s\'est produite lors de la génération de la facture.');
    }
}
public function updateValidation(Request $request, $id)
{
    $commande = Commandes::findOrFail($id);
    // Enregistre les modifications dans la base de données
    $commande->save();

    return redirect()->back()->with('success', 'Validation mise à jour avec succès');
}

public function ajouterVente()
    {
        return view('ajouterVente');
    }
public function ajouterVentePost(Request $request)
{
    // Validez les données entrées par l'utilisateur si nécessaire
    
    // Créez un nouveau client ou récupérez un client existant
    $client = new Client();
    $client->nomC = $request->input('nomC');
    $client->prenomC = $request->input('prenomC');
    $client->telC = $request->input('telC');
    $client->adresseC = $request->input('adresseC');
    $client->emailC = $request->input('emailC');
    $client->villeC = $request->input('villeC');

    
    $client->save();
    
    // Créez une nouvelle instance de Commande avec les données du formulaire
    $commande = new Commandes();
    $commande->idC = $client->idC; // Utilisez l'ID du client créé ou récupéré
    $commande->date_commande = $request->input('date_commande');
    $commande->date_livraison = $request->input('date_livraison');
    $commande->adresse_livraison = $request->input('adresse_livraison');
    $commande->prix_livraison = $request->input('prix_livraison');
    $commande->origine = $request->input('origine');
    // ... autres champs ...
    
    $commande->save();
    return redirect()->route('vente')->with('success', 'La commande a été ajoutée avec succès.');
}

public function showUpdateForm($id) {
    // Fetch the data for the command based on the $id
    $commande = Commandes::find($id); // Remplacez Commande par le modèle de votre commande

    if (request()->has('showForm')) {
        return view('updateVente', compact('commande'));
    } else {
        // Return the regular view without the form
        return view('updateVente', compact('commande'));
    }
}
public function updateVente(Request $request, $id)
{
    // Validez les données entrées par l'utilisateur si nécessaire

    // Find the associated client
    $commande = Commandes::find($id);
    $client = Client::find($commande->idC);

    if (!$client) {
        return redirect()->back()->with('error', 'Le client associé à la commande n\'existe pas.');
    }

    // Update the client details
    $client->nomC = $request->input('nomC');
    $client->prenomC = $request->input('prenomC');
    $client->telC = $request->input('telC');
    $client->adresseC = $request->input('adresseC');
    $client->emailC = $request->input('emailC');
    $client->villeC = $request->input('villeC');
    $client->save();

    // Continue with updating the command
    if (!$commande) {
        return redirect()->back()->with('error', 'La commande que vous essayez de mettre à jour n\'existe pas.');
    }

    // Mettez à jour les champs de la commande avec les nouvelles valeurs du formulaire
    $commande->date_commande = $request->input('date_commande');
    $commande->date_livraison = $request->input('date_livraison');
    $commande->adresse_livraison = $request->input('adresse_livraison');
    $commande->prix_livraison = $request->input('prix_livraison');
    $commande->origine = $request->input('origine');
    // Mettez à jour les autres champs ici...

    $commande->save();
    return redirect()->route('vente')->with('success', 'La commande a été mise à jour avec succès.');
}

//////////////////////////////////////////////////////////CRUD DETAIL/////////////////////////////////////

public function ajouter_referenceVente_index($id)
{
    $references = Reference::all();

    return view('addDetailVente',[
        'id'=> $id,
        'references' => $references,]
    );
}

public function getReferenceImage($id)
{
    $reference = Reference::find($id);

    if ($reference) {
        return response()->json(['urlPhoto' => $reference->urlPhoto]);
    }

    return response()->json(['error' => 'Référence non trouvée'], 404);
}

public function getReferenceSizes($id)
{
    // Obtenez les tailles disponibles pour la référence spécifiée (idR)
    $sizes = Tailles::where('idR', $id)->get();

    // Retournez les tailles sous forme de réponse JSON
    return response()->json(['sizes' => $sizes]);
}



public function ajouter_referenceVente(Request $request)
{
    $idCommande = $request->input('idVente');
    $idR = $request->input('reference');
    $idT = $request->input('taille');
    $quantite = $request->input('quantite');

    // Utiliser une transaction pour gérer les opérations atomiques
    DB::beginTransaction();

    try {
        // Vérifier si une ligne de commande avec la même référence et la même taille existe déjà
        $existingLigneCommande = Ligne_commande::where('idCommande', $idCommande)
            ->where('idR', $idR)
            ->where('idT', $idT)
            ->first();

        if ($existingLigneCommande) {
            $taille = Tailles::find($idT);

            if ($taille->quantiteT >= $quantite) {
                // Créer un nouvel enregistrement dans la table ligne_commande
                // Incrémenter la quantité existante
                $existingLigneCommande->quantite += $quantite;
                $existingLigneCommande->save();
                // Mettre à jour la quantité disponible dans la table tailles
                $taille->quantiteT -= $quantite;
                $taille->save();

                // Récupérer la référence
                $reference = Reference::find($idR);

                $tailles = Tailles::where('idR', $reference->idR)->get();
                $totalQuantiteR = $tailles->sum('quantiteT');
                // Mettre à jour la quantité totale de référence
                $reference->quantiteR = $totalQuantiteR;
                $reference->save();

                // Recalculer et mettre à jour les quantités de Produit
                $references = Reference::where('idP', $reference->idP)->get();
                $totalQuantite = $references->sum('quantiteR');

                // Recalculer et mettre à jour les quantités de stock
                $stock = Stock::where('idP', $reference->idP)->first();
                if ($stock) {
                    $stock->quantite_disponible = $totalQuantite;
                    $stock->save();
                }

                // Si tout s'est bien passé, valider et enregistrer les changements
                DB::commit();
            } else {
                // Quantité insuffisante, annuler la transaction
                DB::rollback();
            // Add an error message to the session
            return redirect()->route('venteDetail.index', ['id' => $idCommande])
            ->withErrors(['quantite' => 'La quantité demandée n\'est pas disponible.']);

                // Gérer l'erreur (redirection, réponse JSON d'erreur, message d'erreur, etc.)
            }
            
        } else {
            // Vérifier la quantité disponible dans la table tailles
            $taille = Tailles::find($idT);

            if ($taille->quantiteT >= $quantite) {
                // Créer un nouvel enregistrement dans la table ligne_commande
                Ligne_commande::create([
                    'idCommande' => $idCommande,
                    'idR' => $idR,
                    'quantite' => $quantite,
                    'idT' => $idT,
                ]);

                // Mettre à jour la quantité disponible dans la table tailles
                $taille->quantiteT -= $quantite;
                $taille->save();

                // Récupérer la référence
                $reference = Reference::find($idR);

                $tailles = Tailles::where('idR', $reference->idR)->get();
                $totalQuantiteR = $tailles->sum('quantiteT');
                // Mettre à jour la quantité totale de référence
                $reference->quantiteR = $totalQuantiteR;
                $reference->save();

                // Recalculer et mettre à jour les quantités de Produit
                $references = Reference::where('idP', $reference->idP)->get();
                $totalQuantite = $references->sum('quantiteR');

                // Recalculer et mettre à jour les quantités de stock
                $stock = Stock::where('idP', $reference->idP)->first();
                if ($stock) {
                    $stock->quantite_disponible = $totalQuantite;
                    $stock->save();
                }

                // Si tout s'est bien passé, valider et enregistrer les changements
                DB::commit();
            } else {
                // Quantité insuffisante, annuler la transaction
                DB::rollback();
            // Add an error message to the session
            return redirect()->route('venteDetail.index', ['id' => $idCommande])
            ->withErrors(['quantite' => 'La quantité demandée n\'est pas disponible.']);

                            // Gérer l'erreur (redirection, réponse JSON d'erreur, message d'erreur, etc.)
            }
        }
        
        // Rediriger l'utilisateur ou retourner une réponse JSON réussie
        return redirect()->route('vente.detail', ['id' => $idCommande]);
    } catch (\Exception $e) {
        // En cas d'erreur, annuler les modifications
        DB::rollback();
        
        // Gérer l'erreur (redirection, réponse JSON d'erreur, message d'erreur, etc.)
    }
}



public function supprimerLigneCommande($id)
{
    $ligne = Ligne_commande::find($id);

    if (!$ligne) {
        return response()->json(['success' => false, 'message' => 'Détail introuvable']);
    }

    // Sauvegarder les informations nécessaires avant la suppression

    $idR = $ligne->idR;
    $tailleL = $ligne->idT;
    $quantite = $ligne->quantite;

    // Suppression de la référence
    $ligne->delete();

    // Appeler une nouvelle méthode pour mettre à jour la quantité dans la table de référence
    $this->mettreAJourQuantiteReference($idR,$tailleL, $quantite);

    return response()->json(['success' => true, 'message' => 'Détail supprimé avec succès']);
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