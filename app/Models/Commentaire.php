<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $table = 'commentaire'; // Spécifiez le nom de la table associée au modèle

    protected $primaryKey = 'idCommentaire'; // Spécifiez la clé primaire de la table (si elle diffère de 'id')
    
    protected $fillable = [
        'id', // Peut être nullable
        'idP',
        'commentaire',
        'statut',
    ];

    // Si vous souhaitez définir des relations avec d'autres modèles (par exemple, User et Produit), vous pouvez le faire ici.
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'idP');
    }
}
