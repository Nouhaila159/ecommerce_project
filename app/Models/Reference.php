<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{

    use HasFactory;
    protected $table = 'reference';
    protected $primaryKey = 'idR'; // Clé primaire
    protected $fillable = ['idP', 'referenceP', 'couleur', 'urlPhoto','quantiteR'];

    
    // Relation avec la table 'produit'
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'idP');
    }
}
