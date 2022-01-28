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
		
		<a href="{{route('admin_visualizar_datos')}}" class="bg-ucn-color hover:bg-ucn-color focus:bg-green-900 | focus:outline-none border rounded-md text-white focus:text-white p-2 transition ease-in-out duration-150">
			<button>
				Volver 
			</button>
		</a>   
		
	<table id="example" class="table table-striped" style="width:100%">
		@if ($tabla == 'usuarios')
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
						<td></td>
					</tr>
				@endforeach
			</tbody>
	
		@endif

		@if ($tabla == 'clientes')
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
						<td></td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'trabajadores')
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
						<td></td>
					</tr>
				@endforeach
			</tbody>

			
		@endif

		@if ($tabla == 'madera_proveedores')
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
						<td></td>
					</tr>
				@endforeach
			</tbody>

				
		@endif

		@if ($tabla == 'transportes')
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
						<td></td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'tornillos')
			<thead>
				<th> ID PRODUCTO </th>
				<th> CABEZA </th>
				<th> TIPO ROSCA </th>
				<th> ROSCA </th>
				<th> PUNTA </th>
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
						<td> {{$tornillo->rosca}} </td>
						<td> {{$tornillo->punta}} </td>
						<td> {{$tornillo->created_at}} </td>
						<td> {{$tornillo->updated_at}} </td>
						<td></td>
					</tr>
				@endforeach
			</tbody>
				
		@endif

		@if ($tabla == 'telefono_proveedores')
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
						<td></td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'techumbres')
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
						<td></td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'proveedores')
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
						<td> {{$techumbre->created_at}} </td>
						<td> {{$techumbre->updated_at}} </td>
						<td></td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'productos')
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
						<td></td>
					</tr>
				@endforeach
				</tbody>

		@endif

		@if ($tabla == 'planchas_construccion')
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
						<td></td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'muebles')
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
						<td></td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'maderas')
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
						<td></td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'sucursal_producto')
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
						<td></td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'inventarios')
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
						<td></td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'fotos')
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
						<td></td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'ejecutivos')
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
						<td></td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'compras')
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
						<td></td>
					</tr>
				@endforeach
			</tbody>

		@endif

		@if ($tabla == 'clavos')
			<thead>
				<th> ID PRODUCTO </th>
				<th> MATERIAL </th>
				<th> CABEZA </th>
				<th> CAÑA </th>
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
						<td> {{$clavo->caña}} </td>
						<td> {{$clavo->punta}} </td>
						<td> {{$clavo->longitud}} </td>
						<td> {{$clavo->created_at}} </td>
						<td> {{$clavo->updated_at}} </td>
						<td></td>
					</tr>
				@endforeach
			</tbody>

		@endif
	</table>
	
	

	
	{{-- <script src="/js/bootstrap.bundle.min.js"></script> --}}

	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>


	<script>
	$(document).ready(function() {
		$('#example').DataTable();
	} );
	</script>

</body>
</html>

