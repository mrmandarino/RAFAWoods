@extends('ventas.master_ventas')
@section('content')
@include('ventas.partials.iconos')

  {{-- script de carrito de compras --}}

<script type = text/javascript defer>
$(document).ready(function() {
	const bclick = document.getElementById('boton_agregar_a_compra');
  const shoppingCartItemsContainer = document.querySelector('.shoppingCartItemsContainer');
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
    addItemToShoppingCart(nombre_producto,id_producto,cantidad_producto,valor_final);
  }

  function addItemToShoppingCart(nombre_producto,id_producto,cantidad_producto,valor_final)
  {
    const shoppingCartRow = document.createElement('tr');
    shoppingCartRow.setAttribute('class','shoppingCartItem');
    shoppingCartRow.setAttribute('id','item_carrito');
    const shoppingCartContent = `
              <tr>
              <td class="text-center" id="id_item_carrito">${id_producto}</td>
              <td class="text-center" id="nombre_item_carrito">${nombre_producto}</td>
              <td class="text-center" id="cantidad_item_carrito">${cantidad_producto}</td>
              <td class="shoppingCartItemPrice text-center" id="valor_item_carrito">${valor_final}</td>
              <td class="text-center"><button type="button" class="btn btn-danger">✕</button></td>
              </tr>
    `;

    shoppingCartRow.innerHTML = shoppingCartContent;
    shoppingCartItemsContainer.append(shoppingCartRow);

    shoppingCartRow.querySelector('.btn-danger').addEventListener('click',removeShoppingCartItem);
    update_total_compra();
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
    shoppingCartTotal.value = total;
    
  }
  

  function removeShoppingCartItem(event)
  {
    const button_clicked = event.target;
    button_clicked.closest('.shoppingCartItem').remove();
    update_total_compra();
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
            <h4 class="text-center" >🪵 Productos 🪵</h4>
          </div>        
        </div>

        <form class="row g-3 mt-3 col-form-izq form-izq">
          @csrf

          <div class="row">
            <div class="col-md-12">
              <div class="input-group">

                <label for="producto" class="input-group-text">Producto:</label>
                <input class="form-control" list="datalist_productos" id="nombre_producto" onchange="cargar_datos()" placeholder="Escriba para buscar...">
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
                <input class="form-control" type="text" id="stock" value="69" aria-label="readonly input example"
                  readonly>
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

          <div class="row justify-content-evenly botones-izq ">
            <div class="col-md-4">
              <button type="submit" class="btn btn-danger">Quitar Producto</button>
            </div>
            <div class="col-md-4 ">
              <button type="button" id="boton_agregar_a_compra" class="btn btn-success">Agregar a Compra</button>
            </div>
          </div>
        </form>



      </div>

      {{-- formulario valor actual de la venta (DERECHA) --}}
      <div class="col-5 card p-3 bg-light col-form-der">

        <div class="row mx-3 justify-content-center">
          <div class="col-md-7 card form-der ml-3">
            <h4 class="text-center" >💵 Venta 💵</h4>
          </div>        
        </div>
        <form class="row g-3 my-auto col-form-der form-der">
          @csrf
          <div class="col-md-12">
            <div class="input-group">
            <label for="total_compra" class="input-group-text">Total Venta:</label>
            <input class="form-control form-control-lg" type="number" id="total_compra" value="0" placeholder="El total es de:" aria-label=".form-control-lg example" readonly>
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
              <label for="fecha" class="input-group-text">№</label>
              <input type="text" class="form-control" id="fecha" value="{{$id_venta}}" readonly>
            </div>
          </div>
          
          <div class="col-6">
            <label for="fecha" class="form-label">Medio de Pago</label>
            <select class="form-select" aria-label="Default select example">
              <option selected>Seleccionar...</option>
              <option value="1">Efectivo 💵</option>
              <option value="2">T. Débito 💳</option>
              <option value="3">T. Crédito 💳</option>
              <option value="4">Transferencia 🏦</option>
            </select>
          </div>
          
          
          <div class="col-md-4">
            <label for="inputState" class="form-label">State</label>
            <select id="inputState" class="form-select">
              <option selected>Choose...</option>
              <option>...</option>
            </select>
          </div>
          <div class="col-md-2">
            <label for="inputZip" class="form-label">Zip</label>
            <input type="text" class="form-control" id="inputZip">
          </div>
          <div class="col-12">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="gridCheck">
              <label class="form-check-label" for="gridCheck">
                Check me out
              </label>
            </div>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Sign in</button>
          </div>
        </form>
      </div>

    </div>

    {{-- Tabla con detalle de producto --}}
    
    <div class="row mt-3 px-5">

      <div class="col-md-12 card bg-light tabla-scroll">
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


  <script type="text/javascript" >
  //poner fecha al abrir la pagina
  const date = new Date();
  const fecha_mysql = date.toISOString().split("T")[0];
  var fecha_js = document.getElementById('fecha');
  fecha_js.value = fecha_mysql;
  </script>



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
  
  

  
  //console.log(productos_en_stock_js);
  
  

  function cargar_datos(){

    
    
    //obtener id segun seleccion en datalist (producto)
    const productos = document.getElementById('datalist_productos');
    const producto_seleccionado = document.querySelector('#nombre_producto');
    const opSelected = productos.querySelector(`[value="${producto_seleccionado.value}"]`);
    const id_producto = opSelected.getAttribute('data-value');//ID del producto seleccionado
    
    //obtener referencia de componentes para llenar (inputs de formulario)
    var codigo_js = document.getElementById('codigo');
    var stock_js = document.getElementById('stock');
    var valor_unidad_js = document.getElementById('valor_unidad');
    

    var stock_p = 0;
    var valor_unidad_p = 0;
    for (let i = 0; i < productos_en_stock_js.length; i++) {

      if (productos_en_stock_js[i].producto_id == id_producto){

        stock_p = productos_en_stock_js[i].stock;
        valor_unidad_p = productos_en_stock_js[i].precio_venta;
        
      }
      
    }
    console.log(valor_unidad_p);
    codigo_js.value = id_producto;
    stock_js.value = stock_p;
    valor_unidad_js.value = valor_unidad_p;
    
    
    
  }
  </script>



</div>


@endsection