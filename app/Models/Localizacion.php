<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localizacion extends Model
{

    use HasFactory;

    protected $primaryKey =['sucursal_id','producto_id'];  //se sobreescribe la primary key para no usar id()

    public $incrementing = false; //se desactiva la funcion de autoincrementar la "id" porque se trabaja con rut
    protected $fillable = [
        'sucursal_id',
        'producto_id',
        'stock',
        'precio_compra',
        'precio_venta',
    ];

}
