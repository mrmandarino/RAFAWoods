@extends('graficos.master_graficos')
@section('content')
@include('inventario.partials.iconos')


<div class="container">

    <div class="row justify-content-center mt-3">

        {{-- columna principal --}}
        <div class="col-6 card p-3 bg-light mt-3">
            {{-- titulo --}}
            <div class="row mx-3 justify-content-center">
                <div class="col-md-7 card form-izq ml-3">
                    <h4 class="text-center">
                        <svg class="bi me-2" width="20" height="20">
                            <use xlink:href="#speedometer2" />
                        </svg>
                        Opciones de gráficos
                    </h4>
                </div>
            </div>

            {{-- fila formulario --}}
            <div class="row justify-content-evenly mt-3 mx-auto">
                {{-- columna formulario --}}
                <div class="col-12">

                    <form action="{{route('redireccion')}}" class="row g-3 mt-3" style="justify-content: center">
                        @csrf

                        <div class="row justify-content-center">

                            <div class="col-12">
                                <div class="row">

                                    <svg class="bi me-2" width="40" height="40">
                                        <use xlink:href="#calendar3" />
                                    </svg>
                                </div>
                                <div class="row">
                                    <div class="col">

                                        <h6 data-bs-toggle="tooltip" data-bs-placement="left" title="Elija una fecha para generar un gráfico. Independiente del tipo de gráfico, debe elegir un día, ya sea de la semana que desea ver, del mes o del año.">Fecha:</h6>
                                        <input type="text" class="form-control date mandarino-date" id="input_fecha"
                                            name="input_fecha" required>

                                        <div class="div mt-3">

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tipo_grafico"
                                                    id="radio_ano" value="grafico_ano" required>
                                                <label class="form-check-label" for="radio_ano" >Gráfico del año</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tipo_grafico"
                                                    id="radio_mes" value="grafico_mes" required>
                                                <label class="form-check-label" for="radio_mes">Gráfico del mes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tipo_grafico"
                                                    id="radio_semana" value="grafico_semana" required>
                                                <label class="form-check-label" for="radio_semana">Gráfico de la semana</label>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        
                            <div class="col-md-3 text-center">
                                <button type="submit" class="btn btn-primary text-center">Ir a gráfico</button>

                            </div>
                            
                        



                    </form>
                </div>
            </div>
        </div>

    </div>






</div>
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
<script type="text/javascript">
    $('.mandarino-date').datepicker({
    weekStart: 1,
    language: "es",
    autoclose: true,
    orientation: 'left',
    format: 'yyyy/mm/dd'
    });
</script>



@endsection