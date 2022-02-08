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

                <form class="row g-3 mt-3 col-form-izq form-izq">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
              
                              <label for="producto" class="input-group-text">Producto:</label>
                              <input class="form-control" list="datalist_productos" id="nombre_producto" onchange="cargar_datos()"
                                placeholder="Escriba para buscar...">
                              <datalist id="datalist_productos">
                                @foreach ($productos as $producto)
                                <option data-value="{{$producto->id}}" value="{{$producto->nombre}}">
                                  @endforeach
                              </datalist>
                            </div>
                          </div>
                    </div>

                    <div class="row justify-content-center mt-3">

                        <div class="col-2">
                            <button type="button" id="administrar_producto" class="btn btn-primary">Administrar
                                Producto</button>
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
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Agregar Nuevo Producto
                                        <svg class="bi me-2" width="16" height="16">
                                            <use xlink:href="#agregar_producto" />
                                        </svg>
                                    </h5>
                                </div>
                                <p class="mb-1">Agregar un nuevo producto al inventario y al catálogo.</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Consultar Precios
                                        <svg class="bi me-2" width="16" height="16">
                                            <use xlink:href="#consultar_precios" />
                                        </svg>
                                    </h5>
                                </div>
                                <p class="mb-1">Ver lista de productos y sus precios.</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
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




    </div>

</div>


@endsection