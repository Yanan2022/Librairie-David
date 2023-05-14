<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_kitscolaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'CodeKitscolaire', 'LibelleKitscolaire', 'PrixKitscolaire', 'ImageKitscolaire', 'StatutKitscolaire', 'IdTypeKitscolaire', 'id', 'entreprise_id','quantite',
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
