@extends('ventas.master_ventas')
@section('content')
@include('ventas.partials.iconos')

<div class="container">

  {{-- Fila global 2 formularios y Tabla --}}
  <div class="row justify-content-evenly mt-3">

    {{-- Fila 2 formularios --}}
    <div class="row justify-content-evenly">
      {{-- Columna formulario agregar producto a la venta (IZQUIERDA) --}}
      <div class="col-6 card p-3 bg-light mt-3 col-form-izq">

        <form class="row g-3 mt-3 col-form-izq form-izq">

          <div class="row">
            <div class="col-md-12">
              <div class="input-group">
                <label class="input-group-text" for="inputGroupSelect01">Producto:</label>
                <select class="form-select" id="inputGroupSelect01">
                  <option selected>Elegir producto</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
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
                <label for="codigo" class="input-group-text">#</label>
                <input class="form-control" type="text" id="stock" value="69" aria-label="readonly input example"
                  readonly>
              </div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-md-6">
              <label for="inputAddress2" class="form-label">Valor Unidad</label>
              <div class="input-group">
                <label for="codigo" class="input-group-text">$</label>
                <input class="form-control" type="text" id="stock" value="4780">
              </div>
            </div>
            <div class="col-md-6">
              <label for="inputAddress2" class="form-label">Cantidad</label>
              <div class="input-group">
                <label for="codigo" class="input-group-text">#</label>
                <input class="form-control" type="text" id="stock" value="33">
              </div>
            </div>

          </div>

          <div class="row mt-4 justify-content-evenly">
            <div class="col-md-5 mt-4">
              <button type="submit" class="btn btn-danger">Quitar Producto</button>
            </div>
            <div class="col-md-5 mt-4">
              <button type="submit" class="btn btn-primary">Agregar a la Compra</button>
            </div>
          </div>
        </form>



      </div>

      {{-- formulario valor actual de la venta (DERECHA) --}}
      <div class="col-5 card p-3 bg-light ">
        <form class="row g-3">
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
          <tbody>
            @for ($i = 1; $i < 6; $i++) <tr>
              <td class="text-center">{{$i}}</td>
              <td class="text-center">pino oregon 2x4</td>
              <td class="text-center">50</td>
              <td class="text-center">75.600</td>
              <td class="text-center"><button type="button" class="btn btn-danger">✕</button></td>
              </tr>
              @endfor

          </tbody>
        </table>
      </div>
    </div>

  </div>



</div>


@endsection