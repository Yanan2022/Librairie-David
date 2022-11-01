<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivraisonModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomclient',
        'prenomclient',
         'contactclient',
         'long',
         'lat',
         'long_Arrive',
         'lat_Arrive',
         'idcolis',
         'description_colis',
         'coutLivraison',
         'imagecolis',
         'idEntreprise',
         'idArticle',
         'id'
     ];

    public function entreprise()
    {
        return $this->belongsTo(EntrepriseModel::class, 'idEntreprise', 'id');
    }

    public function article()
    {
        return $this->belongsTo(Tb_articles::class, 'idArticle', 'id');
    }
}
