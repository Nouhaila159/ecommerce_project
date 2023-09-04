<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Contact::all(); // Récupérez tous les messages depuis la base de données
        return view('messages')->with('messages', $messages);
    }

    public function delete($id)
    {
        // Récupérez le message par son ID et supprimez-le
        $message = Contact::find($id);
        if ($message) {
            $message->delete();
        }
    
        // Redirigez l'utilisateur vers la page de liste des messages avec un message de succès
        return redirect()->route('contact.index')->with('success', 'Le message a été supprimé avec succès.');
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
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'message' => 'required|string',
        ]);
    
        // Créer un nouveau modèle ContactMessage et enregistrer les données dans la base de données
        Contact::create($validatedData);
    
        // Stocker un message dans la session
        $request->session()->flash('message', 'Votre message a été envoyé avec succès.');
    
        // Rediriger vers la page de contact
        return redirect()->route('contact');
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
}
