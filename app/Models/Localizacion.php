<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localizacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'sucursal_id',
        'producto_id',
        'stock',
    ];
}
