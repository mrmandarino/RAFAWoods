@extends('ventas.master_ventas')
@section('content')
@include('ventas.partials.iconos')

{{-- script de carrito de compras --}}

<script type="text/javascript" defer>
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
          element_quant.value = new_element_quant;          

          //Actualizar precio total del item duplicado
          let element_price = elementsId[i].parentElement.querySelector('.shoppingCartItemPrice');
          let new_element_price = new_element_quant*parseInt(valor_producto);
          element_price.innerText = new_element_price;
          element_price.value = new_element_price;

          
          //Removiendo registro repetido de archivo JSON
          var json_arr = JSON.parse(json_final.value);
          var pos = 0;
          for(json_obj of json_arr){
            if(json_obj.producto_id == id_producto){
              JSON_remove(id_producto,nombre_producto,json_arr[pos].cantidad,json_arr[pos].total_producto);
              JSON_append(id_producto,nombre_producto,new_element_quant,new_element_price);
              update_total_compra();
              quitar_producto();
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
                <td class="text-center"><button type="button" class="btn btn-danger">✕</button></td>
                </tr>
      `;
  
      shoppingCartRow.innerHTML = shoppingCartContent;
      shoppingCartItemsContainer.append(shoppingCartRow);
  
      shoppingCartRow.querySelector('.btn-danger').addEventListener('click',() => {removeShoppingCartItem(event,id_producto,nombre_producto,valor_producto)});
      update_total_compra();
      JSON_append(id_producto,nombre_producto,cantidad_producto,valor_final);
    }else{
      alert('Estás excediendo el stock disponible');
    }
    quitar_producto();
  }

  function update_total_compra() 
  {
    let total = 0;

    const items_carrito = document.querySelectorAll('.shoppingCartItem');
    
    items_carrito.forEach((item_carrito)=>{
      const valor_item_carrito = item_carrito.querySelector('.shoppingCartItemPrice');
      const valor_item_carrito_number = Number(valor_item_carrito.textContent);
      total = total + valor_item_carrito_number;
    });
    const shoppingCartTotal = document.getElementById('total_compra');

    shoppingCartTotal.value = Intl.NumberFormat("de-DE").format(total);
    
    
  }
  function removeShoppingCartItem(event,id_producto,nombre_producto,valor_producto)
  {
    const elementsId = shoppingCartItemsContainer.getElementsByClassName('shoppingCartItemId');
    for(let i = 0; i<elementsId.length;i++)
    {
      if(elementsId[i].innerText == id_producto)
      {
        //Obtener valor de cantidad en carrito 
        let element_quant = elementsId[i].parentElement.querySelector('.shoppingCartItemQuantity');
        let element_quant_int = parseInt(element_quant.innerText);
        //Obtener valor de precio final en carrito
        let element_price = elementsId[i].parentElement.querySelector('.shoppingCartItemPrice');
        let element_price_int = parseInt(element_price.innerText);

        JSON_remove(id_producto,nombre_producto,element_quant_int,element_price_int);
      }
    }
    
    const button_clicked = event.target;
    button_clicked.closest('.shoppingCartItem').remove();
    update_total_compra();
    quitar_producto();
  }

  function check_stock() {
    var stock_js = document.getElementById('stock');
    var cantidad_js = document.getElementById('cantidad');
    if(stock_js.value >= cantidad_js.value && stock_js.value>0)
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
    <div class="row justify-content-evenly align-content-center formularios">

      @if (session()->has('correcto'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              <h5 class="text-center" >{{ session()->get('correcto') }} </h5>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif
      {{-- Columna formulario agregar producto a la venta (IZQUIERDA) --}}
      <div class="col-6 card p-3 bg-light mt-3 col-form-izq">

        <div class="row mx-3 justify-content-center">
          <div class="col-md-4 card form-izq ml-3">
            <h4 class="text-center">
              <svg class="bi me-2" width="16" height="16">
                <use xlink:href="#etiqueta_producto" />
              </svg>
                Productos 
            </h4>
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
              <label for="codigo" class="form-label">Código</label>
              <div class="input-group">
                <label for="codigo" class="input-group-text">№</label>
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
              <button type="button" class="btn btn-danger" onclick="quitar_producto()" title="Esta opción reinicia el formulario">Quitar Producto</button>
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
          <div class="col-md-4 card form-der ml-3">
            <h4 class="text-center">
              <svg class="bi me-2" width="20" height="20" style="margin: 0px;" >
                <use xlink:href="#billete"/>
              </svg>
              Venta
            </h4>
          </div>
        </div>
        <form action="{{route('ventas.store')}}"class="row g-3 my-auto col-form-der form-der" method="POST">
          @csrf
          <div class="col-md-12">
            <div class="input-group">
              <label for="total_compra" class="input-group-text">Total Venta:</label>
              <input type="text" class="visually-hidden" name="rut_vendedor" value="{{Auth::user()->rut}}">
              <input class="form-control form-control-lg" type="text" name="total_compra" id="total_compra" value="0"
                placeholder="El total es de:" aria-label=".form-control-lg example" readonly>
            </div>
            @error('total_compra')
            <small style="color:red;">*Debes escoger al menos un producto para la venta</small>
            @enderror
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
              <label for="fecha" class="input-group-text">№</label>
              <input type="text" class="form-control" name="id_venta" id="id_venta" value="{{$id_venta}}" readonly>
            </div>
          </div>

          <div class="col-6 ">
            <label for="fecha" class="form-label">Medio de Pago</label>
            <select class="form-select" aria-label="Default select example" name ="medio_pago" id="medio_pago" required>
              <option selected>Seleccionar...</option>
              <option value="1">Efectivo 💵</option>
              <option value="2">T. Débito 💳</option>
              <option value="3">T. Crédito 💳</option>
              <option value="4">Transferencia 🏦</option>
            </select>
            @error('medio_pago')
            <small style="color:red;">*Debes escoger un medio de pago</small>
            @enderror
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
                  <input class="form-check-input" type="checkbox" role="switch" name="con_factura" id="flexSwitchCheckDefault" onclick="con_factura()">
                  <label class="form-check-label" for="flexSwitchCheckDefault"data-bs-toggle="tooltip" data-bs-placement="right" title="Si la opción está desactivada la venta se hará con boleta." id="documento_fiscal">Se Requiere Factura.</label>
                  <label data-bs-toggle="tooltip" data-bs-placement="right" title="Si la opción está desactivada la venta se hará con boleta."><small>📄</small></label>
                  @if (session('incorrecto'))
                  <br>
                  <small style="color:red;">*{{session('incorrecto')}}</small>    
                  @endif
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
        


        <table class="table table-hover pb-3">
          <thead >
            <tr data-bs-toggle="tooltip" data-bs-placement="left" title="Aquí se agregan todos los productos que serán incluidos en la venta junto a su valor total por producto.">
              <th class="text-center">Código</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Cantidad</th>
              <th class="text-center">Valor Total</th>
              <th class="text-center">Eliminar</th>

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
      extraer = '{"producto_id": '+id+', "nombre": '+'"'+nombre+'"'+', "cantidad": '+cantidad+', "total_producto": '+ final +'},';
      content = content.replace(extraer,"");
      json_final = '['+ content +']';
      json_final = json_final.replace("},]","}]");
      json_final = json_final.replace("},,]","}]");
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
    var cantidad_unidad_js = document.getElementById('cantidad');

    nombre_producto_js.value = "";
    codigo_js.value = "";
    stock_js.value = "";
    valor_unidad_js.value = "";
    cantidad_unidad_js.value = "1";
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

    const shoppingCartItemsContainer = document.querySelector('.shoppingCartItemsContainer');
    
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
    var stock_js_dinamico = 0;
    

    var stock_p = 0;
    var valor_unidad_p = 0;
    for (let i = 0; i < productos_en_stock_js.length; i++) {

      if (productos_en_stock_js[i].producto_id == id_producto){

        stock_p = productos_en_stock_js[i].stock;
        valor_unidad_p = productos_en_stock_js[i].precio_venta;
        
      }
      
    }

    const elementsId = shoppingCartItemsContainer.getElementsByClassName('shoppingCartItemId');
    for(let i = 0; i<elementsId.length;i++)
    {
      if(elementsId[i].innerText == id_producto)
      {
        let element_quant = elementsId[i].parentElement.querySelector('.shoppingCartItemQuantity');
        let element_quant_int = parseInt(element_quant.innerText);
        stock_js_dinamico = stock_js_dinamico + element_quant_int;
      }
    }
    codigo_js.value = id_producto;
    stock_js.value = stock_p - stock_js_dinamico;
    valor_unidad_js.value = valor_unidad_p;
    cantidad_js.setAttribute('max',stock_js.value); 
  }
  </script>


</div>


@endsection