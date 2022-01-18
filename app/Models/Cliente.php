<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

     //Relacion muchos a muchos
    public function productos(){
        return $this->belongsToMany('App\Models\Producto');
    }
}
