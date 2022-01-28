<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/estilos.css">
	<title>Detalle Producto</title>
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
				<p>Stock Actual: {{$prodcuto_en_stock->stock}}</p>
			</main>

			<aside class="col-md-4">
				<h3>ASIDE</h3>
				<p class="d-none d-md-block">4 Columnas</p>
				<p class="d-block d-md-none">12 Columnas</p>
			</aside>
		</section>

		<section class="row widgets justify-content-between">
			<div class="col-12 col-md-4 col-lg-3">
				<p class="d-none d-lg-block">3 Columnas</p>
				<p class="d-none d-md-block d-lg-none">4 Columnas</p>
				<p class="d-block d-md-none">12 Columnas</p>

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat.</p>
			</div>

			<div class="col-12 col-md-4 col-lg-3">
				<p class="d-none d-lg-block">3 Columnas</p>
				<p class="d-none d-md-block d-lg-none">4 Columnas</p>
				<p class="d-block d-md-none">12 Columnas</p>

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat.</p>
			</div>

			<div class="col-12 col-md-4 col-lg-3">
				<p class="d-none d-lg-block">3 Columnas</p>
				<p class="d-none d-md-block d-lg-none">4 Columnas</p>
				<p class="d-block d-md-none">12 Columnas</p>

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat.</p>
			</div>
		</section>

	</div>

	<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>