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
            <input id="duplicado" name="duplicado" type="hidden" class="form-control" tabindex="2" value="si">
            @error('duplicado')
                <small style="color:red;">*El valor del campo rut ya está en uso.</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" tabindex="3" value="{{$dato->nombre}}">
            @error('nombre')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Apellido</label>
            <input id="apellido" name="apellido" type="text" class="form-control" tabindex="4" value="{{$dato->apellido}}">
            @error('apellido')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Correo</label>
            <input id="correo" name="correo" type="email" class="form-control" tabindex="5" value="{{$dato->correo}}">
            @error('correo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tipo Usuario</label>
            <select class="form-control select" name="tipo_usuario" id="tipo_usuario" tabindex="6" value="{{$dato->tipo_usuario}}">
                <option selected>Escoge un tipo de usuario</option>
                <option value=2 {{ $dato->tipo_usuario==2 ? 'selected' : ''  }}>Trabajador</option>  
                <option value=3 {{ $dato->tipo_usuario==3 ? 'selected' : ''  }}>Cliente</option>  
            </select>
            @error('tipo_usuario')
                <small style="color:red;">*Debes escoger un tipo de usuario para continuar</small>
            @enderror
        </div> 

        <div class="mb-3">
            <label for="" class="form-label">Estado</label>
            <select class="form-control select" name="estado" id="estado" tabindex="7" value="{{$dato->estado}}">
                <option value=1 {{ $dato->estado==1 ? 'selected' : ''  }}>Activado</option>  
                <option value=0 {{ $dato->estado==0 ? 'selected' : ''  }}>Desactivado</option>  
            </select>
            @error('estado')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div> 

        {{-- Trabajador --}}
        @php($trabajador=App\Models\Trabajador::find($key))
        <div class="form-group trabajadores">
            <label for="" class="form-label">Tipo trabajador</label>
            <select class="form-control select" name="tipo_trabajador" id="tipo_trabajador" tabindex="8">
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
            <select class="form-control select" name="sucursal_id" id="sucursal_id" tabindex="9">
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
            <input id="telefono" name="telefono" type="tel" class="form-control" pattern="\+569[0-9]{8}" title="El teléfono debe contener el prefijo '+569' y 8 dígitos." tabindex="10" @if ($cliente!=null) value="{{$cliente->telefono}}" @endif>
            @error('telefono')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div> 

    @elseif($tabla == 'clientes') 
        <div class="mb-3">
            <label for="" class="form-label">Telefono</label>
            <input id="telefono" name="telefono" type="tel" class="form-control" pattern="\+569[0-9]{8}" title="El teléfono debe contener el prefijo '+569' y 8 dígitos." tabindex="1" value="{{$dato->telefono}}">
            @error('telefono')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        
    @elseif($tabla == 'trabajadores') 
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
        
    @elseif($tabla == 'orden_compras') 
        @php($proveedores=DB::table('proveedors')->get())
        @php($sucursales=DB::table('inventarios')->get())

        <div class="mb-3">
            <label for="" class="form-label">Sucursal</label>
            <select class="form-control select" name="sucursal_id" id="sucursal_id" tabindex="1">
                @foreach ($sucursales as $sucursal)
                <option value={{$sucursal->id}} {{ $dato->sucursal_id==$sucursal->id ? 'selected' : ''  }}>{{$sucursal->direccion_sucursal}}</option> 
                @endforeach 
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Proveedor</label>
            <select class="form-control select" name="proveedor_rut" id="proveedor_rut" tabindex="2">
                @foreach ($proveedores as $proveedor)
                <option value={{$proveedor->rut}} {{ $dato->proveedor_rut==$proveedor->rut ? 'selected' : ''  }}>{{$proveedor->razon_social}}</option> 
                @endforeach  
            </select>
        </div>
       
        
    @elseif($tabla == 'transportes') 
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
                <option value={{$proveedor->rut}} {{$dato->proveedor_rut==$proveedor->rut ? 'selected' : ''  }}>{{$proveedor->razon_social}}</option> 
                @endforeach  
            </select>
        </div>
        
    @elseif($tabla == 'tornillos') 
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

        
    @elseif($tabla == 'telefono_proveedores') 
        @php($proveedores=DB::table('proveedors')->get())
        <div class="mb-3">
            <label for="" class="form-label">Proveedor</label>
            <select class="form-control select" name="proveedor_rut" id="proveedor_rut" tabindex="1">
                @foreach ($proveedores as $proveedor)
                <option value={{$proveedor->rut}} {{ $dato->proveedor_rut==$proveedor->rut ? 'selected' : ''  }}>{{$proveedor->razon_social}}</option> 
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
        
    @elseif($tabla == 'techumbres') 
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
    @elseif($tabla == 'proveedores') 
        <div class="mb-3">
            <label for="" class="form-label">Rut</label>
            <input id="rut" name="rut" type="text" class="form-control" tabindex="1" value="{{$dato->rut}}">
            @error('rut')
                <small style="color:red;">*{{$message}}</small>
            @enderror
            <input id="duplicado" name="duplicado" type="hidden" class="form-control" tabindex="2" value="si">
            @error('duplicado')
                <small style="color:red;">*El valor del campo rut ya está en uso.</small>
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

    
    @elseif($tabla == 'productos') 
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
            <label for="" class="form-label">Estado</label>
            <select class="form-control select" name="estado" id="estado" tabindex="4">
                <option value=1 {{ $dato->estado==1 ? 'selected' : ''  }}>Activado</option>  
                <option value=0 {{ $dato->estado==0 ? 'selected' : ''  }}>Desactivado</option>  
            </select>
            @error('estado')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Familia</label>
            <select class="form-control select" name="familia" id="familia" tabindex="5">
                <option selected value=1>Selecciona una familia</option>
                <option value="Tornillo" {{ $dato->familia=="Tornillo" ? 'selected' : ''  }}>Tornillo</option>  
                <option value="Plancha_construccion" {{ $dato->familia=="Plancha_construccion" ? 'selected' : ''  }}>Plancha de construcción</option>  
                <option value="Techumbre" {{ $dato->familia=="Techumbre" ? 'selected' : ''  }}>Techumbre</option>  
                <option value="Mueble" {{ $dato->familia=="Mueble" ? 'selected' : ''  }}>Mueble</option>  
                <option value="Madera" {{ $dato->familia=="Madera" ? 'selected' : ''  }}>Madera</option>  
                <option value="Clavo" {{ $dato->familia=="Clavo" ? 'selected' : ''  }}>Clavo</option>  
                <option value="Herramienta" {{ $dato->familia=="Herramienta" ? 'selected' : ''  }}>Herramienta</option>  
                <option value="Otro" {{ $dato->familia=="Otro" ? 'selected' : ''  }}>Otro</option>  
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

    @elseif($tabla == 'planchas_construccion') 
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
    @elseif($tabla == 'muebles')
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
    @elseif($tabla == 'maderas') 
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
    @elseif($tabla == 'sucursal_producto') 
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

        <label for="" class="form-label">Producto</label>
        <div class="input-group" >
            <input class="form-control select" list="datalist_productos" name="producto_id" id="producto_id" tabindex="2" value="{{$dato->producto_id}}">
            <datalist id="datalist_productos" >
                <select>
                    @foreach ($productos as $producto)
                        <option value={{$producto->id}} {{ $dato->producto_id==$producto->id ? 'selected' : ''  }}>{{$producto->nombre}}</option> 
                    @endforeach 
                </select> 
            </datalist>
            <input id="existe_producto" name="existe_producto" type="hidden" class="form-control" tabindex="3" value="no">
        </div>
        <div>
            @error('existe_producto')
            <small style="color:red;">*El ID del producto ingresado no existe.</small>
            @enderror
            @error('producto_id')
            <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>


        <div class="mb-3">
            <label for="" class="form-label">Stock</label>
            <input id="stock" name="stock" type="number" class="form-control" tabindex="4" value="{{$dato->stock}}">
            @error('stock')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Precio compra</label>
            <input id="precio_compra" name="precio_compra" type="number" class="form-control" tabindex="5" value="{{$dato->precio_compra}}">
            @error('precio_compra')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        
    @elseif($tabla == 'inventarios') 
        <div class="mb-3">
            <label for="" class="form-label">Direccion sucursal</label>
            <input id="direccion_sucursal" name="direccion_sucursal" type="text" class="form-control" tabindex="1" value="{{$dato->direccion_sucursal}}">
            @error('direccion_sucursal')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
    @elseif($tabla == 'fotos') 
        @php($productos=DB::table('productos')->get())
  
        <label for="" class="form-label">ID imagenable</label>
        <div class="input-group" >
            <input class="form-control select" list="datalist_productos" id="imagenable_id" name="imagenable_id" type="number" tabindex="2" value="{{$dato->imagenable_id}}" >
            <datalist id="datalist_productos" >
                <select>
                    @foreach ($productos as $producto)
                        <option value={{$producto->id}} {{ old('producto_id')==$producto->id ? 'selected' : ''  }}>{{$producto->nombre}}</option> 
                    @endforeach 
                </select> 
            </datalist>
        </div>
        
    @elseif($tabla == 'ejecutivos')
        @php($proveedores=DB::table('proveedors')->get())
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" tabindex="1" value="{{$dato->nombre}}">
            @error('nombre')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Apellido</label>
            <input id="apellido" name="apellido" type="text" class="form-control" tabindex="2" value="{{$dato->apellido}}">
            @error('apellido')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Correo</label>
            <input id="correo" name="correo" type="email" class="form-control" tabindex="3" value="{{$dato->correo}}">
            @error('correo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Telefono</label>
            <input id="telefono" name="telefono" type="tel" class="form-control" pattern="\+569[0-9]{8}" title="El teléfono debe contener el prefijo '+569' y 8 dígitos." tabindex="4" value="{{$dato->telefono}}">
            @error('telefono')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Proveedor</label>
            <select class="form-control select" name="proveedor_rut" id="proveedor_rut" tabindex="5">
                @foreach ($proveedores as $proveedor)
                    <option value={{$proveedor->rut}} {{ $dato->proveedor_rut==$proveedor->rut ? 'selected' : ''  }}>{{$proveedor->razon_social}}</option> 
                @endforeach  
            </select>
        </div> 
        
    @elseif($tabla == 'detalle_ventas') 
        @php($ventas=DB::table('ventas')->get())
        @php($productos=DB::table('productos')->get())
    
        <div class="mb-3">
            <label for="" class="form-label">ID Venta</label>
            <select class="form-control select" name="venta_id" id="venta_id" tabindex="1">
                @foreach ($ventas as $venta)
                    <option value={{$venta->id}} {{ $dato->venta_id==$venta->id ? 'selected' : ''  }}>{{$venta->id}}</option> 
                @endforeach  
            </select>
        </div>

        <label for="" class="form-label">Producto</label>
        <div class="input-group" >
            <input class="form-control select" list="datalist_productos" name="producto_id" id="producto_id" tabindex="2" value="{{$dato->producto_id}}">
            <datalist id="datalist_productos" >
                <select>
                    @foreach ($productos as $producto)
                        <option value={{$producto->id}} {{ $dato->producto_id==$producto->id ? 'selected' : ''  }}>{{$producto->nombre}}</option> 
                    @endforeach 
                </select> 
            </datalist>
            <input id="existe_producto" name="existe_producto" type="hidden" class="form-control" tabindex="3" value="no">
        </div>
        <div>
            @error('existe_producto')
            <small style="color:red;">*El ID del producto ingresado no existe.</small>
            @enderror
            @error('producto_id')
            <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Cantidad</label>
            <input id="cantidad" name="cantidad" type="number" class="form-control" tabindex="4" value="{{$dato->cantidad}}">
            @error('cantidad')
                <small style="color:red;">*{{$message}}</small>
            @enderror
            <input id="supera_stock" name="supera_stock" type="hidden" class="form-control" tabindex="5" value="si">
            @error('supera_stock')
                <small style="color:red;">*No puedes superar el stock de este producto en el inventario.</small>
            @enderror
        </div>
    @elseif($tabla == 'clavos') 
        <div class="mb-3">
            <label for="" class="form-label">Material</label>
            <input id="material" name="material" type="text" class="form-control" tabindex="1" value="{{$dato->material}}">
            @error('material')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Cabeza</label>
            <input id="cabeza" name="cabeza" type="number" step="0.01" class="form-control" tabindex="2" value="{{$dato->cabeza}}">
            @error('cabeza')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Punta</label>
            <input id="punta" name="punta" type="text" class="form-control" tabindex="3" value="{{$dato->punta}}">
            @error('punta')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Longitud</label>
            <input id="longitud" name="longitud" type="number" step="0.01" class="form-control" tabindex="4" value="{{$dato->longitud}}">
            @error('longitud')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
    @elseif($tabla == 'detalle_compras')
        @php($ordenes=DB::table('orden_compras')->get())
        @php($productos=DB::table('productos')->get())

        <div class="mb-3">
            <label for="" class="form-label">ID Orden de compra</label>
            <select class="form-control select" name="oc_id" id="oc_id" tabindex="1">
                @foreach ($ordenes as $orden)
                    <option value={{$orden->id}} {{ $dato->oc_id==$orden->id ? 'selected' : ''  }}>{{$orden->id}}</option> 
                @endforeach  
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Producto</label>
            <select class="form-control select" name="producto_id" id="producto_id" tabindex="2">
                @foreach ($productos as $producto)
                    <option value={{$producto->id}} {{ $dato->producto_id==$producto->id ? 'selected' : ''  }}>{{$producto->nombre}}</option> 
                @endforeach  
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Nivel de calidad</label>
            <select class="form-control select" name="nivel_calidad" id="nivel_calidad" tabindex="3">
                <option value=1 {{ $dato->nivel_calidad==1? 'selected' : ''  }}>Bajo</option>  
                <option value=2 {{ $dato->nivel_calidad==2? 'selected' : ''  }}>Aceptable</option>  
                <option value=3 {{ $dato->nivel_calidad==3? 'selected' : ''  }}>Medio</option>  
                <option value=4 {{ $dato->nivel_calidad==4? 'selected' : ''  }}>Bueno</option>  
                <option value=5 {{ $dato->nivel_calidad==5? 'selected' : ''  }}>Excelente</option>  
            </select>
            @error('nivel_calidad')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Cantidad</label>
            <input id="cantidad" name="cantidad" type="number" class="form-control" tabindex="4" value="{{$dato->cantidad}}">
            @error('cantidad')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Precio unitario</label>
            <input id="precio_unitario" name="precio_unitario" type="number" class="form-control" tabindex="5" value="{{$dato->precio_unitario}}">
            @error('precio_unitario')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>

    @elseif($tabla == 'ventas') 
        @php($clientes=DB::table('clientes')->get())
        @php($sucursales=DB::table('inventarios')->get())
        @php($vendedores=DB::table('trabajadors')->where('tipo_trabajador',2)->get())

        <div class="mb-3">
            <label for="" class="form-label">Sucursal</label>
            <select class="form-control select" name="sucursal_id" id="sucursal_id" tabindex="1">
                @foreach ($sucursales as $sucursal)
                <option value={{$sucursal->id}} {{ $dato->sucursal_id==$sucursal->id ? 'selected' : ''  }}>{{$sucursal->direccion_sucursal}}</option> 
                @endforeach 
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Rut vendedor</label>
            <select class="form-control select" name="vendedor_rut" id="vendedor_rut" tabindex="2">
                @foreach ($vendedores as $vendedor)
                    <option value={{$vendedor->usuario_rut}} {{ $dato->vendedor_rut==$vendedor->usuario_rut? 'selected' : ''  }}>{{$vendedor->usuario_rut}}</option> 
                @endforeach  
            </select>
        </div>

        <label for="" class="form-label">Rut cliente</label>
        <div class="input-group" >
            <input class="form-control select" list="datalist_clientes" name="cliente_rut" id="cliente_rut" tabindex="3" value="{{$dato->cliente_rut}}">
            <datalist id="datalist_clientes" >
                <select>
                    @foreach ($clientes as $cliente)
                    <option value={{$cliente->usuario_rut}} {{ $dato->cliente_rut==$cliente->usuario_rut ? 'selected' : ''  }}>{{$cliente->usuario_rut}}</option> 
                    @endforeach  
                </select> 
            </datalist>
            <input id="existe_producto" name="existe_producto" type="hidden" class="form-control" tabindex="4" value="no">
        </div>
        <div>
            @error('cliente_rut')
            <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Medio de pago</label>
            <select class="form-control select" name="medio_de_pago" id="medio_de_pago" tabindex="5">
                <option value=1 {{ $dato->medio_de_pago==1? 'selected' : ''  }}>Efectivo</option>  
                <option value=2 {{ $dato->medio_de_pago==2? 'selected' : ''  }}>Tarjeta de débito</option>  
                <option value=3 {{ $dato->medio_de_pago==3? 'selected' : ''  }}>Tarjeta de crédito</option>  
                <option value=4 {{ $dato->medio_de_pago==4? 'selected' : ''  }}>Transferencia</option>  
            </select>
            @error('medio_de_pago')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label">¿Compra con factura?</label>
            <select class="form-control select" name="con_factura" id="con_factura" tabindex="6">
                <option value=0 {{ $dato->con_factura==0? 'selected' : ''  }}>No</option>  
                <option value=1 {{ $dato->con_factura==1? 'selected' : ''  }}>Si</option>  
            </select>
            @error('con_factura')
                <small style="color:red;">{{$message}}</small>
            @enderror
        </div>
       
        
    @endif

    <br>
    <a href={{route('admin_visualizar_especifico',$tabla)}} class="btn btn-secondary" tabindex="20">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="21">Guardar</button>
    
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