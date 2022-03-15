@extends('inventario.master_inv')
@section('content')
@include('inventario.partials.iconos')

<style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
    .img-size{
    /* 	padding: 0;
      margin: 0; */
      height: 450px;
      width: 700px;
      background-size: cover;
      overflow: hidden;
    }
    .modal-content {
      width: 700px;
      border:none;
    }
    .modal-body {
      padding: 0;
    }

    .carousel-control-prev-icon {
      background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23009be1' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
      width: 30px;
      height: 48px;
    }
    .carousel-control-next-icon {
      background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23009be1' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
      width: 30px;
      height: 48px;
    }

    .ajustarderecho {  
    position: absolute;  
      top: 20%;
      bottom: 80%;
      left: 85%;
      right: 50%;
    }

    .ajustarizquierdo {  
      position: absolute;  
      top: 20%;
      bottom: 80%;
      left: 0%;
      right: 0%;
    }
    
    .ajustaranteprimas{
      position: absolute;  
      opacity: 0.2;
    }

    .tabla-h-scroll {
            height: 750px !important;
            overflow: auto;
        }

    .margen {
    margin: 20px 20px 20px 20px;
    }
  </style>


<div class="container-fluid" style="overflow: auto">
    <div class="container">
        <div class="row justify-content-center mt-3 botones">
        

            <div class="row justify-content-center">
                
                <div class="col-8 card p-3 bg-light mt-3 col-form-izq">
    
                    <div class="row mx-3 justify-content-center">
                        <div class="col-md-10 card form-izq ml-3">
                            <h4 class="text-center">
                                <svg class="bi me-2" width="20" height="20">
                                    <use xlink:href="#administrar_producto" />
                                </svg>
                                Administrar: {{ $producto_en_bruto->nombre }}
                            </h4>
                        </div>
                    </div>
    
                    <div class="container">
    
                        <div class="row justify-content-center mt-3">
                
                            {{-- columna principal --}}
                            <div class="col-11 p-4 bg-light mt-6">
                                <div class="div">
                                    <!-- Carousel -->
                                    <div id='carouselExampleIndicators' class='carousel slide' data-bs-ride='carousel'>
                                        <ol class='carousel-indicators '>
                                        @for ($j = 0;$j<$contador_aux;$j++)
                                        @if($j<=0)
                                            <li
                                            data-bs-target='#carouselExampleIndicators '
                                            data-bs-slide-to= {{$j}}
                                            class='active'
                                            ></li>
                                        @else
                                        <li
                                            data-bs-target='#carouselExampleIndicators'
                                            data-bs-slide-to= {{$j}}
                                            ></li>
                                        @endif
                                        @endfor
                                        </ol>
                                            
                                        {{-- Imagenes --}}
                                        <div class='carousel-inner'>
                                            
                                        @if ($contador_aux <= 0)
                                        <div class='carousel-item active'>
                                            <img class='img-size' src="{{ asset('images\imagen_no_disponible.png') }}" alt='First slide' style="height:100%;width:100%"/>
                                        </div>
                                        @else
                                        @php
                                           $contador_imgs = 0;
                                        @endphp
                                        @foreach ($imagenes as $imagen)
                                        @if($contador_imgs <= 0)
                                        @php
                                            $contador_imgs++;
                                        @endphp
                                        <div class='carousel-item active'>
                                            <img class='img-size' src="{{ asset($imagen->url) }}" alt='First slide' style="height:100%;width:100%" />
                                        </div>
                                        @else
                                        <div class='carousel-item'>
                                            <img class='img-size' src="{{ asset($imagen->url) }}" alt='Second slide' style="height:100%;width:100%"/>
                                        </div>
                                        @endif
                                        @endforeach
    
                                        @endif
                                        </div>
                                            
                                        @if ($contador_aux >= 2)   
                                        <a
                                        class='carousel-control-prev'
                                        href='#carouselExampleIndicators'
                                        role='button'
                                        data-bs-slide='prev'
                                        >
                                        <span class='carousel-control-prev-icon'
                                                aria-hidden='true'
                                                ></span>
                                        <span class='sr-only'></span>
                                        </a>
                                        <a
                                        class='carousel-control-next'
                                        href='#carouselExampleIndicators'
                                        role='button'
                                        data-bs-slide='next'
                                        >
                                        <span
                                                class='carousel-control-next-icon'
                                                aria-hidden='true'
                                                ></span>
                                        <span class='sr-only'></span>
                                        </a>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
    
                    <div class="row mx-3 mt-3 justify-content-center">
                        <div class="col-md-10 card form-izq ml-3">
                            <h6 class="text-left">
                                <svg class="bi me-2" width="15" height="15">
                                    <use xlink:href="#descripcion" />
                                </svg>
                                Descripción:
                            </h6>
                            <p>{{ $producto_en_bruto->descripcion }}</p>
    
                        </div>
                    </div>
    
                    <div class="row justify-content-evenly mt-3 mx-auto">
                        
                        <div class="col-12">
                            <div class="row">
    
                                @if (session()->has('estado_cambiado'))
                                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                        {{ session()->get('estado_cambiado') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div><br>
                                @endif
                                @if (session()->has('stock_actualizado'))
                                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                        {{ session()->get('stock_actualizado') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div><br>
                                @endif
                                @if (session()->has('precio_actualizado'))
                                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                        {{ session()->get('precio_actualizado') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div><br>
                                @endif
                                @if (session()->has('producto_actualizado'))
                                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                        {{ session()->get('producto_actualizado') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div><br>
                                @endif
                                @if (session()->has('imagen_subida'))
                                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                        {{ session()->get('imagen_subida') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div><br>
                                @endif
                                @if (session()->has('imagen_eliminada'))
                                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                        {{ session()->get('imagen_eliminada') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div><br>
                                @endif
                                {{-- Mensaje validacion de stock --}}
                                @error('stock')
                                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                        Ha ocurrido un error al actualizar el stock
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div><br>
                                @enderror
                                {{-- Mensaje validacion de precio producto --}}
                                @error('utilidad')
                                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                    Ha ocurrido un error al actualizar el precio del producto
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div><br>
                                @enderror
    
                                {{-- Mensaje validacion edicion producto --}}
                                @if($errors->get('alto') || $errors->get('largo') || $errors->get('ancho') || $errors->get('cabeza') || $errors->get('longitud') || $errors->get('separacion_rosca') || $errors->get('rosca_parcial') || $errors->get('vastago') || $errors->get('nombre') || $errors->get('descripcion') || $errors->get('familia'))
                                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                        Ha ocurrido un error al editar el producto
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div><br>
                                @endif
    
                                @if ($errors->get('url') || $errors->get('existe_imagen'))
                                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                        Ha ocurrido un error al subir el archivo seleccionado
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div><br>
                                @endif
                            </div>
                            <div class="list-group" style="min-width: 600px">
                                <a type="button" data-bs-toggle="modal" data-bs-target="#actualizar_stock_modal"
                                    class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Actualizar Stock
                                            <svg class="bi me-2" width="16" height="16">
                                                <use xlink:href="#editar_stock" />
                                            </svg>
                                        </h5>
                                    </div>
                                    <p class="mb-1">Actualizar el stock del producto en inventario.</p>
                                </a>
                                <a type="button" data-bs-toggle="modal" data-bs-target="#actualizar_precio_venta_modal" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Actualizar Precio de Venta
                                            <svg class="bi me-2" width="16" height="16">
                                                <use xlink:href="#realizar_venta" />
                                            </svg>
                                        </h5>
                                    </div>
                                    <p class="mb-1">Actualizar el precio de venta a clientes.</p>
                                </a>
                                <a type="button" data-bs-toggle="modal" data-bs-target="#editar_producto_modal" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Editar Producto
                                            <svg class="bi me-2" width="16" height="16">
                                                <use xlink:href="#editar_producto" />
                                            </svg>
                                        </h5>
                                    </div>
                                    <p class="mb-1">Editar característica del producto.</p>
                                </a>
                                <a type="button" data-bs-toggle="modal" data-bs-target="#activar_desactivar_modal" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Activar/Desactivar Producto
                                            <svg class="bi me-2" width="16" height="16">
                                                <use xlink:href="#activar_desactivar" />
                                            </svg>
                                        </h5>
                                    </div>
                                    <p class="mb-1">Cambiar estado del producto para mostrarlo u ocultarlo en el sistema.</p>
                                </a>
                                <a type="button" data-bs-toggle="modal" data-bs-target="#subir_imagen_modal" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Subir imagen
                                            <svg class="bi me-2" width="16" height="16">
                                                <use xlink:href="#fotito_icon" />
                                            </svg>
                                        </h5>
                                    </div>
                                    <p class="mb-1">Asocia la foto subida a un producto, desplegando esta foto en el catálogo.</p>
                                </a>
                                
                                <a type="button" data-bs-toggle="modal" data-bs-target="#eliminar_imagen_modal" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Eliminar imagen
                                            <svg class="bi me-2" width="16" height="16">
                                                <use xlink:href="#fotito_icon" />
                                            </svg>
                                        </h5>
                                    </div>
                                    <p class="mb-1">Elimina una foto asociada al producto.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        {{-- Formularios modal --}}
        
        {{-- Actualizar stock --}}
        <div class="modal fade" id="actualizar_stock_modal" tabindex=-1 aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Stock de
                            {{ $producto_en_bruto->nombre }}: {{ $producto_en_stock->stock }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body margen">
                        <form action="{{ route('ver_detalle_stock_actualizado', $producto_en_bruto->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label" style="color:black">Ingrese el stock
                                    deseado</label>
                                    <input type="number" value={{ $producto_en_stock->stock }} class="form-control"
                                    name="stock" id="stock" required>    
                                    <input type="number" value={{ $producto_en_stock->sucursal_id }} class="visually-hidden"
                                    name="sucursal_id_hidden" id="sucursal_id_hidden" required> 
                            </div>
                            @error('stock')
                                <small style="color:red;">*{{$message}}</small>
                            @enderror
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary"
                                    onclick="return confirm('¿Está usted seguro del stock ingresado?')">Confirmar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    
        {{-- Actualizar Precio de Venta--}}
        <div class="modal fade" id="actualizar_precio_venta_modal" tabindex=-1 aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Editar precio de venta de {{$producto_en_bruto->nombre}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body margen">
                        <form action="{{ route('ver_detalle_precio_producto_actualizado', $producto_en_bruto->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label" style="color:black">Precio de Compra</label>
                                <input type="number" value={{ $producto_en_stock->precio_compra }} class="form-control"
                                    name="precio_compra" id="precio_compra" readonly>
                                <label for="recipient-name" class="col-form-label" style="color:black">Utilidad (%)</label>
                                <input type="number" value=1 class="form-control"
                                    name="utilidad" id="utilidad" onchange="calculo_ganancia()" required>
    
                                <script>
                                    function calculo_ganancia()
                                    {
                                        var precio_compra = document.getElementById('precio_compra').value;//solo valor
                                        var utilidad = document.getElementById('utilidad').value;//solo valor
                                        var precio_venta = document.getElementById('precio_venta')//objeto
                                        
                                        var precio_venta_bruto = Math.round(precio_compra/(1-utilidad/100));//precio de venta sin redondear
                                        var resto = precio_venta_bruto%100;
                                        var precio_venta_def = precio_venta_bruto - resto;
    
                                        precio_venta.value = precio_venta_def;//valor del objeto definitivo y redondeado
                                        
                                        
                                    }
                                </script>
    
                                <label for="recipient-name" class="col-form-label" style="color:black">Precio Venta Actual</label>
                                <input type="number" value={{$producto_en_stock->precio_venta}} class="form-control" name="precio_venta_actual" id="precio_venta_actual" step="100" min="1" readonly>
                                <label for="recipient-name" class="col-form-label" style="color:black">Precio Venta</label>
                                <input type="number" class="form-control" name="precio_venta" id="precio_venta" step="100" min="1" readonly>
                                <input type="number" value={{ $producto_en_stock->sucursal_id }} class="visually-hidden"
                                    name="sucursal_id_hidden" id="sucursal_id_hidden" required>
                            </div>
                            @error('utilidad')
                                    <small style="color:red;">*{{$message}}</small>
                            @enderror
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary"
                                    onclick="return confirm('¿Está usted seguro del nuevo precio de venta?')">Confirmar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
        {{-- Editar Producto --}}
        <div class="modal fade" id="editar_producto_modal" tabindex=-1 aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Detalle
                            {{ $producto_en_bruto->nombre }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body margen">
                        <form action="{{route('ver_detalle_producto_actualizado',$producto_en_bruto->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <input type="number" value={{ $producto_en_stock->sucursal_id }} class="visually-hidden"
                                    name="sucursal_id_hidden" id="sucursal_id_hidden" required>
                                <label for="recipient-name" class="col-form-label" style="color:black">Nombre</label>
                                <input type="text" value="{{$producto_en_bruto->nombre}}" class="form-control" name="nombre" id="nombre">
                                @error('alto')
                                <small style="color:red;">*{{$message}}</small>
                                @enderror
                                <label for="recipient-name" class="col-form-label" style="color:black">Descripción</label>
                                <textarea class="form-control" name="descripcion" id="descripcion">{{$producto_en_bruto->descripcion}}</textarea>
                                @error('alto')
                                <small style="color:red;">*{{$message}}</small>
                                @enderror
                                <label for="recipient-name" class="col-form-label" style="color:black">Familia</label>
                                <input type="text" value="{{$producto_en_bruto->familia}}" class="form-control" name="familia" id="familia" disabled>
    
                                @php
                                    if($producto_en_bruto->familia != "Herramienta" && $producto_en_bruto->familia != "Otro")
                                    {
                                        $familia = App\Http\Controllers\EjecutivoController::detectar_nombre($producto_en_bruto->familia);
                                        $producto_en_tabla = DB::table($familia)->where('producto_id', $producto_en_bruto->id)->first();
                                    }
                                @endphp
                                @if ($producto_en_bruto->familia=="Madera" || $producto_en_bruto->familia=="Techumbre" || $producto_en_bruto->familia=="Plancha_construccion" || $producto_en_bruto->familia=="Mueble")
                                <div class="">
                                    <label for="recipient-name" class="col-form-label" style="color:black">Alto</label>
                                    <input type="number" value="{{$producto_en_tabla->alto}}" class="form-control" name="alto" id="alto">
                                    @error('alto')
                                    <small style="color:red;">*{{$message}}</small>
                                    @enderror
                                </div>
    
                                <div class="">
                                    <label for="recipient-name" class="col-form-label" style="color:black">Ancho</label>
                                    <input type="number" value="{{$producto_en_tabla->ancho}}" class="form-control" name="ancho" id="ancho">
                                    @error('ancho')
                                    <small style="color:red;">*{{$message}}</small>
                                    @enderror
                                </div>
                                
    
                                <div class="">
                                    <label for="recipient-name" class="col-form-label" style="color:black">Largo</label>
                                    <input type="number" value="{{$producto_en_tabla->largo}}" class="form-control" name="largo" id="largo" step="0.01">
                                    @error('largo')
                                    <small style="color:red;">*{{$message}}</small>
                                    @enderror
                                </div>
    
                                @endif
    
                                
                                @if ($producto_en_bruto->familia=="Madera")
                                <div class="">
                                    <label for="recipient-name" class="col-form-label" style="color:black">Tipo Madera</label>
                                    <input type="text" value="{{$producto_en_tabla->tipo_madera}}" class="form-control" name="tipo_madera" id="tipo_madera">
                                    @error('tipo_madera')
                                    <small style="color:red;">*{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="">
                                    <label for="recipient-name" class="col-form-label" style="color:black">Tratamiento</label>
                                    <input type="text" value="{{$producto_en_tabla->tratamiento}}" class="form-control" name="tratamiento" id="tratamiento">
                                    @error('tratamiento')
                                    <small style="color:red;">*{{$message}}</small>
                                    @enderror
                                </div>
                                @endif
    
                                @if ($producto_en_bruto->familia=="Clavo")
                                <div class="">
                                    <label for="recipient-name" class="col-form-label" style="color:black">Material</label>
                                    <input type="text" value="{{$producto_en_tabla->material}}" class="form-control" name="material" id="material">
                                    @error('material')
                                    <small style="color:red;">*{{$message}}</small>
                                    @enderror
                                </div>
                               
                                <div class="">
                                    <label for="recipient-name" class="col-form-label" style="color:black">Cabeza</label>
                                    <input type="number" value="{{$producto_en_tabla->cabeza}}" class="form-control" name="cabeza" id="cabeza" step="0.01">
                                    @error('cabeza')
                                    <small style="color:red;">*{{$message}}</small>
                                    @enderror
                                </div>
    
                                <div class="">
                                    <label for="recipient-name" class="col-form-label" style="color:black">Punta</label>
                                    <input type="text" value="{{$producto_en_tabla->punta}}" class="form-control" name="punta" id="punta">
                                </div>
                              
                                <div class="">
                                    <label for="recipient-name" class="col-form-label" style="color:black">Longitud</label>
                                    <input type="number" value="{{$producto_en_tabla->longitud}}" class="form-control" name="longitud" id="longitud" step="0.01">
                                    @error('longitud')
                                    <small style="color:red;">*{{$message}}</small>
                                    @enderror
                                </div>
                                
                                @endif
    
                                @if ($producto_en_bruto->familia=="Techumbre" || $producto_en_bruto->familia=="Plancha_construccion")
                                <div class="">
                                    <label for="recipient-name" class="col-form-label" style="color:black">Material</label>
                                    <input type="text" value="{{$producto_en_tabla->material}}" class="form-control" name="material" id="material">
                                    @error('material')
                                    <small style="color:red;">*{{$message}}</small>
                                    @enderror
                                </div>
                                @endif
    
                                {{-- Tornillo --}}
                                @if ($producto_en_bruto->familia=="Tornillo")
                                <div class="">
                                    <label for="recipient-name" class="col-form-label" style="color:black">Cabeza</label>
                                    <input type="number" value="{{$producto_en_tabla->cabeza}}" class="form-control" name="cabeza" id="cabeza" step="0.01">
                                    @error('cabeza')
                                    <small style="color:red;">*{{$message}}</small>
                                    @enderror
                                </div>
    
                                <div class="">
                                    <label for="recipient-name" class="col-form-label" style="color:black">Tipo Rosca</label>
                                    <select class="form-control select" name="tipo_rosca" id="tipo_rosca" tabindex="4"> 
                                        @if ($producto_en_tabla->tipo_rosca == 2)
                                        <option value="parcial">Parcial</option>  
                                        <option value="total">Total</option> 
                                        @else
                                        <option value="total">Total</option>  
                                        <option value="parcial">Parcial</option> 
                                        @endif
                                    </select>
                                </div>
                                
                                <div class="">
                                    <label for="recipient-name" class="col-form-label" style="color:black">Separacion Rosca</label>
                                    <input type="number" value="{{$producto_en_tabla->separacion_rosca}}" class="form-control" name="separacion_rosca" id="separacion_rosca" step="0.01">
                                    @error('separacion_rosca')
                                    <small style="color:red;">*{{$message}}</small>
                                    @enderror
                                </div>
    
                                <div class="">
                                    <label for="recipient-name" class="col-form-label" style="color:black">Punta</label>
                                    <input type="text" value="{{$producto_en_tabla->punta}}" class="form-control" name="punta" id="punta">
                                    @error('punta')
                                    <small style="color:red;">*{{$message}}</small>
                                    @enderror
                                </div>
    
                                <div class="">
                                    <label for="recipient-name" class="col-form-label" style="color:black">Rosca Parcial</label>
                                    <input type="number" value="{{$producto_en_tabla->rosca_parcial}}" class="form-control" name="rosca_parcial" id="rosca_parcial" step="0.01">
                                    @error('rosca_parcial')
                                    <small style="color:red;">*{{$message}}</small>
                                    @enderror
                                </div>
    
                                <div class="">
                                <label for="recipient-name" class="col-form-label" style="color:black">Vastago</label>
                                <input type="number" value="{{$producto_en_tabla->vastago}}" class="form-control" name="vastago" id="vastago" step="0.01">
                                    @error('vastago')
                                    <small style="color:red;">*{{$message}}</small>
                                    @enderror
                                </div>
    
                                @endif
    
                                {{-- Mueble --}}
                                @if ($producto_en_bruto->familia=="Mueble")
                                <div class="">
                                    <label for="recipient-name" class="col-form-label" style="color:black">Material</label>
                                    <input type="text" value="{{$producto_en_tabla->material}}" class="form-control" name="material" id="material">
                                    @error('material')
                                    <small style="color:red;">*{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="">
                                    <label for="recipient-name" class="col-form-label" style="color:black">Acabado</label>
                                    <input type="text" value="{{$producto_en_tabla->acabado}}" class="form-control" name="acabado" id="acabado">
                                    @error('acabado')
                                    <small style="color:red;">*{{$message}}</small>
                                    @enderror
                                </div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary"
                                    onclick="return confirm('¿Está usted seguro de los cambios al producto?')">Confirmar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
        {{-- Activar Desactivar Producto --}}
        <div class="modal fade" id="activar_desactivar_modal" tabindex=-1 aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Estado del producto:
                            {{ $producto_en_bruto->nombre }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body margen">
    
                        <form action="{{ route('cambiar_estado', $producto_en_bruto->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <input type="number" value={{ $producto_en_stock->sucursal_id }} class="visually-hidden"
                                name="sucursal_id_hidden" id="sucursal_id_hidden" required>
                                <input class="visually-hidden" type="number" value="{{ $producto_en_bruto->estado }}"name="estado" id="estado" required>
                                <label for="recipient-name" class="col-form-label" style="color:black">Estado:</label>
                                
                                <div id="producto_on">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked onchange="cambiar_estado()">
                                        <label class="form-check-label" for="flexSwitchCheckChecked" id="label_on" >Producto Activo</label>
                                    </div>
                                </div>    
                                
                                <div id="producto_off">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" onchange="cambiar_estado()">
                                        <label class="form-check-label" for="flexSwitchCheckChecked"id="label_off" >Producto Inactivo</label>
                                    </div>
                                </div>
                                   
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary"
                                    onclick="return confirm('¿Está usted seguro del cambio ingresado?')">Confirmar</button>
                            </div>
                        </form>
    
                    </div>
                </div>
            </div>
        </div>
    
        {{-- Subir img --}}
        <div class="modal fade" id="subir_imagen_modal" tabindex=-1 aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Subir Imagen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body margen" >
                        <form action="{{ route('subir_imagen_producto', $producto_en_bruto->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input type="number" value={{ $producto_en_stock->sucursal_id }} class="visually-hidden"
                                name="sucursal_id_hidden" id="sucursal_id_hidden" required>
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary"
                                    onclick="return confirm('¿Está usted seguro de subir esta imagen?')">Confirmar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Eliminar imagen --}}
        <div class="modal fade" id="eliminar_imagen_modal" tabindex=-1 aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Eliminar Imagen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body margen">
                        @if ($contador_aux == 0)
                        <div class="mb-3 text-center">
                            <label for="" class="form-label">No hay ninguna imagen asociada a este producto</label>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                        @else
                        <form action="{{route('eliminar_imagen_producto')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input type="number" value={{ $producto_en_stock->sucursal_id }} class="visually-hidden"
                                name="sucursal_id_hidden" id="sucursal_id_hidden" required>
                                <label for="" class="form-label">Seleccione una imagen</label>
                    
                                <select class="form-control select" name="imagen_id" id="imagen_id" tabindex="8">
                                    @php
                                        $valor_asc = 1;
                                    @endphp
                                    @foreach ($imagenes as $imagen)  
                                    <option value={{$imagen->id}}>Imagen N°{{$valor_asc}}</option> 
                                    @php
                                        $valor_asc++;
                                    @endphp
                                    @endforeach
                                </select>
                                @error('existe_imagen')
                                    <small style="color:red;">*:)</small>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary"
                                    onclick="return confirm('¿Está usted seguro de eliminar esta imagen?')">Confirmar</button>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>


<script type="text/javascript">
    $(document).ready(function()
    {
            
        if($("#estado").val() == 1)
        {
            $("#producto_on").show();
            $("#producto_off").hide();
        }
        else
        {
            $("#producto_on").hide();
            $("#producto_off").show();
        }
                  
    });


</script>

<script type="text/javascript">
    var input_estado = document.getElementById('estado');

    function cambiar_estado(){

        if(input_estado.value == 1){

            input_estado.value=0; 
            document.getElementById('label_on').innerHTML = "Producto Inactivo";
            document.getElementById('label_off').innerHTML = "Producto Inactivo";
            
        }
        else{
            input_estado.value=1; 
            document.getElementById('label_off').innerHTML = "Producto Activo";
            document.getElementById('label_on').innerHTML = "Producto Activo";
        }
        
    }
</script>

@endsection