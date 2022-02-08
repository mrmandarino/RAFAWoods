<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tornillo extends Model
{
    use HasFactory;

    const completa = 1;
    const parcial = 2;

    protected $primaryKey = 'producto_id'; //se sobreescribe la primary key para no usar id()
    public $incrementing = false; //se desactiva la funcion de autoincrementar la "id" porque se trabaja con rut
    

    protected $fillable = [
        'producto_id',
        'cabeza',
        'tipo_rosca',
        'separacion_rosca',
        'punta',
        'rosca_parcial',
        'vastago',
    ];
}
