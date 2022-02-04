<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefono_proveedor extends Model
{
    protected $primaryKey =['proveedor_rut','telefono'];  //se sobreescribe la primary key para no usar id()

    protected $fillable = [
        'proveedor_rut',
        'telefono',
    ];
    
    public $incrementing = false; //se desactiva la funcion de autoincrementar la "id" porque se trabaja con rut
    use HasFactory;
}
