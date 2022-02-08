<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_compra extends Model
{
    const bajo = 1;
    const aceptable = 2;
    const medio = 3;
    const bueno = 4;
    const excelente = 5;
    protected $primaryKey =['oc_id','producto_id'];  //se sobreescribe la primary key para no usar id()

    protected $fillable = [
        'oc_id',
        'producto_id',
    ];

    
    public $incrementing = false; //se desactiva la funcion de autoincrementar la "id" porque se trabaja con rut

    use HasFactory;
}
