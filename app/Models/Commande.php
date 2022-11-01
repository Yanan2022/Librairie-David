<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        "uuid",
        "nom",
        "prenoms",
        "telephone",
        "email",
        "ville",
        "commune",
        "quartier",
        "adresse",
        "coordonnees",
        "etat",
        "type_vehicule_id",
    ];

    protected $casts = [
        "coordonnees" => "array",
    ];


    public function articles()
    {
        return $this->belongsToMany(Tb_articles::class, 'commandes_articles', 'commande_id', 'article_id')->withPivot('quantite', 'prix_unitaire');
    }


    public function getTotalAttribute()
    {
        $t = 0;
        foreach ($this->articles as $article) {
            $t += $article->pivot->quantite * $article->pivot->prix_unitaire;
        }

        return $t;
    }


    /**
     * Get the mode_livraison that owns the Commande
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mode_livraison()
    {
        return $this->belongsTo(typevehiculeModel::class, 'type_vehicule_id', 'id');
    }
}
