<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    //Relacion muchos a muchos
    public function inventarios(){
        return $this->belongsToMany('App\Models\Inventario');
    }

    public function clientes(){
        return $this->belongsToMany('App\Models\Cliente');
    }
}
