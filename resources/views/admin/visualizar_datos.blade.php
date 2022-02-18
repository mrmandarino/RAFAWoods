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
			<li><a href="{{route('admin_visualizar_especifico',$tabla='usuarios')}}" class="dropdown-item">Usuarios</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='clientes')}} class="dropdown-item">Clientes</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='trabajadores')}} class="dropdown-item">Trabajadores</a></li>
			<li><a href="{{route('admin_visualizar_especifico',$tabla='orden_compras')}}" class="dropdown-item">Orden de compras</a></li>
			<li><a href="{{route('admin_visualizar_especifico',$tabla='detalle_compras')}}" class="dropdown-item">Detalle de las compras</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='transportes')}} class="dropdown-item">Transportes(proveedores)</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='tornillos')}} class="dropdown-item">Tornillos</a></li>
			<li><a href="{{route('admin_visualizar_especifico',$tabla='telefono_proveedores')}}" class="dropdown-item">Teléfonos(proveedores)</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='techumbres')}} class="dropdown-item">Techumbres</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='proveedores')}} class="dropdown-item">Proveedores</a></li>
			<li><a href="{{route('admin_visualizar_especifico',$tabla='productos')}}" class="dropdown-item">Productos</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='planchas_construccion')}} class="dropdown-item">Planchas de contrucción</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='muebles')}} class="dropdown-item">Muebles</a></li>
			<li><a href="{{route('admin_visualizar_especifico',$tabla='maderas')}}" class="dropdown-item">Maderas</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='sucursal_producto')}} class="dropdown-item">Inventario</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='inventarios')}} class="dropdown-item">Sucursales</a></li>
			<li><a href="{{route('admin_visualizar_especifico',$tabla='fotos')}}" class="dropdown-item">Fotos</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='ejecutivos')}} class="dropdown-item">Ejecutivos(proveedores)</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='detalle_ventas')}} class="dropdown-item">Detalle de ventas</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='ventas')}} class="dropdown-item">Ventas</a></li>
			<li><a href={{route('admin_visualizar_especifico',$tabla='clavos')}} class="dropdown-item">Clavos</a></li>

							
		</ul>
	</div>

	<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>


