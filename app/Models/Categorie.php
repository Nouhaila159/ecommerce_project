<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    
    protected $table = 'categorie';
    protected $primaryKey = 'idCategorie'; 
    protected $fillable = ['categorie'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->validateUniqueCategorie();
        });
    }

    public function validateUniqueCategorie()
    {
        $existingRecord = Categorie::where('categorie', $this->categorie)->first();
        
        if ($existingRecord && $this->idCategorie !== $existingRecord->idCategorie) {
            throw new \Exception('La catégorie existe déjà.');
        }
    }
}
