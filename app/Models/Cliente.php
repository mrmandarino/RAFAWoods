<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $primaryKey = 'usuario_rut'; //se sobreescribe la primary key para no usar id()
    public $incrementing = false; //se desactiva la funcion de autoincrementar la "id" porque se trabaja con rut

    protected $fillable = [
        'usuario_rut',
        'telefono',
    ];

     //Relacion muchos a muchos
    public function productos(){
        return $this->belongsToMany('App\Models\Producto');
    }
}
