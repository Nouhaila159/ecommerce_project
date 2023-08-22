<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoSite extends Model
{
    use HasFactory;

    protected $table = 'info_site'; // Nom de la table dans la base de données

    protected $primaryKey = 'idS'; // Clé primaire de la table

    protected $fillable = [
        'nomS',
        'titreS',
        'urlPhotoS',
        'descriptionS',
        'emailS',
        'adesseS',
        'teleS',
        'footerS'
    ];

    // Autres propriétés, relations ou fonctions liées au modèle
}
