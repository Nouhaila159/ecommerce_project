<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\User;


class Commandes extends Model
{
    use HasFactory;

    protected $table = 'commandes'; // Nom de la table
    protected $primaryKey = 'idCommande'; // Clé primaire

    // Champs remplissables
    protected $fillable = ['idC','id', 'date_commande', 'date_livraison', 'adresse_livraison', 'prix_livraison', 'statut_livraison','statut_commande','validation','origine'];
   
    // Relation avec le client
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
    public function client()
    {
        return $this->belongsTo(Client::class, 'idC');
    }
}
