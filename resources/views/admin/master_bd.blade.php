<!DOCTYPE html>
<html lang="en">

  
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    
    <title>Base de Datos</title>

   

  <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/sidebars.js') }}"></script>
  <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap-datepicker.es.min.js') }}"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css"> 
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/r-2.2.9/datatables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css"> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="{{ asset('css/sidebars.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.min.css') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/logoarbol.png') }}">

  <!-- estilos dashboard  -->
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

        .tabla-h-scroll {
            height: 750px !important;
            overflow: scroll;
        }

        .col-form-izq {
            height: 400px;
            align-self: center;
            margin-bottom: 13px;
            
        }
        
        .form-izq {
            display: flex;
            justify-content: center;
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
            justify-content: center;
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

        .item-details > .item-price {
          margin: 0;
        }

      
        .floatRight{
        float:right;
        margin-left:10px;
        margin-right:10px;
        }

        .dataTables_length {
        float:left;
        font-size: 15px;
        }	

        .buttons-excel {
          font-size: 12.5px;
        }

        .buttons-print {
          font-size: 12.5px;
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

      .madera {
        background-color: #007373;
        color: white;
      }
      .madera:hover {
        background-color: #006767;
        color: white;
      }

      .informacion {
        background-color: #009999;
        color: white;
      }
      .informacion:hover {
        background-color: #008989;
        color: white;
      }
      
      .provedor {
        background-color: #004040;
        color: white;
      }
      .provedor:hover {
        background-color: #195353;
        color: white;
      }
      
      .usuarios {
        background-color: #002626;
        color: white;
      }
      .usuarios:hover {
        background-color: #193b3b;
        color: white;
      }
      .productos {
        background-color: #009999;
        color: white;
      }
      .productos:hover {
        background-color: #008989;
        color: white;
      }

    }

    .tabla-scroll {
      height: 250px !important;
      overflow: scroll;
    }

    .col-form-izq {
      height: 400px;
      align-self: center;

    }

    .form-izq {
      display: flex;
      justify-content: center;
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

    .madera {
      background-color: #007373;
      color: white;
    }

    .madera:hover {
      background-color: #006767;
      color: white;
    }

    .informacion {
      background-color: #009999;
      color: white;
    }

    .informacion:hover {
      background-color: #008989;
      color: white;
    }

    .provedor {
      background-color: #004040;
      color: white;
    }

    .provedor:hover {
      background-color: #195353;
      color: white;
    }

    .usuarios {
      background-color: #002626;
      color: white;
    }

    .usuarios:hover {
      background-color: #193b3b;
      color: white;
    }

    .productos {
      background-color: #009999;
      color: white;
    }

    .productos:hover {
      background-color: #008989;
      color: white;
    }
  </style>


</head>

<body>
  <main>
    <div class="d-flex flex-column flex-shrink-0 p-3 no-shrink text-white bg-dark" style="width: 230px ;">
      <a href="{{route('inicio')}}"
        class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
          <use xlink:href="#arbol" />
        </svg>
        <strong style="font-size: 24px">RAFA Woods</strong>
      </a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="{{route('inicio')}}" class="nav-link text-white" aria-current="page">
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
          <a href="{{route('menu_bd')}}" class="nav-link active">
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
          <svg class="bi me-2" width="20" height="20">
            <use xlink:href="#persona" />
          </svg>
          <strong>{{Auth::user()->nombre}}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
          <form action="{{route('logout')}}" method="POST">
            @csrf
            <li><a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
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

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script> 
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/r-2.2.9/datatables.min.js"></script>

	<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script> {{-- Necesario para ver los botones --}} 
	<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script> {{-- Necesario para ver los botones --}} 
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> {{-- Excel --}} 
	<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script> {{-- Imprimir(PDF) --}}
 

</body>

</html>