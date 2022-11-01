<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typevehiculeModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'LibelleType', 'id'
     ];
}
