@extends('inventario.master_inv')
@section('content')
@include('inventario.partials.iconos')


<div class="container">

    <div class="row justify-content-center mt-3 form-arriba">
        {{-- editar stock --}}

        <div class="row justify-content-center">
            {{-- Columna formulario agregar producto a la venta (IZQUIERDA) --}}
            <div class="col-8 card p-3 bg-light mt-3 col-form-izq">

                <div class="row mx-3 justify-content-center">
                    <div class="col-md-7 card form-izq ml-3">
                        <h4 class="text-center">
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="#inventario" />
                            </svg>
                            Inventario
                        </h4>
                    </div>
                </div>

                <form class="row g-3 mt-3 col-form-izq form-izq" action="{{route('ver_detalle')}}" method="POST">
                    @csrf
                    @method('GET')
                    <div class="row">
                        <div class="col-md-12">
                            <h5 for="nombre_producto" data-bs-toggle="tooltip" data-bs-placement="left" title="Selecciona un producto para administrar y poder actualizar su stock, precio de venta, editar sus carácteristicas y activarlo o desactivarlo en el sistema.">Productos en inventario</h5>
                            <div class="input-group">

                                <label for="nombre_producto" class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="left" title="Selecciona un producto para administrar y poder actualizar su stock, precio de venta, editar sus carácteristicas y activarlo o desactivarlo en el sistema.">Producto:</label>
                                <input class="form-control" list="datalist_productos" name="nombre_producto" id="nombre_producto" placeholder="Escriba para buscar..." onchange="cargar_datos()">
                                <input type="number" class="visually-hidden" name="id_producto_hidden" id="id_producto_hidden">
                                <datalist id="datalist_productos">
                                    @foreach ($productos as $producto)
                                    <option data-value="{{$producto->id}}" value="{{$producto->nombre}}">
                                        @endforeach
                                </datalist>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-3">
                        <div class="col-3" style="justify-self: center;">

                            <button type="submit" id="administrar_producto" class="btn btn-primary" name="action" value="detalle" style="width: 200px ; justify-self: center;" >Administrar Producto</button>
                        </div>
                        
                    </div>




                </form>




            </div>



        </div>

        {{-- funciones --}}

        <div class="row justify-content-center mt-3">
            <div class="col-8 card p-3 bg-light mt-3 col-form-izq">
                <div class="row mx-3 justify-content-center">
                    <div class="col-md-7 card form-izq ml-3">
                        <h4 class="text-center">
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="#inventario" />
                            </svg>
                            Funciones Inventario
                        </h4>
                    </div>
                </div>
                <div class="row justify-content-evenly mt-3 mx-auto">
                    <div class="col-12">

                        <div class="list-group">
                            <a type="button" data-bs-toggle="modal" data-bs-target="#ingresar_producto"
                                 class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Agregar Nuevo Producto
                                        <svg class="bi me-2" width="16" height="16">
                                            <use xlink:href="#agregar_producto" />
                                        </svg>
                                    </h5>
                                </div>
                                <p class="mb-1">Agregar un nuevo producto al inventario y al catálogo.</p>
                            </a>
                            <a href="{{route('ver_detalle_precios')}}" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Consultar Precios
                                        <svg class="bi me-2" width="16" height="16">
                                            <use xlink:href="#consultar_precios" />
                                        </svg>
                                    </h5>
                                </div>
                                <p class="mb-1">Ver lista de productos y sus precios.</p>
                            </a>
                            <a href="{{route('ventas.create')}}" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Realizar Venta
                                        <svg class="bi me-2" width="16" height="16">
                                            <use xlink:href="#realizar_venta" />
                                        </svg>
                                    </h5>
                                </div>
                                <p class="mb-1">Realizar una venta como ejecutivo.</p>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- modal agregar producto --}}
        <div class="modal fade" id="ingresar_producto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agregar Nuevo Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('agregar_producto')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label" style="color:black">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" required>
                                <label for="recipient-name" class="col-form-label" style="color:black">Descripción</label>
                                <textarea class="form-control" name="descripcion" id="descripcion" required></textarea>
                                <label for="recipient-name" class="col-form-label" style="color:black">Tipo de Producto</label>
                                <select class="form-control select" name="familia" id="familia" tabindex="3">
                                    <option selected value="default">Seleccione un tipo de producto</option>
                                    <option value="Tornillo">Tornillo</option>  
                                    <option value="Plancha_construccion">Plancha de construcción</option>  
                                    <option value="Techumbre">Techumbre</option>  
                                    <option value="Mueble">Mueble</option>  
                                    <option value="Madera">Madera</option>  
                                    <option value="Clavo">Clavo</option>  
                                </select>
    
                                
                                <div class="form-group tornillos_clavos">
                                    <label for="" class="form-label" style="color:black">Cabeza</label>
                                    <input id="cabeza" name="cabeza" type="number" step="0.01" class="form-control" tabindex="4" value="{{old('cabeza')}}">
                                </div>
    
                                <div class="form-group tornillos">
                                    <label for="" class="form-label" style="color:black">Tipo rosca</label>
                                    <select class="form-control select" name="tipo_rosca" id="tipo_rosca" tabindex="5"> 
                                        <option value="total" {{ old('tipo_rosca')=="total" ? 'selected' : ''  }}>Total</option>  
                                        <option value="parcial" {{ old('tipo_rosca')=="parcial" ? 'selected' : ''  }}>Parcial</option> 
                                    </select>
                                </div>
    
                                <div class="form-group tornillos">
                                    <label for="" class="form-label" style="color:black">Separación rosca</label>
                                    <input id="separacion_rosca" name="separacion_rosca" type="number" step="0.01" class="form-control" tabindex="6" value="{{old('separacion_rosca')}}">
                                </div>
    
                                <div class="form-group tornillos_clavos">
                                    <label for="" class="form-label" style="color:black">Punta</label>
                                    <input id="punta" name="punta" type="text" class="form-control" tabindex="7" value="{{old('punta')}}">
                                </div>
    
                                <div class="form-group tornillos">
                                    <label for="" class="form-label" style="color:black">Rosca parcial</label>
                                    <input id="rosca_parcial" name="rosca_parcial" type="number" step="0.01" class="form-control" tabindex="8" value="{{old('rosca_parcial')}}">
                                </div>
    
                                <div class="form-group tornillos">
                                    <label for="" class="form-label" style="color:black">Vastago</label>
                                    <input id="vastago" name="vastago" type="number" step="0.01" class="form-control" tabindex="9" value="{{old('vastago')}}">
                                </div>
    
                                <div class="form-group material">
                                    <label for="" class="form-label" style="color:black">Material</label>
                                    <input id="material" name="material" type="text" class="form-control" tabindex="10" value="{{old('material')}}">
                                </div>
    
                                <div class="form-group medidas">
                                    <label for="" class="form-label" style="color:black">Alto</label>
                                    <input id="alto" name="alto" type="number" step="0.01" class="form-control" tabindex="11" value="{{old('alto')}}">
                                </div>
    
                                <div class="form-group medidas">
                                    <label for="" class="form-label" style="color:black">Ancho</label>
                                    <input id="ancho" name="ancho" type="number" step="0.01" class="form-control" tabindex="12" value="{{old('ancho')}}">
                                </div>
    
                                <div class="form-group medidas">
                                    <label for="" class="form-label" style="color:black">Largo</label>
                                    <input id="largo" name="largo" type="number" step="0.01" class="form-control" tabindex="13" value="{{old('largo')}}">
                                </div>
    
                                <div class="form-group muebles">
                                    <label for="" class="form-label" style="color:black">Acabado</label>
                                    <input id="acabado" name="acabado" type="text" class="form-control" tabindex="14" value="{{old('acabado')}}">
                                </div>
    
                                <div class="form-group maderas">
                                    <label for="" class="form-label" style="color:black">Tipo madera</label>
                                    <input id="tipo_madera" name="tipo_madera" type="text" class="form-control" tabindex="15" value="{{old('tipo_madera')}}">
                                </div>
    
                                <div class="form-group maderas">
                                    <label for="" class="form-label" style="color:black">Tratamiento</label>
                                    <input id="tratamiento" name="tratamiento" type="text" class="form-control" tabindex="16" value="{{old('tratamiento')}}">
                                </div>
    
                                <div class="form-group clavos">
                                    <label for="" class="form-label" style="color:black">Longitud</label>
                                    <input id="longitud" name="longitud" type="number" step="0.01" class="form-control" tabindex="17" value="{{old('longitud')}}">
                                </div>
    
                                <label for="recipient-name" class="col-form-label" style="color:black">Stock</label>
                                <input type="number" class="form-control" name="stock" id="stock" min="1" required>
    
                                <label for="recipient-name" class="col-form-label" style="color:black">Precio Compra</label>
                                <input type="number" class="form-control" name="precio_compra" id="precio_compra" min="1" step="100" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary"
                                    onclick="return confirm('¿Estás seguro del stock ingresado?')">Confirmar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </div>

</div>
<script type="text/javascript">
    $(document).ready(function(){ 
    //esconder campos antes de seleccionar familia    
    $(".tornillos").slideUp(200);  
    $(".material").slideUp(200);
    $(".tornillos_clavos").slideUp(200);
    $(".medidas").slideUp(200);
    $(".muebles").slideUp(200);
    $(".maderas").slideUp(200);
    $(".clavos").slideUp(200);

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
    function cargar_datos(){

        const productos = document.getElementById('datalist_productos');
        const producto_seleccionado = document.querySelector('#nombre_producto');
        const opSelected = productos.querySelector(`[value="${producto_seleccionado.value}"]`);
        const id_producto = opSelected.getAttribute('data-value');

        //obtener referencia de componentes para llenar (inputs de formulario)
        var id_producto_hidden = document.getElementById('id_producto_hidden');
        id_producto_hidden.value = parseInt(id_producto);
    

    }
</script>

@endsection