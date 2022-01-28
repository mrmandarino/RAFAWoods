<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/estilos.css">
	<title>Detalle Producto</title>

    @if (session()->has('correcto'))
        <div class="font-medium text-md text-green-800 bg-green-200 px-16 py-4 rounded-md border">
            {{session()->get('correcto')}}
        </div>
    @endif
</head>
<body>
    
	<div class="container">
		<header class="row">
			<div class="col">
				<h1>Detalle {{$producto_en_bruto->nombre}}</h1>
			</div>
		</header>

		<section class="contenedor-main row align-items-center">
			<main class="col-md-8">
				<p>{{$producto_en_bruto->descripcion}}</p>
			</main>

			<aside class="col-md-4">
			</aside>
		</section>

		<section class="row widgets justify-content-between">
			<div class="col-12 col-md-4 col-lg-3">
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="width:90%">Editar Stock</button>
				<p class="d-none d-md-block d-lg-none">4 Columnas</p>
				<p class="d-block d-md-none">12 Columnas</p>

				<p>Permite modificar el stock actual del producto.</p>
			</div>

			<div class="col-12 col-md-4 col-lg-3">
				<p class="d-none d-lg-block"><button style="width:90%">Editar Producto</button></p>
				<p class="d-none d-md-block d-lg-none">4 Columnas</p>
				<p class="d-block d-md-none">12 Columnas</p>

				<p>Permite editar la información y características del producto actual.</p>
			</div>

			<div class="col-12 col-md-4 col-lg-3">
				<p class="d-none d-lg-block"><button style="width:90%">Eliminar Producto</button></p>
				<p class="d-none d-md-block d-lg-none">4 Columnas</p>
				<p class="d-block d-md-none">12 Columnas</p>

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat.</p>
			</div>
		</section>

	</div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel" style="color:black">Stock actual de {{$producto_en_bruto->nombre}}: {{$producto_en_stock->stock}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('ver_detalle_stock_actualizado',$producto_en_bruto->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label" style="color:black">Ingrese el stock deseado</label>
                  <input type="number" value={{$producto_en_stock->stock}} class="form-control" name="stock" id="stock" required>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary" onclick="return confirm('¿Estás seguro del stock ingresado?')">Confirmar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

	<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>