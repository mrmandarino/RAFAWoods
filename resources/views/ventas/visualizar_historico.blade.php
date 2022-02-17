@extends('ventas.master_historico')
@section('content')
@include('ventas.partials.iconos')


<div class="container-fluid tabla-h-scroll">
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
					<a href="{{route('ver_detalle_historico',['id' => $venta->id])}}" class="btn btn-info">
						Detalle</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	
	</table>

</div>




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




@endsection