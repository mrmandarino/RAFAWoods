<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transporte extends Model
{
    use HasFactory;

    //Relacion uno a muchos inversa
    public function proveedor(){
        return $this->belongsTo('App\Models\Proveedor');
    }
}
