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
        top: 50%;
        bottom: 50%;
        left: 50%;
        right: 50%;
      }

    </style>

    
  </head>
  <body>
    
<header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">About</h4>
          <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">Contact</h4>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white">Follow on Twitter</a></li>
            <li><a href="#" class="text-white">Like on Facebook</a></li>
            <li><a href="#" class="text-white">Email me</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="#" class="navbar-brand d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
        <strong>Catálogo</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>

<main>

  {{-- Datalist de familia de productos --}}
  <section class="py-5 text-center container">
    @if (session()->has('familia_erronea'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h5 class="text-center" >{{ session()->get('familia_erronea') }} </h5>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session()->has('producto_erroneo'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <h5 class="text-center" >{{ session()->get('producto_erroneo') }} </h5>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <b><label style="text:black">Filtro por Familia</label></b>
    <form id="form_input_hidden" action="{{route('ver_catalogo_intermedio')}}">
      <input  type="text" class="visually-hidden" name ="input_hidden" id="input_hidden">
      <button type="submit" class="visually-hidden" id="boton_automatico"></button>
      <div class="row py-lg-5">
        <input class="form-control" list="datalist_familia_productos" id="input_datalist_familia_productos" placeholder="Buscar..." onchange="submit_formulario_familia()">
        <datalist id="datalist_familia_productos">
          @foreach ($productos_familia as $producto_familia )
            <option data-value="{{$producto_familia->familia}}">{{$producto_familia->familia}}</option>
          @endforeach
          <option data-value="Todos">Todos los productos</option>
        </datalist>
      </div>
    </form> 
    
    <b><label style="text:black">Buscador de producto</label></b>
    <form id="form_input_hidden_producto" action="{{route('ver_producto_intermedio')}}">
      <input  type="text" class="visually-hidden" name ="input_hidden_producto" id="input_hidden_producto">
      <button type="submit" class="visually-hidden" id="boton_automatico_producto"></button>
      <div class="row py-lg-5">
        <input class="form-control" list="datalist_productos" id="input_datalist_productos" placeholder="Buscar..." onchange="submit_formulario_producto()">
        <datalist id="datalist_productos">
          @foreach ($productos_totales as $producto_total )
            <option data-value="{{$producto_total->id}}">{{$producto_total->nombre}}</option>
          @endforeach
        </datalist>
      </div>
    </form>

          {{-- Filtro por precio --}}
      <div class="input-group mb-3">
        <label name="action" value="filtrar_precio" type="submit" class="input-group-text" style="background:white">Filtrar por precio</label>
        <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="visually-hidden">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu">
          <li><a name="tipo_filtro" id="tipo_filtro" value="ascendente" class="dropdown-item" href="{{route('ver_filtro_intermedio',['familia'=>$familia,'tipo_filtro'=>"asc_precio"])}}">Ascendente</a></li>
          <li><a name="tipo_filtro" id="tipo_filtro" value="descendente" class="dropdown-item" href="{{route('ver_filtro_intermedio',['familia'=>$familia,'tipo_filtro'=>"des_precio"])}}">Descendente</a></li>
        </ul>
      </div>


      {{-- Filtro por alfabeto --}}
      <div class="input-group mb-3">
        <label name="action" value="filtrar_precio" type="submit" class="input-group-text" style="background:white">Filtrar alfabéticamente</label>
        <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="visually-hidden">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu">
          <li><a name="tipo_filtro" id="tipo_filtro" value="ascendente" class="dropdown-item" href="{{route('ver_filtro_intermedio',['familia'=>$familia,'tipo_filtro'=>"asc_alfb"])}}">Ascendente</a></li>
          <li><a name="tipo_filtro" id="tipo_filtro" value="descendente" class="dropdown-item" href="{{route('ver_filtro_intermedio',['familia'=>$familia,'tipo_filtro'=>"des_alfb"])}}">Descendente</a></li>
        </ul>
      </div>

  </section>


  @if($tipo_filtro == "filtrar_alfabetico")
  {{-- Catalogo de productos --}}
  <div class="album py-5 bg-light" onload="carga_datos()">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($productos_filtrados as $producto)
            <div class="col">
                <div class="card shadow-sm">
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
                    <div
                        id='carouselExampleIndicators'
                        class='carousel slide'
                        data-bs-ride='carousel'>
                      <ol class='carousel-indicators '>
                        @php
                          $contador_aux = 0;
                          for($i = 0;$i<$imagenes->count();$i++){
                            if($imagenes[$i]->imagenable_id == $producto->id){
                              $contador_aux++;
                            }
                          }
                        @endphp
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
                        @php
                          $contador_imgs = 0;
                        @endphp
                        @foreach ($imagenes as $imagen)
                        @if($imagen->imagenable_id == $producto->id && $contador_imgs <= 0)
                        @php
                          $contador_imgs++;
                          $url_img = $imagen->url;
                          $url_img_fixed = str_replace("productos","images",$url_img);
                        @endphp
                        <div class='carousel-item active'>
                          <img class='img-size' src="{{ asset($url_img_fixed) }}" alt='First slide' />
                        </div>
                        @else
                        @if ($imagen->imagenable_id == $producto->id) 
                        @php
                          $url_img = $imagen->url;
                          $url_img_fixed = str_replace("productos","images",$url_img);
                        @endphp
                        <div class='carousel-item'>
                          <img class='img-size' src="{{ asset($url_img_fixed) }}" alt='First slide' />
                        </div>
                        @endif
                        @endif
                        @endforeach
                      </div>
                      <a
                        class='carousel-control-prev ajustarizquierdo'
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
                        class='carousel-control-next ajustarderecho'
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
                      
                        {{-- Información sobre el detalle del producto --}}
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
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
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
  <div class="album py-5 bg-light" onload="carga_datos()">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($productos_filtrados as $producto)
            <div class="col">
                <div class="card shadow-sm">
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
                    <div
                        id='carouselExampleIndicators'
                        class='carousel slide'
                        data-bs-ride='carousel'>
                      <ol class='carousel-indicators '>
                        @php
                          $contador_aux = 0;
                          for($i = 0;$i<$imagenes->count();$i++){
                            if($imagenes[$i]->imagenable_id == $producto->id){
                              $contador_aux++;
                            }
                          }
                        @endphp
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
                        @php
                          $contador_imgs = 0;
                        @endphp
                        @foreach ($imagenes as $imagen)
                        @if($imagen->imagenable_id == $producto->id && $contador_imgs <= 0)
                        @php
                          $contador_imgs++;
                          $url_img = $imagen->url;
                          $url_img_fixed = str_replace("productos","images",$url_img);
                        @endphp
                        <div class='carousel-item active'>
                          <img class='img-size' src="{{ asset($url_img_fixed) }}" alt='First slide' />
                        </div>
                        @else
                        @if ($imagen->imagenable_id == $producto->id) 
                        @php
                          $url_img = $imagen->url;
                          $url_img_fixed = str_replace("productos","images",$url_img);
                        @endphp
                        <div class='carousel-item'>
                          <img class='img-size' src="{{ asset($url_img_fixed) }}" alt='First slide' />
                        </div>
                        @endif
                        @endif
                        @endforeach
                      </div>
                      <a
                        class='carousel-control-prev '
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
                        class='carousel-control-next '
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
                      
                    </div>
                  </div>
                    {{-- Información sobre el detalle del producto --}}
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
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
        </div>
        <br>

        <div id="links" class="d-flex justify-content-end">
            {!! $productos_filtrados->links() !!}
        </div>
        
        

    </div>
  </div>
  @endif
    
  
</main>


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



  </body>
</html>
