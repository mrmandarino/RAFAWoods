<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="{{ asset('images/logoarbol.png') }}">


    <title>Maderas RAFA</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
        integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style3.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/brands.min.js"
        integrity="sha512-oPuIMrT4JN6Cw359VQkuI0OPn1reFOKJm1YUOjXxgIzMmNMY7g4jenNcJdYcF3dt90WyNajzivr3vZFSzgqLow=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/fontawesome.min.js"
        integrity="sha512-PoFg70xtc+rAkD9xsjaZwIMkhkgbl1TkoaRrgucfsct7SVy9KvTj5LtECit+ZjQ3ts+7xWzgfHOGzdolfWEgrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/solid.min.js"
        integrity="sha512-wabaor0DW08KSK5TQlRIyYOpDrAfJxl5J0FRzH0dNNhGJbeUpHaNj7up3Kr2Bwz/abLvVcJvDrJL+RLFcyGIkg=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    <!--  jquery  -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    

    <style>
        .map-responsive {

            overflow: hidden;

            padding-bottom: 56.25%;

            position: relative;

            height: 0;

            margin-bottom: -9%;

        }

        .map-responsive iframe {

            left: 0;

            top: 0;

            height: 80%;

            width: 100%;

            position: absolute;

            justify-self: center;

        }
        
        
        .catalogo {
            background-color: #004040;
            color: white;
        }
        .catalogo:hover {
            background-color: #007373;
            color: white;
        }
        
    </style>
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div id="dismiss">
                <i class="fas fa-arrow-left"></i>
            </div>

            <div class="sidebar-header">
                <h3>Maderas</h3>
                <h3>RAFA</h3>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a class="nav-link" href="#inicio">Inicio</a>
                </li>
                <li>
                    <a class="nav-link" href="#productos">Productos</a>
                </li>
                <li>
                    <a href="#acerca-de-nosotros">Acerca de Nosotros</a>
                </li>
                <li>
                    <a href="#como-llegar">Cómo Llegar</a>
                </li>
                <li>
                    <a href="#elab">Elaboraciones</a>
                </li>
                <li>
                    <a href="#info">Informaciones</a>
                </li>
                <li>
                    <a href="{{route('ver_catalogo')}}">Catálogo</a>
                </li>
            </ul>
            <ul class="list-unstyled CTAs">
                <p>Acceso Empleados</p><br>
                <li>
                    <a class="download" href="{{route('login')}}">Iniciar Sesión</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-light">
                        <i class="fas fa-bars"></i>
                    </button>
                    <button class="btn btn-light d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-phone"></i>
                        <i class="fas fa-map-marker-alt"></i>
                        <i class="fas fa-clock"></i>

                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <a href="tel:930939746" class="nav-link">
                                    <i class="fas fa-phone"></i>
                                    Llamar
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="https://www.google.com/maps/dir//Maderas+RAFA/@-30.00953,-71.3274462,12z/data=!4m8!4m7!1m0!1m5!1m1!1s0x9691cd0956366347:0x1192635a2c0ecfb3!2m2!1d-71.257406!2d-30.0095485">
                                    <i class="fas fa-map-marker-alt"></i> Cómo llegar</a>
                            </li>
                            <li class="nav-item">
                                <a tabindex="0" data-trigger="focus" role="button" class="nav-link"
                                    data-container="body" data-toggle="popover" data-placement="bottom"
                                    data-content="{{ 'lun:  9:00-19:30 <br /> mar:  9:00-19:30 <br /> mié:  9:00-19:30 <br /> jue:  9:00-19:30<br /> vie:  9:00-19:30 <br /> sáb:  9:00-19:30 <br /> dom:  10:00-14:00' }}"
                                    data-html="true" style="cursor: pointer">
                                    <i class="fas fa-clock"></i> Horarios</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>

            @if (session()->has('inactivo'))
                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    {{ session()->get('inactivo') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <h1 class="text-center" id="inicio" style="color: #004040 ;font-size: 70px">Maderas RAFA</h1>
            <h4 class="text-center" style="color: #004040">Maderas en Coquimbo</h4>


            <!-- ========== Start carrusel ========== -->
            <div class="container">

                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block" src="{{ asset('images/portada1-1.jpeg') }}" style="width: 100%">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block " src="{{ asset('images/portada2-1.jpeg') }}" style="width: 100%">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block " src="{{ asset('images/portada3-1-1.jpeg') }}" style="width: 100%">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>

                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>

                    </a>
                </div>
            </div>
            <!-- ========== End carrusel ========== -->

            <div class="line"></div>

            <h2 class="text-center" id="productos" style="color: #004040">Productos</h2><br>
            <div class="d-flex flex-wrap">
                <div class="col-sm-4 col-sm-push-8">

                    <h4 class="text-center" style="color: #004040"><i class="fas fa-tree"></i> Madera <i
                            class="fas fa-tree"></i></h4>
                            <p class="text-center">Madera pino: 1x2", 1x3", 1x4", 1x5", 1x6, 1x7", 1x8", 1x9", 1x10" en 3,2m</p>
                            <p class="text-center">Madera pino: 2x2", 2x3", 2x4", 2x5", 2x6", 2x7", 2x8", 2x9", 2x10" en 3,2m</p>
                            <p class="text-center">Cuartones: 3x3", 4x4" en 3,2m</p>
                    <p class="text-center">Entre otros.</p>
                </div>
                <div class="col-sm-4 col-sm-push-8">

                    <h4 class="text-center" style="color: #004040"><i class="fas fa-couch"></i> Muebles <i
                            class="fas fa-couch"></i></h4>
                    <p class="text-center">Muebles de interior: sillas, sillones, mesas, estantes, despensas, alacenas,
                        verduleros, catre 1 plaza, catre 2 plaza, literas, camarotes, tocadores, clóset, cómodas,
                        ventanas, puertas. </p>
                    <p class="text-center">Muebles de terraza y jardín: silla de terraza, silla estilo playa, mesa de
                        terraza, pérgolas, casas de perro, jaula para pájaros, cercas. </p>
                    <p class="text-center">Muebles a pedido.</p>
                </div>
                <div class="col-sm-4 col-sm-push-8">

                    <h4 class="text-center" style="color: #004040"><i class="fas fa-toolbox"></i> Construcción <i
                            class="fas fa-toolbox"></i></h4>
                    <p class="text-center">Techumbre.</p>
                    <p class="text-center">Clavos, tornillos.</p>
                    <p class="text-center">Aislación.</p>
                    <p class="text-center">Mallas y alambres.</p>
                    <p class="text-center">Tableros construcción.</p>
                </div>
            </div>

            <div class="line"></div>

            <h2 class="text-center" id="acerca-de-nosotros" style="color: #004040">Acerca de Nostros</h2><br>
            <div class="row">
                <div class="col-12">
                    <h4 class="text-center" style="color: #004040"> Servicios </h4>

                    <p class="text-center">Ofrecemos varias medidas de madera <b style='color:#004040 !important;'>al
                            por mayor y al detalle</b>, material de construcción, herramientas, trabajos en madera desde
                        muebles hasta <b style='color:#004040 !important;'>elaboraciones por pedido, </b>puede realizar
                        cotizaciones y enviarnos sus consultas a nuestros canales de comunicación en el apartado <b
                            style='color:#004040 !important;'>contacto.</b></p>

                    <h4 class="text-center" style="color: #004040"> Despacho </h4>

                    <p class="text-center">Ofrecemos despacho a las siguientes comunas: <b
                            style='color:#004040 !important;'>Coquimbo, La Serena, Tongoy, Pan de Azúcar, Andacollo,
                            Ovalle.</b></p>

                </div>

            </div>

            <div class="line"></div>

            <h2 class="text-center" id="como-llegar" style="color: #004040" id="como-llegar">Cómo llegar</h2><br>

            <div class="map-responsive">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.951517427044!2d-71.2595946849447!3d-30.00954848189506!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9691cd0956366347%3A0x1192635a2c0ecfb3!2sMaderas%20RAFA!5e0!3m2!1ses-419!2scl!4v1646326921862!5m2!1ses-419!2scl"
                    width="1000" height="700" style="border:0;" frameborder="0"></iframe>
            </div>

            <div class="line"></div>

            <h2 class="text-center" id="elab" style="color: #004040">Elaboraciones</h2>
            
                <!-- ========== Start carrusel ========== -->
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-sm-7 col-m-12">

                            <div id="galeria" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block " src="{{ asset('images/elab1.jpeg') }}" style="width: 100%">
                                    </div>
                                    <div class="carousel-item ">
                                        <img class="d-block" src="{{ asset('images/elab2.jpeg') }}" style="width: 100%">
                                    </div>
                                    <div class="carousel-item ">
                                        <img class="d-block" src="{{ asset('images/elab3.jpeg') }}" style="width: 100%">
                                    </div>
                                    <div class="carousel-item ">
                                        <img class="d-block" src="{{ asset('images/elab4.jpeg') }}" style="width: 100%">
                                    </div>
                                    <div class="carousel-item ">
                                        <img class="d-block" src="{{ asset('images/elab5.jpg') }}" style="width: 100%">
                                    </div>
                
                                </div>
                                <a class="carousel-control-prev" href="#galeria" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        
                                </a>
                                <a class="carousel-control-next" href="#galeria" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
        
                                </a>
                                
                            </div>
                        
                        </div>
                    </div>


                    <div class="row justify-content-center mt-4 ">

                        <a type="button" class="btn catalogo" href="{{route('ver_catalogo')}}"> Ir a Cátalogo</a>
                    </div>
                </div>

                <!-- ========== End carrusel ========== -->

            



            <div class="line"></div>

            <h2 class="text-center" id="info" style="color: #004040">Contacto</h2>
            <div class="row justify-content-center">
                <div class="col" style="align-items: center">

                    <p>
                    <h5 class="text-center" style="color: #004040"><i class="fas fa-phone"></i> Teléfono: <a
                            href="tel:930939746">930939746</a></h5>
                    </p>
                    <p>
                    <h5 class="text-center align-items-center" style="color: #004040"><i
                            class="fa-brands fa-whatsapp"></i> Whatsapp: <a class="nav-text"
                            href="https://wa.me/56930939746">+56930939746</a></h5>
                    </p>
                    <p>
                    <h5 class="text-center" style="color: #004040"><i class="fas fa-envelope"></i> Gmail:
                        maderas.rafa.coquimbo@gmail.com</h5>
                    </p>
                </div>

            </div>

            <div class="line"></div>

            <h2 class="text-center" style="color: #004040">Dirección y Horario</h2>
            <div class="row justify-content-center">
                <div class="col" style="align-items: center">

                    <p>
                    <h5 class="text-center" style="color: #004040"><i class="fa-solid fa-location-dot"></i> Dirección:
                        Ruta 43, sitio 8 , Pan de Azúcar, Coquimbo.</h5>
                    </p>
                    <p>
                    <h5 class="text-center align-items-center" style="color: #004040"><i class="fa-solid fa-clock"></i>
                        Horario:</h5>
                    </p>
                    <div class="row">
                        <div class="col">
                            <h5 class="text-center" style="color: #004040">Lunes: 9:00-19:30</h5>
                            <h5 class="text-center" style="color: #004040">Martes: 9:00-19:30</h5>
                            <h5 class="text-center" style="color: #004040">Miércoles: 9:00-19:30</h5>
                            <h5 class="text-center" style="color: #004040">Jueves: 9:00-19:30</h5>
                            <h5 class="text-center" style="color: #004040">Viernes: 9:00-19:30</h5>
                            <h5 class="text-center" style="color: #004040">Sábado: 9:00-19:30</h5>
                            <h5 class="text-center" style="color: #004040">Domingo: 10:00-14:00</h5><br>
                        </div>
                    </div>
                </div>

            </div>
            <footer class="text-center text-white" style="background-color: #004040;">
                
                <!-- Copyright -->
                <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                 Copyright © 2022
                  <a class="text-white" href="https://mdbootstrap.com/">MADERAS RAFA SpA.</a>
                </div>
                <!-- Copyright -->
            </footer>

        </div>
    </div>

    <div class="overlay"></div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>
    <!-- jQuery Custom Scroller CDN -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js">
    </script>

    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>

    
    <script>
        $(function () {
        $('[data-toggle="popover"]').popover()
        })
        $('.popover-dismiss').popover({
        trigger: 'focus'
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>
    <script type="text/javascript">
        const span = document.querySelector("span");

        span.onclick = function() {
        document.execCommand("copy");
        }

        span.addEventListener("copy", function(event) {
        event.preventDefault();
        if (event.clipboardData) {
            event.clipboardData.setData("text/plain", "+56912345678");
            console.log(event.clipboardData.getData("text"))
        }
        });
    </script>
</body>

</html>