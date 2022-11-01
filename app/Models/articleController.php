<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class articleController extends Model
{
    use HasFactory;

   
    protected $fillable = [
        'CodeArticle', 'LibelleArticle','PrixArticle','ImageArticle','StatutArticle','IdTypeArticle','id'
     ];
}

