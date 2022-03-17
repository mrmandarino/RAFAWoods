<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Catalogo</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">
    <link rel="icon" type="image/png" href="{{ asset('images/logoarbol.png') }}">
    <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    
    

    <!-- Bootstrap core CSS -->
<link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">

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

      .btn-sidebar {
          position: fixed;
          top: 5px;
          left: 15px;
          height: 37px;
          width: 37px;
          text-align: center;
          background: #1e1e1e;
          border-radius: 3px;
          cursor: pointer;
          transition: left 0.4s ease;
          z-index: 1030
      }

      .btn-sidebar.click {
          left: 245px;
          z-index: 1030
      }

      .btn-sidebar span {
          color: white;
          font-size: 15px;
          line-height: 36px
          z-index: 1030
      }

      .btn-sidebar.click span:before {
          content: '\f00d'
      }

      .sidebar {
          position: fixed;
          width: 250px;
          height: 100%;
          left: -250px;
          background: #1e1e1e;
          transition: left 0.4s ease;
          z-index: 1030
      }

      .sidebar.show {
          left: 0px
      }

      .sidebar .text {
          color: white;
          font-size: 19px;
          font-weight: 600;
          line-height: 65px;
          text-align: center;
          background: #1e1e1e;
          letter-spacing: 1px
      }

      .nav_ul {
          background: #1e1e1e;
          height: 100%;
          width: 100%;
          list-style: none;
          padding-left: 10px
      }

      .nav_ul_li {
          line-height: 50px;
          border-top: 1px solid rgba(255, 255, 255, 0.1)
      }

      nav ul li:last-child {
          border-bottom: 1px solid rgba(255, 255, 255, 0.05)
      }

      .nav_ul_li_a {
          position: relative;
          color: white;
          text-decoration: none;
          font-size: 13px;
          padding-left: 14px;
          font-weight: 500;
          display: block;
          width: 100%;
          border-left: 3px solid transparent
      }

      nav ul li.active a {
          color: #15B2B2;
          background: #1e1e1e;
          border-left-color: #15B2B2
      }

      nav ul li a:hover {
          background: #1e1e1e
      }

      .feat-show {
          transition: all 0.5s
      }

      nav ul li.active ul {
          transition: all 0.5s
      }

      nav ul ul {
          position: static;
          display: none
      }

      nav ul.show {
          display: block;
          transition: all 0.5s
      }

      nav ul ul li {
          line-height: 42px;
          border-top: none
      }

      nav ul ul li a {
          font-size: 12px;
          color: #e6e6e6
      }

      nav ul li.active ul li a {
          color: #e6e6e6;
          background: #1e1e1e;
          border-left-color: transparent
      }

      .bg-black-insano{
          background: #1e1e1e;
      }

      .border-black-insano{
        border-color: #1e1e1e;
      }

      .bg-test{
          background: #B9B9B9;
      }

      a:hover {
          color: white!important
      }

      nav ul ul li a:hover {
          color: white !important;
          background: #004040 !important
      }

      nav ul li a span {
          position: absolute;
          top: 50%;
          right: 20px;
          transform: translateY(-50%);
          font-size: 15px;
          transition: transform 0.4s
      }

      nav ul li a span.rotate {
          transform: translateY(-50%) rotate(-180deg)
      }

      .margen {
        margin: 20px 20px 20px 20px;
      }

      .border-test {
        border-color: #e5e5e5;
        border-width: 0.2em;
      }


      /* .content {
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          color: #202020;
          z-index: -1;
          text-align: center
      } */

      .navbar-catalogo{
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem
      }

      .navbar-catalogo > .container,
      .navbar-catalogo > .container-fluid,
      .navbar-catalogo > .container-sm,
      .navbar-catalogo > .container-md,
      .navbar-catalogo > .container-lg,
      .navbar-catalogo > .container-xl,
      .navbar-catalogo > .container-xxl {
        display: flex;
        flex-wrap: inherit;
        align-items: center;
        justify-content: space-between;
      }

      .imagen-card{
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
      @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";
      .probando {
        font-family: 'Poppins', sans-serif;
      }

      .form-control-peruano {
        display: block;
        width: 100%;
        height: 120%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        background-color: #004040;
        background-clip: padding-box;
        border: 1px solid rgba(255, 255, 255, 0.05);
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;

      }

      .form-select-peruano:focus {
        border-color: rgba(255, 255, 255, 0.05);
        outline: 0;
      }

      .form-text-peruano {
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: white;
      }

      input::placeholder {
        color: white;
        font-size: 1.2em;
      }

      .btn-secondary-peruano {
        margin-top:4px;
        height: 33px;
        width: 50px;
        color: #fff;
        background-color: #6c757d;
        border-color: #6c757d;
      }
      
      .btn-secondary-peruano:hover {
        color: #fff;
        background-color: #5c636a;
        border-color: #565e64;
      }
    </style>

    
  </head>
  <body  class="bg-test">
    
<header> 
  <div class="navbar-catalogo navbar-dark fixed-top bg-black-insano shadow-sm d-flex justify-content-center" >
    <div class="container-fluid align-items-center">

      <span  class="navbar-brand d-flex mr-auto" style="color: #1e1e1e">
        
      </span>
      
      <a href="{{route('ver_catalogo')}}" class="navbar-brand mx-auto">
        <i class="fa fa-couch"><strong class="probando"> Catálogo</strong> <i class="fa fa-couch "> </i> </i>
      </a>
      
      <a href="{{route('/')}}" class="navbar-brand d-flex ml-auto" >
        <i class="fas fa-home"></i>
      </a>
    </div>
  </div>
</header>

{{-- SIDEBAR --}}
<div class="btn btn-sidebar"> 
  <span class="fas fa-bars" style="font-size: 20px;margin-top: 6px" ></span> 
</div>
<nav class="sidebar">
  <div class="text"  style="margin-bottom: -4% "> Maderas RAFA </div>    <ul class="main_side nav_ul">
    <form id="form_input_hidden_producto" action="{{route('ver_producto_intermedio')}}">
      @csrf
      <input  type="text" class="visually-hidden" name ="input_hidden_producto" id="input_hidden_producto">
      <button type="submit" class="visually-hidden" id="boton_automatico_producto"></button>
      <div class="btn-group">
        <input  type="text" class="form-control-peruano bg-black-insano border-black-insano form-text-peruano form-select-peruano" name="input_producto"  id="input_datalist_productos" placeholder="Buscar..." onchange="submit_formulario_producto()" >
        <button type="submit" class="btn btn-secondary-peruano" ><i class="fa fa-search"></i></button> 

      </div>
      
      </form>
        <li class="nav_ul_li"> <a class="nav_ul_li_a" href="#" id="1">Filtrar por precio<span class="fas fa-caret-down"></span> </a>
            <ul class="item-show-1 nav_ul">
              {{-- Filtro por precio --}}
                  <li class="nav_ul_li"><a class="nav_ul_li_a" name="tipo_filtro" id="tipo_filtro" value="ascendente" href="{{route('ver_filtro_intermedio',['familia'=>$familia,'tipo_filtro'=>"asc_precio"])}}">Menor a mayor precio</a></li>
                  <li class="nav_ul_li"><a class="nav_ul_li_a" name="tipo_filtro" id="tipo_filtro" value="descendente" href="{{route('ver_filtro_intermedio',['familia'=>$familia,'tipo_filtro'=>"des_precio"])}}">Mayor a menor precio</a></li>
            </ul>
        </li>
        <li class="nav_ul_li"> <a class="nav_ul_li_a" href="#" id="2">Filtrar por nombre <span class="fas fa-caret-down"></span> </a>
            <ul class="item-show-2 nav_ul">
                {{-- Filtro por alfabeto --}}
                <li class="nav_ul_li"><a class="nav_ul_li_a" name="tipo_filtro" id="tipo_filtro" value="ascendente" href="{{route('ver_filtro_intermedio',['familia'=>$familia,'tipo_filtro'=>"asc_alfb"])}}">(A-Z)</a></li>
                <li class="nav_ul_li"><a class="nav_ul_li_a" name="tipo_filtro" id="tipo_filtro" value="descendente" href="{{route('ver_filtro_intermedio',['familia'=>$familia,'tipo_filtro'=>"des_alfb"])}}">(Z-A)</a></li>
            </ul>
        </li>
        <li class="nav_ul_li"> <a class="nav_ul_li_a" href="#" id="3">Filtrar por familia <span class="fas fa-caret-down"></span> </a>
          <ul class="item-show-3 nav_ul">
            <li class="nav_ul_li"><a class="nav_ul_li_a" name="tipo_filtro" id="tipo_filtro" href="{{route('ver_catalogo_por_familia',[$familia='Tornillo'])}}">Tornillo</a></li>
            <li class="nav_ul_li"><a class="nav_ul_li_a" name="tipo_filtro" id="tipo_filtro" href="{{route('ver_catalogo_por_familia',[$familia='Plancha_construccion'])}}">Plancha de construcción</a></li>
            <li class="nav_ul_li"><a class="nav_ul_li_a" name="tipo_filtro" id="tipo_filtro" href="{{route('ver_catalogo_por_familia',[$familia='Techumbre'])}}">Techumbre</a></li>
            <li class="nav_ul_li"><a class="nav_ul_li_a" name="tipo_filtro" id="tipo_filtro" href="{{route('ver_catalogo_por_familia',[$familia='Mueble'])}}">Mueble</a></li>
            <li class="nav_ul_li"><a class="nav_ul_li_a" name="tipo_filtro" id="tipo_filtro" href="{{route('ver_catalogo_por_familia',[$familia='Madera'])}}">Madera</a></li>
            <li class="nav_ul_li"><a class="nav_ul_li_a" name="tipo_filtro" id="tipo_filtro" href="{{route('ver_catalogo_por_familia',[$familia='Clavo'])}}">Clavo</a></li>
            <li class="nav_ul_li"><a class="nav_ul_li_a" name="tipo_filtro" id="tipo_filtro" href="{{route('ver_catalogo_por_familia',[$familia='Herramienta'])}}">Herramienta</a></li>
            <li class="nav_ul_li"><a class="nav_ul_li_a" name="tipo_filtro" id="tipo_filtro" href="{{route('ver_catalogo_por_familia',[$familia='Otro'])}}">Otro</a></li>
            <li class="nav_ul_li"><a class="nav_ul_li_a" name="tipo_filtro" id="tipo_filtro" href="{{route('ver_catalogo_por_familia',[$familia='Todos los productos'])}}">Todos los productos</a></li>
          </ul>
      </li>
    </ul>
</nav>

{{-- END SIDEBAR --}}



<div class="container">
  <div class="header">

    <main>
      @if($tipo_filtro == "filtrar_alfabetico")
 {{-- Catalogo de productos --}}
  <div class="album py-5 bg-test" onload="carga_datos()">
  <div class="container bg-test">

    <div style="margin-bottom: 5% ">
    </div>

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" >

        {{-- Card No existe producto --}}
        @if ($productos_filtrados->total() == 0)
        <section class="py-5 text-center container">
          
          <div class="container" style="border: #B9B9B9">
            <img class="bg-test" src="\images\thinking.png" style="height:100%;width:100%">
            <div class="card-body">
              <b><p class="card-text probando">No se han encontrado resultados.</p></b>
                <div class="d-flex justify-content-center">
                    <div class="btn-group">
                        <a href="{{route('ver_catalogo_por_familia',[$familia='Todos los productos'])}}"><button id="volver_al_catalogo" type="button" class="btn btn-sm btn-secondary mt-2">Volver al catálogo</button></a>
                    </div>
                </div>
            </div>
          </div>
        </section>
        {{-- End card no existe producto --}}
        @else
          @foreach($productos_filtrados as $producto)
          @php
          $contador_aux = 0;
          for($i = 0;$i<$imagenes->count();$i++){
            if($imagenes[$i]->imagenable_id == $producto->id){
              $contador_aux++;
            }
          }
          @endphp
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card border-test shadow-sm ">
                @if ($contador_aux <= 0)
                <a href="#"><img src="\images\imagen_no_disponible.png" style="height:100%;width:100%" data-bs-toggle="modal" data-bs-target="#modal_detalle{{$producto->id}}"></a>
                @else
                  @foreach($imagenes as $imagen)
                  @if($imagen->imagenable_id == $producto->id)
                  <a href="#"><img src="\{{$imagen->url}}" style="height:100%;width:100%" data-bs-toggle="modal" data-bs-target="#modal_detalle{{$producto->id}}"></a>
                  
                  @break
                  @endif
                  @endforeach

                @endif
                <div class="card-body">
                  <small><b><p class="card-text">{{$producto->familia}}</p></b></small>
                  <p class="card-text">{{$producto->nombre}}</p>
                  
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <button id="{{$producto->id}}" type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal_detalle{{$producto->id}}">Ver Detalle</button>
                        </div>
                        @php
                          $numero_formateado = number_format($producto->precio_venta,0,',','.');
                        @endphp
                        <small class="text-muted">Precio: ${{$numero_formateado}}</small>
                        @if ($producto->stock == 0)
                        <small class="text-muted">Agotado</small>
                        @else
                        <small class="text-muted">Stock: {{$producto->stock}}</small>
                        @endif
                    </div>
                </div>
              </div>
            </div>
          
          <!-- Modal -->
          <div class="modal fade" id="modal_detalle{{$producto->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-body">
                  <!-- Carousel -->
                  <div id='carouselExampleIndicators{{$producto->id}}' class='carousel slide' data-bs-ride='carousel'>
                    <ol class='carousel-indicators '>
                      @for ($j = 0;$j<$contador_aux;$j++)
                      @if($j<=0)
                        <li
                        data-bs-target='#carouselExampleIndicators{{$producto->id}} '
                        data-bs-slide-to= {{$j}}
                        class='active'
                        ></li>
                      @else
                      <li
                        data-bs-target='#carouselExampleIndicators{{$producto->id}}'
                        data-bs-slide-to= {{$j}}
                        ></li>
                      @endif
                      @endfor
                    </ol>
                    
      
                    {{-- Imagenes --}}
                    <div class='carousel-inner'>
                      @if ($contador_aux <= 0)
                      <div class='carousel-item active'>
                        <img class='img-size' src="{{ asset('images\imagen_no_disponible.png') }}" style="height:100%;width:100%" alt='First slide' />
                      </div>
                      @else
                      @php
                        $contador_imgs = 0;
                      @endphp
                      @foreach ($imagenes as $imagen)
                      @if($imagen->imagenable_id == $producto->id && $contador_imgs <= 0)
                      @php
                        $contador_imgs++;
                      @endphp
                      <div class='carousel-item active'>
                        <img class='img-size' src="{{ asset($imagen->url) }}" alt='First slide' style="height:100%;width:100%" />
                      </div>
                      @else
                      @if ($imagen->imagenable_id == $producto->id) 
                      <div class='carousel-item'>
                        <img class='img-size' src="{{ asset($imagen->url) }}" alt='Second slide' style="height:100%;width:100%" />
                      </div>
                      @endif
                      @endif
                      @endforeach

                      @endif
                    </div>

                    @if ($contador_aux >= 2)
                      
                    <a
                    class='carousel-control-prev'
                    href='#carouselExampleIndicators{{$producto->id}}'
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
                      href='#carouselExampleIndicators{{$producto->id}}'
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
                  {{-- Información sobre el detalle del producto --}}
                  <div class="margen">

                  
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Nombre</label></b>
                    <input type="text" value="{{$producto->nombre}}" style="background-color:white" class="form-control" name="nombre" id="nombre" readonly></b>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Descripción</label></b>
                    <input type="text" value="{{$producto->descripcion}}" style="background-color:white" class="form-control" name="descripcion" id="descripcion" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Familia</label></b>
                    <input type="text" value="{{$producto->familia}}" style="background-color:white" class="form-control" name="familia" id="familia" readonly>
                  
                    @php
                      if($producto->familia != "Herramienta" && $producto->familia != "Otro")
                      {
                        $familia = App\Http\Controllers\EjecutivoController::detectar_nombre($producto->familia);
                        $producto_en_tabla = DB::table($familia)->where('producto_id', $producto->id)->first();
                      }
                    @endphp

                    @if ($producto->familia=="Madera" || $producto->familia=="Techumbre" || $producto->familia=="Plancha_construccion" || $producto->familia=="Mueble")
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Alto</label></b>
                    <input type="text" value="{{$producto_en_tabla->alto}}" style="background-color:white" class="form-control" name="alto" id="alto" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Ancho</label></b>
                    <input type="text" value="{{$producto_en_tabla->ancho}}" style="background-color:white" class="form-control" name="ancho" id="ancho" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Largo</label></b>
                    <input type="text" value="{{$producto_en_tabla->largo}}" style="background-color:white" class="form-control" name="largo" id="largo" readonly>
                    @endif

                    @if ($producto->familia=="Madera")
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Tipo Madera</label></b>
                    <input type="text" value="{{$producto_en_tabla->tipo_madera}}" style="background-color:white" class="form-control" name="tipo_madera" id="tipo_madera" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Tratamiento</label></b>
                    <input type="text" value="{{$producto_en_tabla->tratamiento}}" style="background-color:white" class="form-control" name="tratamiento" id="tratamiento" readonly>
                    @endif

                    @if ($producto->familia=="Clavo")
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Material</label></b>
                    <input type="text" value="{{$producto_en_tabla->material}}" style="background-color:white" class="form-control" name="material" id="material" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Cabeza</label></b>
                    <input type="text" value="{{$producto_en_tabla->cabeza}}" style="background-color:white" class="form-control" name="cabeza" id="cabeza" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Punta</label></b>
                    <input type="text" value="{{$producto_en_tabla->punta}}" style="background-color:white" class="form-control" name="punta" id="punta" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Longitud</label></b>
                    <input type="text" value="{{$producto_en_tabla->longitud}}" style="background-color:white" class="form-control" name="longitud" id="longitud" readonly>
                    @endif

                    @if ($producto->familia=="Techumbre" || $producto->familia=="Plancha_construccion")
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Material</label></b>
                    <input type="text" value="{{$producto_en_tabla->material}}" style="background-color:white" class="form-control" name="material" id="material" readonly>
                    @endif

                    @if ($producto->familia=="Tornillo")
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Cabeza</label></b>
                    <input type="text" value="{{$producto_en_tabla->cabeza}}" style="background-color:white" class="form-control" name="cabeza" id="cabeza" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Tipo Rosca</label></b>
                    <input type="text" value="{{$producto_en_tabla->tipo_rosca}}" style="background-color:white" class="form-control" name="tipo_rosca" id="tipo_rosca" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Separacion Rosca</label></b>
                    <input type="text" value="{{$producto_en_tabla->separacion_rosca}}" style="background-color:white" class="form-control" name="separacion_rosca" id="separacion_rosca" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Punta</label></b>
                    <input type="text" value="{{$producto_en_tabla->punta}}" style="background-color:white" class="form-control" name="punta" id="punta" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Rosca Parcial</label></b>
                    <input type="text" value="{{$producto_en_tabla->rosca_parcial}}" style="background-color:white" class="form-control" name="rosca_parcial" id="rosca_parcial" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Vastago</label></b>
                    <input type="text" value="{{$producto_en_tabla->vastago}}" style="background-color:white" class="form-control" name="vastago" id="vastago" readonly>
                    @endif
                  </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          @endif
      </div>
      <br>
      <div class="d-flex justify-content-end">
        {!! $productos_filtrados->links() !!}
      </div>
  </div>
</div>

    
      {{-- Filtro por precio --}}
      @else
{{-- Catalogo de productos --}}
<div class="album py-5 bg-test" onload="carga_datos()">
  <div class="container bg-test">

    <div style="margin-bottom: 5% ">
    </div>

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" >

        {{-- Card No existe producto --}}
        {{-- @if ($productos_filtrados->total() == 0) --}}
        @if ($productos_filtrados->total() == 0) 
        <section class="py-5 text-center container">
          <div class="container" style="border: #B9B9B9">
            <img class="bg-test" src="\images\thinking.png" style="height:100%;width:100%">
            <div class="card-body">
              <b><p class="card-text probando">No se han encontrado resultados.</p></b>
                <div class="d-flex justify-content-center">
                    <div class="btn-group">
                        <a href="{{route('ver_catalogo_por_familia',[$familia='Todos los productos'])}}"><button id="volver_al_catalogo" type="button" class="btn btn-sm btn-secondary mt-2">Volver al catálogo</button></a>
                    </div>
                </div>
            </div>
          </div>
        </section>
        {{-- End card no existe producto --}}
        @else
          @foreach($productos_filtrados as $producto)
          @php
          $contador_aux = 0;
          for($i = 0;$i<$imagenes->count();$i++){
            if($imagenes[$i]->imagenable_id == $producto->id){
              $contador_aux++;
            }
          }
          @endphp
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card border-test shadow-sm ">
                @if ($contador_aux <= 0)
                <a href="#"><img src="\images\imagen_no_disponible.png" style="height:100%;width:100%" data-bs-toggle="modal" data-bs-target="#modal_detalle{{$producto->id}}"></a>
                @else
                  @foreach($imagenes as $imagen)
                  @if($imagen->imagenable_id == $producto->id)
                  <a href="#"><img src="\{{$imagen->url}}" style="height:100%;width:100%" data-bs-toggle="modal" data-bs-target="#modal_detalle{{$producto->id}}"></a>
                  
                  @break
                  @endif
                  @endforeach

                @endif
                <div class="card-body">
                  <small><b><p class="card-text">{{$producto->familia}}</p></b></small>
                  <p class="card-text">{{$producto->nombre}}</p>
                  
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <button id="{{$producto->id}}" type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal_detalle{{$producto->id}}">Ver Detalle</button>
                        </div>
                        @if ($producto->familia == "Mueble")
                        @php
                        $numero_formateado = number_format($producto->precio_venta,0,',','.');
                        @endphp
                        <small class="text-muted">Precio: ${{$numero_formateado}}</small>
                        @endif
                        @if ($producto->stock == 0)
                        <small class="text-muted">Agotado</small>
                        @else
                        <small class="text-muted">Stock: {{$producto->stock}}</small>
                        @endif
                    </div>
                </div>
              </div>
            </div>
          
          <!-- Modal -->
          <div class="modal fade" id="modal_detalle{{$producto->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-body">
                  <!-- Carousel -->
                  <div id='carouselExampleIndicators{{$producto->id}}' class='carousel slide' data-bs-ride='carousel'>
                    <ol class='carousel-indicators '>
                      @for ($j = 0;$j<$contador_aux;$j++)
                      @if($j<=0)
                        <li
                        data-bs-target='#carouselExampleIndicators{{$producto->id}} '
                        data-bs-slide-to= {{$j}}
                        class='active'
                        ></li>
                      @else
                      <li
                        data-bs-target='#carouselExampleIndicators{{$producto->id}}'
                        data-bs-slide-to= {{$j}}
                        ></li>
                      @endif
                      @endfor
                    </ol>
                    
      
                    {{-- Imagenes --}}
                    <div class='carousel-inner'>
                      @if ($contador_aux <= 0)
                      <div class='carousel-item active'>
                        <img class='img-size' src="{{ asset('images\imagen_no_disponible.png') }}" style="height:100%;width:100%" alt='First slide' />
                      </div>
                      @else
                      @php
                        $contador_imgs = 0;
                      @endphp
                      @foreach ($imagenes as $imagen)
                      @if($imagen->imagenable_id == $producto->id && $contador_imgs <= 0)
                      @php
                        $contador_imgs++;
                      @endphp
                      <div class='carousel-item active'>
                        <img class='img-size' src="{{ asset($imagen->url) }}" alt='First slide' style="height:100%;width:100%" />
                      </div>
                      @else
                      @if ($imagen->imagenable_id == $producto->id) 
                      <div class='carousel-item'>
                        <img class='img-size' src="{{ asset($imagen->url) }}" alt='Second slide' style="height:100%;width:100%" />
                      </div>
                      @endif
                      @endif
                      @endforeach

                      @endif
                    </div>

                    @if ($contador_aux >= 2)
                      
                    <a
                    class='carousel-control-prev'
                    href='#carouselExampleIndicators{{$producto->id}}'
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
                      href='#carouselExampleIndicators{{$producto->id}}'
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
                  {{-- Información sobre el detalle del producto --}}
                  <div class="margen">

                  
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Nombre</label></b>
                    <input type="text" value="{{$producto->nombre}}" style="background-color:white" class="form-control" name="nombre" id="nombre" readonly></b>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Descripción</label></b>
                    <input type="text" value="{{$producto->descripcion}}" style="background-color:white" class="form-control" name="descripcion" id="descripcion" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Familia</label></b>
                    <input type="text" value="{{$producto->familia}}" style="background-color:white" class="form-control" name="familia" id="familia" readonly>
                  
                    @php
                      if($producto->familia != "Herramienta" && $producto->familia != "Otro")
                      {
                        $familia = App\Http\Controllers\EjecutivoController::detectar_nombre($producto->familia);
                        $producto_en_tabla = DB::table($familia)->where('producto_id', $producto->id)->first();
                      }
                    @endphp

                    @if ($producto->familia=="Madera" || $producto->familia=="Techumbre" || $producto->familia=="Plancha_construccion" || $producto->familia=="Mueble")
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Alto</label></b>
                    <input type="text" value="{{$producto_en_tabla->alto}}" style="background-color:white" class="form-control" name="alto" id="alto" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Ancho</label></b>
                    <input type="text" value="{{$producto_en_tabla->ancho}}" style="background-color:white" class="form-control" name="ancho" id="ancho" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Largo</label></b>
                    <input type="text" value="{{$producto_en_tabla->largo}}" style="background-color:white" class="form-control" name="largo" id="largo" readonly>
                    @endif

                    @if ($producto->familia=="Madera")
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Tipo Madera</label></b>
                    <input type="text" value="{{$producto_en_tabla->tipo_madera}}" style="background-color:white" class="form-control" name="tipo_madera" id="tipo_madera" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Tratamiento</label></b>
                    <input type="text" value="{{$producto_en_tabla->tratamiento}}" style="background-color:white" class="form-control" name="tratamiento" id="tratamiento" readonly>
                    @endif

                    @if ($producto->familia=="Clavo")
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Material</label></b>
                    <input type="text" value="{{$producto_en_tabla->material}}" style="background-color:white" class="form-control" name="material" id="material" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Cabeza</label></b>
                    <input type="text" value="{{$producto_en_tabla->cabeza}}" style="background-color:white" class="form-control" name="cabeza" id="cabeza" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Punta</label></b>
                    <input type="text" value="{{$producto_en_tabla->punta}}" style="background-color:white" class="form-control" name="punta" id="punta" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Longitud</label></b>
                    <input type="text" value="{{$producto_en_tabla->longitud}}" style="background-color:white" class="form-control" name="longitud" id="longitud" readonly>
                    @endif

                    @if ($producto->familia=="Techumbre" || $producto->familia=="Plancha_construccion")
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Material</label></b>
                    <input type="text" value="{{$producto_en_tabla->material}}" style="background-color:white" class="form-control" name="material" id="material" readonly>
                    @endif

                    @if ($producto->familia=="Tornillo")
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Cabeza</label></b>
                    <input type="text" value="{{$producto_en_tabla->cabeza}}" style="background-color:white" class="form-control" name="cabeza" id="cabeza" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Tipo Rosca</label></b>
                    <input type="text" value="{{$producto_en_tabla->tipo_rosca}}" style="background-color:white" class="form-control" name="tipo_rosca" id="tipo_rosca" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Separacion Rosca</label></b>
                    <input type="text" value="{{$producto_en_tabla->separacion_rosca}}" style="background-color:white" class="form-control" name="separacion_rosca" id="separacion_rosca" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Punta</label></b>
                    <input type="text" value="{{$producto_en_tabla->punta}}" style="background-color:white" class="form-control" name="punta" id="punta" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Rosca Parcial</label></b>
                    <input type="text" value="{{$producto_en_tabla->rosca_parcial}}" style="background-color:white" class="form-control" name="rosca_parcial" id="rosca_parcial" readonly>
                    <b><label for="recipient-name" class="col-form-label" style="color:black">Vastago</label></b>
                    <input type="text" value="{{$producto_en_tabla->vastago}}" style="background-color:white" class="form-control" name="vastago" id="vastago" readonly>
                    @endif
                  </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          @endif
      </div>
      <br>
      <div class="d-flex justify-content-end">
        {!! $productos_filtrados->links() !!}
      </div>
  </div>
</div>

      
      
      @endif
    </main>
  </div>
</div>



<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

<script>
  const textareas = document.getElementsByClassName('descripcion-producto');
  const botones = document.getElementsByClassName('btn-outline-secondary');



  function submit_formulario_familia()
  {
    //Actualizacion de ruta de formulario de familias
    const datalist_familia_productos = document.getElementById('datalist_familia_productos');
    const familia_seleccionada = document.querySelector('#input_datalist_familia_productos')
    const form_input_hidden = document.getElementById('form_input_hidden');
    const input_hidden = document.getElementById('input_hidden');
    const familia_datalist = familia_seleccionada.value;
    input_hidden.value = familia_datalist;
  }

  function submit_formulario_producto()
  {
    const datalist_productos = document.getElementById('datalist_productos');
    const producto_seleccionado = document.querySelector('#input_datalist_productos')
    const form_input_hidden_producto = document.getElementById('form_input_hidden_producto');
    const input_hidden_producto = document.getElementById('input_hidden_producto');
    const producto_datalist = producto_seleccionado.value;
    input_hidden_producto.value = producto_datalist;
  }

</script>

<script>
  $('.btn-sidebar').click(function(){
    $(this).toggleClass("click");
    $('.sidebar').toggleClass("show");
    });
    
    
    $('.sidebar ul li a').click(function(){
    var id = $(this).attr('id');
    $('nav ul li ul.item-show-'+id).toggleClass("show");
    $('nav ul li #'+id+' span').toggleClass("rotate");
    
    });
    
    $('nav ul li').click(function(){
    $(this).addClass("active").siblings().removeClass("active");
    });
  </script>

  </body>
</html>
