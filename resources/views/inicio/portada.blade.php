<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Maderas RAFA</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
        integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style3.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/brands.min.js" integrity="sha512-oPuIMrT4JN6Cw359VQkuI0OPn1reFOKJm1YUOjXxgIzMmNMY7g4jenNcJdYcF3dt90WyNajzivr3vZFSzgqLow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/fontawesome.min.js" integrity="sha512-PoFg70xtc+rAkD9xsjaZwIMkhkgbl1TkoaRrgucfsct7SVy9KvTj5LtECit+ZjQ3ts+7xWzgfHOGzdolfWEgrw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/solid.min.js" integrity="sha512-wabaor0DW08KSK5TQlRIyYOpDrAfJxl5J0FRzH0dNNhGJbeUpHaNj7up3Kr2Bwz/abLvVcJvDrJL+RLFcyGIkg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>

    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>
    <style>
    
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
                <p>Accesos Directos</p>
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Home</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#">Home 1</a>
                        </li>
                        <li>
                            <a href="#">Home 2</a>
                        </li>
                        <li>
                            <a href="#">Home 3</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">About</a>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Pages</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Page 1</a>
                        </li>
                        <li>
                            <a href="#">Page 2</a>
                        </li>
                        <li>
                            <a href="#">Page 3</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">Portfolio</a>
                </li>
                <li>
                    <a href="#">Contact</a>
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
                    <button class="btn d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
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
                                    data-content="{{ 'lun:  9:00-19:00 <br /> mar:  9:00-19:00 <br /> mié:  9:00-19:00 <br /> jue:  9:00-19:00<br /> vie:  9:00-19:00 <br /> sáb:  9:00-19:00 <br /> dom:  10:00-14:00' }}"
                                    data-html="true" style="cursor: pointer">
                                    <i class="fas fa-clock"></i> Horarios</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>

            <h1 class="text-center" style="color: #004040 ;font-size: 70px">Maderas RAFA</h1>
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

            <h2 class="text-center" style="color: #004040">Productos</h2><br>
            <div class="d-flex flex-wrap">
                <div class="col-sm-4 col-sm-push-8">

                    <h4 class="text-center" style="color: #004040"><i class="fas fa-tree"></i> Madera <i
                            class="fas fa-tree"></i></h4>
                    <p class="text-center">madera pino: 1x2", 1x3", 1x4", 1x5", 1x6"..., 1x10" en 3,2m/4m</p>
                    <p class="text-center">madera pino: 2x1", 2x2" ,2x3", 2x4"... , 2x10" en 3,2m/4m</p>
                    <p class="text-center">cuartones: 3x3", 4x4" en 3,2m</p>
                    <p class="text-center">entre otros.</p>
                </div>
                <div class="col-sm-4 col-sm-push-8">

                    <h4 class="text-center" style="color: #004040"><i class="fas fa-couch"></i> Muebles <i
                            class="fas fa-couch"></i></h4>
                    <p class="text-center">muebles de interior: sillas, sillones, mesas, estantes, despensas, alacenas,
                        verduderos, catre 1 plaza, catre 2 plaza, literas, camarotes, tocadores, clóset, cómodas,
                        ventanas, puertas. </p>
                    <p class="text-center">muebles de terraza y jardín: silla de terraza, silla estilo playa, mesa de
                        terraza, pergolas, casas de perro, jaula para pájaros, cercas. </p>
                    <p class="text-center">muebles a pedido.</p>
                </div>
                <div class="col-sm-4 col-sm-push-8">

                    <h4 class="text-center" style="color: #004040"><i class="fas fa-toolbox"></i> Construcción <i
                            class="fas fa-toolbox"></i></h4>
                    <p class="text-center">techumbre.</p>
                    <p class="text-center">clavos, tornillos.</p>
                    <p class="text-center">aislación.</p>
                    <p class="text-center">mallas y alambres.</p>
                    <p class="text-center">tableros construcción.</p>
                </div>
            </div>

            <div class="line"></div>

            <h2 class="text-center" style="color: #004040">Acerca de Nostros</h2><br>
            <div class="row">
                <div class="col-12">
                    <h4 class="text-center" style="color: #004040"> Servicios </h4>

                    <p class="text-center">Ofrecemos varidas medidas de madera <b style='color:#004040 !important;'>al
                            por mayor y al detalle</b>, material de construcción, herramientas, trabajos en madera desde
                        muebles hasta <b style='color:#004040 !important;'>elaboraciones por pedido, </b>puede realizar
                        cotizaciones y enviarnos sus consultas a nuestros canales de comunicación en el apartado <b
                            style='color:#004040 !important;'>contacto.</b></p>

                    <h4 class="text-center" style="color: #004040"> Despacho </h4>

                    <p class="text-center">Ofrecemos despacho a las siguientes comunas <b
                            style='color:#004040 !important;'>Coquimbo, La Serena, Tongoy, Pan de Azúcar, Andacollo,
                            Ovalle.</b></p>

                </div>

            </div>

            <div class="line"></div>

            <h2 class="text-center" style="color: #004040">Cómo llegar</h2><br>
            <div class="row justify-content-center">

                <div class="mapouter">
                    <div class="gmap_canvas"><iframe width="1000" height="500" id="gmap_canvas"
                            src="https://maps.google.com/maps?q=maderas%20rafa%20coquimbo&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a
                            href="https://123movies-to.org"></a><br>
                        <style>
                            .mapouter {
                                position: relative;
                                text-align: right;
                                height: 500px;
                                width: 1000px;
                            }
                        </style><a href="https://www.embedgooglemap.net">embedgooglemap.net</a>
                        <style>
                            .gmap_canvas {
                                overflow: hidden;
                                background: none !important;
                                height: 500px;
                                width: 1000px;
                            }
                        </style>
                    </div>
                </div>

            </div>

            <div class="line"></div>

            <h2 class="text-center" style="color: #004040">Contacto</h2>
            <div class="row justify-content-center">
                <div class="col" style="align-items: center">

                    <p>
                        <h3 class="text-center" style="color: #004040"><i class="fas fa-phone"></i> Teléfono: <a href="tel:930939746">930939746</a></h3>
                    </p>
                    <p>
                        <h3  class="text-center align-items-center" style="color: #004040"><i class="fa-brands fa-whatsapp"></i> Whatsapp: <a class="nav-text" href="https://wa.me/56930939746">+56930939746</a></h3>
                    </p>
                    <p>
                        <h3 class="text-center" style="color: #004040"><i class="fas fa-envelope"></i> Gmail: maderas.rafa.coquimbo@gmail.cl</h3>
                    </p>
                </div>

            </div>

            <div class="line"></div>

            <h2 class="text-center" style="color: #004040">Dirección y Horario</h2>
            <div class="row justify-content-center">
                <div class="col" style="align-items: center">

                    <p>
                        <h3 class="text-center" style="color: #004040"><i class="fa-solid fa-location-dot"></i> Dirección: Ruta 43, sitio 8 , Pan de Azúcar, Coquimbo</h3>
                    </p>
                    <p>
                        <h3  class="text-center align-items-center" style="color: #004040"><i class="fa-solid fa-clock"></i> Horario:</h3>
                    </p>
                    <div class="row">
                        <div class="col">

                            <h4 class="text-center" style="color: #004040">Lunes: 9:00-19:00</h4>
                            <h4 class="text-center" style="color: #004040">Martes:	9:00-19:00</h4>
                            <h4 class="text-center" style="color: #004040">Miércoles: 9:00-19:00</h4>
                            <h4 class="text-center" style="color: #004040">Jueves: 9:00-19:00</h4>
                            <h4 class="text-center" style="color: #004040">Viernes: 9:00-19:00</h4>
                            <h4 class="text-center" style="color: #004040">Sábado: 9:00-19:00</h4>
                            <h4 class="text-center" style="color: #004040">Domingo: 10:00-14:00</h4>
                        </div>
                    </div>
                </div>

            </div>

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