<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Madera extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id',
        'alto',
        'ancho',
        'largo',
        'tipo_madera',
        'tratamiento',
    ];

     //Relacion muchos a muchos
     public function proveedores(){
        return $this->belongsToMany('App\Models\Proveedor');
    }
    
}
