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
         'ville',
         'commune',
         'quartier',
         'commande_montant',
         'user_id',
         'description_colis',
         'etat',
         'imagecolis',
         'idEntreprise',
         'idArticle',
         'nomlivreur',
         'prenomlivreur',
         'contactlivreur',
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
