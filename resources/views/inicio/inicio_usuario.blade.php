@extends('inicio.master_inicio')
@section('content')
@include('ventas.partials.iconos')



<div class="container">

  {{-- Fila global --}}
  <div class="row justify-content-evenly mt-3">
    
    {{-- Fila tablero --}}
    <div class="row justify-content-evenly align-content-center formularios">

      {{-- tablero --}}
      <div class="col-12 card p-3 bg-light mt-3 tablero">
        <div class="row mx-3 justify-content-center">
          <div class="col-md-4 card form-izq ml-3">
            <h4 class="text-center align-items-top">
              <svg class="bi me-2" width="20" height="20" style="align-self: top">
                <use xlink:href="#mensaje" />
              </svg>
                Tablero de informaciones
            </h4>
          </div>
        </div>
                   
        <div class="row">
            @for ($i = 0; $i < 3; $i++)            
              @if (!$comentarios[$i]->comentario==null)
              <div class="col-4">
                <div class="d-flex justify-content-center" id="dropdownMacos">
                  <ul class="dropdown-menu dropdown-menu-m dropdown-menu-macos mx-0 shadow" style="width: 320px;">
                    <form action="{{route('destroy_comentario',$comentarios[$i]->id)}}" method="POST">
                      @csrf
                      @method('PUT')
                      @php($usuario=App\Models\User::find($comentarios[$i]->rut))
                      <li><h5>{{$usuario->nombre}} {{$usuario->apellido}}:</h5></li>
                      <li><textarea class="form-control text-secondary bg-white" id="exampleFormControlTextarea1" rows="3" placeholder="Anotación disponible..." disabled>{{$comentarios[$i]->comentario}}</textarea></li>
                      <li>
                        <hr class="dropdown-divider">
                      </li>
                      <li class="justify-content-right">
                        <button type="submit" class="btn btn-outline-danger" style="width: 100%">
                          <svg class="bi" width="16" height="16">
                            <use xlink:href="#papelera" />
                          </svg>
                          Eliminar
                        </button>
                      </li>
                    </form>  
                  </ul>
                </div>
              </div>
                  @else
                  <div class="col-4">
                    <div class="d-flex justify-content-center" id="dropdownMacos">
                      <ul class="dropdown-menu dropdown-menu-m dropdown-menu-macos mx-0 shadow" style="width: 320px;">
                        
                        <form action="{{route('update_comentario',$comentarios[$i]->id)}}" method="POST">
                          @csrf
                          @method('PUT')
                          <li><h5>Tú:</h5></li>
                          <input class="visually-hidden" type="text" name="rut" id="rut" value="{{Auth::user()->rut}}">
                          <li><textarea class="form-control" id="comentario" name="comentario" rows="3" placeholder="Anotación disponible..."></textarea></li>
                          <li>
                            <hr class="dropdown-divider">
                          </li>
                          <li class="justify-content-right">
                            <button type="submit" class="btn btn-outline-success" style="width: 100%">
                              <svg class="bi" width="16" height="16">
                                <use xlink:href="#agregar_comentario" />
                              </svg>
                              Agregar Comentario
                            </button>
                          </li>             
                        </form>
                      </ul>
                    </div>
                  </div>
              @endif
            @endfor  
        </div>

        <div class="row mt-5">
            @for ($i = 3; $i < 6; $i++)            
              @if (!$comentarios[$i]->comentario==null)            
                  <div class="col-4">
                    <div class="d-flex justify-content-center" id="dropdownMacos">
                      <ul class="dropdown-menu dropdown-menu-m dropdown-menu-macos mx-0 shadow" style="width: 320px;">
                        <form action="{{route('destroy_comentario',$comentarios[$i]->id)}}" method="POST">
                          @csrf
                          @method('PUT')
                          @php($usuario=App\Models\User::find($comentarios[$i]->rut))
                          <li><h5>{{$usuario->nombre}} {{$usuario->apellido}}:</h5></li>
                          <li><textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Anotación disponible...">{{$comentarios[$i]->comentario}}</textarea></li>
                          <li>
                            <hr class="dropdown-divider">
                          </li>
                          <li class="justify-content-right">
                            <button type="submit" class="btn btn-outline-danger" style="width: 100%">
                              <svg class="bi" width="16" height="16">
                                <use xlink:href="#papelera" />
                              </svg>
                              Eliminar
                            </button>
                          </li>
                        </form>  
                      </ul>
                    </div>
                  </div>
                  @else
                  <div class="col-4">
                    <div class="d-flex justify-content-center" id="dropdownMacos">
                      <ul class="dropdown-menu dropdown-menu-m dropdown-menu-macos mx-0 shadow" style="width: 320px;">
                        
                        <form action="{{route('update_comentario',$comentarios[$i]->id)}}" method="POST">
                          @csrf
                          @method('PUT')
                          <li><h5>Tú:</h5></li>
                          <input class="visually-hidden" type="text" name="rut" id="rut value="{{Auth::user()->rut}}">
                          <li><textarea class="form-control" id="comentario" name="comentario" rows="3" placeholder="Anotación disponible..."></textarea></li>
                          <li>
                            <hr class="dropdown-divider">
                          </li>
                          <li class="justify-content-right">
                            <button type="submit" class="btn btn-outline-success" style="width: 100%">
                              <svg class="bi" width="16" height="16">
                                <use xlink:href="#agregar_comentario" />
                              </svg>
                              Agregar Comentario
                            </button>
                          </li>             
                        </form>
                      </ul>
                    </div>
                  </div>
                  
              @endif
            @endfor  
        </div>
        
                  
      </div>

    </div>

  </div>

@endsection