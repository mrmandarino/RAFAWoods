@extends('ventas.master_ventas')
@section('content')
@include('ventas.partials.iconos')

<div class="container">

  <div class="row justify-content-center mt-3">

    <div class="row justify-content-evenly">
      {{-- formulario agregar producto a la venta (IZQUIERDA) --}}
      <div class="col-6 card p-3 bg-light">
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


      {{-- formulario valor actual de la venta (DERECHA) --}}
      <div class="col-5 card p-3 bg-light">
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

      <div class="col card bg-light tabla-scroll">
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
            @for ($i = 1; $i < 6; $i++)
            <tr>      
              <td class="text-center">{{$i}}</td>
              <td class="text-center">pino oregon 2x4</td>
              <td class="text-center">50</td>
              <td class="text-center">75.600</td>
              <td class="text-center" ><button type="button" class="btn btn-danger">✕</button></td>
            </tr>
            @endfor
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


@endsection