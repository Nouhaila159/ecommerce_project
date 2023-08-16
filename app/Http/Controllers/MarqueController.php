<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marque;

class MarqueController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marques = Marque::paginate(10)->onEachSide(0);
        return view('brands')->with('marques', $marques);
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
             'marque' => 'required|string|max:255|unique:marque',
         ], [
             'marque.unique' => 'La marque existe déjà.',
         ]);
     
         Marque::create($request->except('_token'));
     
         return redirect()->route('brands.index')->with('success', 'Marque ajoutée avec succès');
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
        // Récupère la marque depuis la base de données en fonction de l'ID
        $row = Marque::find($idMarque);

        // Vérifie si la marque existe
        if (!$row) {
            abort(404); // Marque non trouvée, affiche une erreur 404
        }

        // Passe la variable $row à la vue
        return view('brands', compact('row'));
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
    public function update(Request $request, $idMarque)
{
    $marque = Marque::find($idMarque);

    if (!$marque) {
        return redirect()->route('brands.index')->with('error', 'Marque not found');
    }

    $marque->marque = $request->input('marque');
    $marque->save();

    return redirect()->route('brands.index')->with('success', 'Marque modifiée avec succès');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idMarque)
{
    // Find the Marque record with the given $idMarque
    $marque = Marque::find($idMarque);

    // Check if the Marque record exists
    if (!$marque) {
        return redirect()->route('brands.index')->with('error', 'Marque not found');
    }

    // Delete the Marque record
    $marque->delete();

    return redirect()->route('brands.index')->with('success', 'Marque supprimée avec succès');
}
public function updateMarque($id){
    $marques=Marque::find($id);
   return view('updateMarque',compact('marques')); 

}


public function updateMarqueTraitement(Request $request)
{
    $this->validate($request, [
        'marque' => 'required|string|max:255|unique:marque,marque,' . $request->idMarque . ',idMarque',
    ], [
        'marque.unique' => 'La marque existe déjà.',
    ]);

    $marque = Marque::find($request->idMarque);

    if ($marque) {
        try {
            $marque->marque = $request->marque;
            $marque->save();

            return redirect('/brands')->with('status', 'Marque modifiée avec succès');
        } catch (\Exception $e) {
            return redirect('/brands')->with('error', 'Une erreur s\'est produite.');
        }
    } else {
        return redirect('/brands')->with('error', 'La marque n\'existe pas.');
    }
}
}
