<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    use HasFactory;
    
    protected $table = 'marque';
    protected $primaryKey = 'idMarque'; 
    protected $fillable = ['marque'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->validateUniqueMarque();
        });
    }

    public function validateUniqueMarque()
    {
        $existingRecord = Marque::where('marque', $this->marque)->first();
        
        if ($existingRecord && $this->idMarque !== $existingRecord->idMarque) {
            throw new \Exception('La marque existe déjà.');
        }
    }
}
