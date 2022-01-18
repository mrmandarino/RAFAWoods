<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    use HasFactory;

    const ejecutivo = 1;
    const vendedor = 2;
    
    
    //Relacion uno a muchos inversa
    public function inventario(){
        return $this->belongsTo('App\Models\Inventario');
    }
    
    
    


}
