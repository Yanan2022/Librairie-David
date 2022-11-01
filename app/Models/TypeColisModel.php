<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeColisModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'LibelleType', 'id'
     ];
    
}
