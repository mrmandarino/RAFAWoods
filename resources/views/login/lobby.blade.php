@extends('login.master_login')
@section('content')
@include('inventario.partials.iconos')

<div class="container">
    <div class="row mx-3 justify-content-center">
        <div class="col-md-7 card form-izq ml-3">
            <h4 class="text-center">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#inventario" />
                </svg>
                Inicio
            </h4>
        </div>
    </div>

</div>
@endsection