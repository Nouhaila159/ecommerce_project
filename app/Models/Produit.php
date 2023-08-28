<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $table = 'produit';
    protected $primaryKey = 'idP'; 
    protected $fillable = ['nomP', 'descriptionP', 'idMarque', 'idCategorie','idMateriel', 'prixP','reductionP', 'statutP'];


    public function marque()
    {
        return $this->belongsTo(Marque::class, 'idMarque', 'idMarque');
    }

    public function materiel()
    {
        return $this->belongsTo(Materiel::class, 'idMateriel', 'idMateriel');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'idCategorie', 'idCategorie');
    }
    public function references()
{
    return $this->hasMany(Reference::class, 'idP');
}



   /*  public function validateUniqueMarque()
    {
        $existingRecord = Produit::where('produit', $this->marque)->first();
        
        if ($existingRecord && $this->idMarque !== $existingRecord->idMarque) {
            throw new \Exception('La marque existe déjà.');
        }
    }*/
}
