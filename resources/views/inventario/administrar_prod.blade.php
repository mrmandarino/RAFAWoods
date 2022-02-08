@extends('inventario.master_inv')
@section('content')
@include('inventario.partials.iconos')


<div class="container">

    <div class="row justify-content-center mt-3 botones">
        {{-- editar stock --}}

        <div class="row justify-content-center">
            {{-- Columna formulario agregar producto a la venta (IZQUIERDA) --}}
            <div class="col-8 card p-3 bg-light mt-3 col-form-izq">

                <div class="row mx-3 justify-content-center">
                    <div class="col-md-7 card form-izq ml-3">
                        <h4 class="text-center">
                            <svg class="bi me-2" width="20" height="20">
                                <use xlink:href="#administrar_producto" />
                            </svg>
                            Administrar: 
                        </h4>
                    </div>
                </div>
                <div class="row mx-3 mt-3 justify-content-center">
                    <div class="col-md-7 card form-izq ml-3">
                        <h6 class="text-left">
                            <svg class="bi me-2" width="15" height="15">
                                <use xlink:href="#descripcion" />
                            </svg>
                            Descripción: Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique provident nobis non obcaecati. Perferendis, adipisci, sapiente, cupiditate dolorum quibusdam repudiandae ipsam enim quo cum provident incidunt asperiores assumenda vitae. Iusto.
                        </h6>
                    </div>
                </div>
                <div class="row justify-content-evenly mt-3 mx-auto">
                    <div class="col-12">

                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Actualizar Stock 
                                        <svg class="bi me-2" width="16" height="16">
                                            <use xlink:href="#editar_stock" />
                                        </svg>
                                    </h5>
                                </div>
                                <p class="mb-1">Actualizar el stock del producto en inventario.</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Actualizar Precio de Venta
                                        <svg class="bi me-2" width="16" height="16">
                                            <use xlink:href="#realizar_venta" />
                                        </svg>
                                    </h5>
                                </div>
                                <p class="mb-1">Actualizar el precio de venta a clientes.</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Editar Producto
                                        <svg class="bi me-2" width="16" height="16">
                                            <use xlink:href="#editar_producto" />
                                        </svg>
                                    </h5>
                                </div>
                                <p class="mb-1">Editar característica del producto.</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Desactivar Producto
                                        <svg class="bi me-2" width="16" height="16">
                                            <use xlink:href="#eliminar_producto" />
                                        </svg>
                                    </h5>
                                </div>
                                <p class="mb-1">Desactivar producto del inventario,catálogo y ventas (para futuras ventas).</p>
                            </a>
                        </div>
                    </div>
                </div>
                



            </div>



        </div>


        




    </div>

</div>


@endsection