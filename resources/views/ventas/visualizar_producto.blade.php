@extends('ventas.master_producto')
@section('content')
@include('ventas.partials.iconos')


<div class="container-fluid tabla-h-scroll" >
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
				</tr>
			@endforeach 
		</tbody>
</div>




<script>
	$(document).ready(function() {
		$('#productos').DataTable({
			responsive: true,
			autoWidth: false,
			dom: '<"floatRight">lftrp',
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