<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    
    protected $table = 'contact'; // Nom de la table
    protected $primaryKey = 'id'; // Clé primaire
    protected $fillable = ['name', 'email', 'phone', 'message'];

    // Vous pouvez ajouter des relations ou des méthodes ici si nécessaire
}
