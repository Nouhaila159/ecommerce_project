<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marque;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Materiel;
use App\Models\Reference;
use App\Models\Tailles;
use App\Models\Stock;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexRupture()
{
    $produits = Produit::with(['marque', 'categorie', 'materiel'])
        ->join('stock', 'produit.idP', '=', 'stock.idP')
        ->paginate(6)
        ->onEachSide(0);

    return view('out-of-stock', [
        'produits' => $produits,
    ]);
}

    public function indexStock()
    {
        $produits = Produit::with(['marque', 'categorie', 'materiel'])
            ->join('stock', 'produit.idP', '=', 'stock.idP')
            ->where('stock.quantite_disponible', '>', 0)
            ->paginate(6)
            ->onEachSide(0);

        return view('in-stock', [
            'produits' => $produits,
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
        //
    }
}
