<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tailles extends Model
{
    use HasFactory;
    protected $table = 'tailles';
    protected $primaryKey = 'idT'; // Clé primaire
    protected $fillable = ['idR', 'taille', 'quantiteT'];
    // Relation avec la table 'reference'
    public function reference()
    {
        return $this->belongsTo(Reference::class, 'idR');
    }

}
