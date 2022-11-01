<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntrepriseModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'CodeEntreprise', 'LibelleEntreprise', 'ContactEntreprise', 'AdresseEntreprise', 'MailEntreprise', 'SiteEntreprise', 'long', 'lat', 'Id_Catégorie', 'Id_pays', 'id'
    ];

    public function pays()
    {
        return $this->belongsTo(paysModel::class, 'Id_pays', 'id');
    }

    public function categorie()
    {
        return $this->belongsTo(CatEntreModel::class, 'Id_Catégorie', 'id');
    }
}
