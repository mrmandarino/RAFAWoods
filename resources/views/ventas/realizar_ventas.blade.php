@extends('ventas.master_ventas')
@section('content')
@include('ventas.partials.iconos')

{{-- script de carrito de compras --}}

<script type=text/javascript defer>
  $(document).ready(function() {
	const bclick = document.getElementById('boton_agregar_a_compra');
  const shoppingCartItemsContainer = document.querySelector('.shoppingCartItemsContainer');
  const json_final = document.getElementById('hidden');
	bclick.addEventListener('click',addToCartClicked);

  function addToCartClicked(event) 
  {
    const button = event.target;
    const productos = document.getElementById('datalist_productos');
    const producto_seleccionado = document.querySelector('#nombre_producto');
    const opSelected = productos.querySelector(`[value="${producto_seleccionado.value}"]`);
    
    
    const nombre_producto = producto_seleccionado.value;//Nombre del Producto
    const id_producto = opSelected.getAttribute('data-value');//Id producto seleccionado
    const cantidad_producto = document.getElementById('cantidad').value;//Cantidad de producto a comprar
    const valor_producto = document.getElementById('valor_unidad').value;//Valor del producto a comprar
    const valor_final = cantidad_producto*valor_producto;
    addItemToShoppingCart(nombre_producto,id_producto,cantidad_producto,valor_final,valor_producto);
  }

  function addItemToShoppingCart(nombre_producto,id_producto,cantidad_producto,valor_final,valor_producto)
  {
    var habilitado_para_comprar = check_stock();
    if(habilitado_para_comprar == true)
    {
      const elementsId = shoppingCartItemsContainer.getElementsByClassName('shoppingCartItemId');
      for(let i = 0; i<elementsId.length;i++){
        if(elementsId[i].innerText == id_producto){

          //Actualizar Cantidad del item duplicado
          let element_quant = elementsId[i].parentElement.querySelector('.shoppingCartItemQuantity');
          let element_quant_int = parseInt(element_quant.innerText);
          let new_element_quant = element_quant_int + parseInt(cantidad_producto);
          element_quant.innerText = new_element_quant;
          

          //Actualizar precio total del item duplicado
          let element_price = elementsId[i].parentElement.querySelector('.shoppingCartItemPrice');
          let new_element_price = new_element_quant*parseInt(valor_producto);
          element_price.innerText = new_element_price;


          //Removiendo registro repetido de archivo JSON
          var json_arr = JSON.parse(json_final.value);
          var pos = 0;
          for(json_obj of json_arr){
            if(json_obj.producto_id == id_producto){
              json_arr[pos].cantidad = new_element_quant;
              json_arr[pos].total_producto = new_element_price;
              pos = 0;
              var json_arr_str = JSON.stringify(json_arr);
              var contenido = json_arr_str.replace("[","");
              var contenido = json_arr_str.replace("]","");
              JSON_update(json_arr_str,contenido);
              update_total_compra();
              return;
            }
            pos++;
          }
          
        }
      }
      const shoppingCartRow = document.createElement('tr');
      shoppingCartRow.setAttribute('class','shoppingCartItem');
      shoppingCartRow.setAttribute('id','item_carrito');
      const shoppingCartContent = `
                <tr>
                <td class="shoppingCartItemId text-center" id="id_item_carrito">${id_producto}</td>
                <td class="shoppingCartItemName text-center" id="nombre_item_carrito">${nombre_producto}</td>
                <td class="shoppingCartItemQuantity text-center" id="cantidad_item_carrito">${cantidad_producto}</td>
                <td class="shoppingCartItemPrice text-center" id="valor_item_carrito">${valor_final}</td>
                <td class="text-center"><button type="button" class="btn btn-danger">???</button></td>
                </tr>
      `;
  
      shoppingCartRow.innerHTML = shoppingCartContent;
      shoppingCartItemsContainer.append(shoppingCartRow);
  
      shoppingCartRow.querySelector('.btn-danger').addEventListener('click',() => {removeShoppingCartItem(event,id_producto,nombre_producto,cantidad_producto,valor_final);});
      update_total_compra();
      JSON_append(id_producto,nombre_producto,cantidad_producto,valor_final);
    }else{
      alert('Est??s excediendo el stock disponible');
    }
  }

  function update_total_compra() 
  {
    let total = 0;
    // const total_compra = document.getElementById('total_compra');
    // const total_compra_string = total_compra.value;
    // const total_compra_int = parseInt(total_compra_string);
    // total_compra.value =(total_compra_int + valor_final);

    const items_carrito = document.querySelectorAll('.shoppingCartItem');
    
    items_carrito.forEach((item_carrito)=>{
      const valor_item_carrito = item_carrito.querySelector('.shoppingCartItemPrice');
      const valor_item_carrito_number = Number(valor_item_carrito.textContent);
      total = total + valor_item_carrito_number;
    });
    const shoppingCartTotal = document.getElementById('total_compra');

    shoppingCartTotal.value = Intl.NumberFormat("de-DE").format(total);
    
    
  }
  function removeShoppingCartItem(event,id_producto,nombre_producto,cantidad_producto,valor_final)
  {
    JSON_remove(id_producto,nombre_producto,cantidad_producto,valor_final);
    const button_clicked = event.target;
    button_clicked.closest('.shoppingCartItem').remove();
    update_total_compra();
  }

  function check_stock() {
    var stock_js = document.getElementById('stock');
    var cantidad_js = document.getElementById('cantidad');
    if(stock_js.value >= cantidad_js.value)
    {
      return true;
    }
    return false;
  }

});


