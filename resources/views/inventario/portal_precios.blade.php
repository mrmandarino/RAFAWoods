<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/estilos.css">
	<title>Portal Precios</title>
</head>
<body>
	<div class="container">
		<header class="row">
			<div class="col">
				<h1>Precios Productos</h1>
			</div>
		</header>
        

        
	</div>

    <!--<div class="justify-center">
        <div class="grid grid-cols-4">
            <table class="table-auto divide-y divide-gray-500 col-span-4 col-start-1 border rounded-lg border-gray-300">
                <thead class="rounded-lg">
                    <tr class="bg-white">
                        <th class="text-center text-black"><p>Familia</p></th>
                        <th class="text-center text-black"><p>Nombre</p></th>
                        <th class="text-center text-black"><p>Stock</p></th>
                        <th class="text-center text-black"><p>Precio (IVA inlcuido)</p></th>  
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    <tr class="my-20">
                        <td class="whitespace-nowrap">
                            <p class="text-center text-black"></p>
                        </td>

                    <td class="whitespace-nowrap">
                        <p class="text-center text-black"></p>
                    </td>
                    <td class="whitespace-nowrap">
                        <p class="text-center text-black"></p>
                    </td>
                    
                    <td class="whitespace-nowrap">
                        <p class="text-center text-black"></p>
                    </td>
                </tr>
                    
                </tbody>
            </table>
        </div>
    </div>-->

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
            </div>
                <table class="table">
                    <thead class="bg-white divide-y">
                        <tr>
                            <th class="text-center text-black">Familia</th>
                            <th class="text-center text-black">Nombre</th>
                            <th class="text-center text-black">Stock</th>
                            <th class="text-center text-black">Precio (IVA incluido)</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach($productos_en_bruto as $producto_en_bruto)
                            <tr>
                                <td class="text-center text-black">{{$producto_en_bruto->familia}}</td>
                                <td class="text-center text-black">{{$producto_en_bruto->nombre}}</td>
                                @foreach ($productos_en_stock as $producto_en_stock )
                                @if ($producto_en_bruto->id == $producto_en_stock->producto_id)
                                <td class="text-center text-black">{{$producto_en_stock->stock}}</td>
                                <td class="text-center text-black">${{($producto_en_stock->precio_compra+($producto_en_stock->precio_compra*0.19))}}</td>
                                
                                @endif
                                    
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>

	<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>