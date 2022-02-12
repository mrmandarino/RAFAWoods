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
                                <div class="row" >
                                    
                                    <svg class="bi me-2" width="40" height="40" >
                                        <use xlink:href="#calendar3" />
                                    </svg>
                                </div>
                                <div class="row">
                                    <div class="col">

                                        <label for="input_fecha" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom">Fecha:</label>
                                        <input type="text" class="form-control date mandarino-date" id="input_fecha" name="input_fecha" required>
        
                                        
                                        <div class="form-check form-switch mt-3">
                                            <input type="number" class="visually-hidden" type="number" name="tipo_grafico"
                                            id="tipo_grafico" value="0" required>
                                            <input class="form-check-input" type="checkbox" role="switch" id="switch_semana"
                                            onchange="cambiar_estado()">
                                            <label class="form-check-label" for="flexSwitchCheckChecked" id="label_semana" data-bs-toggle="tooltip" data-bs-placement="right" title="Si la opción está desactivada la venta se hará con boleta.">Ver gráfico
                                                de una semana</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                                
                        </div>
                        <div class="row mt-3 justify-content-center">
                            <div class="col-5">
                                <button type="submit" class="btn btn-primary">Ir a gráfico</button>
                            </div>
                        </div>



                    </form>
                </div>
            </div>
        </div>

    </div>






</div>

<script type="text/javascript">
    $('.mandarino-date').datepicker({
    weekStart: 1,
    language: "es",
    autoclose: true,
    orientation: 'left',
    format: 'yyyy/mm/dd'
    });
</script>



<script type="text/javascript">
    var input_semana = document.getElementById('tipo_grafico');
    
    console.log(input_semana.value);
    function cambiar_estado(){

        if(input_semana.value == 0){

            input_semana.value=1; 
            console.log(input_semana.value);
            $("#div_grafico_semana").show();
        }
        else{
            input_semana.value=0; 
            console.log(input_semana.value);
            $("#div_grafico_semana").hide();
        }
        
    }
</script>


@endsection