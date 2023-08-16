<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class Commandes extends Model
{
    use HasFactory;

    protected $table = 'commandes'; // Nom de la table
    protected $primaryKey = 'idCommande'; // Clé primaire

    // Champs remplissables
    protected $fillable = ['idC', 'date_commande', 'date_livraison', 'adresse_livraison', 'prix_livraison', 'statut_livraison','statut_commande','validation','origine'];
   
    // Relation avec le client
    public function client()
    {
        return $this->belongsTo(Client::class, 'idC');
    }
}
