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

    addItemToShoppingCart(nombre_producto,id_producto,cantidad_producto,valor_producto);
  }

  function addItemToShoppingCart(nombre_producto,id_producto,cantidad_producto,valor_producto)
  {
    
   // console.log('addItemToShoppingCart -> shoppingCartItemsContainer',shoppingCartItemsContainer);
    const shoppingCartRow = document.createElement('div');
    const shoppingCarContent = `
    <div class="row shoppingCartItem">
      <div class="col-6">
            <div class="shopping-cart-item d-flex align-items-center h-100 border-bottom pb-2 pt-3">
                <h6 class="shopping-cart-item-id shoppingCartItemTitle text-truncate ml-3 mb-0">${id_producto}</h6>
            </div>
        </div>
        <div class="col-6">
            <div class="shopping-cart-item d-flex align-items-center h-100 border-bottom pb-2 pt-3">
                <h6 class="shopping-cart-item-title shoppingCartItemTitle text-truncate ml-3 mb-0">${nombre_producto}</h6>
            </div>
        </div>
        <div class="col-2">
            <div class="shopping-cart-price d-flex align-items-center h-100 border-bottom pb-2 pt-3">
                <p class="item-quant mb-0 shoppingCartItemPrice">${cantidad_producto}</p>
            </div>
        </div>
        <div class="col-2">
            <div class="shopping-cart-price d-flex align-items-center h-100 border-bottom pb-2 pt-3">
                <p class="item-price mb-0 shoppingCartItemPrice">${valor_producto}</p>
            </div>
        </div>
        <div class="col-4">
            <div
                class="shopping-cart-quantity d-flex justify-content-between align-items-center h-100 border-bottom pb-2 pt-3">
                <input class="shopping-cart-quantity-input shoppingCartItemQuantity" type="number"
                    value="1">
                <button class="btn btn-danger buttonDelete" type="button">X</button>
            </div>
        </div>
    </div>
    `;

    shoppingCartRow.innerHTML = shoppingCarContent;
    shoppingCartItemsContainer.append(shoppingCartRow);

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
                <input class="form-control" type="text" id="codigo" value="12" aria-label="readonly input example"
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
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="email" class="form-control" id="inputEmail4">
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

    <section class="shopping-cart">
      <div class="container">
        <h1 class="text-center">CARRITO</h1>
        <hr>
        <div class="row">
            <div class="col-6">
                <div class="shopping-cart-header">
                    <h6>Id Producto</h6>
                </div>
            </div>
            <div class="col-2">
                <div class="shopping-cart-header">
                    <h6 class="text-truncate">Nombre</h6>
                </div>
            </div>
            <div class="col-4">
                <div class="shopping-cart-header">
                    <h6>Cantidad</h6>
                </div>
            </div>

            <div class="col-4">
              <div class="shopping-cart-header">
                  <h6>Precio</h6>
              </div>
          </div>
        </div>
        <!-- ? START SHOPPING CART ITEMS -->
        <div class="shopping-cart-items shoppingCartItemsContainer">
            
        </div>
      </div>
    </section>

  </div>



</div>


@endsection