<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clavo extends Model
{
    use HasFactory;

    protected $primaryKey = 'producto_id'; //se sobreescribe la primary key para no usar id()
    public $incrementing = false; //se desactiva la funcion de autoincrementar la "id" porque se trabaja con rut
    
    protected $fillable = [
        'producto_id',
    ];
}
