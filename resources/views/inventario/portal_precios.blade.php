@extends('inventario.master_productos')
@section('content')
@include('ventas.partials.iconos')


<div class="container-fluid mt-3" style="overflow:auto">
	<div class="panel panel-default">

		<table id="precios_productos" class="table" style="width:100%">
			<thead class="bg-white divide-y">
				<tr>
					<th class="text-center text-black">Familia</th>
					<th class="text-center text-black">Nombre</th>
					<th class="text-center text-black">Stock</th>
					<th class="text-center text-black">Precio (IVA incluido)</th>
					<th> Ver detalle </th>
				</tr>
			</thead>
			<tbody class="bg-white divide-y">
				@foreach($productos_en_bruto as $producto_en_bruto)
				@foreach ($productos_en_stock as $producto_en_stock )
				@if ($producto_en_bruto->id == $producto_en_stock->producto_id && $producto_en_stock->sucursal_id == 1)
				<tr>
					<td class="text-center text-black">{{$producto_en_bruto->familia}}</td>
					<td class="text-center text-black">{{$producto_en_bruto->nombre}}</td>
					<td class="text-center text-black">{{$producto_en_stock->stock}}</td>
					<td class="text-center text-black">
						${{($producto_en_stock->precio_compra+($producto_en_stock->precio_compra*0.19))}}</td>
					<td>
						<a data-bs-toggle="modal" data-bs-target="#modal_aux{{$producto_en_bruto->id}}"
							class="btn btn-info" type="button">Ver detalle</a>
					</td>
				</tr>
				<div class="modal fade" id="modal_aux{{$producto_en_bruto->id}}" aria-labelledby="exampleModalLabel"
					aria-hidden="true" tabindex="-1">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel" style="color:black">
									{{$producto_en_bruto->nombre}} </h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<label for="recipient-name" class="col-form-label"
									style="color:black">Descripción</label>
								<textarea class="form-control" name="descripcion" id="descripcion" required
									disabled>{{$producto_en_bruto->descripcion}}</textarea>

								@if ($producto_en_bruto->familia == "Tornillo")
								@php($tornillo=App\Models\Tornillo::find($producto_en_bruto->id))
								<label for="recipient-name" class="col-form-label" style="color:black">Cabeza (mm)</label>
								<input type="text" value="{{$tornillo->cabeza}}" class="form-control" name="cabeza"
									id="cabeza" required disabled>
								<label for="recipient-name" class="col-form-label" style="color:black">Tipo
									rosca</label>
								<input type="text" value="{{$tornillo->tipo_rosca}}" class="form-control"
									name="tipo_rosca" id="tipo_rosca" required disabled>
								<label for="recipient-name" class="col-form-label" style="color:black">Separación
									rosca (mm)</label>
								<input type="text" value="{{$tornillo->separacion_rosca}}" class="form-control"
									name="separacion_rosca" id="separacion_rosca" required disabled>
								<label for="recipient-name" class="col-form-label" style="color:black">Punta</label>
								<input type="text" value="{{$tornillo->punta}}" class="form-control" name="punta"
									id="punta" required disabled>
								<label for="recipient-name" class="col-form-label" style="color:black">Rosca
									parcial (mm)</label>
								<input type="text" value="{{$tornillo->rosca_parcial}}" class="form-control"
									name="rosca_parcial" id="rosca_parcial" required disabled>
								<label for="recipient-name" class="col-form-label" style="color:black">Vástago (mm)</label>
								<input type="text" value="{{$tornillo->vastago}}" class="form-control" name="vastago"
									id="vastago" required disabled>

								@elseif ($producto_en_bruto->familia == "Mueble")
								@php($mueble=App\Models\Mueble::find($producto_en_bruto->id))
								<label for="recipient-name" class="col-form-label" style="color:black">Material</label>
								<input type="text" value="{{$mueble->material}}" class="form-control" name="material"
									id="material" required disabled>
								<label for="recipient-name" class="col-form-label" style="color:black">Acabado</label>
								<input type="text" value="{{$mueble->acabado}}" class="form-control" name="acabado"
									id="acabado" required disabled>
								<label for="recipient-name" class="col-form-label" style="color:black">Alto (m)</label>
								<input type="text" value="{{$mueble->alto}}" class="form-control" name="alto" id="alto"
									required disabled>
								<label for="recipient-name" class="col-form-label" style="color:black">Ancho (m)</label>
								<input type="text" value="{{$mueble->ancho}}" class="form-control" name="ancho"
									id="ancho" required disabled>
								<label for="recipient-name" class="col-form-label" style="color:black">Largo (m)</label>
								<input type="text" value="{{$mueble->largo}}" class="form-control" name="largo"
									id="largo" required disabled>

								@elseif($producto_en_bruto->familia == "Plancha_construccion")
								@php($plancha_construccion=App\Models\Plancha_construccion::find($producto_en_bruto->id))
								<label for="recipient-name" class="col-form-label" style="color:black">Material</label>
								<input type="text" value="{{$plancha_construccion->material}}" class="form-control"
									name="material" id="material" required disabled>
								<label for="recipient-name" class="col-form-label" style="color:black">Alto (m)</label>
								<input type="text" value="{{$plancha_construccion->alto}}" class="form-control"
									name="alto" id="alto" required disabled>
								<label for="recipient-name" class="col-form-label" style="color:black">Ancho (mm)</label>
								<input type="text" value="{{$plancha_construccion->ancho}}" class="form-control"
									name="ancho" id="ancho" required disabled>
								<label for="recipient-name" class="col-form-label" style="color:black">Largo (m)</label>
								<input type="text" value="{{$plancha_construccion->largo}}" class="form-control"
									name="largo" id="largo" required disabled>

								@elseif ($producto_en_bruto->familia == "Techumbre")
								@php($techumbre=App\Models\Techumbre::find($producto_en_bruto->id))
								<label for="recipient-name" class="col-form-label" style="color:black">Material</label>
								<input type="text" value="{{$techumbre->material}}" class="form-control" name="material"
									id="material" required disabled>
								<label for="recipient-name" class="col-form-label" style="color:black">Alto (m)</label>
								<input type="text" value="{{$techumbre->alto}}" class="form-control" name="alto"
									id="alto" required disabled>
								<label for="recipient-name" class="col-form-label" style="color:black">Ancho (mm)</label>
								<input type="text" value="{{$techumbre->ancho}}" class="form-control" name="ancho"
									id="ancho" required disabled>
								<label for="recipient-name" class="col-form-label" style="color:black">Largo (m)</label>
								<input type="text" value="{{$techumbre->largo}}" class="form-control" name="largo"
									id="largo" required disabled>

								@elseif($producto_en_bruto->familia == "Madera")
								@php($madera=App\Models\Madera::find($producto_en_bruto->id))
								<label for="recipient-name" class="col-form-label" style="color:black">Alto (in)</label>
								<input type="text" value="{{$madera->alto}}" class="form-control" name="alto" id="alto"
									required disabled>
								<label for="recipient-name" class="col-form-label" style="color:black">Ancho (in)</label>
								<input type="text" value="{{$madera->ancho}}" class="form-control" name="ancho"
									id="ancho" required disabled>
								<label for="recipient-name" class="col-form-label" style="color:black">Largo (m)</label>
								<input type="text" value="{{$madera->largo}}" class="form-control" name="largo"
									id="largo" required disabled>
								<label for="recipient-name" class="col-form-label" style="color:black">Tipo de
									madera</label>
								<input type="text" value="{{$madera->tipo_madera}}" class="form-control"
									name="tipo_madera" id="tipo_madera" required disabled>
								<label for="recipient-name" class="col-form-label"
									style="color:black">Tratamiento</label>
								<input type="text" value="{{$madera->tratamiento}}" class="form-control"
									name="tratamiento" id="tratamiento" required disabled>

								@elseif($producto_en_bruto->familia == "Clavo")
								@php($clavo=App\Models\Clavo::find($producto_en_bruto->id))
								<label for="recipient-name" class="col-form-label" style="color:black">Material</label>
								<input type="text" value="{{$clavo->material}}" class="form-control" name="material"
									id="material" required disabled>
								<label for="recipient-name" class="col-form-label" style="color:black">Cabeza (mm)</label>
								<input type="text" value="{{$clavo->cabeza}}" class="form-control" name="cabeza"
									id="cabeza" required disabled>
								<label for="recipient-name" class="col-form-label" style="color:black">Punta</label>
								<input type="text" value="{{$clavo->punta}}" class="form-control" name="punta"
									id="punta" required disabled>
								<label for="recipient-name" class="col-form-label" style="color:black">Longitud (mm)</label>
								<input type="text" value="{{$clavo->longitud}}" class="form-control" name="longitud"
									id="longitud" required disabled>

								@endif
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary"
										data-bs-dismiss="modal">Cerrar</button>
								</div>

							</div>
						</div>
					</div>
				</div>

				@endif
				@endforeach

				@endforeach
			</tbody>
		</table>
	</div>
</div>




<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/r-2.2.9/datatables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script> {{-- Necesario para ver
los botones --}}
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script> {{-- Necesario para ver los
botones --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> {{-- Excel --}}
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script> {{-- Imprimir(PDF) --}}

<script>
	$(document).ready(function() {
			$('#precios_productos').DataTable({
				responsive: true,
				autoWidth: false,
				lengthMenu: [10, 25, 50, 100, -1],
				dom: '<"floatRight"B>lftrp',

				 buttons: {
				   buttons: [
					   
					{ extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', title: '', filename:'Precio_productos', className: 'btn btn-success'},
					{ extend: 'print', text: '<i class="fas fa-file-pdf"></i> PDF', title: '', filename:'Precios_productos', className: 'btn btn-danger'},
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
									<option value = '-1'>Todos</option>
									</select>`,
									
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