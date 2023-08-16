<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;

class CategorieController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::paginate(10)->onEachSide(0);
        return view('categorie')->with('categories', $categories);
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
             'categorie' => 'required|string|max:255|unique:categorie',
         ], [
             'categorie.unique' => 'La categorie existe déjà.',
         ]);
     
         Categorie::create($request->except('_token'));
     
         return redirect()->route('categorie.index')->with('success', 'Categorie ajoutée avec succès');
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
        // Récupère la categorie depuis la base de données en fonction de l'ID
        $row = Categorie::find($idCategorie);

        // Vérifie si la categorie existe
        if (!$row) {
            abort(404); 
        }

        // Passe la variable $row à la vue
        return view('categorie', compact('row'));
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
    public function update(Request $request, $idCategorie)
{
    $categorie = Categorie::find($idCategorie);

    if (!$categorie) {
        return redirect()->route('categorie.index')->with('error', 'Categorie not found');
    }

    $categorie->categorie = $request->input('categorie');
    $categorie->save();

    return redirect()->route('categorie.index')->with('success', 'Categorie modifiée avec succès');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idCategorie)
{
    $categorie = Categorie::find($idCategorie);

    if (!$categorie) {
        return redirect()->route('categorie.index')->with('error', 'Categorie not found');
    }

    $categorie->delete();

    return redirect()->route('categorie.index')->with('success', 'Categorie supprimée avec succès');
}
public function updateCategorie($id){
    $categories=Categorie::find($id);
   return view('updateCategorie',compact('categories')); 

}


public function updateCategorieTraitement(Request $request)
{
    $this->validate($request, [
        'categorie' => 'required|string|max:255|unique:categorie,categorie,' . $request->idCategorie . ',idCategorie',
    ], [
        'categorie.unique' => 'La categorie existe déjà.',
    ]);

    $categorie = Categorie::find($request->idCategorie);

    if ($categorie) {
        try {
            $categorie->categorie = $request->categorie;
            $categorie->save();

            return redirect('/categorie')->with('status', 'Categorie modifiée avec succès');
        } catch (\Exception $e) {
            return redirect('/categorie')->with('error', 'Une erreur s\'est produite.');
        }
    } else {
        return redirect('/categorie')->with('error', 'La categorie n\'existe pas.');
    }
}
}
