<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $table = 'stock';
    protected $primaryKey = 'idStock'; // Clé primaire
    protected $fillable = ['idP', 'quantite_disponible'];

    // Relation avec la table 'produit'
    public function reference()
    {
        return $this->belongsTo(Produit::class, 'idP');
    }
}