</script>

<div class="container">

  {{-- Fila global 2 formularios y Tabla --}}
  <div class="row justify-content-evenly mt-3">

    {{-- Fila 2 formularios --}}
    <div class="row justify-content-evenly">
      {{-- Columna formulario agregar producto a la venta (IZQUIERDA) --}}
      <div class="col-6 card p-3 bg-light mt-3 col-form-izq">

        <div class="row mx-3 justify-content-center">
          <div class="col-md-7 card form-izq ml-3">
            <h4 class="text-center">???? Productos ????</h4>
          </div>
        </div>

        <form class="row g-3 mt-3 col-form-izq form-izq">
          @csrf

          <div class="row">
            <div class="col-md-12">
              <div class="input-group">

                <label for="producto" class="input-group-text">Producto:</label>
                <input class="form-control" list="datalist_productos" id="nombre_producto" onchange="cargar_datos()"
                  placeholder="Escriba para buscar...">
                <datalist id="datalist_productos">
                  @foreach ($productos as $producto)
                  <option data-value="{{$producto->id}}" value="{{$producto->nombre}}">
                    @endforeach
                </datalist>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-6">
              <label for="codigo" class="form-label">C??digo</label>
              <div class="input-group">
                <label for="codigo" class="input-group-text">???</label>
                <input class="form-control" type="text" id="codigo" value="" aria-label="readonly input example"
                  readonly>
              </div>
            </div>

            <div class="col-md-6">
              <label for="stock" class="form-label">Stock</label>
              <div class="input-group">
                <label for="stock" class="input-group-text">#</label>
                <input class="form-control" type="number" id="stock" aria-label="readonly input example" readonly>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <label for="valor-u" class="form-label">Valor Unidad</label>
              <div class="input-group">
                <label for="valor_unidad" class="input-group-text">$</label>
                <input class="form-control" type="number" id="valor_unidad" readonly>
              </div>
            </div>


            <div class="col-md-6">
              <label for="cantidad" class="form-label">Cantidad</label>
              <div class="input-group">
                <label for="cantidad" class="input-group-text">#</label>
                <input type="number" class="form-control" id="cantidad" value="1" min="1">
              </div>
            </div>

          </div>

          <div class="row justify-content-evenly botones ">
            <div class="col-md-4">
              <button type="button" class="btn btn-danger" onclick="quitar_producto()">Quitar Producto</button>
            </div>
            <div class="col-md-4 ">
              <button type="button" id="boton_agregar_a_compra" class="btn btn-primary">Agregar a Venta</button>
            </div>
          </div>
        </form>



      </div>

      {{-- formulario valor actual de la venta (DERECHA) --}}
      <div class="col-5 card p-3 bg-light col-form-der">

        <div class="row mx-3 justify-content-center">
          <div class="col-md-7 card form-der ml-3">
            <h4 class="text-center">???? Venta ????</h4>
          </div>
        </div>
        <form action="{{route('ventas.store')}}"class="row g-3 my-auto col-form-der form-der" method="POST">
          @csrf
          <div class="col-md-12">
            <div class="input-group">
              <label for="total_compra" class="input-group-text">Total Venta:</label>
              <input class="form-control form-control-lg" type="text" name="total_compra" id="total_compra" value="0"
                placeholder="El total es de:" aria-label=".form-control-lg example" readonly>
            </div>
          </div>

          <div class="col-6">
            <label for="fecha" class="form-label">Fecha</label>
            <div class="input-group">
              <label for="fecha" class="input-group-text">&#x1F4C6;</label>
              <input type="text" class="form-control" id="fecha" readonly>
            </div>
          </div>

          <div class="col-6">
            <label for="fecha" class="form-label">Nro. Venta</label>
            <div class="input-group">
              <label for="fecha" class="input-group-text">???</label>
              <input type="text" class="form-control" name="id_venta" id="id_venta" value="{{$id_venta}}" readonly>
            </div>
          </div>

          <div class="col-6 ">
            <label for="fecha" class="form-label">Medio de Pago</label>
            <select class="form-select" aria-label="Default select example" name ="medio_pago" id="medio_pago" required>
              <option selected>Seleccionar...</option>
              <option value="1">Efectivo ????</option>
              <option value="2">T. D??bito ????</option>
              <option value="3">T. Cr??dito ????</option>
              <option value="4">Transferencia ????</option>
            </select>
          </div>
          <div class="col-6">
            <div class="row">
              <div class="col">


                <label for="rut_cliente" class="form-label">Rut Cliente</label>
                <input class="form-control" list="datalist_rut" name ="rut_cliente" id="rut_cliente" placeholder="Buscar Rut...">
                <datalist id="datalist_rut">
                  @foreach ($clientes as $cliente)
                  <option value="{{$cliente->usuario_rut}}">
                    @endforeach
                </datalist>

              </div>

            </div>
            <div class="row mt-1">
              <div class="col">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" onclick="con_factura()">
                  <label class="form-check-label" for="flexSwitchCheckDefault"data-bs-toggle="tooltip" data-bs-placement="right" title="Si la opci??n est?? desactivada la venta se har?? con boleta." id="documento_fiscal">Se Requiere Factura.</label>
                  <label data-bs-toggle="tooltip" data-bs-placement="right" title="Si la opci??n est?? desactivada la venta se har?? con boleta."><small>????</small></label>
                </div>

              </div>
            </div>
          </div>
          <div class="row justify-content-evenly botones ml-3">
            
            <div class="col-md-4">
              <a class="btn btn-danger" href="{{ route('ventas.create') }}" role="button">Cancelar Venta</a>
            </div>
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary">Realizar Venta</button>
            </div>
            

            {{-- input escondido que envia el JSON con el detalle_venta --}}
            <input type="text" class="visually-hidden" name ="hidden" id="hidden">
          </div>
        </form>
        
      </div>

    </div>

    {{-- Tabla con detalle de producto --}}

    <div class="row mt-3 px-5">

      <div class="col-md-12 card bg-light tabla-scroll">
        <div class="row mx-3 mt-3 justify-content-center">
          <div class="col-md-3 card form-izq ml-3">
            <h4 class="text-center">???? Carrito ????</h4>
          </div>
        </div>

        <table class="table table-hover pb-3">
          <thead>
            <tr>
              <th class="text-center">Codigo</th>
              <th class="text-center">nombre</th>
              <th class="text-center">cantidad</th>
              <th class="text-center">valor total</th>
              <th class="text-center">descartar</th>

            </tr>
          </thead>
          <tbody class="shoppingCartItemsContainer">

          </tbody>
        </table>
      </div>
    </div>

  </div>

  <script type="text/javascript">
        
    var content ="";
    var json_final = "["+ content +"]";
    const shoppingCartItemsContainer = document.querySelector('.shoppingCartItemsContainer');

    
    function JSON_append(id_producto,nombre_producto,cantidad_producto,valor_final){
        
        var id = parseInt(id_producto);
        var cantidad = parseInt(cantidad_producto);
        content = content + '{"producto_id": '+id+', "nombre": '+'"'+nombre_producto+'"'+', "cantidad": '+cantidad+', "total_producto": '+ valor_final +'},';
        json_final = '['+ content +']';
        json_final = json_final.replace("},]","}]");
        var input_hidden = document.getElementById('hidden'); 
        input_hidden.value = json_final;
        console.log(input_hidden.value);
        
    }

    var extraer ="";
    function JSON_remove(id,nombre,cantidad,final){
      extraer = '{"producto_id": '+id+', "nombre": '+'"'+nombre+'"'+', "cantidad": '+cantidad+', "total_producto": '+ final +'}';
      json_final = json_final.replace(extraer,"");
      json_final = json_final.replace("[,{","[{");
      json_final = json_final.replace("},,{","},{");
      var input_hidden = document.getElementById('hidden'); 
      input_hidden.value = json_final;
      console.log(input_hidden.value);
    }

    function JSON_update(json_updated,contenido_updated)
    {
      json_final = json_updated;
      content = contenido_updated;
      var input_hidden = document.getElementById('hidden'); 
      input_hidden.value = json_final;
      console.log(input_hidden.value);
    }
    
  </script>


  {{-- Agregar fecha (solo lectura) y switch factura --}}
  
  <script type="text/javascript">
    //poner fecha al abrir la pagina
  const date = new Date();
  const fecha_mysql = date.toISOString().split("T")[0];
  var fecha_js = document.getElementById('fecha');
  fecha_js.value = fecha_mysql;

  var factura = false;  
  function con_factura(){
    if(factura==false){
    document.getElementById('documento_fiscal').innerHTML = "Venta con Factura";
    factura = true;
    }
    else{
    document.getElementById('documento_fiscal').innerHTML = "Se Requiere Factura";
    factura = false;

    }
  }
  </script>

  {{-- boton quitar producto --}}

  <script type="text/javascript">
    function quitar_producto(){
    
    var nombre_producto_js = document.getElementById('nombre_producto');
    var codigo_js = document.getElementById('codigo');
    var stock_js = document.getElementById('stock');
    var valor_unidad_js = document.getElementById('valor_unidad');

    nombre_producto_js.value = "";
    codigo_js.value = "";
    stock_js.value = "";
    valor_unidad_js.value = "";
  }
    
  
  </script>

  {{-- Query con Javascript y arreglos recibidos desde Controlador --}}
  
  <script type="text/javascript">
    //var arreglo = parseInt('<?php echo $productos; ?>');
  <?php
  $js_array = json_encode($productos);
  echo "var producto_js = ". $js_array . ";\n";
  ?>
  <?php
  $js_array = json_encode($productos_en_stock);
  echo "var productos_en_stock_js = ". $js_array . ";\n";
  ?>
  

  function cargar_datos(){

    
    
    //obtener id segun seleccion en datalist (producto)
    const productos = document.getElementById('datalist_productos');
    const producto_seleccionado = document.querySelector('#nombre_producto');
    const opSelected = productos.querySelector(`[value="${producto_seleccionado.value}"]`);
    const id_producto = opSelected.getAttribute('data-value');//ID del producto seleccionado
    
    //obtener referencia de componentes para llenar (inputs de formulario)
    var codigo_js = document.getElementById('codigo');
    var stock_js = document.getElementById('stock');
    var cantidad_js = document.getElementById('cantidad');
    var valor_unidad_js = document.getElementById('valor_unidad');
    

    var stock_p = 0;
    var valor_unidad_p = 0;
    for (let i = 0; i < productos_en_stock_js.length; i++) {

      if (productos_en_stock_js[i].producto_id == id_producto){

        stock_p = productos_en_stock_js[i].stock;
        valor_unidad_p = productos_en_stock_js[i].precio_venta;
        
      }
      
    }
    
    codigo_js.value = id_producto;
    stock_js.value = stock_p;
    valor_unidad_js.value = valor_unidad_p;
    cantidad_js.setAttribute('max',stock_js.value); 
  }
  </script>


  <div class="col-12 col-md-4 col-lg-3">
                    <!--Mensaje de eliminado con exito -->
                    @if (session()->has('correcto'))
                        <div class="alert alert-success">
                            {{ session()->get('correcto') }}
                        </div><br>
                    @endif
  </div>
</div>


@endsection