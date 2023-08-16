<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'client'; // Nom de la table
    protected $primaryKey = 'idC'; // Clé primaire

    // Champs remplissables
    protected $fillable = ['nomC', 'prenomC', 'telC', 'adresseC', 'villeC', 'emailC'];
}
