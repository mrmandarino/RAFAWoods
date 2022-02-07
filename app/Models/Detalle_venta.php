<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_venta',
        'cantidad',
        'cliente_rut',
        'producto_id',
        'total_producto',
    ];

    //Relacion uno a muchos inversa
    public function venta(){
        return $this->belongsTo('App\Models\Venta');
    }
}
