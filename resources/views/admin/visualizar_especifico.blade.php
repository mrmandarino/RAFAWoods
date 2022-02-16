<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Base de datos</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css"> 
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/r-2.2.9/datatables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css"> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<style type="text/css">
		
		.floatRight{
		float:right;
		margin-left:10px;
		margin-right:10px;
		}
		
		.dataTables_length {
		float:left;
		font-size: 15px;
		}	

		.buttons-excel {
			font-size: 12.5px;
		}

		.buttons-print {
			font-size: 12.5px;
		}
    </style> 





</head>
<body>

	<div> 
		<a href="{{route('admin_crear_fila',$tabla)}}" class="btn btn-primary" >CREAR</a> 
		&nbsp;&nbsp;
		<a href="{{route('admin_visualizar_datos')}}" class="btn btn-primary" >VOLVER</a>
	</div>
		
		@if ($tabla == 'usuarios')
		
			<table id="usuarios" class="table" style="width:100%">
			
			<thead>
				<tr>
					<th>  RUT    </th>
					<th> NOMBRE </th>
					<th> APELLIDO </th>
					<th> CORREO </th>
					<th> TIPO USUARIO  </th>
					<th> ESTADO </th>
					<th> FECHA REGISTRO  </th>
					<th>  FECHA ACTUALIZACION</th>
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
	
		@elseif($tabla == 'clientes')
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
					@php($usuario=DB::table('users')->where('rut',$cliente->usuario_rut)->first())
					@if ($usuario->estado==1)
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
					@endif
				@endforeach
			</tbody>

		@elseif($tabla == 'trabajadores')
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
					@php($usuario=DB::table('users')->where('rut',$trabajador->usuario_rut)->first())
					@if ($usuario->estado==1)
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
					@endif
				@endforeach
			</tbody>

			
		@elseif($tabla == 'orden_compras')
			<table id="orden_compras" class="table" style="width:100%">
			<thead>
				<th> ID </th>
				<th> ID SUCURSAL </th>
				<th> RUT PROVEEDOR </th>
				<th> TOTAL OOCC </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>

			<tbody>
				@foreach ($datos as $orden)
					<tr>
						<td> {{$orden->id}} </td>
						<td> {{$orden->sucursal_id}} </td>
						<td> {{$orden->proveedor_rut}} </td>
						<td> {{$orden->total_oocc}} </td>
						<td> {{$orden->created_at}} </td>
						<td> {{$orden->updated_at}} </td>
						<td>
							<form action="{{route('admin_borrar_datos',['key' => $orden->id,'tabla' => $tabla])}}" method="GET" class="btn-group">
								<a href="{{route('admin_editar_fila',['key' => $orden->id,'tabla' => $tabla])}}" class="btn btn-info">Editar</a> 
								&nbsp;&nbsp;&nbsp;&nbsp;
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>

				
		@elseif($tabla == 'transportes')
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

		@elseif($tabla == 'tornillos')
			<table id="tornillos" class="table" style="width:100%">
			<thead>
				<th> ID PRODUCTO </th>
				<th> CABEZA (mm) </th>
				<th> TIPO ROSCA </th>
				<th> SEPARACION ROSCA (mm) </th>
				<th> PUNTA </th>
				<th> ROSCA PARCIAL (mm) </th>
				<th> VASTAGO (mm) </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>
			<tbody>
				@foreach ($datos as $tornillo)
					@php($producto=DB::table('productos')->where('id',$tornillo->producto_id)->first())
					@if ($producto->estado==1)
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
					@endif
				@endforeach
			</tbody>
				
		@elseif($tabla == 'telefono_proveedores')
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
							<form action="{{route('admin_borrar_datos',['key' => $telefono->proveedor_rut,'tabla' => $tabla, 'key2' => $telefono->telefono ])}}" method="GET" class="btn-group">
								<a href="{{route('admin_editar_fila',['key' => $telefono->proveedor_rut,'tabla' => $tabla, 'key2' => $telefono->telefono])}}" class="btn btn-info">Editar</a> 
								&nbsp;&nbsp;&nbsp;&nbsp;
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>

		@elseif($tabla == 'techumbres')
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
					@php($producto=DB::table('productos')->where('id',$techumbre->producto_id)->first())
					@if ($producto->estado==1)
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
					@endif
				@endforeach
			</tbody>

		@elseif($tabla == 'proveedores')
			<table id="proveedores" class="table" style="width:100%">
			<thead>
				<th> RUT </th>
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

		@elseif($tabla == 'productos')
			<table id="productos" class="table" style="width:100%">
			<thead>
				<th> ID </th>
				<th> NOMBRE </th>
				<th> DESCRIPCION </th>
				<th> NIVEL DEMANDA </th>
				<th> FAMILIA </th>
				<th> ESTADO </th>
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
						<td> {{$producto->estado}} </td>
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

		@elseif($tabla == 'planchas_construccion')
			<table id="planchas_construccion" class="table" style="width:100%">
			<thead>
				<th> ID PRODUCTO </th>
				<th> MATERIAL </th>
				<th> ALTO (m) </th>
				<th> ANCHO (mm) </th>
				<th> LARGO (m) </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>
			<tbody>
				@foreach ($datos as $plancha)
					@php($producto=DB::table('productos')->where('id',$plancha->producto_id)->first())
					@if ($producto->estado==1)
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
					@endif
				@endforeach
			</tbody>

		@elseif($tabla == 'muebles')
			<table id="muebles" class="table" style="width:100%">
			<thead>
				<th> ID PRODUCTO </th>
				<th> MATERIAL </th>
				<th> ACABADO </th>
				<th> ALTO (m) </th>
				<th> ANCHO (m) </th>
				<th> LARGO (m) </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>
			<tbody>
				@foreach ($datos as $mueble)
					@php($producto=DB::table('productos')->where('id',$mueble->producto_id)->first())
					@if ($producto->estado==1)
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
					@endif
				@endforeach
			</tbody>

		@elseif($tabla == 'maderas')
			<table id="maderas" class="table" style="width:100%">
			<thead>
				<th> ID PRODUCTO </th>
				<th> ALTO (in) </th>
				<th> ANCHO (in) </th>
				<th> LARGO (m) </th>
				<th> TIPO MADERA </th>
				<th> TRATAMIENTO </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>
			<tbody>
				@foreach ($datos as $madera)
					@php($producto=DB::table('productos')->where('id',$madera->producto_id)->first())
					@if ($producto->estado==1)
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
					@endif
				@endforeach
			</tbody>

		@elseif($tabla == 'sucursal_producto')
			<table id="sucursal_producto" class="table" style="width:100%">
			<thead>
				<th> ID SUCURSAL </th>
				<th> ID PRODUCTO </th>
				<th> STOCK </th>
				<th> PRECIO VENTA </th>
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
						<td> {{$localizacion->precio_venta}} </td>
						<td> {{$localizacion->precio_compra}} </td>
						<td> {{$localizacion->created_at}} </td>
						<td> {{$localizacion->updated_at}} </td>
						<td>
							<form action="{{route('admin_borrar_datos',['key' => $localizacion->sucursal_id,'tabla' => $tabla, 'key2' => $localizacion->producto_id ])}}" method="GET" class="btn-group">
								<a href="{{route('admin_editar_fila',['key' => $localizacion->sucursal_id,'tabla' => $tabla, 'key2' => $localizacion->producto_id ])}}" class="btn btn-info">Editar</a> 
								&nbsp;&nbsp;&nbsp;&nbsp;
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>

		@elseif($tabla == 'inventarios')
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

		@elseif($tabla == 'fotos')
			<table id="fotos" class="table" style="width:100%">
			<thead>
				<th> ID </th>
				<th> URL </th>
				<th> ID PRODUCTO </th>
				<th> TIPO PRODUCTO </th>
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
						<td> {{$foto->imagenable_tipo}} </td>
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

		@elseif($tabla == 'ejecutivos')
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

		@elseif($tabla == 'detalle_ventas')
			<table id="detalle_ventas" class="table" style="width:100%">
			<thead>
				<th> ID VENTA </th>
				<th> ID PRODUCTO </th>
				<th> CANTIDAD </th>
				<th> TOTAL PRODUCTO </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>
			<tbody>
				@foreach ($datos as $detalle_venta)
					<tr>
						<td> {{$detalle_venta->venta_id}} </td>
						<td> {{$detalle_venta->producto_id}} </td>
						<td> {{$detalle_venta->cantidad}} </td>
						<td> {{$detalle_venta->total_producto}} </td>
						<td> {{$detalle_venta->created_at}} </td>
						<td> {{$detalle_venta->updated_at}} </td>
						<td>
							<form action="{{route('admin_borrar_datos',['key' => $detalle_venta->venta_id,'tabla' => $tabla, 'key2' => $detalle_venta->producto_id ])}}" method="GET" class="btn-group">
								<a href="{{route('admin_editar_fila',['key' => $detalle_venta->venta_id,'tabla' => $tabla, 'key2' => $detalle_venta->producto_id ])}}" class="btn btn-info">Editar</a> 
								&nbsp;&nbsp;&nbsp;&nbsp;
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>

		@elseif($tabla == 'clavos')
			<table id="clavos" class="table" style="width:100%">
			<thead>
				<th> ID PRODUCTO </th>
				<th> MATERIAL </th>
				<th> PUNTA </th>
				<th> CABEZA (mm) </th>
				<th> LONGITUD (mm) </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>
			<tbody>
				@foreach ($datos as $clavo)
					@php($producto=DB::table('productos')->where('id',$clavo->producto_id)->first())
					@if ($producto->estado==1)
						<tr>
							<td> {{$clavo->producto_id}} </td>
							<td> {{$clavo->material}} </td>
							<td> {{$clavo->punta}} </td>
							<td> {{$clavo->cabeza}} </td>
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
					@endif
				@endforeach
			</tbody>

		@elseif($tabla == 'detalle_compras')
			<table id="detalle_compras" class="table" style="width:100%">
			<thead>
				<th> ID OC </th>
				<th> ID PRODUCTO </th>
				<th> NIVEL CALIDAD </th>
				<th> CANTIDAD </th>
				<th> PRECIO UNITARIO </th>
				<th> TOTAL </th>
				<th> FECHA REGISTRO </th>
				<th> FECHA ACTUALIZACION </th>
				<th> ACCION </th>
			</thead>

			<tbody>
				@foreach ($datos as $detalle)
					<tr>
						<td> {{$detalle->oc_id}} </td>
						<td> {{$detalle->producto_id}} </td>
						<td> {{$detalle->nivel_calidad}} </td>
						<td> {{$detalle->cantidad}} </td>
						<td> {{$detalle->precio_unitario}} </td>
						<td> {{$detalle->total}} </td>
						<td> {{$detalle->created_at}} </td>
						<td> {{$detalle->updated_at}} </td>
						<td>
							<form action="{{route('admin_borrar_datos',['key' => $detalle->oc_id,'tabla' => $tabla, 'key2' => $detalle->producto_id ])}}" method="GET" class="btn-group">
								<a href="{{route('admin_editar_fila',['key' => $detalle->oc_id,'tabla' => $tabla, 'key2' => $detalle->producto_id])}}" class="btn btn-info">Editar</a> 
								&nbsp;&nbsp;&nbsp;&nbsp;
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>

				
		@elseif($tabla == 'ventas')
			<table id="ventas" class="table" style="width:100%">
				<thead>
					<th> ID </th>
					<th> ID SUCURSAL </th>
					<th> RUT VENDEDOR </th>
					<th> RUT CLIENTE </th>
					<th> MEDIO DE PAGO </th>
					<th> FACTURA </th>
					<th> TOTAL VENTA </th>
					<th> UTILIDAD BRUTA </th>
					<th> FECHA REGISTRO </th>
					<th> FECHA ACTUALIZACION </th>
					<th> ACCION </th>
				</thead>

				<tbody>
					@foreach ($datos as $venta)
						<tr>
							<td> {{$venta->id}} </td>
							<td> {{$venta->sucursal_id}} </td>
							<td> {{$venta->vendedor_rut}} </td>
							<td> {{$venta->cliente_rut}} </td>
							<td> {{$venta->medio_de_pago}} </td>
							<td> {{$venta->con_factura}} </td>
							<td> {{$venta->total_venta}} </td>
							<td> {{$venta->utilidad_bruta}} </td>
							<td> {{$venta->created_at}} </td>
							<td> {{$venta->updated_at}} </td>
							<td>
								<form action="{{route('admin_borrar_datos',['key' => $venta->id,'tabla' => $tabla])}}" method="GET" class="btn-group">
									<a href="{{route('admin_editar_fila',['key' => $venta->id,'tabla' => $tabla])}}" class="btn btn-info">Editar</a> 
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
	

	
	
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script> 
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/r-2.2.9/datatables.min.js"></script>

	<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script> {{-- Necesario para ver los botones --}} 
	<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script> {{-- Necesario para ver los botones --}} 
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> {{-- Excel --}} 
	<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script> {{-- Imprimir(PDF) --}}



	

	@if ($tabla == 'usuarios')
		<script>
			$(document).ready(function() {
				$('#usuarios').DataTable({
					responsive: true,
					autoWidth: false,
					dom: '<"floatRight"B>lftrp',

					 buttons: {
      				 buttons: [
						   
            			{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Usuarios', className: 'btn btn-success', exportOptions: {columns: ':not(:last-child)', } },
        				{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Usuarios', className: 'btn btn-danger', exportOptions: {columns: ':not(:last-child)', } },
							  ],
       					dom: {
		  					button: {
		  					className: 'btn'
	        					 }
       					}
     				},
					"language": {
						"lengthMenu": "Mostrar " + 
									   `<select class="custom-select custom-select-sm form-control form-control-sm">
										<option value = '10'>10</option>
										<option value = '25'>25</option>
										<option value = '50'>50</option>
										<option value = '100'>100</option>
										<option value = '-1'>Total</option>
									    </select>` + 
										" registros por página",
						"zeroRecords": "No se encontraron registros",
						"info": "Visualizando página _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrado de _MAX_ registros totales)",
						"search": "Buscar :",
						"paginate": {"next": "Siguiente", "previous": "Anterior"}
        			}
				});
			});
		</script> 	
	@elseif($tabla == 'clientes')
		<script>
			$(document).ready(function() {
				$('#clientes').DataTable({
					responsive: true,
					autoWidth: false,
					dom: '<"floatRight"B>lftrp',

					 buttons: {
      				 buttons: [
						   
            			{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Clientes', className: 'btn btn-success', exportOptions: {columns: ':not(:last-child)', } },
        				{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Clientes', className: 'btn btn-danger', exportOptions: {columns: ':not(:last-child)', } },
							  ],
       					dom: {
		  					button: {
		  					className: 'btn'
	        					 }
       					}
     				},
					"language": {
						"lengthMenu": "Mostrar " + 
									   `<select class="custom-select custom-select-sm form-control form-control-sm">
										<option value = '10'>10</option>
										<option value = '25'>25</option>
										<option value = '50'>50</option>
										<option value = '100'>100</option>
										<option value = '-1'>Total</option>
									    </select>` + 
										" registros por página",
						"zeroRecords": "No se encontraron registros",
						"info": "Visualizando página _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrado de _MAX_ registros totales)",
						"search": "Buscar :",
						"paginate": {"next": "Siguiente", "previous": "Anterior"}
        			}
				});
			});
		</script> 	
	@elseif($tabla == 'trabajadores')
		<script>
			$(document).ready(function() {
				$('#trabajadores').DataTable({
					responsive: true,
					autoWidth: false,
					dom: '<"floatRight"B>lftrp',

					 buttons: {
      				 buttons: [
						   
            			{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Trabajadores', className: 'btn btn-success', exportOptions: {columns: ':not(:last-child)', } },
        				{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Trabajadores', className: 'btn btn-danger', exportOptions: {columns: ':not(:last-child)', } },
							  ],
       					dom: {
		  					button: {
		  					className: 'btn'
	        					 }
       					}
     				},
					"language": {
						"lengthMenu": "Mostrar " + 
									   `<select class="custom-select custom-select-sm form-control form-control-sm">
										<option value = '10'>10</option>
										<option value = '25'>25</option>
										<option value = '50'>50</option>
										<option value = '100'>100</option>
										<option value = '-1'>Total</option>
									    </select>` + 
										" registros por página",
						"zeroRecords": "No se encontraron registros",
						"info": "Visualizando página _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrado de _MAX_ registros totales)",
						"search": "Buscar :",
						"paginate": {"next": "Siguiente", "previous": "Anterior"}
        			}
				});
			});
		</script> 	
	@elseif($tabla == 'orden_compras')
		<script>
			$(document).ready(function() {
				$('#orden_compras').DataTable({
					responsive: true,
					autoWidth: false,
					dom: '<"floatRight"B>lftrp',

					 buttons: {
      				 buttons: [
						   
            			{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Orden_compras', className: 'btn btn-success', exportOptions: {columns: ':not(:last-child)', } },
        				{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Orden_compras', className: 'btn btn-danger', exportOptions: {columns: ':not(:last-child)', } },
							  ],
       					dom: {
		  					button: {
		  					className: 'btn'
	        					 }
       					}
     				},
					"language": {
						"lengthMenu": "Mostrar " + 
									   `<select class="custom-select custom-select-sm form-control form-control-sm">
										<option value = '10'>10</option>
										<option value = '25'>25</option>
										<option value = '50'>50</option>
										<option value = '100'>100</option>
										<option value = '-1'>Total</option>
									    </select>` + 
										" registros por página",
						"zeroRecords": "No se encontraron registros",
						"info": "Visualizando página _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrado de _MAX_ registros totales)",
						"search": "Buscar :",
						"paginate": {"next": "Siguiente", "previous": "Anterior"}
        			}
				});
			});
		</script> 	
	@elseif($tabla == 'transportes')
		<script>
			$(document).ready(function() {
				$('#transportes').DataTable({
					responsive: true,
					autoWidth: false,
					dom: '<"floatRight"B>lftrp',

					 buttons: {
      				 buttons: [
						   
            			{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Transportes', className: 'btn btn-success', exportOptions: {columns: ':not(:last-child)', } },
        				{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Transportes', className: 'btn btn-danger', exportOptions: {columns: ':not(:last-child)', } },
							  ],
       					dom: {
		  					button: {
		  					className: 'btn'
	        					 }
       					}
     				},
					"language": {
						"lengthMenu": "Mostrar " + 
									   `<select class="custom-select custom-select-sm form-control form-control-sm">
										<option value = '10'>10</option>
										<option value = '25'>25</option>
										<option value = '50'>50</option>
										<option value = '100'>100</option>
										<option value = '-1'>Total</option>
									    </select>` + 
										" registros por página",
						"zeroRecords": "No se encontraron registros",
						"info": "Visualizando página _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrado de _MAX_ registros totales)",
						"search": "Buscar :",
						"paginate": {"next": "Siguiente", "previous": "Anterior"}
        			}
				});
			});
		</script> 	
	@elseif($tabla == 'tornillos')
		<script>
			$(document).ready(function() {
				$('#tornillos').DataTable({
					responsive: true,
					autoWidth: false,
					dom: '<"floatRight"B>lftrp',

					 buttons: {
      				 buttons: [
						   
            			{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Tornillos', className: 'btn btn-success', exportOptions: {columns: ':not(:last-child)', } },
        				{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Tornillos', className: 'btn btn-danger', exportOptions: {columns: ':not(:last-child)', } },
							  ],
       					dom: {
		  					button: {
		  					className: 'btn'
	        					 }
       					}
     				},
					"language": {
						"lengthMenu": "Mostrar " + 
									   `<select class="custom-select custom-select-sm form-control form-control-sm">
										<option value = '10'>10</option>
										<option value = '25'>25</option>
										<option value = '50'>50</option>
										<option value = '100'>100</option>
										<option value = '-1'>Total</option>
									    </select>` + 
										" registros por página",
						"zeroRecords": "No se encontraron registros",
						"info": "Visualizando página _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrado de _MAX_ registros totales)",
						"search": "Buscar :",
						"paginate": {"next": "Siguiente", "previous": "Anterior"}
        			}
				});
			});
		</script> 	
	@elseif($tabla == 'telefono_proveedores')
		<script>
			$(document).ready(function() {
				$('#telefono_proveedores').DataTable({
					responsive: true,
					autoWidth: false,
					dom: '<"floatRight"B>lftrp',

					 buttons: {
      				 buttons: [
						   
            			{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Teléfono_proveedores', className: 'btn btn-success', exportOptions: {columns: ':not(:last-child)', } },
        				{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Teléfono_proveedores', className: 'btn btn-danger', exportOptions: {columns: ':not(:last-child)', } },
							  ],
       					dom: {
		  					button: {
		  					className: 'btn'
	        					 }
       					}
     				},
					"language": {
						"lengthMenu": "Mostrar " + 
									   `<select class="custom-select custom-select-sm form-control form-control-sm">
										<option value = '10'>10</option>
										<option value = '25'>25</option>
										<option value = '50'>50</option>
										<option value = '100'>100</option>
										<option value = '-1'>Total</option>
									    </select>` + 
										" registros por página",
						"zeroRecords": "No se encontraron registros",
						"info": "Visualizando página _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrado de _MAX_ registros totales)",
						"search": "Buscar :",
						"paginate": {"next": "Siguiente", "previous": "Anterior"}
        			}
				});
			});
		</script> 	
	@elseif($tabla == 'techumbres')
		<script>
			$(document).ready(function() {
				$('#techumbres').DataTable({
					responsive: true,
					autoWidth: false,
					
					responsive: true,
					autoWidth: false,
					dom: '<"floatRight"B>lftrp',

					 buttons: {
      				 buttons: [
						   
            			{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Techumbres', className: 'btn btn-success', exportOptions: {columns: ':not(:last-child)', } },
        				{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Techumbres', className: 'btn btn-danger', exportOptions: {columns: ':not(:last-child)', } },
							  ],
       					dom: {
		  					button: {
		  					className: 'btn'
	        					 }
       					}
     				},
					"language": {
						"lengthMenu": "Mostrar " + 
									   `<select class="custom-select custom-select-sm form-control form-control-sm">
										<option value = '10'>10</option>
										<option value = '25'>25</option>
										<option value = '50'>50</option>
										<option value = '100'>100</option>
										<option value = '-1'>Total</option>
									    </select>` + 
										" registros por página",
						"zeroRecords": "No se encontraron registros",
						"info": "Visualizando página _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrado de _MAX_ registros totales)",
						"search": "Buscar :",
						"paginate": {"next": "Siguiente", "previous": "Anterior"}
        			}
				});
			});
		</script> 	
	@elseif($tabla == 'proveedores')
		<script>
			$(document).ready(function() {
				$('#proveedores').DataTable({
					responsive: true,
					autoWidth: false,
					dom: '<"floatRight"B>lftrp',

					 buttons: {
      				 buttons: [
						   
            			{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Proveedores', className: 'btn btn-success', exportOptions: {columns: ':not(:last-child)', } },
        				{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Proveedores', className: 'btn btn-danger', exportOptions: {columns: ':not(:last-child)', } },
							  ],
       					dom: {
		  					button: {
		  					className: 'btn'
	        					 }
       					}
     				},
					"language": {
						"lengthMenu": "Mostrar " + 
									   `<select class="custom-select custom-select-sm form-control form-control-sm">
										<option value = '10'>10</option>
										<option value = '25'>25</option>
										<option value = '50'>50</option>
										<option value = '100'>100</option>
										<option value = '-1'>Total</option>
									    </select>` + 
										" registros por página",
						"zeroRecords": "No se encontraron registros",
						"info": "Visualizando página _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrado de _MAX_ registros totales)",
						"search": "Buscar :",
						"paginate": {"next": "Siguiente", "previous": "Anterior"}
        			}
				});
			});
		</script> 	
	@elseif($tabla == 'productos')
		<script>
			$(document).ready(function() {
				$('#productos').DataTable({
					responsive: true,
					autoWidth: false,
					dom: '<"floatRight"B>lftrp',

					 buttons: {
      				 buttons: [
						   
            			{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Productos', className: 'btn btn-success', exportOptions: {columns: ':not(:last-child)', } },
        				{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Productos', className: 'btn btn-danger', exportOptions: {columns: ':not(:last-child)', } },
							  ],
       					dom: {
		  					button: {
		  					className: 'btn'
	        					 }
       					}
     				},
					"language": {
						"lengthMenu": "Mostrar " + 
									   `<select class="custom-select custom-select-sm form-control form-control-sm">
										<option value = '10'>10</option>
										<option value = '25'>25</option>
										<option value = '50'>50</option>
										<option value = '100'>100</option>
										<option value = '-1'>Total</option>
									    </select>` + 
										" registros por página",
						"zeroRecords": "No se encontraron registros",
						"info": "Visualizando página _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrado de _MAX_ registros totales)",
						"search": "Buscar :",
						"paginate": {"next": "Siguiente", "previous": "Anterior"}
        			}
				});
			});
		</script> 	
	@elseif($tabla == 'planchas_construccion')
		<script>
			$(document).ready(function() {
				$('#planchas_construccion').DataTable({
					responsive: true,
					autoWidth: false,
					dom: '<"floatRight"B>lftrp',

					 buttons: {
      				 buttons: [
						   
            			{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Planchas_construcción', className: 'btn btn-success', exportOptions: {columns: ':not(:last-child)', } },
        				{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Planchas_construcción', className: 'btn btn-danger', exportOptions: {columns: ':not(:last-child)', } },
							  ],
       					dom: {
		  					button: {
		  					className: 'btn'
	        					 }
       					}
     				},
					"language": {
						"lengthMenu": "Mostrar " + 
									   `<select class="custom-select custom-select-sm form-control form-control-sm">
										<option value = '10'>10</option>
										<option value = '25'>25</option>
										<option value = '50'>50</option>
										<option value = '100'>100</option>
										<option value = '-1'>Total</option>
									    </select>` + 
										" registros por página",
						"zeroRecords": "No se encontraron registros",
						"info": "Visualizando página _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrado de _MAX_ registros totales)",
						"search": "Buscar :",
						"paginate": {"next": "Siguiente", "previous": "Anterior"}
        			}
				});
			});
		</script> 	
	@elseif($tabla == 'muebles')
		<script>
			$(document).ready(function() {
				$('#muebles').DataTable({
					responsive: true,
					autoWidth: false,
					dom: '<"floatRight"B>lftrp',

					 buttons: {
      				 buttons: [
						   
            			{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Muebles', className: 'btn btn-success', exportOptions: {columns: ':not(:last-child)', } },
        				{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Muebles', className: 'btn btn-danger', exportOptions: {columns: ':not(:last-child)', } },
							  ],
       					dom: {
		  					button: {
		  					className: 'btn'
	        					 }
       					}
     				},
					"language": {
						"lengthMenu": "Mostrar " + 
									   `<select class="custom-select custom-select-sm form-control form-control-sm">
										<option value = '10'>10</option>
										<option value = '25'>25</option>
										<option value = '50'>50</option>
										<option value = '100'>100</option>
										<option value = '-1'>Total</option>
									    </select>` + 
										" registros por página",
						"zeroRecords": "No se encontraron registros",
						"info": "Visualizando página _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrado de _MAX_ registros totales)",
						"search": "Buscar :",
						"paginate": {"next": "Siguiente", "previous": "Anterior"}
        			}
				});
			});
		</script> 	
	@elseif($tabla == 'maderas')
		<script>
			$(document).ready(function() {
				$('#maderas').DataTable({
					responsive: true,
					autoWidth: false,
					dom: '<"floatRight"B>lftrp',

					 buttons: {
      				 buttons: [
						   
            			{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Maderas', className: 'btn btn-success', exportOptions: {columns: ':not(:last-child)', } },
        				{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Maderas', className: 'btn btn-danger', exportOptions: {columns: ':not(:last-child)', } },
							  ],
       					dom: {
		  					button: {
		  					className: 'btn'
	        					 }
       					}
     				},
					"language": {
						"lengthMenu": "Mostrar " + 
									   `<select class="custom-select custom-select-sm form-control form-control-sm">
										<option value = '10'>10</option>
										<option value = '25'>25</option>
										<option value = '50'>50</option>
										<option value = '100'>100</option>
										<option value = '-1'>Total</option>
									    </select>` + 
										" registros por página",
						"zeroRecords": "No se encontraron registros",
						"info": "Visualizando página _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrado de _MAX_ registros totales)",
						"search": "Buscar :",
						"paginate": {"next": "Siguiente", "previous": "Anterior"}
        			}
				});
			});
		</script> 	
	@elseif($tabla == 'sucursal_producto')
		<script>
			$(document).ready(function() {
				$('#sucursal_producto').DataTable({
					responsive: true,
					autoWidth: false,
					dom: '<"floatRight"B>lftrp',

					 buttons: {
      				 buttons: [
						   
            			{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Inventario', className: 'btn btn-success', exportOptions: {columns: ':not(:last-child)', } },
        				{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Inventario', className: 'btn btn-danger', exportOptions: {columns: ':not(:last-child)', } },
							  ],
       					dom: {
		  					button: {
		  					className: 'btn'
	        					 }
       					}
     				},
					"language": {
						"lengthMenu": "Mostrar " + 
									   `<select class="custom-select custom-select-sm form-control form-control-sm">
										<option value = '10'>10</option>
										<option value = '25'>25</option>
										<option value = '50'>50</option>
										<option value = '100'>100</option>
										<option value = '-1'>Total</option>
									    </select>` + 
										" registros por página",
						"zeroRecords": "No se encontraron registros",
						"info": "Visualizando página _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrado de _MAX_ registros totales)",
						"search": "Buscar :",
						"paginate": {"next": "Siguiente", "previous": "Anterior"}
        			}
				});
			});
		</script> 	
	@elseif($tabla == 'inventarios')
		<script>
			$(document).ready(function() {
				$('#inventarios').DataTable({
					responsive: true,
					autoWidth: false,
					dom: '<"floatRight"B>lftrp',

					 buttons: {
      				 buttons: [
						   
            			{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Sucursales', className: 'btn btn-success', exportOptions: {columns: ':not(:last-child)', } },
        				{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Sucursales', className: 'btn btn-danger', exportOptions: {columns: ':not(:last-child)', } },
							  ],
       					dom: {
		  					button: {
		  					className: 'btn'
	        					 }
       					}
     				},
					"language": {
						"lengthMenu": "Mostrar " + 
									   `<select class="custom-select custom-select-sm form-control form-control-sm">
										<option value = '10'>10</option>
										<option value = '25'>25</option>
										<option value = '50'>50</option>
										<option value = '100'>100</option>
										<option value = '-1'>Total</option>
									    </select>` + 
										" registros por página",
						"zeroRecords": "No se encontraron registros",
						"info": "Visualizando página _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrado de _MAX_ registros totales)",
						"search": "Buscar :",
						"paginate": {"next": "Siguiente", "previous": "Anterior"}
        			}
				});
			});
		</script> 	
	@elseif($tabla == 'fotos')
		<script>
			$(document).ready(function() {
				$('#fotos').DataTable({
					responsive: true,
					autoWidth: false,
					dom: '<"floatRight"B>lftrp',

					 buttons: {
      				 buttons: [
						   
            			{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Imágenes', className: 'btn btn-success', exportOptions: {columns: ':not(:last-child)', } },
        				{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Imágenes', className: 'btn btn-danger', exportOptions: {columns: ':not(:last-child)', } },
							  ],
       					dom: {
		  					button: {
		  					className: 'btn'
	        					 }
       					}
     				},
					"language": {
						"lengthMenu": "Mostrar " + 
									   `<select class="custom-select custom-select-sm form-control form-control-sm">
										<option value = '10'>10</option>
										<option value = '25'>25</option>
										<option value = '50'>50</option>
										<option value = '100'>100</option>
										<option value = '-1'>Total</option>
									    </select>` + 
										" registros por página",
						"zeroRecords": "No se encontraron registros",
						"info": "Visualizando página _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrado de _MAX_ registros totales)",
						"search": "Buscar :",
						"paginate": {"next": "Siguiente", "previous": "Anterior"}
        			}
				});
			});
		</script> 	
	@elseif($tabla == 'ejecutivos')
		<script>
			$(document).ready(function() {
				$('#ejecutivos').DataTable({
					responsive: true,
					autoWidth: false,
					dom: '<"floatRight"B>lftrp',

					 buttons: {
      				 buttons: [
						   
            			{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Ejecutivos', className: 'btn btn-success', exportOptions: {columns: ':not(:last-child)', } },
        				{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Ejecutivos', className: 'btn btn-danger', exportOptions: {columns: ':not(:last-child)', } },
							  ],
       					dom: {
		  					button: {
		  					className: 'btn'
	        					 }
       					}
     				},
					"language": {
						"lengthMenu": "Mostrar " + 
									   `<select class="custom-select custom-select-sm form-control form-control-sm">
										<option value = '10'>10</option>
										<option value = '25'>25</option>
										<option value = '50'>50</option>
										<option value = '100'>100</option>
										<option value = '-1'>Total</option>
									    </select>` + 
										" registros por página",
						"zeroRecords": "No se encontraron registros",
						"info": "Visualizando página _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrado de _MAX_ registros totales)",
						"search": "Buscar :",
						"paginate": {"next": "Siguiente", "previous": "Anterior"}
        			}
				});
			});
		</script> 	
	@elseif($tabla == 'detalle_ventas')
		<script>
			$(document).ready(function() {
				$('#detalle_ventas').DataTable({
					responsive: true,
					autoWidth: false,
					dom: '<"floatRight"B>lftrp',

					 buttons: {
      				 buttons: [
						   
            			{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Detalle_ventas', className: 'btn btn-success', exportOptions: {columns: ':not(:last-child)', } },
        				{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Detalle_ventas', className: 'btn btn-danger', exportOptions: {columns: ':not(:last-child)', } },
							  ],
       					dom: {
		  					button: {
		  					className: 'btn'
	        					 }
       					}
     				},
					"language": {
						"lengthMenu": "Mostrar " + 
									   `<select class="custom-select custom-select-sm form-control form-control-sm">
										<option value = '10'>10</option>
										<option value = '25'>25</option>
										<option value = '50'>50</option>
										<option value = '100'>100</option>
										<option value = '-1'>Total</option>
									    </select>` + 
										" registros por página",
						"zeroRecords": "No se encontraron registros",
						"info": "Visualizando página _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrado de _MAX_ registros totales)",
						"search": "Buscar :",
						"paginate": {"next": "Siguiente", "previous": "Anterior"}
        			}
				});
			});
		</script> 	
	@elseif($tabla == 'clavos')
		<script>
			$(document).ready(function() {
				$('#clavos').DataTable({
					responsive: true,
					autoWidth: false,
					dom: '<"floatRight"B>lftrp',

					 buttons: {
      				 buttons: [
						   
            			{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Clavos', className: 'btn btn-success', exportOptions: {columns: ':not(:last-child)', } },
        				{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Clavos', className: 'btn btn-danger', exportOptions: {columns: ':not(:last-child)', } },
							  ],
       					dom: {
		  					button: {
		  					className: 'btn'
	        					 }
       					}
     				},
					"language": {
						"lengthMenu": "Mostrar " + 
									   `<select class="custom-select custom-select-sm form-control form-control-sm">
										<option value = '10'>10</option>
										<option value = '25'>25</option>
										<option value = '50'>50</option>
										<option value = '100'>100</option>
										<option value = '-1'>Total</option>
									    </select>` + 
										" registros por página",
						"zeroRecords": "No se encontraron registros",
						"info": "Visualizando página _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrado de _MAX_ registros totales)",
						"search": "Buscar :",
						"paginate": {"next": "Siguiente", "previous": "Anterior"}
        			}
				});
			});
		</script> 	
	@elseif($tabla == 'detalle_compras')
		<script>
			$(document).ready(function() {
				$('#detalle_compras').DataTable({
					responsive: true,
					autoWidth: false,
					dom: '<"floatRight"B>lftrp',

					 buttons: {
      				 buttons: [
						   
            			{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Detalle_compras', className: 'btn btn-success', exportOptions: {columns: ':not(:last-child)', } },
        				{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Detalle_compras', className: 'btn btn-danger', exportOptions: {columns: ':not(:last-child)', } },
							  ],
       					dom: {
		  					button: {
		  					className: 'btn'
	        					 }
       					}
     				},
					"language": {
						"lengthMenu": "Mostrar " + 
									   `<select class="custom-select custom-select-sm form-control form-control-sm">
										<option value = '10'>10</option>
										<option value = '25'>25</option>
										<option value = '50'>50</option>
										<option value = '100'>100</option>
										<option value = '-1'>Total</option>
									    </select>` + 
										" registros por página",
						"zeroRecords": "No se encontraron registros",
						"info": "Visualizando página _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrado de _MAX_ registros totales)",
						"search": "Buscar :",
						"paginate": {"next": "Siguiente", "previous": "Anterior"}
        			}
				});
			});
		</script> 	
	@elseif($tabla == 'ventas')
		<script>
			$(document).ready(function() {
				$('#ventas').DataTable({
					responsive: true,
					autoWidth: false,
					dom: '<"floatRight"B>lftrp',

					buttons: {
					buttons: [
						
						{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Ventas', className: 'btn btn-success', exportOptions: {columns: ':not(:last-child)', } },
						{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Ventas', className: 'btn btn-danger', exportOptions: {columns: ':not(:last-child)', } },
							],
						dom: {
							button: {
							className: 'btn'
								}
						}
					},
					"language": {
						"lengthMenu": "Mostrar " + 
									`<select class="custom-select custom-select-sm form-control form-control-sm">
										<option value = '10'>10</option>
										<option value = '25'>25</option>
										<option value = '50'>50</option>
										<option value = '100'>100</option>
										<option value = '-1'>Total</option>
										</select>` + 
										" registros por página",
						"zeroRecords": "No se encontraron registros",
						"info": "Visualizando página _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrado de _MAX_ registros totales)",
						"search": "Buscar :",
						"paginate": {"next": "Siguiente", "previous": "Anterior"}
					}
				});
			});
		</script> 	
	@endif


</body>
</html>

