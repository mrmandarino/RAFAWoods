<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_venta extends Model
{
    protected $primaryKey =['venta_id','producto_id'];  //se sobreescribe la primary key para no usar id()

    protected $fillable = [
        'venta_id',
        'producto_id',
    ];
    
    public $incrementing = false; //se desactiva la funcion de autoincrementar la "id" porque se trabaja con rut

    use HasFactory;
    
    //Relacion uno a muchos inversa
    public function venta(){
        return $this->belongsTo('App\Models\Venta');
    }



}
