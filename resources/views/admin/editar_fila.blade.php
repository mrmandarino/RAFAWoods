@extends('layouts.plantilla')

@section('header')
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style type="text/css">
        .trabajadores{
          display: none;    
        }
        .clientes{
          display: none;   
        }
        .tornillos{
          display: none;  
        }
        .muebles{
          display: none;   
        }
        .maderas{
          display: none;     
        }
        .clavos{
          display: none;     
        }
        .techumbres{
          display: none;     
        }
        .planchas{
          display: none;     
        }

    </style>
@endsection

@section('contenido')
<h2>MODIFICAR REGISTROS</h2>
<form action={{route('admin_update_fila',['key' => $key,'tabla' => $tabla, 'key2' => $key2])}} method="POST">
    @csrf
    @method('PUT')

    @if ($tabla == 'usuarios')
        @php($sucursales=DB::table('inventarios')->get())
        <div class="mb-3">
            <label for="" class="form-label">Rut</label>
            <input id="rut" name="rut" type="text" class="form-control" tabindex="1" value="{{$dato->rut}}">
            @error('rut')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" tabindex="2" value="{{$dato->nombre}}">
            @error('nombre')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Apellido</label>
            <input id="apellido" name="apellido" type="text" class="form-control" tabindex="3" value="{{$dato->apellido}}">
            @error('apellido')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Correo</label>
            <input id="correo" name="correo" type="email" class="form-control" tabindex="4" value="{{$dato->correo}}">
            @error('correo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tipo Usuario</label>
            <select class="form-control select" name="tipo_usuario" id="tipo_usuario" tabindex="5" value="{{$dato->tipo_usuario}}">
                <option selected>Escoge un tipo de usuario</option>
                <option value=2>Trabajador</option>  
                <option value=3>Cliente</option>  
            </select>
            @error('tipo_usuario')
                <small style="color:red;">*Debes escoger un tipo de usuario para continuar</small>
            @enderror
        </div> 

        <div class="mb-3">
            <label for="" class="form-label">Estado</label>
            <select class="form-control select" name="estado" id="estado" tabindex="6" value="{{$dato->estado}}">
                <option value=1>Activado</option>  
                <option value=0>Desactivado</option>  
            </select>
            @error('estado')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div> 

        {{-- Trabajador --}}
        @php($trabajador=App\Models\Trabajador::find($key))
        <div class="form-group trabajadores">
            <label for="" class="form-label">Tipo trabajador</label>
            <select class="form-control select" name="tipo_trabajador" id="tipo_trabajador" tabindex="7">
                @if ($trabajador!=null)
                    <option value=1 {{$trabajador->tipo_trabajador==1 ? 'selected' : ''  }}>Ejecutivo</option>  
                    <option value=2 {{$trabajador->tipo_trabajador==2 ? 'selected' : ''  }}>Vendedor</option> 
                @else
                    <option value=1 >Ejecutivo</option>  
                    <option value=2 >Vendedor</option>  
                @endif
            </select>
        </div>
        
        <div class="form-group trabajadores">
            <label for="" class="form-label">Sucursal</label>
            <select class="form-control select" name="sucursal_id" id="sucursal_id" tabindex="8">
                @if ($trabajador!=null)
                    @foreach ($sucursales as $sucursal)
                        <option value={{$sucursal->id}} {{ $trabajador->sucursal_id==$sucursal->id ? 'selected' : ''  }}>{{$sucursal->direccion_sucursal}}</option> 
                    @endforeach 
                @else
                    @foreach ($sucursales as $sucursal)
                        <option value={{$sucursal->id}}>{{$sucursal->direccion_sucursal}}</option> 
                    @endforeach
                @endif 
            </select>
        </div>

        {{-- Cliente --}}
        @php($cliente=App\Models\Cliente::find($key))
        <div class="form-group clientes">
            <label for="" class="form-label">Telefono(Opcional)</label>
            <input id="telefono" name="telefono" type="tel" class="form-control" pattern="\+569[0-9]{8}" title="El teléfono debe contener el prefijo '+569' y 8 dígitos." tabindex="9" @if ($cliente!=null) value="{{$cliente->telefono}}" @endif>
            @error('telefono')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div> 

    @endif

    @if ($tabla == 'clientes') 
        <div class="mb-3">
            <label for="" class="form-label">Telefono</label>
            <input id="telefono" name="telefono" type="tel" class="form-control" pattern="\+569[0-9]{8}" title="El teléfono debe contener el prefijo '+569' y 8 dígitos." tabindex="11" value="{{$dato->telefono}}">
            @error('telefono')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        
    @endif

    @if ($tabla == 'trabajadores') 
        @php($sucursales=DB::table('inventarios')->get())

        <div class="mb-3">
            <label for="" class="form-label">Tipo trabajador</label>
            <select class="form-control select" name="tipo_trabajador" id="tipo_trabajador" tabindex="1"> 
                <option value=1 {{$dato->tipo_trabajador==1 ? 'selected' : ''  }}>Ejecutivo</option>  
                <option value=2 {{$dato->tipo_trabajador==2 ? 'selected' : ''  }}>Vendedor</option>  
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Sucursal</label>
            <select class="form-control select" name="sucursal_id" id="sucursal_id" tabindex="2">
                @foreach ($sucursales as $sucursal)
                    <option value={{$sucursal->id}} {{ $dato->sucursal_id==$sucursal->id ? 'selected' : ''  }}>{{$sucursal->direccion_sucursal}}</option>
                @endforeach  
            </select>
        </div>
        
    @endif

    @if ($tabla == 'madera_proveedores') 
        @php($proveedores=DB::table('proveedors')->get())
        @php($maderas=DB::table('maderas')->get())

        <div class="mb-3">
            <label for="" class="form-label">Nivel calidad</label>
            <select class="form-control select" name="nivel_calidad" id="nivel_calidad" tabindex="1"> 
                <option value=1 {{ $dato->nivel_calidad==1 ? 'selected' : ''  }}>Bajo</option>  
                <option value=2 {{ $dato->nivel_calidad==2 ? 'selected' : ''  }}>Aceptable</option> 
                <option value=3 {{ $dato->nivel_calidad==3 ? 'selected' : ''  }}>Medio</option>  
                <option value=4 {{ $dato->nivel_calidad==4 ? 'selected' : ''  }}>Alto</option>  
                <option value=5 {{ $dato->nivel_calidad==5 ? 'selected' : ''  }}>Excelente</option>  
            </select>
        </div>
       
        <div class="mb-3">
            <label for="" class="form-label">Proveedor</label>
            <select class="form-control select" name="proveedor_rut" id="proveedor_rut" tabindex="2">
                @foreach ($proveedores as $proveedor)
                <option value={{$proveedor->rut}} {{ $dato->proveedor_rut==$proveedor->rut ? 'selected' : ''  }}>{{$proveedor->nombre}}</option> 
                @endforeach  
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Madera</label>
            <select class="form-control select" name="madera_id" id="madera_id" tabindex="3">
                @foreach ($maderas as $madera)
                @php($producto=DB::table('productos')->get()->where('id',$madera->producto_id)->first())
                <option value={{$madera->producto_id}} {{ $dato->madera_id==$madera->producto_id ? 'selected' : ''  }}>{{$producto->nombre}}</option> 
                @endforeach 
            </select>
        </div>
        
    @endif

    @if ($tabla == 'transportes') 
        @php($proveedores=DB::table('proveedors')->get())
        <div class="mb-3">
            <label for="" class="form-label">Nombre transportista</label>
            <input id="nombre_transportista" name="nombre_transportista" type="text" class="form-control" tabindex="1" value="{{substr($dato->nombre_transportista,0,strpos($dato->nombre_transportista,' '))}}">
            @error('nombre_transportista')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Apellido transportista</label>
            <input id="apellido_transportista" name="apellido_transportista" type="text" class="form-control" tabindex="2" value="{{substr($dato->nombre_transportista,strpos($dato->nombre_transportista,' '))}}">
            @error('apellido_transportista')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tipo vehiculo</label>
            <input id="tipo_vehiculo" name="tipo_vehiculo" type="text" class="form-control" tabindex="3" value="{{$dato->tipo_vehiculo}}">
            @error('tipo_vehiculo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Valor viaje</label>
            <input id="valor_viaje" name="valor_viaje" type="number" class="form-control" tabindex="4" value="{{$dato->valor_viaje}}">
            @error('valor_viaje')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Proveedor</label>
            <select class="form-control select" name="proveedor_rut" id="proveedor_rut" tabindex="5">
                @foreach ($proveedores as $proveedor)
                <option value={{$proveedor->rut}} {{$dato->proveedor_rut==$proveedor->rut ? 'selected' : ''  }}>{{$proveedor->nombre}}</option> 
                @endforeach  
            </select>
        </div>
        
    @endif

    @if ($tabla == 'tornillos') 
        <div class="mb-3">
            <label for="" class="form-label">Cabeza</label>
            <input id="cabeza" name="cabeza" type="number" step="0.01" class="form-control" tabindex="1" value="{{$dato->cabeza}}">
            @error('cabeza')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tipo rosca</label>
            <select class="form-control select" name="tipo_rosca" id="tipo_rosca" tabindex="2"> 
                <option value="total" {{ $dato->tipo_rosca=="total" ? 'selected' : ''  }}>Total</option>  
                <option value="parcial" {{ $dato->tipo_rosca=="parcial" ? 'selected' : ''  }}>Parcial</option> 
            </select>
        </div>  
        <div class="mb-3">
            <label for="" class="form-label">Separación rosca</label>
            <input id="separacion_rosca" name="separacion_rosca" type="number" step="0.01" class="form-control" tabindex="3" value="{{$dato->separacion_rosca}}">
            @error('separacion_rosca')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Punta</label>
            <input id="punta" name="punta" type="text" class="form-control" tabindex="4" value="{{$dato->punta}}">
            @error('punta')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Rosca parcial</label>
            <input id="rosca_parcial" name="rosca_parcial" type="number" step="0.01" class="form-control" tabindex="5" value="{{$dato->rosca_parcial}}">
            @error('rosca_parcial')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Vastago</label>
            <input id="vastago" name="vastago" type="number" step="0.01" class="form-control" tabindex="6" value="{{$dato->vastago}}">
            @error('vastago')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>

        
    @endif

    @if ($tabla == 'telefono_proveedores') 
        @php($proveedores=DB::table('proveedors')->get())
        <div class="mb-3">
            <label for="" class="form-label">Proveedor</label>
            <select class="form-control select" name="proveedor_rut" id="proveedor_rut" tabindex="1">
                @foreach ($proveedores as $proveedor)
                <option value={{$proveedor->rut}} {{ $dato->proveedor_rut==$proveedor->rut ? 'selected' : ''  }}>{{$proveedor->nombre}}</option> 
                @endforeach  
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Telefono</label>
            <input id="telefono" name="telefono" type="tel" class="form-control" tabindex="2" pattern="\+569[0-9]{8}" title="El teléfono debe contener el prefijo '+569' y 8 dígitos." value={{$dato->telefono}}>
            @error('telefono')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        
    @endif

    @if ($tabla == 'techumbres') 
        <div class="mb-3">
            <label for="" class="form-label">Material</label>
            <input id="material" name="material" type="text" class="form-control" tabindex="1" value="{{$dato->material}}">
            @error('material')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Alto</label>
            <input id="alto" name="alto" type="number" step="0.01" class="form-control" tabindex="2" value="{{$dato->alto}}">
            @error('alto')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Ancho</label>
            <input id="ancho" name="ancho" type="number" step="0.01" class="form-control" tabindex="3" value="{{$dato->ancho}}">
            @error('ancho')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Largo</label>
            <input id="largo" name="largo" type="number" step="0.01" class="form-control" tabindex="4" value="{{$dato->largo}}">
            @error('largo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
    @endif

    @if ($tabla == 'proveedores') 
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" tabindex="1" value="{{$dato->nombre}}">
            @error('nombre')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Rut</label>
            <input id="rut" name="rut" type="text" class="form-control" tabindex="2" value="{{$dato->rut}}">
            @error('rut')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Razon social</label>
            <input id="razon_social" name="razon_social" type="text" class="form-control" tabindex="3" value="{{$dato->razon_social}}">
            @error('razon_social')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Correo</label>
            <input id="correo" name="correo" type="email" class="form-control" tabindex="4" value="{{$dato->correo}}">
            @error('correo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Ubicacion</label>
            <input id="ubicacion" name="ubicacion" type="text" class="form-control" tabindex="5" value="{{$dato->ubicacion}}">
            @error('ubicacion')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>

    
    @endif

    @if ($tabla == 'productos') 
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" tabindex="1" value="{{$dato->nombre}}">
            @error('nombre')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Descripcion</label>
            <input id="descripcion" name="descripcion" type="text" class="form-control" tabindex="2" value="{{$dato->descripcion}}">
            @error('descripcion')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nivel demanda</label>
            <select class="form-control select" name="nivel_demanda" id="nivel_demanda" tabindex="3"> 
                <option value=1 {{ $dato->nivel_demanda==1 ? 'selected' : ''  }}>1</option>
                <option value=2 {{ $dato->nivel_demanda==2 ? 'selected' : ''  }}>2</option>  
                <option value=3 {{ $dato->nivel_demanda==3 ? 'selected' : ''  }}>3</option>  
                <option value=4 {{ $dato->nivel_demanda==4 ? 'selected' : ''  }}>4</option>  
                <option value=5 {{ $dato->nivel_demanda==5 ? 'selected' : ''  }}>5</option>   
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Familia</label>
            <select class="form-control select" name="familia" id="familia" tabindex="4">
                <option selected value=1>Selecciona una familia</option>
                <option value="Tornillo">Tornillo</option>  
                <option value="Plancha_construccion">Plancha de construcción</option>  
                <option value="Techumbre">Techumbre</option>  
                <option value="Mueble">Mueble</option>  
                <option value="Madera">Madera</option>  
                <option value="Clavo">Clavo</option>  
            </select>
            @error('familia')
                <small style="color:red;">*Debes escoger una familia para continuar</small>
            @enderror
        </div>

        @if ($dato->familia == "Tornillo")
            @php($tornillo=App\Models\Tornillo::find($key))
        @elseif ($dato->familia == "Mueble") 
            @php($mueble=App\Models\Mueble::find($key))
        @elseif($dato->familia == "Plancha_construccion")
            @php($plancha_construccion=App\Models\Plancha_construccion::find($key)) 
        @elseif ($dato->familia == "Techumbre")
            @php($techumbre=App\Models\Techumbre::find($key))
        @elseif($dato->familia == "Madera")
            @php($madera=App\Models\Madera::find($key))
        @else 
            @php($clavo=App\Models\Clavo::find($key))
        @endif

        
        <div class="form-group tornillos">
            <label for="" class="form-label">Cabeza</label>
            <input id="cabeza" name="cabeza" type="number" step="0.01" class="form-control" tabindex="5" @if ($dato->familia == "Tornillo") value="{{$tornillo->cabeza}}" @endif>
            @error('cabeza')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group tornillos">
            <label for="" class="form-label">Tipo rosca</label>
            <select class="form-control select" name="tipo_rosca" id="tipo_rosca" tabindex="6"> 
                <option value="total" @if ($dato->familia == "Tornillo") {{ $tornillo->tipo_rosca=="total" ? 'selected' : ''  }} @endif>Total</option>  
                <option value="parcial" @if ($dato->familia == "Tornillo") {{ $tornillo->tipo_rosca=="parcial" ? 'selected' : ''  }} @endif>Parcial</option> 
            </select>
        </div>
        <div class="form-group tornillos">
            <label for="" class="form-label">Separación rosca</label>
            <input id="separacion_rosca" name="separacion_rosca" type="number" step="0.01" class="form-control" tabindex="7" @if ($dato->familia == "Tornillo") value="{{$tornillo->separacion_rosca}}" @endif>
            @error('separacion_rosca')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group tornillos">
            <label for="" class="form-label">Punta</label>
            <input id="punta" name="punta" type="text" class="form-control" tabindex="8" @if ($dato->familia == "Tornillo") value="{{$tornillo->punta}}" @endif>
            @error('punta')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group tornillos">
            <label for="" class="form-label">Rosca parcial</label>
            <input id="rosca_parcial" name="rosca_parcial" type="number" step="0.01" class="form-control" tabindex="9" @if ($dato->familia == "Tornillo") value="{{$tornillo->rosca_parcial}}" @endif>
            @error('rosca_parcial')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group tornillos">
            <label for="" class="form-label">Vastago</label>
            <input id="vastago" name="vastago" type="number" step="0.01" class="form-control" tabindex="10" @if ($dato->familia == "Tornillo") value="{{$tornillo->vastago}}" @endif>
            @error('vastago')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>  
        
        <div class="form-group planchas">
            <label for="" class="form-label">Material</label>
            <input id="material_plancha" name="material_plancha" type="text" class="form-control" tabindex="11" @if ($dato->familia == "Plancha_construccion") value="{{$plancha_construccion->material}}" @endif>
            @error('material_plancha')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group planchas">
            <label for="" class="form-label">Alto</label>
            <input id="alto_plancha" name="alto_plancha" type="number" step="0.01" class="form-control" tabindex="12" @if ($dato->familia == "Plancha_construccion") value="{{$plancha_construccion->alto}}" @endif>
            @error('alto_plancha')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group planchas">
            <label for="" class="form-label">Ancho</label>
            <input id="ancho_plancha" name="ancho_plancha" type="number" step="0.01" class="form-control" tabindex="13" @if ($dato->familia == "Plancha_construccion") value="{{$plancha_construccion->ancho}}" @endif>
            @error('ancho_plancha')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group planchas">
            <label for="" class="form-label">Largo</label>
            <input id="largo_plancha" name="largo_plancha" type="number" step="0.01" class="form-control" tabindex="14" @if ($dato->familia == "Plancha_construccion") value="{{$plancha_construccion->largo}}" @endif>
            @error('largo_plancha')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>

        <div class="form-group techumbres">
            <label for="" class="form-label">Material</label>
            <input id="material_techumbre" name="material_techumbre" type="text" class="form-control" tabindex="15" @if ($dato->familia == "Techumbre") value="{{$techumbre->material}}" @endif>
            @error('material_techumbre')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group techumbres">
            <label for="" class="form-label">Alto</label>
            <input id="alto_techumbre" name="alto_techumbre" type="number" step="0.01" class="form-control" tabindex="16" @if ($dato->familia == "Techumbre") value="{{$techumbre->alto}}" @endif>
            @error('alto_techumbre')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group techumbres">
            <label for="" class="form-label">Ancho</label>
            <input id="ancho_techumbre" name="ancho_techumbre" type="number" step="0.01" class="form-control" tabindex="17" @if ($dato->familia == "Techumbre") value="{{$techumbre->ancho}}" @endif>
            @error('ancho_techumbre')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group techumbres">
            <label for="" class="form-label">Largo</label>
            <input id="largo_techumbre" name="largo_techumbre" type="number" step="0.01" class="form-control" tabindex="18" @if ($dato->familia == "Techumbre") value="{{$techumbre->largo}}" @endif>
            @error('largo_techumbre')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>

        <div class="form-group muebles">
            <label for="" class="form-label">Material</label>
            <input id="material_mueble" name="material_mueble" type="text" class="form-control" tabindex="19" @if ($dato->familia == "Mueble")  value="{{$mueble->material}}" @endif>
            @error('material_mueble')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group muebles">
            <label for="" class="form-label">Acabado</label>
            <input id="acabado_mueble" name="acabado_mueble" type="text" class="form-control" tabindex="20" @if ($dato->familia == "Mueble")  value="{{$mueble->acabado}}" @endif>
            @error('acabado_mueble')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group muebles">
            <label for="" class="form-label">Alto</label>
            <input id="alto_mueble" name="alto_mueble" type="number" step="0.01" class="form-control" tabindex="21" @if ($dato->familia == "Mueble")  value="{{$mueble->alto}}" @endif>
            @error('alto_mueble')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group muebles">
            <label for="" class="form-label">Ancho</label>
            <input id="ancho_mueble" name="ancho_mueble" type="number" step="0.01" class="form-control" tabindex="22" @if ($dato->familia == "Mueble")  value="{{$mueble->ancho}}" @endif>
            @error('ancho_mueble')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group muebles">
            <label for="" class="form-label">Largo</label>
            <input id="largo_mueble" name="largo_mueble" type="number" step="0.01" class="form-control" tabindex="23" @if ($dato->familia == "Mueble")  value="{{$mueble->largo}}" @endif>
            @error('largo_mueble')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        
        <div class="form-group maderas">
            <label for="" class="form-label">Alto</label>
            <input id="alto_madera" name="alto_madera" type="number" step="0.01" class="form-control" tabindex="24" @if ($dato->familia == "Madera") value="{{$madera->alto}}" @endif>
            @error('alto_madera')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group maderas">
            <label for="" class="form-label">Ancho</label>
            <input id="ancho_madera" name="ancho_madera" type="number" step="0.01" class="form-control" tabindex="25" @if ($dato->familia == "Madera") value="{{$madera->ancho}}" @endif>
            @error('ancho_madera')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group maderas">
            <label for="" class="form-label">Largo</label>
            <input id="largo_madera" name="largo_madera" type="number" step="0.01" class="form-control" tabindex="26" @if ($dato->familia == "Madera") value="{{$madera->largo}}" @endif>
            @error('largo_madera')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group maderas">
            <label for="" class="form-label">Tipo madera</label>
            <input id="tipo_madera" name="tipo_madera" type="text" class="form-control" tabindex="27" @if ($dato->familia == "Madera") value="{{$madera->tipo_madera}}" @endif>
            @error('tipo_madera')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group maderas">
            <label for="" class="form-label">Tratamiento</label>
            <input id="tratamiento" name="tratamiento" type="text" class="form-control" tabindex="28" @if ($dato->familia == "Madera") value="{{$madera->tratamiento}}" @endif>
            @error('tratamiento')
                <small style="color:red;">*{{$message}}</small>
            @enderror

        </div>
            
        <div class="form-group clavos">
            <label for="" class="form-label">Material</label>
            <input id="material_clavo" name="material_clavo" type="text" class="form-control" tabindex="29" @if ($dato->familia == "Clavo") value="{{$clavo->material}}" @endif>
            @error('material_clavo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group clavos">
            <label for="" class="form-label">Cabeza</label>
            <input id="cabeza_clavo" name="cabeza_clavo" type="number" step="0.01" class="form-control" tabindex="30" @if ($dato->familia == "Clavo") value="{{$clavo->cabeza}}" @endif>
            @error('cabeza_clavo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group clavos">
            <label for="" class="form-label">Punta</label>
            <input id="punta_clavo" name="punta_clavo" type="text" class="form-control" tabindex="31" @if ($dato->familia == "Clavo") value="{{$clavo->punta}}" @endif>
            @error('punta_clavo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group clavos">
            <label for="" class="form-label">Longitud</label>
            <input id="longitud_clavo" name="longitud_clavo" type="number" step="0.01" class="form-control" tabindex="32" @if ($dato->familia == "Clavo") value="{{$clavo->longitud}}" @endif>
            @error('longitud_clavo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>

    @endif

    @if ($tabla == 'planchas_construccion') 
        <div class="mb-3">
            <label for="" class="form-label">Material</label>
            <input id="material" name="material" type="text" class="form-control" tabindex="1" value="{{$dato->material}}">
            @error('material')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Alto</label>
            <input id="alto" name="alto" type="number" step="0.01" class="form-control" tabindex="2" value="{{$dato->alto}}">
            @error('alto')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Ancho</label>
            <input id="ancho" name="ancho" type="number" step="0.01" class="form-control" tabindex="3" value="{{$dato->ancho}}">
            @error('ancho')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Largo</label>
            <input id="largo" name="largo" type="number" step="0.01" class="form-control" tabindex="4" value="{{$dato->largo}}">
            @error('largo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
    @endif

    @if ($tabla == 'muebles')
        <div class="mb-3">
            <label for="" class="form-label">Material</label>
            <input id="material" name="material" type="text" class="form-control" tabindex="1" value="{{$dato->material}}">
            @error('material')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Acabado</label>
            <input id="acabado" name="acabado" type="text" class="form-control" tabindex="2" value="{{$dato->acabado}}">
            @error('acabado')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Alto</label>
            <input id="alto" name="alto" type="number" step="0.01" class="form-control" tabindex="3" value="{{$dato->alto}}">
            @error('alto')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Ancho</label>
            <input id="ancho" name="ancho" type="number" step="0.01" class="form-control" tabindex="4" value="{{$dato->ancho}}">
            @error('ancho')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Largo</label>
            <input id="largo" name="largo" type="number" step="0.01" class="form-control" tabindex="5" value="{{$dato->largo}}">
            @error('largo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
    @endif

    @if ($tabla == 'maderas') 
        <div class="mb-3">
            <label for="" class="form-label">Alto</label>
            <input id="alto" name="alto" type="number" step="0.01" class="form-control" tabindex="1" value="{{$dato->alto}}">
            @error('alto')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Ancho</label>
            <input id="ancho" name="ancho" type="number" step="0.01" class="form-control" tabindex="2" value="{{$dato->ancho}}">
            @error('ancho')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Largo</label>
            <input id="largo" name="largo" type="number" step="0.01" class="form-control" tabindex="3" value="{{$dato->largo}}">
            @error('largo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tipo madera</label>
            <input id="tipo_madera" name="tipo_madera" type="text" class="form-control" tabindex="4" value="{{$dato->tipo_madera}}">
            @error('tipo_madera')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tratamiento</label>
            <input id="tratamiento" name="tratamiento" type="text" class="form-control" tabindex="5" value="{{$dato->tratamiento}}">
            @error('tratamiento')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
    @endif

    {{-- Verificar al final --}}
    @if ($tabla == 'sucursal_producto') 
        @php($sucursales=DB::table('inventarios')->get())
        @php($productos=DB::table('productos')->get())
        <div class="mb-3">
            <label for="" class="form-label">Sucursal</label>
            <select class="form-control select" name="sucursal_id" id="sucursal_id" tabindex="1">
                @foreach ($sucursales as $sucursal)
                <option value={{$sucursal->id}} {{ $dato->sucursal_id==$sucursal->id ? 'selected' : ''  }}>{{$sucursal->direccion_sucursal}}</option> 
                @endforeach  
            </select>
            @error('sucursal_id')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Producto</label>
            <select class="form-control select" name="producto_id" id="producto_id" tabindex="2">
                @foreach ($productos as $producto)
                <option value={{$producto->id}} {{ $dato->producto_id==$producto->id ? 'selected' : ''  }}>{{$producto->nombre}}</option> 
                @endforeach  
            </select>
            @error('producto_id')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Stock</label>
            <input id="stock" name="stock" type="number" class="form-control" tabindex="3" value="{{$dato->stock}}">
            @error('stock')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Precio compra</label>
            <input id="precio_compra" name="precio_compra" type="number" class="form-control" tabindex="4" value="{{$dato->precio_compra}}">
            @error('precio_compra')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        
    @endif

    @if ($tabla == 'inventarios') 
        <div class="mb-3">
            <label for="" class="form-label">Direccion sucursal</label>
            <input id="direccion_sucursal" name="direccion_sucursal" type="text" class="form-control" tabindex="5" value="{{$dato->direccion_sucursal}}">
            @error('direccion_sucursal')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
    @endif

    @if ($tabla == 'fotos') 
        <div class="mb-3">
            <label for="" class="form-label">Url</label>
            <input id="url" name="url" type="text" class="form-control" tabindex="5" value="{{$dato->url}}">
            @error('url')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">ID imagenable</label>
            <input id="imagenable_id" name="imagenable_id" type="number" class="form-control" tabindex="6" value="{{$dato->imagenable_id}}">
            @error('imagenable_id')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tipo imanegenable</label>
            <input id="imagenable_tipo" name="imagenable_tipo" type="text" class="form-control" tabindex="7" value="{{$dato->imagenable_tipo}}">
            @error('tipo_imagenable')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        
    @endif

    @if ($tabla == 'ejecutivos')
        @php($proveedores=DB::table('proveedors')->get())
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" tabindex="5" value="{{$dato->nombre}}">
            @error('nombre')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Apellido</label>
            <input id="apellido" name="apellido" type="text" class="form-control" tabindex="6" value="{{$dato->apellido}}">
            @error('apellido')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Correo</label>
            <input id="correo" name="correo" type="email" class="form-control" tabindex="7" value="{{$dato->correo}}">
            @error('correo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Telefono</label>
            <input id="telefono" name="telefono" type="tel" class="form-control" pattern="\+569[0-9]{8}" title="El teléfono debe contener el prefijo '+569' y 8 dígitos." tabindex="8" value="{{$dato->telefono}}">
            @error('telefono')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Proveedor</label>
            <select class="form-control select" name="proveedor_rut" id="proveedor_rut" tabindex="9">
                @foreach ($proveedores as $proveedor)
                    <option value={{$proveedor->rut}} {{ $dato->proveedor_rut==$proveedor->rut ? 'selected' : ''  }}>{{$proveedor->nombre}}</option> 
                @endforeach  
            </select>
        </div> 
        
    @endif

    @if ($tabla == 'compras') 
        @php($clientes=DB::table('clientes')->get())
        @php($productos=DB::table('productos')->get())
        <div class="mb-3">
            <label for="" class="form-label">Cantidad</label>
            <input id="cantidad" name="cantidad" type="number" class="form-control" tabindex="5" value="{{$dato->cantidad}}">
            @error('cantidad')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Rut cliente</label>
            <select class="form-control select" name="rut" id="rut" tabindex="6">
                @foreach ($clientes as $cliente)
                    <option value={{$cliente->usuario_rut}} {{ $dato->cliente_rut==$cliente->usuario_rut ? 'selected' : ''  }}>{{$cliente->usuario_rut}}</option> 
                @endforeach  
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Producto</label>
            <select class="form-control select" name="producto_id" id="producto_id" tabindex="7">
                @foreach ($productos as $producto)
                    <option value={{$producto->id}} {{ $dato->producto_id==$producto->id ? 'selected' : ''  }}>{{$producto->nombre}}</option> 
                @endforeach  
            </select>
        </div>
    @endif

    @if ($tabla == 'clavos') 
        <div class="mb-3">
            <label for="" class="form-label">Material</label>
            <input id="material" name="material" type="text" class="form-control" tabindex="5" value="{{$dato->material}}">
            @error('material')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Cabeza</label>
            <input id="cabeza" name="cabeza" type="number" step="0.01" class="form-control" tabindex="6" value="{{$dato->cabeza}}">
            @error('cabeza')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Punta</label>
            <input id="punta" name="punta" type="text" class="form-control" tabindex="7" value="{{$dato->punta}}">
            @error('punta')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Longitud</label>
            <input id="longitud" name="longitud" type="number" step="0.01" class="form-control" tabindex="8" value="{{$dato->longitud}}">
            @error('longitud')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
    @endif

    <br>
    <a href={{route('admin_visualizar_especifico',$tabla)}} class="btn btn-secondary" tabindex="10">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="11">Guardar</button>
    
</form>

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
     $("#tipo_usuario").on('change',function(){
       var selectedBalue = $("#tipo_usuario").val();
       if (selectedBalue == 2) 
       {
         $(".trabajadores").slideDown(200);
       }
       else{
         $(".trabajadores").slideUp(200);
       }
       if (selectedBalue == 3) 
       {
         $(".clientes").slideDown(200);
       }
       else{
         $(".clientes").slideUp(200);
       }
    }); 

    $("#familia").on('change',function(){
       var selectedBalue = $("#familia").val();
       if (selectedBalue == "Tornillo") 
       {
         $(".tornillos").slideDown(200);   
       }
       else{
         $(".tornillos").slideUp(200);   
       }

       if (selectedBalue == "Mueble") 
       {
         $(".muebles").slideDown(200);   
       }
       else{
         $(".muebles").slideUp(200);   
       }
       if (selectedBalue == "Madera") 
       {
         $(".maderas").slideDown(200);   
       }
       else{
         $(".maderas").slideUp(200);   
       }
       if (selectedBalue == "Clavo") 
       {
         $(".clavos").slideDown(200);   
       }
       else{
         $(".clavos").slideUp(200);   
       }
       if (selectedBalue == "Techumbre") 
       {
         $(".techumbres").slideDown(200);   
       }
       else{
         $(".techumbres").slideUp(200);   
       }
       if (selectedBalue == "Plancha_construccion") 
       {
         $(".planchas").slideDown(200);   
       }
       else{
         $(".planchas").slideUp(200);   
       }


    }); 


    }
     
    );
</script> 
@endsection