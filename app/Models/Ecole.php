<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecole extends Model
{
    use HasFactory;
    protected $fillable = [
        'code', 'libelle', 'contact', 'image', 'email'
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
