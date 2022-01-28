<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Base de datos</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
	<!-- Dropdown con enlace -->
	<div class="dropdown">
		<a class="btn btn-primary dropdown-toggle" type="button" id="dropdown-2" data-bs-toggle="dropdown" aria-expanded="false">
			Selecciona una tabla
		</a>
		<ul class="dropdown-menu" aria-labelledby="dropdown-2">
			<li><a href="{{route('admin_visualizar_especifico',$tabla='usuarios')}}" class="dropdown-item">usuarios</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='clientes')}} class="dropdown-item">clientes</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='trabajadores')}} class="dropdown-item">trabajadores</a></li>
			<li><a href="{{route('admin_visualizar_especifico',$tabla='madera_proveedores')}}" class="dropdown-item">ventas(proveedores)</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='transportes')}} class="dropdown-item">transportes(proveedores)</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='tornillos')}} class="dropdown-item">tornillos</a></li>
			<li><a href="{{route('admin_visualizar_especifico',$tabla='telefono_proveedores')}}" class="dropdown-item">telefonos(proveedores)</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='techumbres')}} class="dropdown-item">techumbres</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='proveedores')}} class="dropdown-item">proveedores</a></li>
			<li><a href="{{route('admin_visualizar_especifico',$tabla='productos')}}" class="dropdown-item">productos</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='planchas_construccion')}} class="dropdown-item">planchas de contrucción</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='muebles')}} class="dropdown-item">muebles</a></li>
			<li><a href="{{route('admin_visualizar_especifico',$tabla='maderas')}}" class="dropdown-item">maderas</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='sucursal_producto')}} class="dropdown-item">productos por inventario</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='inventarios')}} class="dropdown-item">inventarios</a></li>
			<li><a href="{{route('admin_visualizar_especifico',$tabla='fotos')}}" class="dropdown-item">fotos</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='ejecutivos')}} class="dropdown-item">ejecutivos(proveedores)</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='compras')}} class="dropdown-item">transacciones(venta a clientes)</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='clavos')}} class="dropdown-item">clavos</a></li>

							
		</ul>
	</div>

	<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
