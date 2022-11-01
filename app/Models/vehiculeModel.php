<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehiculeModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'marque', 'couleur','capacite','numerocarteGrise','nomproprietaire','nomconducteur','idTypeV','id'
     ];


     public function type()
     {
         return $this->belongsTo(typevehiculeModel::class, 'idTypeV');
     }
}
