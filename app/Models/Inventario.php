<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;


    //Relacion muchos a muchos
    public function trabajadores(){
        return $this->belongsToMany('App\Models\Trabajador');
    }

    public function productos(){
        return $this->belongsToMany('App\Models\Producto');
    }

    /*
    
    //Relacion uno a muchos 
    public function trabajadores(){
        return $this->hasMany('App\Models\Trabajador');
    }
    
    */ 


}
