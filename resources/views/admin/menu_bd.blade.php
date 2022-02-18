@extends('admin.master_bd')
@section('content')
@include('inventario.partials.iconos')


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
                        Base de Datos
                    </h4>
                </div>
            </div>

            <div class="row justify-content-evenly mt-3 mx-auto">

                <div class="col-12">


                    <div class="row justify-content-center">

                        <div class="col-12">
                            <div class="row">

                                <svg class="bi me-2" width="40" height="40">
                                    <use xlink:href="#tablabd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="div">

                {{-- usuarios --}}
                <div class="row justify-content-center text-center mt-3">
                    <div class="col-4 ">
                        <a type="button" style="width: 66%" class="btn usuarios"
                            href="{{route('admin_visualizar_especifico',$tabla='usuarios')}}">Usuarios</a>
                    </div>
                    <div class="col-4 ">
                        <a type="button" style="width: 66%" class="btn usuarios"
                            href="{{route('admin_visualizar_especifico',$tabla='clientes')}}">Clientes</a>
                    </div>
                    <div class="col-4 ">
                        <a type="button" style="width: 66%" class="btn usuarios"
                            href="{{route('admin_visualizar_especifico',$tabla='trabajadores')}}">Trabajadores</a>
                    </div>
                </div>
                {{-- OOCC --}}
                <div class="row justify-content-center text-center mt-3">
                    <div class="col-4 ">
                        <a type="button" style="width: 66%" class="btn provedor"
                            href="{{route('admin_visualizar_especifico',$tabla='orden_compras')}}">OOCC</a>
                    </div>
                    <div class="col-4 ">
                        <a type="button" style="width: 66%" class="btn provedor"
                            href="{{route('admin_visualizar_especifico',$tabla='detalle_compras')}}">OOCC detalle</a>
                    </div>
                    <div class="col-4 ">
                        <a type="button" style="width: 66%" class="btn provedor"
                            href="{{route('admin_visualizar_especifico',$tabla='proveedores')}}">Proveedores</a>
                    </div>
                </div>
                {{-- info ejecutivo --}}
                <div class="row justify-content-center text-center mt-3">
                    <div class="col-4 ">
                        <a type="button" style="width: 66%" class="btn provedor"
                            href="{{route('admin_visualizar_especifico',$tabla='telefono_proveedores')}}">Teléfonos</a>
                    </div>
                    <div class="col-4 ">
                        <a type="button" style="width: 66%" class="btn provedor"
                            href="{{route('admin_visualizar_especifico',$tabla='transportes')}}">Transportes</a>
                    </div>
                    <div class="col-4 ">
                        <a type="button" style="width: 66%" class="btn provedor"
                            href="{{route('admin_visualizar_especifico',$tabla='ejecutivos')}}">Ejecutivos</a>
                    </div>
                </div>
                
                {{-- Maderas --}}
                <div class="row justify-content-center text-center mt-3">
                    <div class="col-4 ">
                        <a type="button" style="width: 66%" class="btn madera"
                            href="{{route('admin_visualizar_especifico',$tabla='maderas')}}">Maderas</a>
                    </div>
                    <div class="col-4 ">
                        <a type="button" style="width: 66%" class="btn madera"
                            href="{{route('admin_visualizar_especifico',$tabla='clavos')}}">Clavos</a>
                    </div>
                    <div class="col-4 ">
                        <a type="button" style="width: 66%" class="btn madera"
                            href="{{route('admin_visualizar_especifico',$tabla='tornillos')}}">Tornillos</a>
                    </div>
                </div>
                {{-- otros productos --}}
                <div class="row justify-content-center text-center mt-3">
                    <div class="col-4 ">
                        <a type="button" style="width: 66%" class="btn madera"
                            href="{{route('admin_visualizar_especifico',$tabla='muebles')}}">Muebles</a>
                    </div>
                    <div class="col-4 ">
                        <a type="button" style="width: 66%" class="btn madera"
                            href="{{route('admin_visualizar_especifico',$tabla='planchas_construccion')}}">Planchas</a>
                    </div>
                    <div class="col-4 ">
                        <a type="button" style="width: 66%" class="btn madera"
                            href="{{route('admin_visualizar_especifico',$tabla='techumbres')}}">Techumbre</a>
                    </div>
                </div>
                {{-- Inventario --}}
                <div class="row justify-content-center text-center mt-3">
                    <div class="col-4 ">
                        <a type="button" style="width: 66%" class="btn productos"
                            href="{{route('admin_visualizar_especifico',$tabla='productos')}}">Productos</a>
                    </div>
                    <div class="col-4 ">
                        <a type="button" style="width: 66%" class="btn productos"
                            href="{{route('admin_visualizar_especifico',$tabla='sucursal_producto')}}">Inventario</a>
                    </div>
                    <div class="col-4 ">
                        <a type="button" style="width: 66%" class="btn productos"
                            href="{{route('admin_visualizar_especifico',$tabla='inventarios')}}">Sucursales</a>
                    </div>
                </div>
                {{-- Ventas --}}
                <div class="row justify-content-center text-center mt-3">
                    <div class="col-4 ">
                        <a type="button" style="width: 66%" class="btn informacion"
                            href="{{route('admin_visualizar_especifico',$tabla='ventas')}}">Ventas</a>
                    </div>
                    <div class="col-4 ">
                        <a type="button" style="width: 66%" class="btn informacion"
                            href="{{route('admin_visualizar_especifico',$tabla='detalle_ventas')}}">Detalle ventas</a>
                    </div>
                    <div class="col-4 ">
                        <a type="button" style="width: 66%" class="btn informacion"
                            href="{{route('admin_visualizar_especifico',$tabla='fotos')}}">Fotos</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>




@endsection