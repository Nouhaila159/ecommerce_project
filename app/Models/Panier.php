<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produit;
use App\Models\Reference;
use App\Models\Tailles;

class Panier extends Model
{
    use HasFactory;

    protected $table = 'paniers';
    protected $primaryKey = 'idPaniers';
    protected $fillable = ['quantiteP', /* autres colonnes de votre table */];

    // Relation avec l'utilisateur (un panier appartient à un utilisateur)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relation avec le produit (un panier appartient à un produit)
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'idP', 'idP');
    }

    // Relation avec la référence (un panier appartient à une référence)
    public function reference()
    {
        return $this->belongsTo(Reference::class, 'idR', 'idR');
    }

    // Relation avec la taille (un panier a une taille)
    public function taille()
    {
        return $this->belongsTo(Tailles::class, 'idT', 'idT');
    }
}
