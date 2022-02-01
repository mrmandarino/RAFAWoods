<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/estilos.css">
    <title>Detalle Producto</title>

</head>

<body>

    <div class="container">
        <header class="row">
            <div class="col">
                <h1>Detalle {{ $producto_en_bruto->nombre }}</h1>
            </div>
        </header>

        <section class="contenedor-main row align-items-center">
            <main class="col-md-8">
                <p>{{ $producto_en_bruto->descripcion }}</p>
            </main>

            <aside class="col-md-4">
                <div class="row justify-content-between">
                    <div class="col-12 col-md-4 col-lg-3">
                        <!--Mensaje de stock con exito -->
                        @if (session()->has('correcto_stock'))
                            <div class="alert alert-success">
                                {{ session()->get('correcto_stock') }}
                            </div><br>
                        @endif
                    </div>
        
                    <div class="col-12 col-md-4 col-lg-3">
                        <!--Mensaje de editado con exito -->
                        @if (session()->has('correcto_producto'))
                            <div class="alert alert-success">
                                {{ session()->get('correcto_producto') }}
                            </div><br>
                        @endif
                    </div>
        
                    <div class="col-12 col-md-4 col-lg-3">
                        <!--Mensaje de eliminado con exito -->
                        @if (session()->has('correcto'))
                            <div class="alert alert-success">
                                {{ session()->get('correcto') }}
                            </div><br>
                        @endif
                    </div>
        
        
                </div>
            </aside>
        </section>

        


        <section class="row widgets justify-content-between">
            <div class="col-12 col-md-4 col-lg-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editar_stock"style="width:90%">Editar Stock</button>
                <p class="d-none d-md-block d-lg-none">4 Columnas</p>
                <p class="d-block d-md-none">12 Columnas</p>

                <p>Esta opción permite modificar el stock actual del producto.</p>
            </div>

            <div class="col-12 col-md-4 col-lg-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editar_producto"style="width:90%">Editar Producto</button>
                <p class="d-none d-md-block d-lg-none">4 Columnas</p>
                <p class="d-block d-md-none">12 Columnas</p>

                <p>Esta opción permite editar la información y características del producto actual.</p>
            </div>

            <div class="col-12 col-md-4 col-lg-3">
                <form action="{{route('eliminar_producto',$producto_en_bruto->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary" data-bs-toggle="modal" style="width:90%" onclick="return confirm('¿Estás seguro de querer eliminar este producto?')">Eliminar Producto</button>
                </form>
                <p class="d-none d-md-block d-lg-none">4 Columnas</p>
                <p class="d-block d-md-none">12 Columnas</p>

                <p>Esta opción permite eliminar el producto del sistema.</p>
            </div>

            
        </section>
        

        <section class="row widgets justify-content-between">
            <div class="col-12 col-md-4 col-lg-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editar_precio_venta"style="width:90%">Editar Precio Venta</button>
                <p class="d-none d-md-block d-lg-none">4 Columnas</p>
                <p class="d-block d-md-none">12 Columnas</p>
    
                <p>Esta opción permite editar la información y características del producto actual.</p>
            </div>
        </section>

        <!---->

    </div>
    
    <div class="modal fade" id="editar_stock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:black">Stock actual de
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
                                onclick="return confirm('¿Estás seguro del stock ingresado?')">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editar_producto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input type="text" value={{$producto_en_bruto->nombre}} class="form-control" name="nombre" id="nombre" required>
                            <label for="recipient-name" class="col-form-label" style="color:black">Descripción</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" required>{{$producto_en_bruto->descripcion}}</textarea>
                            <label for="recipient-name" class="col-form-label" style="color:black">Familia</label>
                            <input type="text" value={{$producto_en_bruto->familia}} class="form-control" name="familia" id="familia" required>

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
                                onclick="return confirm('¿Estás seguro del stock ingresado?')">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editar_precio_venta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                    precio_venta.value = Math.round(precio_compra/(1-utilidad/100));//valor del objeto

                                    
                                }
                            </script>

                            <label for="recipient-name" class="col-form-label" style="color:black">Precio Venta</label>
                            <input type="number" class="form-control" name="precio_venta" id="precio_venta" step="100" min="1" readonly>
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


    

    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>
