<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typearticleModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'LibCategorieArt', 'id', 'type_parent_id'
    ];

    public function type_parent()
    {
        return $this->belongsTo(typearticleModel::class, 'type_parent_id', 'id');
    }

    public function sous_types()
    {
        return $this->hasMany(typearticleModel::class, 'type_parent_id', 'id');
    }

    public function articles()
    {
        return $this->hasMany(Tb_articles::class, 'IdTypeArticle');
    }
}
