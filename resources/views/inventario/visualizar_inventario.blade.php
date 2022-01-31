<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventario</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="container">
		<header class="row">
			<div class="col">
				<h1>Inventario</h1>
			</div>
		</header>

		<section class="contenedor-main row align-items-center">
			<main class="col-md-8">
				<h2>Productos</h2>
                <form action="{{route('ver_detalle')}}" method="POST">
                    @csrf
                    @method('GET')
                    <div>
                        <select name="_producto" id="_producto">
                            <option selected>Escoja un producto</option>
                            @foreach ($productos as $item)
                            <option value="{{$item->familia}}">{{$item->familia}}</option>
                            @endforeach
                        </select>
                        <select name="_familia" id="_familia"></select>
                    </div>
                    <script>
                        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
                        document.getElementById('_producto').addEventListener('change',(e)=>{
                         fetch('familias',{
                            method : 'POST',
                            body: JSON.stringify({texto : e.target.value}),
                            headers:{
                                'Content-Type': 'application/json',
                                "X-CSRF-Token": csrfToken
                            }
                        }).then(response =>{
                            return response.json()
                        }).then( data =>{
                            var opciones ="<option value=''>Elegir</option>";
                            for (let i in data.lista) {
                               opciones+= '<option value="'+data.lista[i].id+'">'+data.lista[i].nombre+'</option>';
                            }
                            document.getElementById("_familia").innerHTML = opciones;
                        }).catch(error =>console.error(error));
                    })
                </script>
                
                <br>
                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" name="action" value="detalle">Detalle</button>
                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" name="action" value="realizar_venta">Realizar Venta</button>
                </form>
			</main>

            <aside class="col-md-4">
                <div class="row justify-content-between">
                    <div class="col-12 col-md-4 col-lg-3">
                        <!--Mensaje de stock con exito -->
                        @if (session()->has('correcto_eliminado'))
                            <div class="alert alert-success">
                                {{ session()->get('correcto_eliminado') }}
                            </div><br>
                        @endif
                    </div>        
                </div>
            </aside>
		</section>
	</div>
    
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>