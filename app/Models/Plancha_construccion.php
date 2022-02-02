<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plancha_construccion extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id',
        'material',
        'alto',
        'ancho',
        'largo',
    ];
}
