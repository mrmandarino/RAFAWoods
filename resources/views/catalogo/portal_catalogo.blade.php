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

      .btn-sidebar {
          position: fixed;
          top: 10px;
          left: 45px;
          height: 37px;
          width: 37px;
          text-align: center;
          background: #1b1b1b;
          border-radius: 3px;
          cursor: pointer;
          transition: left 0.4s ease
      }

      .btn-sidebar.click {
          left: 260px
      }

      .btn-sidebar span {
          color: white;
          font-size: 15px;
          line-height: 36px
      }

      .btn-sidebar.click span:before {
          content: '\f00d'
      }

      .sidebar {
          position: fixed;
          width: 250px;
          height: 100%;
          left: -250px;
          background: #1b1b1b;
          transition: left 0.4s ease;
          z-index: 999
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
          background: #1b1b1b;
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
          background: #1b1b1b;
          border-left-color: transparent
      }

      .bg-black-insano{
          background: #1e1e1e;
      }

      .bg-test{
          background: #eaeaea;
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
        padding-bottom: 0.5rem;
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
    </style>

    
  </head>
  <body class="bg-test">
    
<header>
  
  <div class="navbar-catalogo navbar-dark fixed-top bg-black-insano shadow-sm" >
    <div class="container">
      <a href="#" class="navbar-brand d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
        <strong>Catálogo</strong>
      </a>
      
    
      <form id="form_input_hidden_producto" action="{{route('ver_producto_intermedio')}}">
        <input  type="text" class="visually-hidden" name ="input_hidden_producto" id="input_hidden_producto">
        <button type="submit" class="visually-hidden" id="boton_automatico_producto"></button>
          <input class="form-control" list="datalist_productos" id="input_datalist_productos" placeholder="Buscar..." onchange="submit_formulario_producto()">
          <datalist id="datalist_productos">
            @foreach ($productos_totales as $producto_total )
              <option data-value="{{$producto_total->id}}">{{$producto_total->nombre}}</option>
            @endforeach
          </datalist>
      </form>
    </div>
  </div>
</header>

{{-- SIDEBAR --}}
<div class="btn btn-sidebar"> <span class="fas fa-bars"></span> </div>
<nav class="sidebar">
    <div class="text"> Maderas RAFA </div>
    <ul class="main_side nav_ul">
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
  <div class="header "> 
      <main>
      {{-- Catalogo de productos --}}
      <div class="album py-5 bg-test" onload="carga_datos()">
        <div class="container bg-test">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach($productos as $producto)
                @php
                $contador_aux = 0;
                for($i = 0;$i<$imagenes->count();$i++){
                  if($imagenes[$i]->imagenable_id == $producto->id){
                    $contador_aux++;
                  }
                }
                @endphp
                <div class="col">
                    <div class="card shadow-sm">
                      @if ($contador_aux <= 0)
                      <a href="#"><svg data-bs-toggle="modal" data-bs-target="#modal_detalle{{$producto->id}}" class="bd-placeholder-img card-img-top" width="100%" height="305" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><image class="news__img" href="{{ asset('images\Imagen_no_disponible.svg.png') }}" height="315" width="420" ></svg></a>
                      @else
                        @foreach($imagenes as $imagen)
                        @if($imagen->imagenable_id == $producto->id)
                        @php
                            $url_img = $imagen->url;
                            $url_img_fixed = str_replace("productos","images",$url_img);
                        @endphp 
                        <a href="#"><svg data-bs-toggle="modal" data-bs-target="#modal_detalle{{$producto->id}}" class="bd-placeholder-img card-img-top" width="100%" height="305" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><image class="news__img" href="{{ asset($url_img_fixed) }}" height="315" width="420" ></svg></a>
                        
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
                              <img class='img-size' src="{{ asset('images\Imagen_no_disponible.svg.png') }}" alt='First slide' />
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
                              <img class='img-size' src="{{ asset($imagen->url) }}" alt='First slide' />
                            </div>
                            @else
                            @if ($imagen->imagenable_id == $producto->id) 
                            <div class='carousel-item'>
                              <img class='img-size' src="{{ asset($imagen->url) }}" alt='Second slide' />
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
            </div>
            <br>
            <div class="d-flex justify-content-end">
              {!! $productos->links() !!}
            </div>
        </div>
      </div>
    
      
        
      
    </main>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

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
