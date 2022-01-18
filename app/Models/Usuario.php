<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    const ACTIVADO = 1;
    const DESACTIVADO = 0;
    const trabajador = 1;
    const cliente = 2;
    
}
