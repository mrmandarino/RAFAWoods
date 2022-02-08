<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventario</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style type="text/css">
        .tornillos{
          display: none;  
        }
        .material{
          display: none;  
        }
        .clientes{
          display: none; 
        }
        .muebles{
          display: none;   
        }
        .maderas{
          display: none;     
        }
        .clavos{
          display: none;     
        }
        .medidas{
          display: none;  
        }
        .tornillos_clavos{
          display: none;   
        }
    </style>
</head>
<body>
    <div class="container">
		<header class="row">
			<div class="col">
				<h1>Inventario</h1>
			</div>
		</header>

		<section class="contenedor-main row align-items-center">
			<main class="col-md-8">
				<h2>Productos</h2>
                <form action="{{route('ver_detalle')}}" method="POST">
                    @csrf
                    @method('GET')
                    <div>
                        <select name="_producto" id="_producto">
                            <option selected>Escoja un producto</option>
                            @foreach ($productos as $item)
                            <option value="{{$item->familia}}">{{$item->familia}}</option>
                            @endforeach
                        </select>
                        <select name="_familia" id="_familia"></select>
                    </div>
                    <script>
                        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
                        document.getElementById('_producto').addEventListener('change',(e)=>{
                         fetch('familias',{
                            method : 'POST',
                            body: JSON.stringify({texto : e.target.value}),
                            headers:{
                                'Content-Type': 'application/json',
                                "X-CSRF-Token": csrfToken
                            }
                        }).then(response =>{
                            return response.json()
                        }).then( data =>{
                            var opciones ="<option value=''>Elegir</option>";
                            for (let i in data.lista) {
                               opciones+= '<option value="'+data.lista[i].id+'">'+data.lista[i].nombre+'</option>';
                            }
                            document.getElementById("_familia").innerHTML = opciones;
                        }).catch(error =>console.error(error));
                    })
                </script>
                
                <br>
                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" name="action" value="detalle">Detalle</button>
                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" name="action" value="realizar_venta">Realizar Venta</button>
                
                </form>
			</main>

            <aside class="col-md-4">
                <div class="row justify-content-between">
                    <div class="col-12 col-md-4 col-lg-3">
                        <!--Mensaje de stock con exito -->
                        @if (session()->has('correcto_eliminado'))
                            <div class="alert alert-success">
                                {{ session()->get('correcto_eliminado') }}
                            </div><br>
                        @endif
                    </div>        
                </div>
                <div class="row justify-content-between">
                    <div class="col-12 col-md-4 col-lg-3">
                        <!--Mensaje de stock con exito -->
                        @if (session()->has('correcto_agregado'))
                            <div class="alert alert-success">
                                {{ session()->get('correcto_agregado') }}
                            </div><br>
                        @endif
                    </div>        
                </div>
                <a href="{{route('ver_detalle_precios')}}"><button type="button" class="btn btn-primary" data-bs-toggle="modal" name="action" value="consultar_precio" style="width:90%">Consultar Precios</button></a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ingresar_producto" style="width:90%">Agregar Nuevo Producto</button>
            </aside>
		</section>
	</div>

    <div class="modal fade" id="ingresar_producto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:black">Agregar Nuevo Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('agregar_producto')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label" style="color:black">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" required>
                            <label for="recipient-name" class="col-form-label" style="color:black">Descripción</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" required></textarea>
                            <label for="recipient-name" class="col-form-label" style="color:black">Tipo de Producto</label>
                            <select class="form-control select" name="familia" id="familia" tabindex="3">
                                <option selected value=1>Seleccione un tipo de producto</option>
                                <option value="Tornillo">Tornillo</option>  
                                <option value="Plancha_construccion">Plancha de construcción</option>  
                                <option value="Techumbre">Techumbre</option>  
                                <option value="Mueble">Mueble</option>  
                                <option value="Madera">Madera</option>  
                                <option value="Clavo">Clavo</option>  
                            </select>

                            
                            <div class="form-group tornillos_clavos">
                                <label for="" class="form-label" style="color:black">Cabeza</label>
                                <input id="cabeza" name="cabeza" type="number" step="0.01" class="form-control" tabindex="4" value="{{old('cabeza')}}">
                            </div>

                            <div class="form-group tornillos">
                                <label for="" class="form-label" style="color:black">Tipo rosca</label>
                                <select class="form-control select" name="tipo_rosca" id="tipo_rosca" tabindex="5"> 
                                    <option value="total" {{ old('tipo_rosca')=="total" ? 'selected' : ''  }}>Total</option>  
                                    <option value="parcial" {{ old('tipo_rosca')=="parcial" ? 'selected' : ''  }}>Parcial</option> 
                                </select>
                            </div>

                            <div class="form-group tornillos">
                                <label for="" class="form-label" style="color:black">Separación rosca</label>
                                <input id="separacion_rosca" name="separacion_rosca" type="number" step="0.01" class="form-control" tabindex="6" value="{{old('separacion_rosca')}}">
                            </div>

                            <div class="form-group tornillos_clavos">
                                <label for="" class="form-label" style="color:black">Punta</label>
                                <input id="punta" name="punta" type="text" class="form-control" tabindex="7" value="{{old('punta')}}">
                            </div>

                            <div class="form-group tornillos">
                                <label for="" class="form-label" style="color:black">Rosca parcial</label>
                                <input id="rosca_parcial" name="rosca_parcial" type="number" step="0.01" class="form-control" tabindex="8" value="{{old('rosca_parcial')}}">
                            </div>

                            <div class="form-group tornillos">
                                <label for="" class="form-label" style="color:black">Vastago</label>
                                <input id="vastago" name="vastago" type="number" step="0.01" class="form-control" tabindex="9" value="{{old('vastago')}}">
                            </div>

                            <div class="form-group material">
                                <label for="" class="form-label" style="color:black">Material</label>
                                <input id="material" name="material" type="text" class="form-control" tabindex="10" value="{{old('material')}}">
                            </div>

                            <div class="form-group medidas">
                                <label for="" class="form-label" style="color:black">Alto</label>
                                <input id="alto" name="alto" type="number" step="0.01" class="form-control" tabindex="11" value="{{old('alto')}}">
                            </div>

                            <div class="form-group medidas">
                                <label for="" class="form-label" style="color:black">Ancho</label>
                                <input id="ancho" name="ancho" type="number" step="0.01" class="form-control" tabindex="12" value="{{old('ancho')}}">
                            </div>

                            <div class="form-group medidas">
                                <label for="" class="form-label" style="color:black">Largo</label>
                                <input id="largo" name="largo" type="number" step="0.01" class="form-control" tabindex="13" value="{{old('largo')}}">
                            </div>

                            <div class="form-group muebles">
                                <label for="" class="form-label" style="color:black">Acabado</label>
                                <input id="acabado" name="acabado" type="text" class="form-control" tabindex="14" value="{{old('acabado')}}">
                            </div>

                            <div class="form-group maderas">
                                <label for="" class="form-label" style="color:black">Tipo madera</label>
                                <input id="tipo_madera" name="tipo_madera" type="text" class="form-control" tabindex="15" value="{{old('tipo_madera')}}">
                            </div>

                            <div class="form-group maderas">
                                <label for="" class="form-label" style="color:black">Tratamiento</label>
                                <input id="tratamiento" name="tratamiento" type="text" class="form-control" tabindex="16" value="{{old('tratamiento')}}">
                            </div>

                            <div class="form-group clavos">
                                <label for="" class="form-label" style="color:black">Longitud</label>
                                <input id="longitud" name="longitud" type="number" step="0.01" class="form-control" tabindex="17" value="{{old('longitud')}}">
                            </div>

                            <label for="recipient-name" class="col-form-label" style="color:black">Stock</label>
                            <input type="number" class="form-control" name="stock" id="stock" min="1" required>

                            <label for="recipient-name" class="col-form-label" style="color:black">Precio Compra</label>
                            <input type="number" class="form-control" name="precio_compra" id="precio_compra" min="1" step="100" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary"
                                onclick="return confirm('¿Estás seguro del stock ingresado?')">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<script src="js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){ 
    $("#familia").on('change',function(){
       var selectedBalue = $("#familia").val();
       if (selectedBalue == "Tornillo") 
       {
         $(".tornillos").slideDown(200);   
       }
       else{
         $(".tornillos").slideUp(200);   
       }
       if (selectedBalue == "Plancha_construccion" || selectedBalue == "Techumbre" || selectedBalue == "Mueble" || selectedBalue == "Clavo") 
       {
         $(".material").slideDown(200);
       }
       else{
         $(".material").slideUp(200);
       }
       if (selectedBalue == "Tornillo" || selectedBalue == "Clavo") 
       {
           $(".tornillos_clavos").slideDown(200); 
       }
       else{
           $(".tornillos_clavos").slideUp(200);
       }
       if (selectedBalue == "Plancha_construccion" || selectedBalue == "Techumbre" || selectedBalue == "Mueble" || selectedBalue == "Madera") 
       {
         $(".medidas").slideDown(200);   
       }
       else{
         $(".medidas").slideUp(200);
       }
       if (selectedBalue == "Mueble") 
       {
         $(".muebles").slideDown(200); 
       }
       else{
         $(".muebles").slideUp(200);
       }
       if (selectedBalue == "Madera") 
       {
         $(".maderas").slideDown(200);   
       }
       else{
         $(".maderas").slideUp(200);
       }
       if (selectedBalue == "Clavo") 
       {
         $(".clavos").slideDown(200);  
       }
       else{
         $(".clavos").slideUp(200);
       }
    }); 
    }
     
    );
</script> 
</body>
</html>