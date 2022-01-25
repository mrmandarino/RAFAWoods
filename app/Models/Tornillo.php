<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tornillo extends Model
{
    use HasFactory;

    const completa = 1;
    const parcial = 2;
    

    protected $fillable = [
        'producto_id',
    ];
}
