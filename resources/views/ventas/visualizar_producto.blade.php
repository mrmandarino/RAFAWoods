@extends('ventas.master_producto')
@section('content')
@include('ventas.partials.iconos')


<div class="container-fluid tabla-h-scroll mt-2">
	<table id="productos" class="table" style="width:100%">
		<thead>
			<th> ID </th>
			<th> NOMBRE </th>
			<th> DESCRIPCION </th>
			<th> NIVEL DEMANDA </th>
			<th> FAMILIA </th>
			<th> ESTADO </th>
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
			</tr>
			@endforeach
		</tbody>
	</table>
</div>




<script>
	$(document).ready(function() {
				$('#productos').DataTable({
					responsive: true,
					autoWidth: false,
					dom: '<"floatRight"B>lftrp',
					lengthMenu: [15, 20, 25, -1],
					 buttons: {
      				 buttons: [
						   
            			{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Productos', className: 'btn btn-success'},
        				{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Productos', className: 'btn btn-danger'},
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
										<option value = '15'>15</option>
										<option value = '20'>20</option>
										<option value = '25'>25</option>
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