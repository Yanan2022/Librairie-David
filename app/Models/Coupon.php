<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'id', 'code','percent_off','date_debut','date_fin',
     ];

     public function discount($total)
     {
        # code...
        return ($total * ($this->percent_off / 100));
     }
}

