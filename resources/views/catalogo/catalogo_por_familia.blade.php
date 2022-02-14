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
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

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
        <strong>Album</strong>
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
    
  </section>


  {{-- Catalogo de productos --}}
  <div class="album py-5 bg-light" onload="carga_datos()">
    <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($productos as $producto)
            <div class="col">
                <div class="card shadow-sm">
                    @foreach($imagenes as $imagen)
                    @if($imagen->imagenable_id == $producto->id)
                    @php
                        $url_img = $imagen->url;
                        $url_img_fixed = str_replace("productos","images",$url_img);
                    @endphp 
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="305" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><image class="news__img" href="{{ asset($url_img_fixed) }}" height="315" width="420" ></svg> <!--height="300" width="420"  style="width:420; height:300"-->
                    @endif
                    @endforeach

                  
                  <div class="card-body">
                    <p class="card-text">{{$producto->nombre}}</p>
                    <p class="card-text">{{$producto->descripcion}}</p>
                      <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                              <button type="button" class="btn btn-sm btn-outline-secondary">Ver Detalle</button>
                          </div>
                          @foreach ($productos_en_stock as $producto_en_stock)
                          @if ($producto_en_stock->producto_id == $producto->id)
                          @php
                            $numero_formateado = number_format($producto_en_stock->precio_venta,0,',','.');
                          @endphp
                          <small class="text-muted">Precio: ${{$numero_formateado}}</small>
                          @if ($producto_en_stock->stock == 0)
                          <small class="text-muted">No hay stock</small>
                          @else
                          <small class="text-muted">Stock: {{$producto_en_stock->stock}}</small>
                          @endif
                          @endif
                          @endforeach
                      </div>
                  </div>
                </div>
              </div>
            @endforeach
        </div>
        <br>
        {{-- Paginador --}}
        <div class="d-flex justify-content-end">
          {!! $productos->links() !!}
        </div>
    </div>
  </div>

  
</main>


<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>


<script type="text/javascript">
function submit_formulario_familia()
  {
    //Actualizacion de ruta de formulario de familias
    const datalist_familia_productos = document.getElementById('datalist_familia_productos');
    const familia_seleccionada = document.querySelector('#input_datalist_familia_productos')
    const form_input_hidden = document.getElementById('form_input_hidden');
    const input_hidden = document.getElementById('input_hidden');
    const familia_datalist = familia_seleccionada.value;
    input_hidden.value = familia_datalist;

    // //Click automatico de datalist
    // const boton_automatico = document.getElementById('boton_automatico');
    // boton_automatico.click();
  }
</script>
  </body>
</html>
