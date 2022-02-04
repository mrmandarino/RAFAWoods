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
        .material{
          display: none;  
        }
        .clientes{
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
        .medidas{
          display: none;  
        }
        .tornillos_clavos{
          display: none;   
        }
    </style>
@endsection

@section('contenido')
<h2>CREAR REGISTROS</h2>
<form action={{route('admin_guardar_datos',$tabla)}} method="POST">
    @csrf
    @if ($tabla == 'usuarios') 
        @php($sucursales=DB::table('inventarios')->get())
        <div class="mb-3">
            <label for="" class="form-label">Rut</label>
            <input id="rut" name="rut" type="text" class="form-control" tabindex="1" value="{{old('rut')}}">
            @error('rut')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" tabindex="2" value="{{old('nombre')}}">
            @error('nombre')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Apellido</label>
            <input id="apellido" name="apellido" type="text" class="form-control" tabindex="3" value="{{old('apellido')}}">
            @error('apellido')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Password</label>
            <div class="input-group">
                <input id="password" name="password" type="password" class="form-control" tabindex="4">
                <div class="input-group-append">
                    <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                </div>
            </div>
            @error('password')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Correo</label>
            <input id="correo" name="correo" type="email" class="form-control" tabindex="5" value="{{old('correo')}}">
            @error('correo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tipo Usuario</label>
            <select class="form-control select" name="tipo_usuario" id="tipo_usuario" tabindex="6">
                <option selected>Escoge un tipo de usuario</option>
                <option value=2>Trabajador</option>  
                <option value=3>Cliente</option>  
            </select>
            @error('tipo_usuario')
                <small style="color:red;">*Debes escoger un tipo de usuario para continuar</small>
            @enderror
        </div>
        
        {{-- Trabajador --}}
        <div class="form-group trabajadores">
            <label for="" class="form-label">Tipo trabajador</label>
            <select class="form-control select" name="tipo_trabajador" id="tipo_trabajador" tabindex="7">
                <option value=1 {{ old('tipo_trabajador')==1 ? 'selected' : ''  }}>Ejecutivo</option>  
                <option value=2 {{ old('tipo_trabajador')==2 ? 'selected' : ''  }}>Vendedor</option>  
            </select>
        </div>

        <div class="form-group trabajadores">
            <label for="" class="form-label">Sucursal</label>
            <select class="form-control select" name="sucursal_id" id="sucursal_id" tabindex="8">
                @foreach ($sucursales as $sucursal)
                <option value={{$sucursal->id}} {{ old('sucursal_id')==$sucursal->id ? 'selected' : ''  }}>{{$sucursal->direccion_sucursal}}</option> 
                @endforeach  
            </select>
        </div>

        {{-- Cliente --}}
        <div class="form-group clientes">
            <label for="" class="form-label">Telefono(Opcional)</label>
            <input id="telefono" name="telefono" type="tel" class="form-control" tabindex="9" pattern="\+569[0-9]{8}" title="El teléfono debe contener el prefijo '+569' y 8 dígitos." value="{{old('telefono')}}">
            @error('telefono')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div> 

        <br>
        <a href={{route('admin_visualizar_especifico',$tabla)}} class="btn btn-secondary" tabindex="10">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="11">Guardar</button>
        
    @endif

    @if ($tabla == 'clientes')
        <div class="mb-3">
            <label for="" class="form-label">Rut</label>
            <input id="rut" name="rut" type="text" class="form-control" tabindex="1" value="{{old('rut')}}">
            @error('rut')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" tabindex="2" value="{{old('nombre')}}">
            @error('nombre')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Apellido</label>
            <input id="apellido" name="apellido" type="text" class="form-control" tabindex="3" value="{{old('apellido')}}">
            @error('apellido')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Password</label>
            <div class="input-group">
                <input id="password" name="password" type="password" class="form-control" tabindex="4">
                <div class="input-group-append">
                    <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                </div>
            </div>
            @error('password')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Correo</label>
            <input id="correo" name="correo" type="email" class="form-control" tabindex="5" value="{{old('correo')}}">
            @error('correo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Telefono(Opcional)</label>
            <input id="telefono" name="telefono" type="tel" class="form-control" pattern="\+569[0-9]{8}" title="El teléfono debe contener el prefijo '+569' y 8 dígitos." tabindex="6" value="{{old('telefono')}}">
            @error('telefono')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <a href={{route('admin_visualizar_especifico',$tabla)}} class="btn btn-secondary" tabindex="7">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="8">Guardar</button>
        
    @endif

    @if ($tabla == 'trabajadores')
        @php($sucursales=DB::table('inventarios')->get())

        <div class="mb-3">
            <label for="" class="form-label">Rut</label>
            <input id="rut" name="rut" type="text" class="form-control" tabindex="1" value="{{old('rut')}}">
            @error('rut')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" tabindex="2" value="{{old('nombre')}}">
            @error('nombre')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Apellido</label>
            <input id="apellido" name="apellido" type="text" class="form-control" tabindex="3" value="{{old('apellido')}}">
            @error('apellido')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Password</label>
            <div class="input-group">
                <input id="password" name="password" type="password" class="form-control" tabindex="4">
                <div class="input-group-append">
                    <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                </div>
            </div>
            @error('password')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Correo</label>
            <input id="correo" name="correo" type="email" class="form-control" tabindex="5" value="{{old('correo')}}">
            @error('correo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Tipo trabajador</label>
            <select class="form-control select" name="tipo_trabajador" id="tipo_trabajador" tabindex="6"> 
                <option value=1 {{ old('tipo_trabajador')==1 ? 'selected' : ''  }}>Ejecutivo</option>  
                <option value=2 {{ old('tipo_trabajador')==2 ? 'selected' : ''  }}>Vendedor</option>  
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Sucursal</label>
            <select class="form-control select" name="sucursal_id" id="sucursal_id" tabindex="7">
                @foreach ($sucursales as $sucursal)
                <option value={{$sucursal->id}}>{{$sucursal->direccion_sucursal}}</option> 
                @endforeach  
            </select>
        </div>
        <a href={{route('admin_visualizar_especifico',$tabla)}} class="btn btn-secondary" tabindex="8">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="9">Guardar</button>
        
    @endif

    @if ($tabla == 'madera_proveedores')  
        @php($proveedores=DB::table('proveedors')->get())
        @php($maderas=DB::table('maderas')->get())

        <div class="mb-3">
            <label for="" class="form-label">Nivel calidad</label>
            <select class="form-control select" name="nivel_calidad" id="nivel_calidad" tabindex="1"> 
                <option value=1 {{ old('nivel_calidad')==1 ? 'selected' : ''  }}>Bajo</option>  
                <option value=2 {{ old('nivel_calidad')==2 ? 'selected' : ''  }}>Aceptable</option> 
                <option value=3 {{ old('nivel_calidad')==3 ? 'selected' : ''  }}>Medio</option>  
                <option value=4 {{ old('nivel_calidad')==4 ? 'selected' : ''  }}>Alto</option>  
                <option value=5 {{ old('nivel_calidad')==5 ? 'selected' : ''  }}>Excelente</option>  
            </select>
        </div>
       
        <div class="mb-3">
            <label for="" class="form-label">Proveedor</label>
            <select class="form-control select" name="proveedor_rut" id="proveedor_rut" tabindex="2">
                @foreach ($proveedores as $proveedor)
                <option value={{$proveedor->rut}} {{ old('proveedor_rut')==$proveedor->rut ? 'selected' : ''  }}>{{$proveedor->nombre}}</option>  {{-- ojo con el old --}}
                @endforeach  
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Madera</label>
            <select class="form-control select" name="madera_id" id="madera_id" tabindex="3">
                @foreach ($maderas as $madera)
                @php($producto=DB::table('productos')->get()->where('id',$madera->producto_id)->first())
                <option value={{$madera->producto_id}} {{ old('madera_id')==$madera->producto_id ? 'selected' : ''  }}>{{$producto->nombre}}</option> 
                @endforeach 
            </select>
        </div>
        <a href={{route('admin_visualizar_especifico',$tabla)}} class="btn btn-secondary" tabindex="4">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="5">Guardar</button>
    
    @endif

    @if ($tabla == 'transportes')
        @php($proveedores=DB::table('proveedors')->get())
        <div class="mb-3">
            <label for="" class="form-label">Nombre transportista</label>
            <input id="nombre_transportista" name="nombre_transportista" type="text" class="form-control" tabindex="1" value="{{old('nombre_transportista')}}">
            @error('nombre_transportista')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Apellido transportista</label>
            <input id="apellido_transportista" name="apellido_transportista" type="text" class="form-control" tabindex="2" value="{{old('apellido_transportista')}}">
            @error('apellido_transportista')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tipo vehiculo</label>
            <input id="tipo_vehiculo" name="tipo_vehiculo" type="text" class="form-control" tabindex="3" value="{{old('tipo_vehiculo')}}">
            @error('tipo_vehiculo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Valor viaje</label>
            <input id="valor_viaje" name="valor_viaje" type="number" class="form-control" tabindex="4" value="{{old('valor_viaje')}}">
            @error('valor_viaje')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Proveedor</label>
            <select class="form-control select" name="proveedor_rut" id="proveedor_rut" tabindex="5">
                @foreach ($proveedores as $proveedor)
                <option value={{$proveedor->rut}} {{ old('proveedor_rut')==$proveedor->rut ? 'selected' : ''  }}>{{$proveedor->nombre}}</option> 
                @endforeach  
            </select>
        </div>
        <a href={{route('admin_visualizar_especifico',$tabla)}} class="btn btn-secondary" tabindex="6">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
    
    @endif

    @if ($tabla == 'tornillos')
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" tabindex="1" value="{{old('nombre')}}">
            @error('nombre')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Descripcion</label>
            <input id="descripcion" name="descripcion" type="text" class="form-control" tabindex="2" value="{{old('descripcion')}}">
            @error('descripcion')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Cabeza</label>
            <input id="cabeza" name="cabeza" type="number" step="0.01" class="form-control" tabindex="3" value="{{old('cabeza')}}">
            @error('cabeza')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tipo rosca</label>
            <select class="form-control select" name="tipo_rosca" id="tipo_rosca" tabindex="4"> 
                <option value="total" {{ old('tipo_rosca')=="total" ? 'selected' : ''  }}>Total</option>  
                <option value="parcial" {{ old('tipo_rosca')=="parcial" ? 'selected' : ''  }}>Parcial</option> 
            </select>
        </div>  
        <div class="mb-3">
            <label for="" class="form-label">Separación rosca</label>
            <input id="separacion_rosca" name="separacion_rosca" type="number" step="0.01" class="form-control" tabindex="5" value="{{old('separacion_rosca')}}">
            @error('separacion_rosca')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Punta</label>
            <input id="punta" name="punta" type="text" class="form-control" tabindex="6" value="{{old('punta')}}">
            @error('punta')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Rosca parcial</label>
            <input id="rosca_parcial" name="rosca_parcial" type="number" step="0.01" class="form-control" tabindex="7" value="{{old('rosca_parcial')}}">
            @error('rosca_parcial')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Vastago</label>
            <input id="vastago" name="vastago" type="number" step="0.01" class="form-control" tabindex="8" value="{{old('vastago')}}">
            @error('vastago')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <a href={{route('admin_visualizar_especifico',$tabla)}} class="btn btn-secondary" tabindex="9">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="10">Guardar</button>
    
    @endif

    @if ($tabla == 'telefono_proveedores') 
        @php($proveedores=DB::table('proveedors')->get())
        <div class="mb-3">
            <label for="" class="form-label">Proveedor</label>
            <select class="form-control select" name="proveedor_rut" id="proveedor_rut" tabindex="1">
                @foreach ($proveedores as $proveedor)
                <option value={{$proveedor->rut}} {{ old('proveedor_rut')==$proveedor->rut ? 'selected' : ''  }}>{{$proveedor->nombre}}</option> 
                @endforeach  
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Telefono</label>
            <input id="telefono" name="telefono" type="tel" class="form-control" tabindex="2" pattern="\+569[0-9]{8}" title="El teléfono debe contener el prefijo '+569' y 8 dígitos." value="{{old('telefono')}}">
            @error('telefono')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <a href={{route('admin_visualizar_especifico',$tabla)}} class="btn btn-secondary" tabindex="3">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
    
    @endif

    @if ($tabla == 'techumbres')
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" tabindex="1" value="{{old('nombre')}}">
            @error('nomnbre')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Descripcion</label>
            <input id="descripcion" name="descripcion" type="text" class="form-control" tabindex="2" value="{{old('descripcion')}}">
            @error('descripcion')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Material</label>
            <input id="material" name="material" type="text" class="form-control" tabindex="3" value="{{old('material')}}">
            @error('material')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Alto</label>
            <input id="alto" name="alto" type="number" step="0.01" class="form-control" tabindex="4" value="{{old('alto')}}">
            @error('alto')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Ancho</label>
            <input id="ancho" name="ancho" type="number" step="0.01" class="form-control" tabindex="5" value="{{old('ancho')}}">
            @error('ancho')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Largo</label>
            <input id="largo" name="largo" type="number" step="0.01" class="form-control" tabindex="6" value="{{old('largo')}}">
            @error('largo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <a href={{route('admin_visualizar_especifico',$tabla)}} class="btn btn-secondary" tabindex="7">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="8">Guardar</button>
    
    @endif

    @if ($tabla == 'proveedores')
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" tabindex="1" value="{{old('nombre')}}">
            @error('nombre')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Rut</label>
            <input id="rut" name="rut" type="text" class="form-control" tabindex="2" value="{{old('rut')}}">
            @error('rut')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Razon social</label>
            <input id="razon_social" name="razon_social" type="text" class="form-control" tabindex="3" value="{{old('razon_social')}}">
            @error('razon_social')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Correo</label>
            <input id="correo" name="correo" type="email" class="form-control" tabindex="4" value="{{old('correo')}}">
            @error('correo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Ubicacion</label>
            <input id="ubicacion" name="ubicacion" type="text" class="form-control" tabindex="5" value="{{old('ubicacion')}}">
            @error('ubicacion')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
   
        <a href={{route('admin_visualizar_especifico',$tabla)}} class="btn btn-secondary" tabindex="6">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
    
    @endif

    @if ($tabla == 'productos')  
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" tabindex="1" value="{{old('nombre')}}">
            @error('nombre')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Descripcion</label>
            <input id="descripcion" name="descripcion" type="text" class="form-control" tabindex="2" value="{{old('descripcion')}}">
            @error('descripcion')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Familia</label>
            <select class="form-control select" name="familia" id="familia" tabindex="3">
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

        {{-- Tornillo --}}
        <div class="form-group tornillos_clavos">
            <label for="" class="form-label">Cabeza</label>
            <input id="cabeza" name="cabeza" type="number" step="0.01" class="form-control" tabindex="4" value="{{old('cabeza')}}">
            @error('cabeza')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group tornillos">
            <label for="" class="form-label">Tipo rosca</label>
            <select class="form-control select" name="tipo_rosca" id="tipo_rosca" tabindex="5"> 
                <option value="total" {{ old('tipo_rosca')=="total" ? 'selected' : ''  }}>Total</option>  
                <option value="parcial" {{ old('tipo_rosca')=="parcial" ? 'selected' : ''  }}>Parcial</option> 
            </select>
        </div>
        <div class="form-group tornillos">
            <label for="" class="form-label">Separación rosca</label>
            <input id="separacion_rosca" name="separacion_rosca" type="number" step="0.01" class="form-control" tabindex="6" value="{{old('separacion_rosca')}}">
            @error('separacion_rosca')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group tornillos_clavos">
            <label for="" class="form-label">Punta</label>
            <input id="punta" name="punta" type="text" class="form-control" tabindex="7" value="{{old('punta')}}">
            @error('punta')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group tornillos">
            <label for="" class="form-label">Rosca parcial</label>
            <input id="rosca_parcial" name="rosca_parcial" type="number" step="0.01" class="form-control" tabindex="8" value="{{old('rosca_parcial')}}">
            @error('rosca_parcial')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group tornillos">
            <label for="" class="form-label">Vastago</label>
            <input id="vastago" name="vastago" type="number" step="0.01" class="form-control" tabindex="9" value="{{old('vastago')}}">
            @error('vastago')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>

        {{-- Plancha construccion y Techumbre --}}
        <div class="form-group material">
            <label for="" class="form-label">Material</label>
            <input id="material" name="material" type="text" class="form-control" tabindex="10" value="{{old('material')}}">
            @error('material')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group medidas">
            <label for="" class="form-label">Alto</label>
            <input id="alto" name="alto" type="number" step="0.01" class="form-control" tabindex="11" value="{{old('alto')}}">
            @error('alto')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group medidas">
            <label for="" class="form-label">Ancho</label>
            <input id="ancho" name="ancho" type="number" step="0.01" class="form-control" tabindex="12" value="{{old('ancho')}}">
            @error('ancho')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group medidas">
            <label for="" class="form-label">Largo</label>
            <input id="largo" name="largo" type="number" step="0.01" class="form-control" tabindex="13" value="{{old('largo')}}">
            @error('largo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>

         {{-- Mueble --}}
         <div class="form-group muebles">
            <label for="" class="form-label">Acabado</label>
            <input id="acabado" name="acabado" type="text" class="form-control" tabindex="14" value="{{old('acabado')}}">
            @error('acabado')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>

        {{-- Madera --}}
        <div class="form-group maderas">
            <label for="" class="form-label">Tipo madera</label>
            <input id="tipo_madera" name="tipo_madera" type="text" class="form-control" tabindex="15" value="{{old('tipo_madera')}}">
            @error('tipo_madera')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group maderas">
            <label for="" class="form-label">Tratamiento</label>
            <input id="tratamiento" name="tratamiento" type="text" class="form-control" tabindex="16" value="{{old('tratamiento')}}">
            @error('tratamiento')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>

        {{-- Clavo --}}
        <div class="form-group clavos">
            <label for="" class="form-label">Longitud</label>
            <input id="longitud" name="longitud" type="number" step="0.01" class="form-control" tabindex="17" value="{{old('longitud')}}">
            @error('longitud')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <br>

        <a href={{route('admin_visualizar_especifico',$tabla)}} class="btn btn-secondary" tabindex="18">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="19">Guardar</button>
    
    @endif

    @if ($tabla == 'planchas_construccion')
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" tabindex="1" value="{{old('nombre')}}">
            @error('nombre')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Descripcion</label>
            <input id="descripcion" name="descripcion" type="text" class="form-control" tabindex="2" value="{{old('descripcion')}}">
            @error('descripcion')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Material</label>
            <input id="material" name="material" type="text" class="form-control" tabindex="3" value="{{old('material')}}">
            @error('material')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Alto</label>
            <input id="alto" name="alto" type="number" step="0.01" class="form-control" tabindex="4" value="{{old('alto')}}">
            @error('alto')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Ancho</label>
            <input id="ancho" name="ancho" type="number" step="0.01" class="form-control" tabindex="5" value="{{old('ancho')}}">
            @error('ancho')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Largo</label>
            <input id="largo" name="largo" type="number" step="0.01" class="form-control" tabindex="6" value="{{old('largo')}}">
            @error('largo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <a href={{route('admin_visualizar_especifico',$tabla)}} class="btn btn-secondary" tabindex="7">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="8">Guardar</button>
    
    @endif

    @if ($tabla == 'muebles')
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" tabindex="1" value="{{old('nombre')}}">
            @error('nombre')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Descripcion</label>
            <input id="descripcion" name="descripcion" type="text" class="form-control" tabindex="2" value="{{old('descripcion')}}">
            @error('descripcion')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Material</label>
            <input id="material" name="material" type="text" class="form-control" tabindex="3" value="{{old('material')}}">
            @error('material')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Acabado</label>
            <input id="acabado" name="acabado" type="text" class="form-control" tabindex="4" value="{{old('acabado')}}">
            @error('acabado')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Alto</label>
            <input id="alto" name="alto" type="number" step="0.01" class="form-control" tabindex="5" value="{{old('alto')}}">
            @error('alto')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Ancho</label>
            <input id="ancho" name="ancho" type="number" step="0.01" class="form-control" tabindex="6" value="{{old('ancho')}}">
            @error('ancho')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Largo</label>
            <input id="largo" name="largo" type="number" step="0.01" class="form-control" tabindex="7" value="{{old('largo')}}">
            @error('largo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <a href={{route('admin_visualizar_especifico',$tabla)}} class="btn btn-secondary" tabindex="8">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="9">Guardar</button>
    
    @endif

    @if ($tabla == 'maderas')
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" tabindex="1" value="{{old('nombre')}}">
            @error('nombre')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Descripcion</label>
            <input id="descripcion" name="descripcion" type="text" class="form-control" tabindex="2" value="{{old('descripcion')}}">
            @error('descripcion')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Alto</label>
            <input id="alto" name="alto" type="number" step="0.01" class="form-control" tabindex="3" value="{{old('alto')}}">
            @error('alto')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Ancho</label>
            <input id="ancho" name="ancho" type="number" step="0.01" class="form-control" tabindex="4" value="{{old('ancho')}}">
            @error('ancho')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Largo</label>
            <input id="largo" name="largo" type="number" step="0.01" class="form-control" tabindex="5" value="{{old('largo')}}">
            @error('largo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tipo madera</label>
            <input id="tipo_madera" name="tipo_madera" type="text" class="form-control" tabindex="6" value="{{old('tipo_madera')}}">
            @error('tipo_madera')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tratamiento</label>
            <input id="tratamiento" name="tratamiento" type="text" class="form-control" tabindex="7" value="{{old('tratamiento')}}">
            @error('tratamiento')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <a href={{route('admin_visualizar_especifico',$tabla)}} class="btn btn-secondary" tabindex="8">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="9">Guardar</button>
    
    @endif

    @if ($tabla == 'sucursal_producto')
        @php($sucursales=DB::table('inventarios')->get())
        @php($productos=DB::table('productos')->get())
        <div class="mb-3">
            <label for="" class="form-label">Sucursal</label>
            <select class="form-control select" name="sucursal_id" id="sucursal_id" tabindex="1">
                @foreach ($sucursales as $sucursal)
                <option value={{$sucursal->id}} {{ old('sucursal_id')==$sucursal->id ? 'selected' : ''  }}>{{$sucursal->direccion_sucursal}}</option> 
                @endforeach  
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Producto</label>
            <select class="form-control select" name="producto_id" id="producto_id" tabindex="2">
                @foreach ($productos as $producto)
                <option value={{$producto->id}} {{ old('producto_id')==$producto->id ? 'selected' : ''  }}>{{$producto->nombre}}</option> 
                @endforeach  
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Stock</label>
            <input id="stock" name="stock" type="number" class="form-control" tabindex="3" value="{{old('stock')}}">
            @error('stock')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Precio compra</label>
            <input id="precio_compra" name="precio_compra" type="number" class="form-control" tabindex="4" value="{{old('precio_compra')}}">
            @error('precio_compra')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <a href={{route('admin_visualizar_especifico',$tabla)}} class="btn btn-secondary" tabindex="5">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="6">Guardar</button>
    
    @endif

    @if ($tabla == 'inventarios')
        <div class="mb-3">
            <label for="" class="form-label">Direccion sucursal</label>
            <input id="direccion_sucursal" name="direccion_sucursal" type="text" class="form-control" tabindex="1" value="{{old('direccion_sucursal')}}">
            @error('direccion_sucursal')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <a href={{route('admin_visualizar_especifico',$tabla)}} class="btn btn-secondary" tabindex="2">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="3">Guardar</button>
    
    @endif

    @if ($tabla == 'fotos')
        <div class="mb-3">
            <label for="" class="form-label">Url</label>
            <input id="url" name="url" type="text" class="form-control" tabindex="1" value="{{old('url')}}">
            @error('url')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">ID imagenable</label>
            <input id="imagenable_id" name="imagenable_id" type="number" class="form-control" tabindex="2" value="{{old('imagenable_id')}}">
            @error('imagenable_id')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tipo imanegenable</label>
            <input id="imagenable_tipo" name="imagenable_tipo" type="text" class="form-control" tabindex="3" value="{{old('imagenable_tipo')}}">
            @error('tipo_imagenable')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <a href={{route('admin_visualizar_especifico',$tabla)}} class="btn btn-secondary" tabindex="4">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="5">Guardar</button>
    
    @endif

    @if ($tabla == 'ejecutivos')
        @php($proveedores=DB::table('proveedors')->get())
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" tabindex="1" value="{{old('nombre')}}">
            @error('nombre')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Apellido</label>
            <input id="apellido" name="apellido" type="text" class="form-control" tabindex="2" value="{{old('apellido')}}">
            @error('apellido')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Correo</label>
            <input id="correo" name="correo" type="email" class="form-control" tabindex="3" value="{{old('correo')}}">
            @error('correo')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Telefono</label>
            <input id="telefono" name="telefono" type="tel" class="form-control" pattern="\+569[0-9]{8}" title="El teléfono debe contener el prefijo '+569' y 8 dígitos." tabindex="4" value="{{old('telefono')}}">
            @error('telefono')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Proveedor</label>
            <select class="form-control select" name="proveedor_rut" id="proveedor_rut" tabindex="5">
                @foreach ($proveedores as $proveedor)
                    <option value={{$proveedor->rut}} {{ old('proveedor_rut')==$proveedor->rut ? 'selected' : ''  }}>{{$proveedor->nombre}}</option> 
                @endforeach  
            </select>
        </div>
        <a href={{route('admin_visualizar_especifico',$tabla)}} class="btn btn-secondary" tabindex="6">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
    
    @endif

    @if ($tabla == 'compras')
        @php($clientes=DB::table('clientes')->get())
        @php($productos=DB::table('productos')->get())
        <div class="mb-3">
            <label for="" class="form-label">Cantidad</label>
            <input id="cantidad" name="cantidad" type="number" class="form-control" tabindex="1" value="{{old('cantidad')}}">
            @error('cantidad')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Rut cliente</label>
            <select class="form-control select" name="rut" id="rut" tabindex="2">
                @foreach ($clientes as $cliente)
                    <option value={{$cliente->usuario_rut}} {{ old('rut')==$cliente->usuario_rut ? 'selected' : ''  }}>{{$cliente->usuario_rut}}</option> 
                @endforeach  
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Producto</label>
            <select class="form-control select" name="producto_id" id="producto_id" tabindex="3">
                @foreach ($productos as $producto)
                    <option value={{$producto->id}} {{ old('producto_id')==$producto->id ? 'selected' : ''  }}>{{$producto->nombre}}</option> 
                @endforeach  
            </select>
        </div>
        <a href={{route('admin_visualizar_especifico',$tabla)}} class="btn btn-secondary" tabindex="4">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="5">Guardar</button>
    
    @endif

    @if ($tabla == 'clavos')
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" tabindex="1" value="{{old('nombre')}}">
            @error('nombre')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Descripcion</label>
            <input id="descripcion" name="descripcion" type="text" class="form-control" tabindex="2" value="{{old('descripcion')}}">
            @error('descripcion')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Material</label>
            <input id="material" name="material" type="text" class="form-control" tabindex="3" value="{{old('material')}}">
            @error('material')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Cabeza</label>
            <input id="cabeza" name="cabeza" type="number" step="0.01" class="form-control" tabindex="4" value="{{old('cabeza')}}">
            @error('cabeza')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Punta</label>
            <input id="punta" name="punta" type="text" class="form-control" tabindex="5" value="{{old('punta')}}">
            @error('punta')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Longitud</label>
            <input id="longitud" name="longitud" type="number" step="0.01" class="form-control" tabindex="6" value="{{old('longitud')}}">
            @error('longitud')
                <small style="color:red;">*{{$message}}</small>
            @enderror
        </div>
        <a href={{route('admin_visualizar_especifico',$tabla)}} class="btn btn-secondary" tabindex="7">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="8">Guardar</button>
    
    @endif
    
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

       if (selectedBalue == "Plancha_construccion" || selectedBalue == "Techumbre" || selectedBalue == "Mueble" || selectedBalue == "Clavo") 
       {
         $(".material").slideDown(200);
       }
       else{
         $(".material").slideUp(200);
       }

       if (selectedBalue == "Tornillo" || selectedBalue == "Clavo") 
       {
           $(".tornillos_clavos").slideDown(200); 
       }
       else{
           $(".tornillos_clavos").slideUp(200);
       }

       if (selectedBalue == "Plancha_construccion" || selectedBalue == "Techumbre" || selectedBalue == "Mueble" || selectedBalue == "Madera") 
       {
         $(".medidas").slideDown(200);   
       }
       else{
         $(".medidas").slideUp(200);
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


    }); 


    }
     
    );
</script> 
<script type="text/javascript">
    function mostrarPassword(){
            var cambio = document.getElementById("password");
            if(cambio.type == "password"){
                cambio.type = "text";
                $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            }else{
                cambio.type = "password";
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        } 
        
        $(document).ready(function () {
        //CheckBox mostrar contraseña
        $('#ShowPassword').click(function () {
            $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
        });
    });
</script>    
@endsection