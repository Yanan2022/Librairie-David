<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatEntreModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'LibCategorie', 'id'
     ];
}
