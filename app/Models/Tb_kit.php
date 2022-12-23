<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_kit extends Model
{
    use HasFactory;
    protected $fillable = [
        'CodeKit', 'LibelleKit', 'PrixKit', 'ImageKit', 'StatutKit', 'IdTypeKit', 'id', 'entreprise_id',
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
