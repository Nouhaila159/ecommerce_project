<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiel;

class MaterielController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materiels = Materiel::paginate(10)->onEachSide(0);
        return view('materiel')->with('materiels', $materiels);
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
             'materiel' => 'required|string|max:255|unique:materiel',
         ], [
             'materiel.unique' => 'La Matière première existe déjà.',
         ]);
     
         Materiel::create($request->except('_token'));
     
         return redirect()->route('materiel.index')->with('success', 'Matière première ajoutée avec succès');
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
        $row = Materiel::find($idMateriel);

 
        if (!$row) {
            abort(404); 
        }

        // Passe la variable $row à la vue
        return view('materiel', compact('row'));
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
    public function update(Request $request, $idMateriel)
{
    $materiel = Materiel::find($idMateriel);

    if (!$materiel) {
        return redirect()->route('materiel.index')->with('error', 'Matière première not found');
    }

    $materiel->materiel = $request->input('materiel');
    $materiel->save();

    return redirect()->route('materiel.index')->with('success', 'Matière première modifiée avec succès');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idMateriel)
{
    $materiel = Materiel::find($idMateriel);

    if (!$materiel) {
        return redirect()->route('materiel.index')->with('error', 'Matière première not found');
    }

    $materiel->delete();

    return redirect()->route('materiel.index')->with('success', 'Matière première supprimée avec succès');
}
public function updateMateriel($id){
    $materiels=Materiel::find($id);
   return view('updateMateriel',compact('materiels')); 

}


public function updateMaterielTraitement(Request $request)
{
    $this->validate($request, [
        'materiel' => 'required|string|max:255|unique:materiel,materiel,' . $request->idMateriel . ',idMateriel',
    ], [
        'materiel.unique' => 'La Matière première existe déjà.',
    ]);

    $materiel = Materiel::find($request->idMateriel);

    if ($materiel) {
        try {
            $materiel->materiel = $request->materiel;
            $materiel->save();

            return redirect('/materiel')->with('status', 'Matière première modifiée avec succès');
        } catch (\Exception $e) {
            return redirect('/materiel')->with('error', 'Une erreur s\'est produite.');
        }
    } else {
        return redirect('/materiel')->with('error', 'La Matière première n\'existe pas.');
    }
}
}
