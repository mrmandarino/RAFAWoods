<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Base de datos</title>
	{{-- <link rel="stylesheet" href="/css/bootstrap.min.css"> --}}

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css"> 
	


</head>
<body>

	<div> 
		<a href="{{route('admin_crear_fila',$tabla)}}" class="btn btn-primary">CREAR</a> 
		&nbsp;&nbsp;
		<a href="{{route('admin_visualizar_datos')}}" class="btn btn-primary">VOLVER</a>
	</div>
		
		@if ($tabla == 'usuarios')
		
			<table id="usuarios" class="table" style="width:100%">
			
			<thead>
				<tr>
					<th> RUT </th>
					<th> NOMBRE </th>
					<th> APELLIDO </th>
					<th> PASSWORD </th>
					<th> CORREO </th>
					<th> TIPO USUARIO </th>
					<th> ESTADO </th>
					<th> FECHA REGISTRO </th>
					<th> FECHA ACTUALIZACION </th>
					<th> ACCION </th>
				</tr>
			</thead>
			<tbody>
				@foreach ($datos as $usuario)
					@if ($usuario->tipo_usuario!=1)
						<tr>
							<td> {{$usuario->rut}} </td>
							<td> {{$usuario->nombre}} </td>
							<td> {{$usuario->apellido}} </td>
							<td> {{$usuario->password}} </td>
							<td> {{$usuario->correo}} </td>
							<td> {{$usuario->tipo_usuario}} </td>
							<td> {{$usuario->estado}} </td>
							<td> {{$usuario->created_at}} </td>
							<td> {{$usuario->updated_at}} </td>
							<td> 
								<form action="{{route('admin_borrar_datos',['key' => $usuario->rut,'tabla' => $tabla])}}" method="GET" class="btn-group">
									<a href="{{route('admin_editar_fila',['key' => $usuario->rut,'tabla' => $tabla])}}" class="btn btn-info">Editar</a> 
									&nbsp;&nbsp;&nbsp;&nbsp;
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-danger">Eliminar</button>
								</form>
							</td>	
						</tr>
					@endif
					
						
				@endforeach
			</tbody>
	
		@endif

		@if ($tabla == 'clientes')
			<table id="clientes" class="table" style="width:100%">
			<thead>
				<tr>
					<th> RUT </th>
					<th> TELEFONO </th>
					<th> FECHA REGISTRO </th>
					<th> FECHA ACTUALIZACION </th>
					<th> ACCION </th>
				</tr>
			</thead>
			<tbody>
				@foreach ($datos as $cliente)
					<tr>
						<td> {{$cliente->usuario_rut}} </td>
						<td> {{$cliente->telefono}} </td>
						<td> {{$cliente->created_at}} </td>
						<td> {{$cliente->updated_at}} </td>
						<td> 
							<form action="{{route('admin_borrar_datos',['key' => $cliente->usuario_rut,'tabla' => $tabla])}}" method="GET" class="btn-group">
								<a href="{{route('admin_editar_fila',['key' => $cliente->usuario_rut,'tabla' => $tabla])}}" class="btn btn-info">Editar</a> 
								&nbsp;&nbsp;&nbsp;&nbsp;
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'trabajadores')
			<table id="trabajadores" class="table" style="width:100%">
			<thead>
				<tr>
					<th> RUT </th>
					<th> TIPO TRABAJADOR </th>
					<th> ID SUCURSAL </th>
					<th> FECHA REGISTRO </th>
					<th> FECHA ACTUALIZACION </th>
					<th> ACCION </th>
				</tr>
			</thead>
			<tbody>
				@foreach ($datos as $trabajador)
					<tr>
						<td> {{$trabajador->usuario_rut}} </td>
						<td> {{$trabajador->tipo_trabajador}} </td>
						<td> {{$trabajador->sucursal_id}} </td>
						<td> {{$trabajador->created_at}} </td>
						<td> {{$trabajador->updated_at}} </td>
						<td>
							<form action="{{route('admin_borrar_datos',['key' => $trabajador->usuario_rut,'tabla' => $tabla])}}" method="GET" class="btn-group">
								<a href="{{route('admin_editar_fila',['key' => $trabajador->usuario_rut,'tabla' => $tabla])}}" class="btn btn-info">Editar</a> 
								&nbsp;&nbsp;&nbsp;&nbsp;
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>

			
		@endif

		@if ($tabla == 'madera_proveedores')
			<table id="madera_proveedores" class="table" style="width:100%">
			<thead>
				<th> ID </th>
				<th> NIVEL CALIDAD </th>
				<th> RUT PROVEEDOR </th>
				<th> ID MADERA </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>

			<tbody>
				@foreach ($datos as $madera)
					<tr>
						<td> {{$madera->id}} </td>
						<td> {{$madera->nivel_calidad}} </td>
						<td> {{$madera->proveedor_rut}} </td>
						<td> {{$madera->madera_id}} </td>
						<td> {{$madera->created_at}} </td>
						<td> {{$madera->updated_at}} </td>
						<td>
							<form action="{{route('admin_borrar_datos',['key' => $madera->id,'tabla' => $tabla])}}" method="GET" class="btn-group">
								<a href="{{route('admin_editar_fila',['key' => $madera->id,'tabla' => $tabla])}}" class="btn btn-info">Editar</a> 
								&nbsp;&nbsp;&nbsp;&nbsp;
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>

				
		@endif

		@if ($tabla == 'transportes')
			<table id="transportes" class="table" style="width:100%">
			<thead>
				<th> ID </th>
				<th> NOMBRE TRANSPORTISTA </th>
				<th> TIPO VEHICULO </th>
				<th> VALOR VIAJE </th>
				<th> RUT PROVEEDOR </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>
			<tbody>
				@foreach ($datos as $transporte)
					<tr>
						<td> {{$transporte->id}} </td>
						<td> {{$transporte->nombre_transportista}} </td>
						<td> {{$transporte->tipo_vehiculo}} </td>
						<td> {{$transporte->valor_viaje}} </td>
						<td> {{$transporte->proveedor_rut}} </td>
						<td> {{$transporte->created_at}} </td>
						<td> {{$transporte->updated_at}} </td>
						<td>
							<form action="{{route('admin_borrar_datos',['key' => $transporte->id,'tabla' => $tabla])}}" method="GET" class="btn-group">
							<a href="{{route('admin_editar_fila',['key' =>$transporte->id,'tabla' => $tabla])}}" class="btn btn-info">Editar</a> 
							&nbsp;&nbsp;&nbsp;&nbsp;
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'tornillos')
			<table id="tornillos" class="table" style="width:100%">
			<thead>
				<th> ID PRODUCTO </th>
				<th> CABEZA </th>
				<th> TIPO ROSCA </th>
				<th> SEPARACION ROSCA </th>
				<th> PUNTA </th>
				<th> ROSCA PARCIAL </th>
				<th> VASTAGO </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>
			<tbody>
				@foreach ($datos as $tornillo)
					<tr>
						<td> {{$tornillo->producto_id}} </td>
						<td> {{$tornillo->cabeza}} </td>
						<td> {{$tornillo->tipo_rosca}} </td>
						<td> {{$tornillo->separacion_rosca}} </td>
						<td> {{$tornillo->punta}} </td>
						<td> {{$tornillo->rosca_parcial}} </td>
						<td> {{$tornillo->vastago}} </td>
						<td> {{$tornillo->created_at}} </td>
						<td> {{$tornillo->updated_at}} </td>
						<td>
							<form action="{{route('admin_borrar_datos',['key' => $tornillo->producto_id,'tabla' => $tabla])}}" method="GET" class="btn-group">
								<a href="{{route('admin_editar_fila',['key' => $tornillo->producto_id,'tabla' => $tabla])}}" class="btn btn-info">Editar</a> 
								&nbsp;&nbsp;&nbsp;&nbsp;
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
				
		@endif

		@if ($tabla == 'telefono_proveedores')
			<table id="telefono_proveedores" class="table" style="width:100%">
			<thead>
				<th> RUT PROVEEDOR </th>
				<th> TELEFONO </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>
			<tbody>
				@foreach ($datos as $telefono)
					<tr>
						<td> {{$telefono->proveedor_rut}} </td>
						<td> {{$telefono->telefono}} </td>
						<td> {{$telefono->created_at}} </td>
						<td> {{$telefono->updated_at}} </td>
						<td>
							<form action="{{route('admin_borrar_datos',['key' => $telefono->proveedor_rut,'tabla' => $tabla])}}" method="GET" class="btn-group">
								<a href="{{route('admin_editar_fila',['key' => $telefono->proveedor_rut,'tabla' => $tabla])}}" class="btn btn-info">Editar</a> 
								&nbsp;&nbsp;&nbsp;&nbsp;
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'techumbres')
			<table id="techumbres" class="table" style="width:100%">
			<thead>
				<th> ID PRODUCTO </th>
				<th> MATERIAL </th>
				<th> ALTO </th>
				<th> ANCHO </th>
				<th> LARGO </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>
			<tbody>
				@foreach ($datos as $techumbre)
					<tr>
						<td> {{$techumbre->producto_id}} </td>
						<td> {{$techumbre->material}} </td>
						<td> {{$techumbre->alto}} </td>
						<td> {{$techumbre->ancho}} </td>
						<td> {{$techumbre->largo}} </td>
						<td> {{$techumbre->created_at}} </td>
						<td> {{$techumbre->updated_at}} </td>
						<td>
							<form action="{{route('admin_borrar_datos',['key' => $techumbre->producto_id,'tabla' => $tabla])}}" method="GET" class="btn-group">
								<a href="{{route('admin_editar_fila',['key' => $techumbre->producto_id,'tabla' => $tabla])}}" class="btn btn-info">Editar</a> 
								&nbsp;&nbsp;&nbsp;&nbsp;
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'proveedores')
			<table id="proveedores" class="table" style="width:100%">
			<thead>
				<th> RUT </th>
				<th> NOMBRE </th>
				<th> RAZON SOCIAL </th>
				<th> CORREO </th>
				<th> UBICACION </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>
			<tbody>
				@foreach ($datos as $proveedor)
					<tr>
						<td> {{$proveedor->rut}} </td>
						<td> {{$proveedor->nombre}} </td>
						<td> {{$proveedor->razon_social}} </td>
						<td> {{$proveedor->correo}} </td>
						<td> {{$proveedor->ubicacion}} </td>
						<td> {{$proveedor->created_at}} </td>
						<td> {{$proveedor->updated_at}} </td>
						<td>
							<form action="{{route('admin_borrar_datos',['key' => $proveedor->rut,'tabla' => $tabla])}}" method="GET" class="btn-group">
								<a href="{{route('admin_editar_fila',['key' => $proveedor->rut,'tabla' => $tabla])}}" class="btn btn-info">Editar</a> 
								&nbsp;&nbsp;&nbsp;&nbsp;
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'productos')
			<table id="productos" class="table" style="width:100%">
			<thead>
				<th> ID </th>
				<th> NOMBRE </th>
				<th> DESCRIPCION </th>
				<th> NIVEL DEMANDA </th>
				<th> FAMILIA </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>
			<tbody>
				@foreach ($datos as $producto)
					<tr>
						<td> {{$producto->id}} </td>
						<td> {{$producto->nombre}} </td>
						<td> {{$producto->descripcion}} </td>
						<td> {{$producto->nivel_demanda}} </td>
						<td> {{$producto->familia}} </td>
						<td> {{$producto->created_at}} </td>
						<td> {{$producto->updated_at}} </td>
						<td>
							<form action="{{route('admin_borrar_datos',['key' => $producto->id,'tabla' => $tabla])}}" method="GET" class="btn-group">
								<a href="{{route('admin_editar_fila',['key' => $producto->id,'tabla' => $tabla])}}" class="btn btn-info">Editar</a> 
								&nbsp;&nbsp;&nbsp;&nbsp;
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach 
			</tbody>

		@endif

		@if ($tabla == 'planchas_construccion')
			<table id="planchas_construccion" class="table" style="width:100%">
			<thead>
				<th> ID PRODUCTO </th>
				<th> MATERIAL </th>
				<th> ALTO </th>
				<th> ANCHO </th>
				<th> LARGO </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>
			<tbody>
				@foreach ($datos as $plancha)
					<tr>
						<td> {{$plancha->producto_id}} </td>
						<td> {{$plancha->material}} </td>
						<td> {{$plancha->alto}} </td>
						<td> {{$plancha->ancho}} </td>
						<td> {{$plancha->largo}} </td>
						<td> {{$plancha->created_at}} </td>
						<td> {{$plancha->updated_at}} </td>
						<td>
							<form action="{{route('admin_borrar_datos',['key' => $plancha->producto_id,'tabla' => $tabla])}}" method="GET" class="btn-group">
								<a href="{{route('admin_editar_fila',['key' => $plancha->producto_id,'tabla' => $tabla])}}" class="btn btn-info">Editar</a> 
								&nbsp;&nbsp;&nbsp;&nbsp;
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'muebles')
			<table id="muebles" class="table" style="width:100%">
			<thead>
				<th> ID PRODUCTO </th>
				<th> MATERIAL </th>
				<th> ACABADO </th>
				<th> ALTO </th>
				<th> ANCHO </th>
				<th> LARGO </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>
			<tbody>
				@foreach ($datos as $mueble)
					<tr>
						<td> {{$mueble->producto_id}} </td>
						<td> {{$mueble->material}} </td>
						<td> {{$mueble->acabado}} </td>
						<td> {{$mueble->alto}} </td>
						<td> {{$mueble->ancho}} </td>
						<td> {{$mueble->largo}} </td>
						<td> {{$mueble->created_at}} </td>
						<td> {{$mueble->updated_at}} </td>
						<td>
							<form action="{{route('admin_borrar_datos',['key' => $mueble->producto_id,'tabla' => $tabla])}}" method="GET" class="btn-group">
								<a href="{{route('admin_editar_fila',['key' => $mueble->producto_id,'tabla' => $tabla])}}" class="btn btn-info">Editar</a> 
								&nbsp;&nbsp;&nbsp;&nbsp;
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'maderas')
			<table id="maderas" class="table" style="width:100%">
			<thead>
				<th> ID PRODUCTO </th>
				<th> ALTO </th>
				<th> ANCHO </th>
				<th> LARGO </th>
				<th> TIPO MADERA </th>
				<th> TRATAMIENTO </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>
			<tbody>
				@foreach ($datos as $madera)
					<tr>
						<td> {{$madera->producto_id}} </td>
						<td> {{$madera->alto}} </td>
						<td> {{$madera->ancho}} </td>
						<td> {{$madera->largo}} </td>
						<td> {{$madera->tipo_madera}} </td>
						<td> {{$madera->tratamiento}} </td>
						<td> {{$madera->created_at}} </td>
						<td> {{$madera->updated_at}} </td>
						<td>
							<form action="{{route('admin_borrar_datos',['key' => $madera->producto_id,'tabla' => $tabla])}}" method="GET" class="btn-group">
								<a href="{{route('admin_editar_fila',['key' => $madera->producto_id,'tabla' => $tabla])}}" class="btn btn-info">Editar</a> 
								&nbsp;&nbsp;&nbsp;&nbsp;
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'sucursal_producto')
			<table id="sucursal_producto" class="table" style="width:100%">
			<thead>
				<th> ID SUCURSAL </th>
				<th> ID PRODUCTO </th>
				<th> STOCK </th>
				<th> PRECIO COMPRA </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>
			<tbody>
				@foreach ($datos as $localizacion)
					<tr>
						<td> {{$localizacion->sucursal_id}} </td>
						<td> {{$localizacion->producto_id}} </td>
						<td> {{$localizacion->stock}} </td>
						<td> {{$localizacion->precio_compra}} </td>
						<td> {{$localizacion->created_at}} </td>
						<td> {{$localizacion->updated_at}} </td>
						<td>
							<form action="{{route('admin_borrar_datos',['key' => $localizacion->sucursal_id,'tabla' => $tabla])}}" method="GET" class="btn-group">
								<a href="{{route('admin_editar_fila',['key' => $localizacion->sucursal_id,'tabla' => $tabla])}}" class="btn btn-info">Editar</a> 
								&nbsp;&nbsp;&nbsp;&nbsp;
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'inventarios')
			<table id="inventarios" class="table" style="width:100%">
			<thead>
				<th> ID </th>
				<th> DIRECCION SUCURSAL </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>
			<tbody>
				@foreach ($datos as $inventario)
					<tr>
						<td> {{$inventario->id}} </td>
						<td> {{$inventario->direccion_sucursal}} </td>
						<td> {{$inventario->created_at}} </td>
						<td> {{$inventario->updated_at}} </td>
						<td>
							<form action="{{route('admin_borrar_datos',['key' => $inventario->id,'tabla' => $tabla])}}" method="GET" class="btn-group">
								<a href="{{route('admin_editar_fila',['key' => $inventario->id,'tabla' => $tabla])}}" class="btn btn-info">Editar</a> 
								&nbsp;&nbsp;&nbsp;&nbsp;
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'fotos')
			<table id="fotos" class="table" style="width:100%">
			<thead>
				<th> ID </th>
				<th> URL </th>
				<th> ID PRODUCTO </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>
			<tbody>
				@foreach ($datos as $foto)
					<tr>
						<td> {{$foto->id}} </td>
						<td> {{$foto->url}} </td>
						<td> {{$foto->imagenable_id}} </td>
						<td> {{$foto->created_at}} </td>
						<td> {{$foto->updated_at}} </td>
						<td>
							<form action="{{route('admin_borrar_datos',['key' => $foto->id,'tabla' => $tabla])}}" method="GET" class="btn-group">
								<a href="{{route('admin_editar_fila',['key' => $foto->id,'tabla' => $tabla])}}" class="btn btn-info">Editar</a> 
								&nbsp;&nbsp;&nbsp;&nbsp;
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'ejecutivos')
			<table id="ejecutivos" class="table" style="width:100%">
			<thead>
				<th> ID </th>
				<th> NOMBRE </th>
				<th> APELLIDO </th>
				<th> CORREO </th>
				<th> TELEFONO </th>
				<th> RUT PROVEEDOR </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>
			<tbody>
				@foreach ($datos as $ejecutivo)
					<tr>
						<td> {{$ejecutivo->id}} </td>
						<td> {{$ejecutivo->nombre}} </td>
						<td> {{$ejecutivo->apellido}} </td>
						<td> {{$ejecutivo->correo}} </td>
						<td> {{$ejecutivo->telefono}} </td>
						<td> {{$ejecutivo->proveedor_rut}} </td>
						<td> {{$ejecutivo->created_at}} </td>
						<td> {{$ejecutivo->updated_at}} </td>
						<td>
							<form action="{{route('admin_borrar_datos',['key' => $ejecutivo->id,'tabla' => $tabla])}}" method="GET" class="btn-group">
								<a href="{{route('admin_editar_fila',['key' => $ejecutivo->id,'tabla' => $tabla])}}" class="btn btn-info">Editar</a> 
								&nbsp;&nbsp;&nbsp;&nbsp;
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'compras')
			<table id="compras" class="table" style="width:100%">
			<thead>
				<th> ID </th>
				<th> CANTIDAD </th>
				<th> RUT CLIENTE </th>
				<th> ID PRODUCTO </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>
			<tbody>
				@foreach ($datos as $compra)
					<tr>
						<td> {{$compra->id}} </td>
						<td> {{$compra->cantidad}} </td>
						<td> {{$compra->cliente_rut}} </td>
						<td> {{$compra->producto_id}} </td>
						<td> {{$compra->created_at}} </td>
						<td> {{$compra->updated_at}} </td>
						<td>
							<form action="{{route('admin_borrar_datos',['key' => $compra->id,'tabla' => $tabla])}}" method="GET" class="btn-group">
								<a href="{{route('admin_editar_fila',['key' => $compra->id,'tabla' => $tabla])}}" class="btn btn-info">Editar</a> 
								&nbsp;&nbsp;&nbsp;&nbsp;
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'clavos')
			<table id="clavos" class="table" style="width:100%">
			<thead>
				<th> ID PRODUCTO </th>
				<th> MATERIAL </th>
				<th> CABEZA </th>
				<th> PUNTA </th>
				<th> LONGITUD </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>
			<tbody>
				@foreach ($datos as $clavo)
					<tr>
						<td> {{$clavo->producto_id}} </td>
						<td> {{$clavo->material}} </td>
						<td> {{$clavo->cabeza}} </td>
						<td> {{$clavo->punta}} </td>
						<td> {{$clavo->longitud}} </td>
						<td> {{$clavo->created_at}} </td>
						<td> {{$clavo->updated_at}} </td>
						<td>
							<form action="{{route('admin_borrar_datos',['key' => $clavo->producto_id,'tabla' => $tabla])}}" method="GET" class="btn-group">
								<a href="{{route('admin_editar_fila',['key' => $clavo->producto_id,'tabla' => $tabla])}}" class="btn btn-info">Editar</a> 
								&nbsp;&nbsp;&nbsp;&nbsp;
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>

		@endif
	</table>
	

	
	{{-- <script src="/js/bootstrap.bundle.min.js"></script> --}}

	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script> 
	

	@if ($tabla == 'usuarios')
		<script>
			$(document).ready(function() {
				$('#usuarios').DataTable();
			});
		</script> 	
	@endif

	@if ($tabla == 'clientes')
		<script>
			$(document).ready(function() {
				$('#clientes').DataTable();
			});
		</script> 	
	@endif
	
	@if ($tabla == 'trabajadores')
		<script>
			$(document).ready(function() {
				$('#trabajadores').DataTable();
			});
		</script> 	
	@endif

	@if ($tabla == 'madera_proveedores')
		<script>
			$(document).ready(function() {
				$('#madera_proveedores').DataTable();
			});
		</script> 	
	@endif

	@if ($tabla == 'transportes')
		<script>
			$(document).ready(function() {
				$('#transportes').DataTable();
			});
		</script> 	
	@endif
	
	@if ($tabla == 'tornillos')
		<script>
			$(document).ready(function() {
				$('#tornillos').DataTable();
			});
		</script> 	
	@endif

	@if ($tabla == 'telefono_proveedores')
		<script>
			$(document).ready(function() {
				$('#telefono_proveedores').DataTable();
			});
		</script> 	
	@endif

	@if ($tabla == 'techumbres')
		<script>
			$(document).ready(function() {
				$('#techumbres').DataTable();
			});
		</script> 	
	@endif
	
	@if ($tabla == 'proveedores')
		<script>
			$(document).ready(function() {
				$('#proveedores').DataTable();
			});
		</script> 	
	@endif

	@if ($tabla == 'productos')
		<script>
			$(document).ready(function() {
				$('#productos').DataTable();
			});
		</script> 	
	@endif

	@if ($tabla == 'planchas_construccion')
		<script>
			$(document).ready(function() {
				$('#planchas_construccion').DataTable();
			});
		</script> 	
	@endif
	
	@if ($tabla == 'muebles')
		<script>
			$(document).ready(function() {
				$('#muebles').DataTable();
			});
		</script> 	
	@endif

	@if ($tabla == 'maderas')
		<script>
			$(document).ready(function() {
				$('#maderas').DataTable();
			});
		</script> 	
	@endif

	@if ($tabla == 'sucursal_producto')
		<script>
			$(document).ready(function() {
				$('#sucursal_producto').DataTable();
			});
		</script> 	
	@endif
	
	@if ($tabla == 'inventarios')
		<script>
			$(document).ready(function() {
				$('#inventarios').DataTable();
			});
		</script> 	
	@endif

	@if ($tabla == 'fotos')
		<script>
			$(document).ready(function() {
				$('#fotos').DataTable();
			});
		</script> 	
	@endif

	@if ($tabla == 'ejecutivos')
		<script>
			$(document).ready(function() {
				$('#ejecutivos').DataTable();
			});
		</script> 	
	@endif
	
	@if ($tabla == 'compras')
		<script>
			$(document).ready(function() {
				$('#compras').DataTable();
			});
		</script> 	
	@endif

	@if ($tabla == 'clavos')
		<script>
			$(document).ready(function() {
				$('#clavos').DataTable();
			});
		</script> 	
	@endif


</body>
</html>

