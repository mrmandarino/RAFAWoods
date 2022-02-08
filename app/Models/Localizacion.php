<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localizacion extends Model
{
    protected $primaryKey =['sucursal_id','producto_id'];  //se sobreescribe la primary key para no usar id()

    protected $fillable = [
        'sucursal_id',
        'producto_id',
    ];


    use HasFactory;
}
