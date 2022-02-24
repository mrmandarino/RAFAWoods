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

    .b-example-divider {
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .dropdown-menu-m {
      position: static;
      display: block;
      width: auto;
      margin: 1rem auto;
    }

    .dropdown-menu-macos {
      display: grid;
      gap: .25rem;
      padding: .5rem;
      border-radius: .5rem;
    }

    .dropdown-menu-macos .dropdown-item {
      border-radius: .25rem;
    }

    .dropdown-item-danger {
      color: var(--bs-red);
    }
    .dropdown-item-success {
      color: var(--bs-green);
    }

    .dropdown-item-danger:hover,
    .dropdown-item-danger:focus {
      color: #fff;
      background-color: var(--bs-red);
    }
    .dropdown-item-success:hover,
    .dropdown-item-success:focus {
      color: #fff;
      background-color: var(--bs-green);
    }

    .dropdown-item-danger.active {
      background-color: var(--bs-red);
    }
    .dropdown-item-success.active {
      background-color: var(--bs-green);
    }

    .btn-hover-light {
      text-align: left;
      background-color: var(--bs-white);
      border-radius: .25rem;
    }

    .btn-hover-light:hover,
    .btn-hover-light:focus {
      color: var(--bs-blue);
      background-color: var(--bs-light);
    }

    .cal-month,
    .cal-days,
    .cal-weekdays {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      align-items: center;
    }

    .cal-month-name {
      grid-column-start: 2;
      grid-column-end: 7;
      text-align: center;
    }

    .cal-weekday,
    .cal-btn {
      display: flex;
      flex-shrink: 0;
      align-items: center;
      justify-content: center;
      height: 3rem;
      padding: 0;
    }

    .cal-btn:not([disabled]) {
      font-weight: 500;
    }

    .cal-btn:hover,
    .cal-btn:focus {
      background-color: rgba(0, 0, 0, .05);
    }

    .cal-btn[disabled] {
      opacity: .5;
    }

    .form-control-dark {
      background-color: rgba(255, 255, 255, .05);
      border-color: rgba(255, 255, 255, .15);
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
          <a href="#" class="nav-link active" aria-current="page">
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
          <form action="{{route('logout')}}" method="POST">
            @csrf
            <li><a class="dropdown-item" href="{{route('logout')}}"
              onclick="event.preventDefault();
                          this.closest('form').submit();">Cerrar Sesión</a></li>
          </form>
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