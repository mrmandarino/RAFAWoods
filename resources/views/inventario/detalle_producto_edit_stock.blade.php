<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/estilos.css">
	<title>Stock Producto</title>
</head>
<body>
	<div class="container">
		<header class="row">
			<div class="col">
				<h1>Stock {{$producto_en_bruto->nombre}}</h1>
			</div>
		</header>

        <section class="contenedor-main row align-items-center">
			<main class="col-md-8">
				<p>Stock Actual: {{$producto_en_stock->stock}}</p>
			</main>
		</section>

        <div class="container">
            <div class="row mt-3">
                <div class="col-6">
                    <form action="{{route('ver_detalle_stock_actualizado',$producto_en_bruto->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="titulo_stock" class="form-label" style="color:black">Ingrese el stock deseado</label>
                            <input type="number" min={{$producto_en_stock->stock}} class="form-control" name="stock" id="stock" required>
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="return confirm('¿Estás seguro del stock ingresado?')">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
		

	</div>

	<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>