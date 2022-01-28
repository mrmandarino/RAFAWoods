<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS  --->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <style>
        body {
            background: #f2f2f2;
            font-size: 16px;
            font-family: 'Open Sans', sans-serif;
        }

        a {
            text-decoration: none;
        }

        /* --- --- BARRA LATERAL --- --- */
        .barra-lateral {
            background: #262a34;
            color: #fff;
            min-width: 300px;
            min-height: 100vh;
        }

        .barra-lateral a {
            color: #fff;
        }

        /* --- LOGO --- */
        .barra-lateral .logo {
            background: #0275db;
        }

        .barra-lateral .logo h2 {
            font-size: 30px;
            font-family: 'Roboto', sans-serif;
            text-align: center;
            font-weight: 300;
        }

        /* --- MENU --- */
        .barra-lateral .menu a {
            display: block;
            padding: 20px;
            font-family: 'Roboto', sans-serif;
            font-weight: 500;
            border-bottom: 1px solid rgba(255, 255, 255, .1);
        }

        .barra-lateral .menu a:hover {
            background: #35ae6b;
        }

        .barra-lateral .menu a svg {
            margin-right: 10px;
        }


        /* --- --- MAIN --- --- */
        .main {
            padding-top: 40px;
        }

        .main .columna {
            padding: 0 40px;
        }

        .main .titulo {
            color: #262a34;
            font-size: 25px;
            font-weight: 500;
            font-family: 'Roboto', sans-serif;
            margin-bottom: 20px;
        }

        .main .widget {
            margin-bottom: 40px;
        }

        /* --- Widget Nueva Entrada --- */
        .main .nueva_entrada form input[type="text"],
        .main .nueva_entrada form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            font-family: 'Open Sans', sans-serif;
            border: none;
            box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, .2);
        }


        .main .nueva_entrada form textarea {
            height: 400px;
            min-height: 200px;
            max-width: 100%;
            min-width: 100%;
        }


        .main .nueva_entrada button {
            background: #0275d8;
            cursor: pointer;
            color: #fff;
            font-family: 'Roboto', sans-serif;
            font-size: 18px;
            font-weight: 500;
            border: none;
            display: inline-block;
            padding: 10px;
            width: 200px;
            border-radius: 3px;
            transition: .3s ease all;
        }

        .main .nueva_entrada button:hover {
            background: #025aa5;
        }

        .main .nueva_entrada button svg {
            margin-right: 10px;
        }

        /* --- Widget Estadisticas --- */
        .main .estadisticas .contenedor {
            box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, .2);
        }

        .main .estadisticas .caja {
            background: #fff;
            border: 1px solid #e3e3e3;
            padding: 40px 20px;
            flex: 1;
            text-align: center;
            font-family: 'Roboto', sans-serif;
        }

        .main .estadisticas .caja h3 {
            margin-bottom: 10px;
            color: #35ae6b;
        }

        .main .estadisticas .caja p {
            color: #a8a8a8;
            margin-bottom: 0;
        }

        .main .estadisticas .caja:first-child {
            border-right: none;
        }

        .main .estadisticas .caja:last-child {
            border-left: none;
        }

        /* --- Widget Comentarios --- */
        .main .comentarios .contenedor {
            box-shadow: 0px 0px 2px 0px rgba(0, 0, 0, .2);
        }

        .main .comentarios .comentario {
            background: #fff;
            padding: 20px;
            border-bottom: 1px solid #dfdfdf;
        }

        .main .comentarios .comentario .foto {
            width: 64px;
            height: 64px;
            overflow: hidden;
            margin-right: 20px;
            border-radius: 100px;
        }

        .main .comentarios .comentario .foto a {
            display: inline-block;
        }

        .main .comentarios .comentario .foto img {
            width: 100%;
            vertical-align: top;
        }

        .main .comentarios .comentario .texto {
            flex: 1;
        }

        .main .comentarios .comentario .texto .texto-comentario {
            font-size: 14px;
            font-family: 'Open Sans', sans-serif;
        }

        .main .comentarios .comentario .botones button {
            background: none;
            cursor: pointer;
            color: #fff;
            font-family: 'Roboto', sans-serif;
            font-size: 14px;
            font-weight: 500;
            border: none;
            display: inline-block;
            padding: 5px 10px;
            border-radius: 3px;
            transition: all .3s ease;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .main .comentarios .comentario .botones .aprobar {
            background: #35ae6b;
        }

        .main .comentarios .comentario .botones .eliminar {
            background: #b74848;
        }

        .main .comentarios .comentario .botones .bloquear {
            color: #acacac;
        }

        .main .comentarios .comentario .botones .aprobar:hover {
            background: #449d44;
        }

        .main .comentarios .comentario .botones .eliminar:hover {
            background: #c9302c;
        }

        .main .comentarios .comentario .botones .bloquear:hover {
            color: #fff;
            background: #acacac;
        }


        /* --- MEDIAQUERIES ---  */
        /* Dispositivo xs */
        @media screen and (max-width: 320px) {}

        /* Dispositivo sm */
        @media screen and (max-width: 576px) {
            .barra-lateral {
                min-height: auto;
            }
        }

        /* Dispositivo md */
        @media screen and (max-width: 768px) {
            .main .comentarios .comentario .botones button {
                width: 100%;
            }
        }

        /* Dispositivo lg */
        @media screen and (max-width: 992px) {}

        /* Dispositivo xl */
        @media screen and (max-width: 1200px) {
            .barra-lateral {
                min-width: auto;
            }

            .barra-lateral .logo {
                display: none;
            }

            .barra-lateral .menu a svg {
                display: none;
            }

            .main .comentarios .comentario .foto {
                width: 30px;
                height: 30px;
            }
        }

        /* Dispositivo xxl */
        @media screen and (max-width: 1400px) {}

    </style>
    <title>Realizar Venta</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <aside class="barra-lateral col-12 col-sm-auto p-0">
                <div class="logo">
                    <h2 class="py-4 m-0">Dashboard</h2>
                </div>
                <nav class="menu d-flex d-sm-block justify-content-center flex-wrap">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-house-door-fill" viewBox="0 0 16 16">
                            <path
                                d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z" />
                        </svg>
                        Inicio
                    </a>
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-file-earmark-text-fill" viewBox="0 0 16 16">
                            <path
                                d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1h-4z" />
                        </svg>
                        Entradas
                    </a>
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            <path fill-rule="evenodd"
                                d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z" />
                            <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                        </svg>
                        Usuarios
                    </a>
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-gear-fill" viewBox="0 0 16 16">
                            <path
                                d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                        </svg>
                        Configuracion
                    </a>
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                            <path fill-rule="evenodd"
                                d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                        </svg>
                        Salir
                    </a>

                </nav>
            </aside>

            <main class="main col">
                <div class="row">
                    <div class="columna col-12 col-lg-7">
                        <div class="widget nueva_entrada">
                            <h3 class="titulo">Nueva Entrada</h3>
                            <form action="">
                                <input type="text" placeholder="Titulo de la entrada" />
                                <textarea
                                    placeholder="Lorem, ipsum dolor sit amet consectetur adipisicing elit. Rem, ab!"></textarea>
                                <div class="d-flex justify-content-end">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                        </svg>
                                        Enviar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="columna col-12 col-lg-5">
                        <div class="widget estadisticas">
                            <h3 class="titulo">Estadisticas</h3>
                            <div class="contenedor d-flex flex-wrap">
                                <div class="caja">
                                    <h3>15,236</h3>
                                    <p>Visitas</p>
                                </div>
                                <div class="caja">
                                    <h3>1,831</h3>
                                    <p>Registros</p>
                                </div>
                                <div class="caja">
                                    <h3>$160,545</h3>
                                    <p>Ingresos</p>
                                </div>
                            </div>
                        </div>

                        <div class="widget comentarios">
                            <h3 class="titulo">Comentarios</h3>
                            <div class="contenedor">
                                <div class="comentario d-flex flex-wrap">
                                    <div class="foto">
                                        <a href="#">
                                            <img src="img/persona1.jpg" alt="" width="100">
                                        </a>
                                    </div>

                                    <div class="texto">
                                        <a href="#">John Doe</a>
                                        <p>en <a href="#">Mi primera entrada</a></p>
                                        <p class="texto-comentario">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam
                                            repellendus itaque optio dolores nemo at eveniet molestias delectus, magni
                                            consectetur.
                                        </p>
                                    </div>

                                    <div class="botones d-flex justify-content-start flex-wrap w-100">
                                        <button class="aprobar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                                <path
                                                    d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z" />
                                            </svg>
                                            Aprobar
                                        </button>
                                        <button class="eliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                            </svg>
                                            Eliminar
                                        </button>
                                        <button class="bloquear">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                <path
                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                            </svg>
                                            Bloquear
                                        </button>
                                    </div>
                                </div>

                                <div class="comentario d-flex flex-wrap">
                                    <div class="foto">
                                        <a href="#">
                                            <img src="img/persona2.jpg" alt="" width="100">
                                        </a>
                                    </div>

                                    <div class="texto">
                                        <a href="#">John Doe</a>
                                        <p>en <a href="#">Mi primera entrada</a></p>
                                        <p class="texto-comentario">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam
                                            repellendus itaque optio dolores nemo at eveniet molestias delectus, magni
                                            consectetur.
                                        </p>
                                    </div>

                                    <div class="botones d-flex justify-content-start flex-wrap w-100">
                                        <button class="aprobar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                                <path
                                                    d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z" />
                                            </svg>
                                            Aprobar
                                        </button>
                                        <button class="eliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                            </svg>
                                            Eliminar
                                        </button>
                                        <button class="bloquear">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                <path
                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                            </svg>
                                            Bloquear
                                        </button>
                                    </div>
                                </div>

                                <div class="comentario d-flex flex-wrap">
                                    <div class="foto">
                                        <a href="#">
                                            <img src="img/persona3.jpg" alt="" width="100">
                                        </a>
                                    </div>

                                    <div class="texto">
                                        <a href="#">John Doe</a>
                                        <p>en <a href="#">Mi primera entrada</a></p>
                                        <p class="texto-comentario">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam
                                            repellendus itaque optio dolores nemo at eveniet molestias delectus, magni
                                            consectetur.
                                        </p>
                                    </div>

                                    <div class="botones d-flex justify-content-start flex-wrap w-100">
                                        <button class="aprobar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                                <path
                                                    d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z" />
                                            </svg>
                                            Aprobar
                                        </button>
                                        <button class="eliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                            </svg>
                                            Eliminar
                                        </button>
                                        <button class="bloquear">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                <path
                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                            </svg>
                                            Bloquear
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>


    <!-- JS  --->
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>
