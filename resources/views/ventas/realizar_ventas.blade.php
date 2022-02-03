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

        <form class="row g-3 mt-3 col-form-izq form-izq">
          @csrf

          <div class="row">
            <div class="col-md-12">
              <div class="input-group">

                <label for="producto" class="input-group-text">Producto:</label>
                <input class="form-control" list="datalist_productos" id="nombre_producto" placeholder="Escriba para buscar...">
                <datalist id="datalist_productos">
                  @foreach ($productos as $producto)
                    <option data-value="{{$producto->id}}" value="{{$producto->nombre}}">
                    @endforeach
                </datalist>
              </div>
            </div>
          </div>


          <div class="row mt-4">
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

          <div class="row mt-4">
            <div class="col-md-6">
              <label for="valor-u" class="form-label">Valor Unidad</label>
              <div class="input-group">
                <label for="valor_unidad" class="input-group-text">$</label>
                <input class="form-control" type="number" id="valor_unidad" step="1000">
              </div>
            </div>

            
            <div class="col-md-6">
              <label for="cantidad" class="form-label">Cantidad</label>
              <div class="input-group">
                <label for="cantidad" class="input-group-text">#</label>
                <input class="form-control" id="cantidad" value="33" min="1">
              </div>
            </div>

          </div>

          <div class="row mt-4 justify-content-evenly">
            <div class="col-md-4 mt-4">
              <button type="submit" class="btn btn-danger">Quitar Producto</button>
            </div>
            <div class="col-md-4 mt-4">
              <button type="button" id="boton_agregar_a_compra" class="btn btn-success">Agregar a Compra</button>
            </div>
          </div>
        </form>



      </div>

      {{-- formulario valor actual de la venta (DERECHA) --}}
      <div class="col-5 card p-3 bg-light ">
        <form class="row g-3">
          @csrf
          <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Total</label>
            <input type="number" class="form-control" id="total_compra" value="0" readonly>
          </div>
          <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Password</label>
            <input type="password" class="form-control" id="inputPassword4">
          </div>
          <div class="col-12">
            <label for="inputAddress" class="form-label">Address</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
          </div>
          <div class="col-12">
            <label for="inputAddress2" class="form-label">Address 2</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
          </div>
          <div class="col-md-6">
            <label for="inputCity" class="form-label">City</label>
            <input type="text" class="form-control" id="inputCity">
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

    {{-- tabla con detalle de la venta (ABAJO) --}}

    <!--<section class="shopping-cart">
      <div class="container">
        <h1 class="text-center">CARRITO</h1>
        <hr>
        <div class="row">
            <div class="col-3">
                <div class="shopping-cart-header">
                    <h6 class="text-center">Id Producto</h6>
                </div>
            </div>
            <div class="col-3">
                <div class="shopping-cart-header">
                    <h6 class="text-center">Nombre</h6>
                </div>
            </div>
            <div class="col-3">
                <div class="shopping-cart-header">
                    <h6 class="text-center">Cantidad</h6>
                </div>
            </div>

            <div class="col-3">
              <div class="shopping-cart-header">
                  <h6 class="text-center">Precio</h6>
              </div>
          </div>
        </div>
        <div class="shopping-cart-items shoppingCartItemsContainer">
            
        </div>
      </div>
    </section>-->
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



</div>


@endsection