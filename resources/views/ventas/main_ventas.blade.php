@extends('ventas.master_ventas')
@section('content')
@include('ventas.partials.iconos')

<main>
  {{-- Sidebar vendedor-ejecutivo--}}

  <div class="d-flex flex-column flex-shrink-0 p-3 no-shrink text-white bg-dark" style="width: 280px ;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <svg class="bi me-2" width="40" height="32">
        <use xlink:href="#bootstrap" />
      </svg>
      <span class="fs-4">Sidebar</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="#" class="nav-link active" aria-current="page">
          <svg class="bi me-2" width="16" height="16">
            <use xlink:href="#home" />
          </svg>
          Home
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16">
            <use xlink:href="#speedometer2" />
          </svg>
          Dashboard
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16">
            <use xlink:href="#table" />
          </svg>
          Orders
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16">
            <use xlink:href="#grid" />
          </svg>
          Products
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16">
            <use xlink:href="#people-circle" />
          </svg>
          Customers
        </a>
      </li>
    </ul>
    <hr>

    <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1"
        data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
        <strong>mdo</strong>
      </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
        <li><a class="dropdown-item" href="#">New project...</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="#">Sign out</a></li>
      </ul>
    </div>
  </div>

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
                <th>Codigo</th>
                <th>nombre</th>
                <th>cantidad</th>
                <th>valor total</th>
                <th>descartar</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>pino oregon 2x4</td>
                <td>50</td>
                <td>75.600</td>
                <td><button type="button" class="btn btn-danger">✕</button></td>
              </tr>
              <tr>
                <td>2</td>
                <td>tornillo 3"</td>
                <td>54</td>
                <td>34.900</td>
                <td><button type="button" class="btn btn-danger">✕</button></td>
              </tr>
              <tr>
                <td>3</td>
                <td>olb 9mm multiplac</td>
                <td>5</td>
                <td>45.650</td>
                <td><button type="button" class="btn btn-danger">✕</button></td>
              </tr>
              <tr>
                <td>4</td>
                <td>olb 9mm multiplac</td>
                <td>5</td>
                <td>45.650</td>
                <td><button type="button" class="btn btn-danger">✕</button></td>
              </tr>
              <tr>
                <td>5</td>
                <td>olb 9mm multiplac</td>
                <td>5</td>
                <td>45.650</td>
                <td><button type="button" class="btn btn-danger">✕</button></td>
              </tr>
            </tbody>
          </table>
        </div>





      </div>


    </div>




  </div>





</main>

@endsection