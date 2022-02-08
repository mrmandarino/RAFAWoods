<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $primaryKey = 'rut'; //se sobreescribe la primary key para no usar id()
    public $incrementing = false; //se desactiva la funcion de autoincrementar la "id" porque se trabaja con rut
    
    protected $fillable = [
        'rut',
        'nombre',
        'razon_social',
        'correo',
        'ubicacion',
    ];

     //Relacion muchos a muchos
     public function maderas(){
        return $this->belongsToMany('App\Models\Madera');
    }
    
    //Relacion uno a muchos
    public function transportes(){
        return $this->hasMany('App\Models\Transporte');
    }

    public function ejecutivos(){
        return $this->hasMany('App\Models\Ejecutivo');
    }

}
