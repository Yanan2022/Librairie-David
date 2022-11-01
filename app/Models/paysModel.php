<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paysModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'NomPays', 'IconPays','DevisePays','id'
     ];
}
