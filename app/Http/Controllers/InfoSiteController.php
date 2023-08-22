<?php

namespace App\Http\Controllers;

use App\Models\InfoSite;
use Illuminate\Http\Request;

class InfoSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infoSite = InfoSite::first(); // Pour obtenir le premier enregistrement       
        return view('settings', [
            'infoSite' => $infoSite,
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
     * @param  \App\Models\InfoSite  $infoSite
     * @return \Illuminate\Http\Response
     */
    public function show(InfoSite $infoSite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InfoSite  $infoSite
     * @return \Illuminate\Http\Response
     */
    public function edit(InfoSite $infoSite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InfoSite  $infoSite
     * @return \Illuminate\Http\Response
     */
    public function updateInfoSite(Request $request, $idS)
    {
        // Retrouver l'objet InfoSite à mettre à jour
        $infoSite = InfoSite::findOrFail($idS);
    
        // Mettre à jour les champs avec les valeurs du formulaire
        $infoSite->nomS = $request->input('nomS');
        $infoSite->titreS = $request->input('titreS');
        $infoSite->descriptionS = $request->input('descriptionS');
        $infoSite->adesseS = $request->input('adesseS');
        $infoSite->teleS = $request->input('teleS');
        $infoSite->footerS = $request->input('footerS');
        $infoSite->emailS = $request->input('emailS');
           
        // Mettre à jour l'image si elle est fournie
        if ($request->hasFile('urlphotoS')) {
            $imagePath = $request->file('urlphotoS')->store('images', 'public');
            $infoSite->urlPhotoS = $imagePath;
        }
        
    
        // Enregistrer les modifications
        $infoSite->save();
    
        // Rediriger avec un message de succès
        return redirect()->route('settings.index')->with('success', 'Informations du site modifiées avec succès.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InfoSite  $infoSite
     * @return \Illuminate\Http\Response
     */
    public function destroy(InfoSite $infoSite)
    {
        //
    }
    
}
