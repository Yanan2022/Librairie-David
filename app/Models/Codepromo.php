<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Codepromo extends Model
{

    protected $fillable = [
        'id',
        'libelle',
        'code',
        'date_debut',
        'date_fin',
    ];


}
