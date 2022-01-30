<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Dashboard Ventas</title>

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
            height: 300px !important;
            overflow: scroll;
        }

    </style>

</head>

<body>
    <main>
        <div class="d-flex flex-column flex-shrink-0 p-3 no-shrink text-white bg-dark" style="width: 280px ;">
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
                <a href="#" class="nav-link text-white">
                  <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#speedometer2" />
                  </svg>
                  Dashboard
                </a>
              </li>
              <li>
                <a href="#" class="nav-link text-white">
                  <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#table" />
                  </svg>
                  Histórico de Ventas
                </a>
              </li>
              <li>
                <a href="#" class="nav-link text-white">
                  <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#grid" />
                  </svg>
                  Productos
                </a>
              </li>
              <li>
                <a href="#" class="nav-link text-white">
                  <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#inventario" />
                  </svg>
                  Inventario
                </a>
              </li>
              <li>
                <a href="#" class="nav-link text-white">
                  <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#basedatos" />
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
                <strong>mandarino</strong>
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




    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sidebars.js') }}"></script>
</body>

</html>
