<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

     //Relacion muchos a muchos
     public function maderas(){
        return $this->belongsToMany('App\Models\Madera');
    }
    
    //Relacion uno a muchos
    public function transportes(){
        return $this->hasMany('App\Models\Transporte');
    }

    public function ejecutivos(){
        return $this->hasMany('App\Models\Ejecutivo');
    }

}
