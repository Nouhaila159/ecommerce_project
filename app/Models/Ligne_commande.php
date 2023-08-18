<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ligne_commande extends Model
{
    use HasFactory;

    protected $table = 'ligne_commande'; // Nom de la table

    protected $primaryKey = 'idLigneC'; // Clé primaire

    protected $fillable = ['idCommande', 'idR', 'quantite','idT']; // Colonnes que vous souhaitez remplir

    public function taille()
    {
        return $this->belongsTo(Tailles::class, 'idT', 'idT'); // Relation avec la table 'commandes'
    }

    public function commande()
    {
        return $this->belongsTo(Commande::class, 'idCommande', 'idCommande'); // Relation avec la table 'commandes'
    }

    public function reference()
    {
        return $this->belongsTo(Reference::class, 'idR', 'idR'); // Relation avec la table 'reference'
    }
}
