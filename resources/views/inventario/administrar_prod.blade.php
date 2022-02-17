@extends('inventario.master_inv')
@section('content')
@include('inventario.partials.iconos')


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
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session()->get('estado_cambiado') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div><br>
                            @endif
                            @if (session()->has('stock_actualizado'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session()->get('stock_actualizado') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div><br>
                            @endif
                            @if (session()->has('precio_actualizado'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session()->get('precio_actualizado') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div><br>
                            @endif
                            @if (session()->has('producto_actualizado'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session()->get('producto_actualizado') }}
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- formularios modal --}}
    
    {{-- Actualizar stock --}}
    <div class="modal fade" id="actualizar_stock_modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:black">Stock de
                        {{ $producto_en_bruto->nombre }}: {{ $producto_en_stock->stock }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('ver_detalle_stock_actualizado', $producto_en_bruto->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label" style="color:black">Ingrese el stock
                                deseado</label>
                                <input type="number" value={{ $producto_en_stock->stock }} class="form-control"
                                name="stock" id="stock" required>    
                        </div>
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
    <div class="modal fade" id="actualizar_precio_venta_modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:black">Editar precio de venta de {{$producto_en_bruto->nombre}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('ver_detalle_precio_producto_actualizado', $producto_en_bruto->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label" style="color:black">Precio de Compra</label>
                            <input type="number" value={{ $producto_en_stock->precio_compra }} class="form-control"
                                name="precio_compra" id="precio_compra" readonly>
                            <label for="recipient-name" class="col-form-label" style="color:black">Utilidad</label>
                            <input type="number" value=1 class="form-control"
                                name="utilidad" id="utilidad" min="1" max="100" onchange="calculo_ganancia()" required>

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
                        </div>
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
    <div class="modal fade" id="editar_producto_modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:black">Detalle
                        {{ $producto_en_bruto->nombre }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('ver_detalle_producto_actualizado',$producto_en_bruto->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label" style="color:black">Nombre</label>
                            <input type="text" value="{{$producto_en_bruto->nombre}}" class="form-control" name="nombre" id="nombre" required>
                            <label for="recipient-name" class="col-form-label" style="color:black">Descripción</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" required>{{$producto_en_bruto->descripcion}}</textarea>
                            <label for="recipient-name" class="col-form-label" style="color:black">Familia</label>
                            <input type="text" value="{{$producto_en_bruto->familia}}" class="form-control" name="familia" id="familia" required>

                            @if ($producto_en_bruto->familia=="Madera" || $producto_en_bruto->familia=="Techumbre" || $producto_en_bruto->familia=="Plancha_construccion" || $producto_en_bruto->familia=="Mueble")
                            <label for="recipient-name" class="col-form-label" style="color:black">Alto</label>
                            <input type="text" value="{{$producto_en_tabla->alto}}" class="form-control" name="alto" id="alto" required>
                            <label for="recipient-name" class="col-form-label" style="color:black">Ancho</label>
                            <input type="text" value="{{$producto_en_tabla->ancho}}" class="form-control" name="ancho" id="ancho" required>
                            <label for="recipient-name" class="col-form-label" style="color:black">Largo</label>
                            <input type="text" value="{{$producto_en_tabla->largo}}" class="form-control" name="largo" id="largo" required>
                            @endif

                            @if ($producto_en_bruto->familia=="Madera")
                            <label for="recipient-name" class="col-form-label" style="color:black">Tipo Madera</label>
                            <input type="text" value="{{$producto_en_tabla->tipo_madera}}" class="form-control" name="tipo_madera" id="tipo_madera" required>
                            <label for="recipient-name" class="col-form-label" style="color:black">Tratamiento</label>
                            <input type="text" value="{{$producto_en_tabla->tratamiento}}" class="form-control" name="tratamiento" id="tratamiento" required>
                            @endif

                            @if ($producto_en_bruto->familia=="Clavo")
                            <label for="recipient-name" class="col-form-label" style="color:black">Material</label>
                            <input type="text" value="{{$producto_en_tabla->material}}" class="form-control" name="material" id="material" required>
                            <label for="recipient-name" class="col-form-label" style="color:black">Cabeza</label>
                            <input type="text" value="{{$producto_en_tabla->cabeza}}" class="form-control" name="cabeza" id="cabeza" required>
                            <label for="recipient-name" class="col-form-label" style="color:black">Punta</label>
                            <input type="text" value="{{$producto_en_tabla->punta}}" class="form-control" name="punta" id="punta" required>
                            <label for="recipient-name" class="col-form-label" style="color:black">Longitud</label>
                            <input type="text" value="{{$producto_en_tabla->longitud}}" class="form-control" name="longitud" id="longitud" required>
                            @endif

                            @if ($producto_en_bruto->familia=="Techumbre" || $producto_en_bruto->familia=="Plancha_construccion")
                            <label for="recipient-name" class="col-form-label" style="color:black">Material</label>
                            <input type="text" value="{{$producto_en_tabla->material}}" class="form-control" name="material" id="material" required>
                            @endif

                            @if ($producto_en_bruto->familia=="Tornillo")
                            <label for="recipient-name" class="col-form-label" style="color:black">Cabeza</label>
                            <input type="text" value="{{$producto_en_tabla->cabeza}}" class="form-control" name="cabeza" id="cabeza" required>
                            <label for="recipient-name" class="col-form-label" style="color:black">Tipo Rosca</label>
                            <input type="text" value="{{$producto_en_tabla->tipo_rosca}}" class="form-control" name="tipo_rosca" id="tipo_rosca" required>
                            <label for="recipient-name" class="col-form-label" style="color:black">Separacion Rosca</label>
                            <input type="text" value="{{$producto_en_tabla->separacion_rosca}}" class="form-control" name="separacion_rosca" id="separacion_rosca" required>
                            <label for="recipient-name" class="col-form-label" style="color:black">Punta</label>
                            <input type="text" value="{{$producto_en_tabla->punta}}" class="form-control" name="punta" id="punta" required>
                            <label for="recipient-name" class="col-form-label" style="color:black">Rosca Parcial</label>
                            <input type="text" value="{{$producto_en_tabla->rosca_parcial}}" class="form-control" name="rosca_parcial" id="rosca_parcial" required>
                            <label for="recipient-name" class="col-form-label" style="color:black">Vastago</label>
                            <input type="text" value="{{$producto_en_tabla->vastago}}" class="form-control" name="vastago" id="vastago" required>
                            @endif

                            @if ($producto_en_bruto->familia=="Mueble")
                            <label for="recipient-name" class="col-form-label" style="color:black">Material</label>
                            <input type="text" value="{{$producto_en_tabla->material}}" class="form-control" name="material" id="material" required>
                            <label for="recipient-name" class="col-form-label" style="color:black">Acabado</label>
                            <input type="text" value="{{$producto_en_tabla->acabado}}" class="form-control" name="acabado" id="acabado" required>
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
    <div class="modal fade" id="activar_desactivar_modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:black">Estado del producto:
                        {{ $producto_en_bruto->nombre }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('cambiar_estado', $producto_en_bruto->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
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