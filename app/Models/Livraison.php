<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;
    
    protected $table = 'livraison';
    protected $primaryKey = 'idlivraison'; 
    protected $fillable = ['livraison','prix'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->validateUniqueLivraison();
        });
    }

    public function validateUniqueLivraison()
    {
        $existingRecord = Livraison::where('livraison', $this->livraison)->first();
        
        if ($existingRecord && $this->idlivraison !== $existingRecord->idlivraison) {
            throw new \Exception('La ville de livraison existe déjà.');
        }
    }
}
