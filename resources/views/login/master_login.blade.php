<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">



  <title>Inicio</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="{{ asset('css/sidebars.css') }}">
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

    .tabla-scroll {
      height: 250px !important;
      overflow: scroll;
    }

    .form-arriba {
      height: 400px;
      align-self: center;
    }

    .botones {

      align-self: center;
      justify-content: center;
    }

    .col-form-der {
      height: 400px;
      align-self: center;

    }

    .form-der {
      display: flex;
      justify-content: left;
    }


    #myInput {
      padding: 20px;
      margin-top: -6px;
      border: 0;
      border-radius: 0;
      background: #f1f1f1;
    }

    .item {
      border: 2px solid #000;
      padding: 10px;
      border-radius: 20px;
    }

    .item-title {
      text-transform: uppercase;
      text-align: center;
      font-weight: 600;
    }

    .item-image {
      height: 300px;
      width: 100%;
    }

    .item-details {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin: 20px 0px 15px;
    }

    .item-details>.item-price {
      margin: 0;
    }

    /* ? SHOPPING CART */
    .shopping-cart-items {
      padding: 20px 0px;
    }

    .shopping-cart-header {
      border-bottom: 1px solid #ccc;
    }

    .shopping-cart-image {
      max-width: 80px;
      border-radius: 20px;
    }

    .shopping-cart-quantity-input {
      max-width: 45px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background: #eee;
      padding: 5px;
    }

    .shopping-cart-total {
      min-height: 96px;
    }

    .row-carrito {
      display: flex;
      justify-content: right;
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>             

<body>
  <main>
    <div class="d-flex flex-column flex-shrink-0 p-3 no-shrink text-white bg-dark" style="width: 230px ;">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
          <use xlink:href="#accesos" />
        </svg>
        <span class="fs-4">Accesos Directos</span>
      </a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="{{route('inicio')}}" class="nav-link active" aria-current="page">
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#home" />
            </svg>
            Inicio
          </a>
        </li>
        <li>
          <a href="{{route('graficos')}}" class="nav-link text-white">
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#speedometer2" />
            </svg>
            Gráficos
          </a>
        </li>
        <li>
          <a href="{{route('ventas.create')}}" class="nav-link text-white">
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#dollar" />
            </svg>
            Realizar Venta
          </a>
        </li>
        <li>
          <a href="{{route('ver_historico')}}" class="nav-link text-white">
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#table" />
            </svg>
            Histórico de Ventas
          </a>
        </li>
        <li>
          <a href="{{route('ver_productos')}}" class="nav-link text-white">
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#grid" />
            </svg>
            Productos
          </a>
        </li>   
        <li>
          <a href="{{route('ver_inventario')}}" class="nav-link text-white">
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#inventario" />
            </svg>
            Inventario
          </a>
        </li>
        <li>
          <a href="{{route('menu_bd')}}" class="nav-link text-white">
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#server" />
            </svg>
            Base de Datos
          </a>
        </li>
      </ul>
      <hr>

      <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1"
          data-bs-toggle="dropdown" aria-expanded="false">
          <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
          <strong>{{Auth::user()->nombre}}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
          <li><a class="dropdown-item" href="#">New project...</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item" href="#">Profile</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="#">Cerrar Sesión</a></li>
        </ul>
      </div>
    </div>

    @yield('content')

  </main>

  <script>
    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $(".dropdown-menu li").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
      });
  </script>




  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/sidebars.js') }}"></script>
</body>

</html>