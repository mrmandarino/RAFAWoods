<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    const efectivo= 1;
    const tarjeta_debito = 2;
    const tarjeta_credito = 3;
    const transferencia = 4;
    protected $fillable = [
        'sucursal_id',
        'medio_de_pago',
        'cliente_rut',
        'total_venta',
        'con_factura',
    ];


    //Relacion uno a muchos 
    public function detalles(){
        return $this->hasMany('App\Models\Detalle_venta');
    }

}
