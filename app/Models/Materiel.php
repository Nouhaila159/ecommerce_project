<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    use HasFactory;
    
    protected $table = 'materiel';
    protected $primaryKey = 'idMateriel'; 
    protected $fillable = ['materiel'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->validateUniqueMateriel();
        });
    }

    public function validateUniqueMateriel()
    {
        $existingRecord = Materiel::where('materiel', $this->materiel)->first();
        
        if ($existingRecord && $this->idMateriel !== $existingRecord->idMateriel) {
            throw new \Exception('La matière première existe déjà.');
        }
    }
}
