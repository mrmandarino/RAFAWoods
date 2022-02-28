@extends('admin.master_bd')
@section('content')
@include('inventario.partials.iconos')

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
        /* Styles for Opera Style datalist */
        .options-opera-shadowdom .different-label-value span {
            width: 49%;
            overflow: hidden;
        }
                            
        .options-opera-shadowdom .different-label-value .option-value {
            display: inline-block;
        }

    </style>
    
    <div class="container">

        <div class="row justify-content-center mt-3">
    
            {{-- columna principal --}}
            <div class="col-6 card p-3 bg-light mt-3">
                {{-- titulo --}}
                <div class="row mx-3 justify-content-center">
                    <div class="col-md-7 card form-izq ml-3">
                        <h4 class="text-center">
                            <svg class="bi me-2" width="20" height="20">
                                <use xlink:href="#server" />
                            </svg>
                            Crear registro
                        </h4>
                    </div>
                </div>
    
                <div class="row justify-content-evenly mt-3 mx-auto">
    
                    <div class="col-12">
    
    
                        <div class="row justify-content-center">
    
                            <div class="col-12">
                                <div class="row">
    
                                    <svg class="bi me-2" width="40" height="40">
                                        <use xlink:href="#edicion" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="div">
    
                    <form action={{route('admin_guardar_datos',$tabla)}} method="POST" enctype="multipart/form-data">
                        @csrf
                        @if ($tabla == 'usuarios') 
                            @php($sucursales=DB::table('inventarios')->get())
                            <div class="mb-3">
                                <label for="" class="form-label">Rut</label>
                                <input id="rut" name="rut" type="text" class="form-control" tabindex="1" value="{{old('rut')}}">
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
                                    <input id="password" name="password" type="password" class="form-control" tabindex="4" value="{{old('password')}}">
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
                            <div class="form-group trabajadores mb-3">
                                <label for="" class="form-label">Tipo trabajador</label>
                                <select class="form-control select" name="tipo_trabajador" id="tipo_trabajador" tabindex="7">
                                    <option value=1 {{ old('tipo_trabajador')==1 ? 'selected' : ''  }}>Ejecutivo</option>  
                                    <option value=2 {{ old('tipo_trabajador')==2 ? 'selected' : ''  }}>Vendedor</option>  
                                </select>
                            </div>
                    
                            <div class="form-group trabajadores mb-3">
                                <label for="" class="form-label">Sucursal</label>
                                <select class="form-control select" name="sucursal_id" id="sucursal_id" tabindex="8">
                                    @foreach ($sucursales as $sucursal)
                                    <option value={{$sucursal->id}} {{ old('sucursal_id')==$sucursal->id ? 'selected' : ''  }}>{{$sucursal->direccion_sucursal}}</option> 
                                    @endforeach  
                                </select>
                            </div>
                    
                            {{-- Cliente --}}
                            <div class="form-group clientes mb-3">
                                <label for="" class="form-label">Telefono(Opcional)</label>
                                <input id="telefono" name="telefono" type="tel" class="form-control" tabindex="9" pattern="\+569[0-9]{8}" title="El teléfono debe contener el prefijo '+569' y 8 dígitos." value="{{old('telefono')}}">
                                @error('telefono')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div> 
                            
                        @elseif($tabla == 'clientes')
                            <div class="mb-3">
                                <label for="" class="form-label">Rut</label>
                                <input id="rut" name="rut" type="text" class="form-control" tabindex="1" value="{{old('rut')}}">
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
                                <input id="nombre" name="nombre" type="text" class="form-control" tabindex="3" value="{{old('nombre')}}">
                                @error('nombre')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Apellido</label>
                                <input id="apellido" name="apellido" type="text" class="form-control" tabindex="4" value="{{old('apellido')}}">
                                @error('apellido')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Password</label>
                                <div class="input-group">
                                    <input id="password" name="password" type="password" class="form-control" tabindex="5">
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
                                <input id="correo" name="correo" type="email" class="form-control" tabindex="6" value="{{old('correo')}}">
                                @error('correo')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Telefono(Opcional)</label>
                                <input id="telefono" name="telefono" type="tel" class="form-control" pattern="\+569[0-9]{8}" title="El teléfono debe contener el prefijo '+569' y 8 dígitos." tabindex="7" value="{{old('telefono')}}">
                                @error('telefono')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                            
                        @elseif($tabla == 'trabajadores')
                            @php($sucursales=DB::table('inventarios')->get())
                    
                            <div class="mb-3">
                                <label for="" class="form-label">Rut</label>
                                <input id="rut" name="rut" type="text" class="form-control" tabindex="1" value="{{old('rut')}}">
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
                                <input id="nombre" name="nombre" type="text" class="form-control" tabindex="3" value="{{old('nombre')}}">
                                @error('nombre')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Apellido</label>
                                <input id="apellido" name="apellido" type="text" class="form-control" tabindex="4" value="{{old('apellido')}}">
                                @error('apellido')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Password</label>
                                <div class="input-group">
                                    <input id="password" name="password" type="password" class="form-control" tabindex="5">
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
                                <input id="correo" name="correo" type="email" class="form-control" tabindex="6" value="{{old('correo')}}">
                                @error('correo')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                    
                            <div class="mb-3">
                                <label for="" class="form-label">Tipo trabajador</label>
                                <select class="form-control select" name="tipo_trabajador" id="tipo_trabajador" tabindex="7"> 
                                    <option value=1 {{ old('tipo_trabajador')==1 ? 'selected' : ''  }}>Ejecutivo</option>  
                                    <option value=2 {{ old('tipo_trabajador')==2 ? 'selected' : ''  }}>Vendedor</option>  
                                </select>
                            </div>
                    
                            <div class="mb-3">
                                <label for="" class="form-label">Sucursal</label>
                                <select class="form-control select" name="sucursal_id" id="sucursal_id" tabindex="8">
                                    @foreach ($sucursales as $sucursal)
                                    <option value={{$sucursal->id}}>{{$sucursal->direccion_sucursal}}</option> 
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
                                    <option value={{$sucursal->id}} {{ old('sucursal_id')==$sucursal->id ? 'selected' : ''  }}>{{$sucursal->direccion_sucursal}}</option> 
                                    @endforeach 
                                </select>
                            </div>
                    
                            <div class="mb-3">
                                <label for="" class="form-label">Proveedor</label>
                                <select class="form-control select" name="proveedor_rut" id="proveedor_rut" tabindex="2">
                                    @foreach ($proveedores as $proveedor)
                                    <option value={{$proveedor->rut}} {{ old('proveedor_rut')==$proveedor->rut ? 'selected' : ''  }}>{{$proveedor->razon_social}}</option>  {{-- ojo con el old --}}
                                    @endforeach  
                                </select>
                                @error('proveedor_rut')
                                <small style="color:red;">*No se encontraron proveedores. Debe existir al menos un proveedor en la base de datos antes de registrar la orden de compra.</small>
                                @enderror
                            </div>
                    
                        @elseif($tabla == 'detalle_compras')
                            @php($ordenes=DB::table('orden_compras')->get())
                            @php($productos=DB::table('productos')->get())
                    
                            <label for="" class="form-label">ID Orden de compra</label>
                            <div class="input-group" >
                                <input class="form-control select" list="datalist_orden" name="oc_id" id="oc_id" tabindex="1" value="{{old('oc_id')}}"  >
                                <datalist id="datalist_orden" >
                                <select>
                                    @foreach ($ordenes as $orden)
                                        <option value={{$orden->id}} {{ old('oc_id')==$orden->id ? 'selected' : ''  }}>{{$orden->id}}</option> 
                                    @endforeach  
                                </select>
                                </datalist>
                                <input id="existe_orden" name="existe_orden" type="hidden" class="form-control" tabindex="2" value="no">
                            </div>
                            <div>
                                @error('existe_orden')
                                <small style="color:red;">*El ID de la orden de compra ingresada no existe.</small>
                                @enderror
                                @error('oc_id')
                                <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                                
                            <label for="" class="form-label">Producto</label>
                            <div class="input-group" >
                                <input class="form-control select" list="datalist_productos" name="producto_id" id="producto_id" tabindex="3" value="{{old('producto_id')}}" >
                                <datalist id="datalist_productos" >
                                    <select>
                                        @foreach ($productos as $producto)
                                            <option value={{$producto->id}} {{ old('producto_id')==$producto->id ? 'selected' : ''  }}>{{$producto->nombre}}</option> 
                                        @endforeach 
                                    </select> 
                                </datalist>
                                <input id="existe_producto" name="existe_producto" type="hidden" class="form-control" tabindex="4" value="no">
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
                                <label for="" class="form-label">Nivel de calidad</label>
                                <select class="form-control select" name="nivel_calidad" id="nivel_calidad" tabindex="5">
                                    <option value=1 {{ old('nivel_calidad')==1? 'selected' : ''  }}>Bajo</option>  
                                    <option value=2 {{ old('nivel_calidad')==2? 'selected' : ''  }}>Aceptable</option>  
                                    <option value=3 {{ old('nivel_calidad')==3? 'selected' : ''  }}>Medio</option>  
                                    <option value=4 {{ old('nivel_calidad')==4? 'selected' : ''  }}>Bueno</option>  
                                    <option value=5 {{ old('nivel_calidad')==5? 'selected' : ''  }}>Excelente</option>  
                                </select>
                                @error('nivel_calidad')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                    
                            <div class="mb-3">
                                <label for="" class="form-label">Cantidad</label>
                                <input id="cantidad" name="cantidad" type="number" class="form-control" tabindex="6" value="{{old('cantidad')}}">
                                @error('cantidad')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                    
                            <div class="mb-3">
                                <label for="" class="form-label">Precio unitario</label>
                                <input id="precio_unitario" name="precio_unitario" type="number" class="form-control" tabindex="7" value="{{old('precio_unitario')}}">
                                @error('precio_unitario')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                    
                        @elseif($tabla == 'transportes')
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
                                    <option value={{$proveedor->rut}} {{ old('proveedor_rut')==$proveedor->rut ? 'selected' : ''  }}>{{$proveedor->razon_social}}</option> 
                                    @endforeach  
                                </select>
                            </div>
                    
                        @elseif($tabla == 'tornillos')
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
                    
                        @elseif($tabla == 'telefono_proveedores') 
                            @php($proveedores=DB::table('proveedors')->get())
                            <div class="mb-3">
                                <label for="" class="form-label">Proveedor</label>
                                <select class="form-control select" name="proveedor_rut" id="proveedor_rut" tabindex="1">
                                    @foreach ($proveedores as $proveedor)
                                    <option value={{$proveedor->rut}} {{ old('proveedor_rut')==$proveedor->rut ? 'selected' : ''  }}>{{$proveedor->razon_social}}</option> 
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
                    
                        @elseif($tabla == 'techumbres')
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
                    
                        @elseif($tabla == 'proveedores')
                            <div class="mb-3">
                                <label for="" class="form-label">Rut</label>
                                <input id="rut" name="rut" type="text" class="form-control" tabindex="1" value="{{old('rut')}}">
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
                    
                        @elseif($tabla == 'productos')  
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
                                    <option value="Herramienta">Herramienta</option>  
                                    <option value="Otro">Otro</option>  
                                </select>
                                @error('familia')
                                    <small style="color:red;">*Debes escoger una familia para continuar</small>
                                @enderror
                            </div>
                            
                            {{-- Tornillo --}}
                            <div class="form-group tornillos_clavos mb-3">
                                <label for="" class="form-label">Cabeza</label>
                                <input id="cabeza" name="cabeza" type="number" step="0.01" class="form-control" tabindex="4" value="{{old('cabeza')}}">
                                @error('cabeza')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group tornillos mb-3">
                                <label for="" class="form-label">Tipo rosca</label>
                                <select class="form-control select" name="tipo_rosca" id="tipo_rosca" tabindex="5"> 
                                    <option value="total" {{ old('tipo_rosca')=="total" ? 'selected' : ''  }}>Total</option>  
                                    <option value="parcial" {{ old('tipo_rosca')=="parcial" ? 'selected' : ''  }}>Parcial</option> 
                                </select>
                            </div>
                            <div class="form-group tornillos mb-3">
                                <label for="" class="form-label">Separación rosca</label>
                                <input id="separacion_rosca" name="separacion_rosca" type="number" step="0.01" class="form-control" tabindex="6" value="{{old('separacion_rosca')}}">
                                @error('separacion_rosca')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group tornillos_clavos mb-3">
                                <label for="" class="form-label">Punta</label>
                                <input id="punta" name="punta" type="text" class="form-control" tabindex="7" value="{{old('punta')}}">
                                @error('punta')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group tornillos mb-3">
                                <label for="" class="form-label">Rosca parcial</label>
                                <input id="rosca_parcial" name="rosca_parcial" type="number" step="0.01" class="form-control" tabindex="8" value="{{old('rosca_parcial')}}">
                                @error('rosca_parcial')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group tornillos mb-3">
                                <label for="" class="form-label">Vastago</label>
                                <input id="vastago" name="vastago" type="number" step="0.01" class="form-control" tabindex="9" value="{{old('vastago')}}">
                                @error('vastago')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                    
                            {{-- Plancha construccion y Techumbre --}}
                            <div class="form-group material mb-3">
                                <label for="" class="form-label">Material</label>
                                <input id="material" name="material" type="text" class="form-control" tabindex="10" value="{{old('material')}}">
                                @error('material')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group medidas mb-3">
                                <label for="" class="form-label">Alto</label>
                                <input id="alto" name="alto" type="number" step="0.01" class="form-control" tabindex="11" value="{{old('alto')}}">
                                @error('alto')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group medidas mb-3">
                                <label for="" class="form-label">Ancho</label>
                                <input id="ancho" name="ancho" type="number" step="0.01" class="form-control" tabindex="12" value="{{old('ancho')}}">
                                @error('ancho')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group medidas mb-3">
                                <label for="" class="form-label">Largo</label>
                                <input id="largo" name="largo" type="number" step="0.01" class="form-control" tabindex="13" value="{{old('largo')}}">
                                @error('largo')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                    
                             {{-- Mueble --}}
                             <div class="form-group muebles mb-3">
                                <label for="" class="form-label">Acabado</label>
                                <input id="acabado" name="acabado" type="text" class="form-control" tabindex="14" value="{{old('acabado')}}">
                                @error('acabado')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                    
                            {{-- Madera --}}
                            <div class="form-group maderas mb-3">
                                <label for="" class="form-label">Tipo madera</label>
                                <input id="tipo_madera" name="tipo_madera" type="text" class="form-control" tabindex="15" value="{{old('tipo_madera')}}">
                                @error('tipo_madera')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group maderas mb-3">
                                <label for="" class="form-label">Tratamiento</label>
                                <input id="tratamiento" name="tratamiento" type="text" class="form-control" tabindex="16" value="{{old('tratamiento')}}">
                                @error('tratamiento')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                    
                            {{-- Clavo --}}
                            <div class="form-group clavos mb-3">
                                <label for="" class="form-label">Longitud</label>
                                <input id="longitud" name="longitud" type="number" step="0.01" class="form-control" tabindex="17" value="{{old('longitud')}}">
                                @error('longitud')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                    
                        @elseif($tabla == 'planchas_construccion')
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
                    
                        @elseif($tabla == 'muebles')
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
                    
                        @elseif($tabla == 'maderas')
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
                                <input id="alto" name="alto" type="number" class="form-control" tabindex="3" value="{{old('alto')}}">
                                @error('alto')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Ancho</label>
                                <input id="ancho" name="ancho" type="number" class="form-control" tabindex="4" value="{{old('ancho')}}">
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
                    
                        @elseif($tabla == 'sucursal_producto')
                            @php($sucursales=DB::table('inventarios')->get())
                            @php($productos=DB::table('productos')->get())
                            <div class="mb-3">
                                <label for="" class="form-label">Sucursal</label>
                                <select class="form-control select" name="sucursal_id" id="sucursal_id" tabindex="1">
                                    @foreach ($sucursales as $sucursal)
                                    <option value={{$sucursal->id}} {{ old('sucursal_id')==$sucursal->id ? 'selected' : ''  }}>{{$sucursal->direccion_sucursal}}</option> 
                                    @endforeach  
                                </select>
                                @error('sucursal_id')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                            <label for="" class="form-label">Producto</label>
                            <div class="input-group" >
                                <input class="form-control select" list="datalist_productos" name="producto_id" id="producto_id" tabindex="2" value="{{old('producto_id')}}">
                                <datalist id="datalist_productos" >
                                    <select>
                                        @foreach ($productos as $producto)
                                            <option value={{$producto->id}} {{ old('producto_id')==$producto->id ? 'selected' : ''  }}>{{$producto->nombre}}</option> 
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
                                <input id="stock" name="stock" type="number" class="form-control" tabindex="4" value="{{old('stock')}}">
                                @error('stock')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Precio compra</label>
                                <input id="precio_compra" name="precio_compra" type="number" class="form-control" tabindex="5" value="{{old('precio_compra')}}">
                                @error('precio_compra')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                    
                        @elseif($tabla == 'inventarios')
                            <div class="mb-3">
                                <label for="" class="form-label">Direccion sucursal</label>
                                <input id="direccion_sucursal" name="direccion_sucursal" type="text" class="form-control" tabindex="1" value="{{old('direccion_sucursal')}}">
                                @error('direccion_sucursal')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                        
                        @elseif($tabla == 'fotos')
                            @php($productos=DB::table('productos')->get())
                            <div class="mb-3">
                                <label for="" class="form-label">Url</label>
                    
                                <input id="url" name="url" type="file" class="form-control" tabindex="1" accept="image/*">
                    
                                @error('url')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                                <input id="existe_imagen" name="existe_imagen" type="hidden" class="form-control" tabindex="3" value="no">
                                @error('existe_imagen')
                                    <small style="color:red;">*Ya existe una imagen con ese nombre en la base de datos.</small>
                                @enderror
                            </div>
                            
                            <label for="" class="form-label">ID imagenable</label>
                            <div class="input-group" >
                                <input class="form-control select" list="datalist_productos" id="imagenable_id" name="imagenable_id" type="number" tabindex="2" value="{{old('imagenable_id')}}" >
                                <datalist id="datalist_productos" >
                                    <select>
                                        @foreach ($productos as $producto)
                                            <option value={{$producto->id}} {{ old('producto_id')==$producto->id ? 'selected' : ''  }}>{{$producto->nombre}}</option> 
                                        @endforeach 
                                    </select> 
                                </datalist>
                                <input id="existe_producto" name="existe_producto" type="hidden" class="form-control" tabindex="3" value="no">
                            </div>
                            <div>
                                @error('existe_producto')
                                <small style="color:red;">*El ID del producto ingresado no existe.</small>
                                @enderror
                                @error('imagenable_id')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                    
                            {{-- <div class="mb-3">
                                <label for="" class="form-label">Tipo imanegenable</label>
                                <input id="imagenable_tipo" name="imagenable_tipo" type="text" class="form-control" tabindex="3" value="{{old('imagenable_tipo')}}">
                                @error('tipo_imagenable')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div> --}}
                    
                        @elseif($tabla == 'ejecutivos')
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
                                        <option value={{$proveedor->rut}} {{ old('proveedor_rut')==$proveedor->rut ? 'selected' : ''  }}>{{$proveedor->razon_social}}</option> 
                                    @endforeach  
                                </select>
                            </div>
                    
                        @elseif($tabla == 'clavos')
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
                    
                        @elseif($tabla == 'ventas')
                            @php($clientes=DB::table('clientes')->get())
                            @php($sucursales=DB::table('inventarios')->get())
                            @php($vendedores=DB::table('trabajadors')->where('tipo_trabajador',2)->get())
                    
                            <div class="mb-3">
                                <label for="" class="form-label">ID Sucursal</label>
                                <select class="form-control select" name="sucursal_id" id="sucursal_id" tabindex="1">
                                    @foreach ($sucursales as $sucursal)
                                        <option value={{$sucursal->id}} {{ old('sucursal_id')==$sucursal->id ? 'selected' : ''  }}>{{$sucursal->id}}</option> 
                                    @endforeach  
                                </select>
                            </div>
                    
                            <div class="mb-3">
                                <label for="" class="form-label">Rut vendedor</label>
                                <select class="form-control select" name="vendedor_rut" id="vendedor_rut" tabindex="2">
                                    @foreach ($vendedores as $vendedor)
                                        <option value={{$vendedor->usuario_rut}} {{ old('vendedor_rut')==$vendedor->usuario_rut? 'selected' : ''  }}>{{$vendedor->usuario_rut}}</option> 
                                    @endforeach  
                                </select>
                            </div>
                    
                            <label for="" class="form-label">Rut cliente</label>
                            <div class="input-group" >
                                <input class="form-control select" list="datalist_productos" name="cliente_rut" id="cliente_rut" tabindex="3" value="{{old('cliente_rut')}}">
                                <datalist id="datalist_productos" >
                                    <select>
                                        @foreach ($clientes as $cliente)
                                        <option value={{$cliente->usuario_rut}} {{ old('cliente_rut')==$cliente->usuario_rut ? 'selected' : ''  }}>{{$cliente->usuario_rut}}</option> 
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
                                    <option value=1 {{ old('medio_de_pago')==1? 'selected' : ''  }}>Efectivo</option>  
                                    <option value=2 {{ old('medio_de_pago')==2? 'selected' : ''  }}>Tarjeta de débito</option>  
                                    <option value=3 {{ old('medio_de_pago')==3? 'selected' : ''  }}>Tarjeta de crédito</option>  
                                    <option value=4 {{ old('medio_de_pago')==4? 'selected' : ''  }}>Transferencia</option>  
                                </select>
                                @error('medio_de_pago')
                                    <small style="color:red;">{{$message}}</small>
                                @enderror
                            </div>
                    
                            <div class="mb-3">
                                <label for="" class="form-label">¿Compra con factura?</label>
                                <select class="form-control select" name="con_factura" id="con_factura" tabindex="6">
                                    <option value=0 {{ old('con_factura')==0? 'selected' : ''  }}>No</option>  
                                    <option value=1 {{ old('con_factura')==1? 'selected' : ''  }}>Si</option>  
                                </select>
                                @error('con_factura')
                                    <small style="color:red;">{{$message}}</small>
                                @enderror
                            </div>
                    
                        @elseif($tabla == 'detalle_ventas')
                            @php($ventas=DB::table('ventas')->get())
                            @php($productos=DB::table('productos')->get())
                    
                            <div class="mb-3">
                                <label for="" class="form-label">ID Venta</label>
                                <select class="form-control select" name="venta_id" id="venta_id" tabindex="1">
                                    @foreach ($ventas as $venta)
                                        <option value={{$venta->id}} {{ old('venta_id')==$venta->id ? 'selected' : ''  }}>{{$venta->id}}</option> 
                                    @endforeach  
                                </select>
                                @error('venta_id')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                            </div>
                    
                            <label for="" class="form-label">Producto</label>
                            <div class="input-group" >
                                <input class="form-control select" list="datalist_productos" name="producto_id" id="producto_id" tabindex="2" value="{{old('producto_id')}}">
                                <datalist id="datalist_productos" >
                                    <select>
                                        @foreach ($productos as $producto)
                                            <option value={{$producto->id}} {{ old('producto_id')==$producto->id ? 'selected' : ''  }}>{{$producto->nombre}}</option> 
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
                                <input id="cantidad" name="cantidad" type="number" class="form-control" tabindex="4" value="{{old('cantidad')}}">
                                @error('cantidad')
                                    <small style="color:red;">*{{$message}}</small>
                                @enderror
                                <input id="supera_stock" name="supera_stock" type="hidden" class="form-control" tabindex="5" value="si">
                                @error('supera_stock')
                                    <small style="color:red;">*No puedes superar el stock de este producto en el inventario.</small>
                                @enderror
                            </div>
                    
                        @endif
                    
                        <a href={{route('admin_visualizar_especifico',$tabla)}} class="btn btn-secondary row justify-content-center text-center mt-3 col-5" style="margin-left: 2px " tabindex="20">Cancelar</a>
                        <button type="submit" class="btn btn-primary row justify-content-center text-center mt-3 col-5" style="margin-left: 110px " tabindex="21">Guardar</button>

                    </form>
    
                </div>
            </div>
        </div>
    </div>


 
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