<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livraison;

class LivraisonController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $livraisons = Livraison::paginate(10)->onEachSide(0);
        return view('livraison')->with('livraisons', $livraisons);
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
         $this->validate($request, [
             'livraison' => 'required|string|max:255|unique:livraison',
             'prix' => 'required|numeric|min:0',
         ], [
              'livraison.unique' => 'La ville de livraison existe déjà.',
         ]);
     
         Livraison::create($request->except('_token'));
     
         return redirect()->route('livraison.index')->with('success', 'Livraison ajoutée avec succès');
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
    public function showForm($id)
    {
        // Récupère la livraison depuis la base de données en fonction de l'ID
        $row = Livraison::find($idlivraison);

        // Vérifie si la livraison existe
        if (!$row) {
            abort(404); // Livraison non trouvée, affiche une erreur 404
        }

        // Passe la variable $row à la vue
        return view('livraison', compact('row'));
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
    public function update(Request $request, $idlivraison)
{
    $livraison = Livraison::find($idlivraison);

    if (!$livraison) {
        return redirect()->route('livraison.index')->with('error', 'Livraison not found');
    }

    $livraison->livraison = $request->input('livraison');
    $livraison->prix = $request->input('prix');


    $livraison->save();

    return redirect()->route('livraison.index')->with('success', 'Livraison modifiée avec succès');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idlivraison)
{
    // Find the Livraison record with the given $idlivraison
    $livraison = Livraison::find($idlivraison);

    // Check if the Livraison record exists
    if (!$livraison) {
        return redirect()->route('livraison.index')->with('error', 'Livraison not found');
    }

    // Delete the Livraison record
    $livraison->delete();

    return redirect()->route('livraison.index')->with('success', 'Livraison supprimée avec succès');
}
public function updateLivraison($id){
    $livraisons=Livraison::find($id);
   return view('updateLivraison',compact('livraisons')); 

}


public function updateLivraisonTraitement(Request $request)
{
       $this->validate($request, [
              'livraison' => 'required|string|max:255|unique:livraison,livraison,' . $request->idlivraison . ',idlivraison',
              'prix' => 'required|numeric|min:0',
          ], [
              'livraison.unique' => 'La ville de livraison existe déjà.',
          ]);
          

    $livraison = Livraison::find($request->idlivraison);

    if ($livraison) {
        try {
            $livraison->livraison = $request->livraison;
            $livraison->prix = $request->prix;
            $livraison->save();

            return redirect('/livraison')->with('status', 'Livraison modifiée avec succès');
        } catch (\Exception $e) {
            return redirect('/livraison')->with('error', 'Une erreur s\'est produite.');
        }
    } else {
        return redirect('/livraison')->with('error', 'La livraison n\'existe pas.');
    }
}
}
