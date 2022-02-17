<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Portal Precios</title>

    <link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/estilos.css">

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
	<div class="container">
		<header class="row">
			<div class="col">
				<h1>Precios Productos</h1>
			</div>
		</header>     
	</div>

    <div class="container col-md-8 col-md-offset-2 tabla-scroll">
        <div class="panel panel-default">
            <div class="panel-heading">
            </div>
            <table id="precios_productos" class="table" style="width:100%">
                    <thead class="bg-white divide-y">
                        <tr>
                            <th class="text-center text-black">Familia</th>
                            <th class="text-center text-black">Nombre</th>
                            <th class="text-center text-black">Stock</th>
                            <th class="text-center text-black">Precio (IVA incluido)</th>
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
                                <td class="text-center text-black">${{($producto_en_stock->precio_compra+($producto_en_stock->precio_compra*0.19))}}</td>
                                </tr>
                                @endif    
                                @endforeach
                            
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>

	<script src="/js/bootstrap.bundle.min.js"></script>
    
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
			$('#precios_productos').DataTable({
				responsive: true,
				autoWidth: false,
				lengthMenu: [15, 20, 25, -1],
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



</body>
</html>