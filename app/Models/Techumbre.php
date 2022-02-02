<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Techumbre extends Model
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
