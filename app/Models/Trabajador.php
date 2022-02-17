<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    use HasFactory;

    protected $primaryKey = 'usuario_rut'; //se sobreescribe la primary key para no usar id()
    public $incrementing = false; //se desactiva la funcion de autoincrementar la "id" porque se trabaja con rut
    
    const ejecutivo = 1;
    const vendedor = 2;
    
    protected $fillable = [
        'usuario_rut',
        'tipo_trabajador',
        'sucursal_id',
    ];
    
    //Relacion uno a muchos inversa
    public function inventario(){
        return $this->belongsTo('App\Models\Inventario');
    }
    
    
    


}
