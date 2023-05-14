<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panierkit extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'etat',
    ];

    public function articles()
    {
        return $this->belongsToMany(Tb_articles::class, 'paniers_articles', 'panier_id', 'article_id')->withPivot('quantite', 'prix_unitaire');
    }



    public function kits()
    {
        return $this->belongsToMany(Tb_kitscolaire::class, 'paniers_kits', 'panier_id', 'kit_id')->withPivot('quantite', 'prix_unitaire');
    }

    public function getTotalAttribute()
    {
        $t = 0;
        foreach ($this->kits as $article) {
            $t += $article->pivot->quantite * $article->pivot->prix_unitaire;
        }

        return $t;
    }


    public function addArticle(Tb_articles $article, $quantite = 1)
    {
        if(!$this->articles->contains('id', $article->id)) {
            $this->articles()->attach($article->id, [
                'quantite' => $quantite,
                'prix_unitaire' => (int) $article->PrixArticle,
            ]);
        } else {
            $article = $this->articles->where('id', $article->id)->first();
            $this->articles()->updateExistingPivot($article->id, [
                'quantite' => $article->pivot->quantite + $quantite
            ]);
        }

        return $this;
    }

    public function addKit(Tb_kitscolaire $kitscolaire, $quantite = 1)
    {
        if(!$this->kits->contains('id', $kitscolaire->id)) {
            $this->kits()->attach($kitscolaire->id, [
                'quantite' => $quantite,
                'prix_unitaire' => (int) $kitscolaire->PrixKitscolaire,
            ]);
        } else {
            $kitscolaire = $this->kits->where('id', $kitscolaire->id)->first();
            $this->kits()->updateExistingPivot($kitscolaire->id, [
                'quantite' => $kitscolaire->pivot->quantite + $quantite
            ]);
        }

        return $this;
    }

    public function removeKit(Tb_kitscolaire $kitscolaire, $qte = 0)
    {
        $kitscolaire = $this->kits->where('id', $kitscolaire->id)->first();
        if($qte === 0)
            $this->kits()->detach($kitscolaire->id);
        else {
            if($kitscolaire->pivot->quantite <= $qte) {
                $this->kits()->detach($kitscolaire->id);
            } else {
                $this->kits()->updateExistingPivot($kitscolaire->id, [
                    'quantite' => $kitscolaire->pivot->quantite - $qte
                ]);
            }
        }

        return $this;
    }
}
