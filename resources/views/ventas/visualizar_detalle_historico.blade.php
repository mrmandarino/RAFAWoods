@extends('ventas.master_historico')
@section('content')
@include('ventas.partials.iconos')

<div class="container-fluid mt-3" style="overflow:auto">

	<table id="detalle_ventas" class="table" style="width:100%">
		<thead>
			<th> ID VENTA </th>
			<th> ID PRODUCTO </th>
			<th> CANTIDAD </th>
			<th> TOTAL PRODUCTO </th>
			<th> FECHA REGISTRO </th>
			<th> FECHA ACTUALIZACION </th>
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
				</tr>
			@endforeach
		</tbody>

	</table>
	

	
	
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script> 
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/r-2.2.9/datatables.min.js"></script>

	<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script> {{-- Necesario para ver los botones --}} 
	<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script> {{-- Necesario para ver los botones --}} 
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> {{-- Excel --}} 
	<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script> {{-- Imprimir(PDF) --}}


	<script>
		$(document).ready(function() {
			$('#detalle_ventas').DataTable({
				responsive: true,
				autoWidth: false,
				dom: '<"floatRight"B>lftrp',
				
				 buttons: {
				   buttons: [
						{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Detalle_venta', className: 'btn btn-success'},
						{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Detalle_ventas', className: 'btn btn-danger'},
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



</div>


@endsection