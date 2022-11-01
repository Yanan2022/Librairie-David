<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_articles extends Model
{
    use HasFactory;
    protected $fillable = [
        'CodeArticle', 'LibelleArticle', 'PrixArticle', 'ImageArticle', 'StatutArticle', 'IdTypeArticle', 'id', 'entreprise_id',
    ];

    public function type()
    {
        return $this->belongsTo(typearticleModel::class, 'IdTypeArticle', 'id');
    }

    public function entreprise()
    {
        return $this->belongsTo(EntrepriseModel::class);
    }
}
