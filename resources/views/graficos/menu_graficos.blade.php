@extends('graficos.master_graficos')
@section('content')
@include('inventario.partials.iconos')


<div class="container" >

    <div class="row justify-content-center mt-3" >

        {{-- columna principal --}}
        <div class="col-6 card p-3 bg-light mt-3" >
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

                    <form class="row g-3 mt-3" style="justify-content: center">
                        @csrf

                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <label class="input-group-text" for="inputGroupSelect01">Año:</label>
                                    <select class="form-select" id="inputGroupSelect01">
                                        @foreach ($years_arr as $year)
                                        <option value="{{$year}}">{{$year}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <label class="input-group-text" for="inputGroupSelect01">Mes:</label>
                                    <select class="form-select" id="inputGroupSelect01">
                                        <option value="1">Enero</option>
                                        <option value="2">Febrero</option>
                                        <option value="3">Marzo</option>
                                        <option value="4">Abril</option>
                                        <option value="5">Mayo</option>
                                        <option value="6">Junio</option>
                                        <option value="7">Julio</option>
                                        <option value="8">Agosto</option>
                                        <option value="9">Septiembre</option>
                                        <option value="10">Octubre</option>
                                        <option value="11">Novimebre</option>
                                        <option value="12">Diciembre</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 justify-content-left" >
                            <div class="col-md-6">
                                <input type="number" class="visually-hidden" type="number" name="tipo_grafico"
                                    id="tipo_grafico" value="0" required>

                                <div id="producto_on">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckDefault" onchange="cambiar_estado()">
                                        <label class="form-check-label" for="flexSwitchCheckChecked"
                                            id="label_semana">Ver gráfico de una semana</label>
                                    </div>
                                </div>
                                <div id="div_grafico_semana" style="margin-top: 10px">
                                    <div class="input-group">
                                        <label class="input-group-text" for="inputGroupSelect01">Semana:</label>
                                        <select class="form-select" id="inputGroupSelect01">
                                            <option value="1">Semana 1</option>
                                            <option value="2">Semana 2</option>
                                            <option value="3">Semana 3</option>
                                            <option value="4">Semana 4</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 justify-content-center">
                            <div class="col-3">
                                <button type="button" class="btn btn-primary">Ir a gráfico</button>
                            </div>
                        </div>



                    </form>
                </div>
            </div>
        </div>

    </div>






</div>

<script type="text/javascript">
    var este_ano = new Date().getFullYear();
console.log(este_ano);
console.log(este_ano-1);
console.log(este_ano-2);
console.log(este_ano-3);
console.log(este_ano-4);

</script>

<script type="text/javascript">
    $(document).ready(function()
    {
        $("#div_grafico_semana").hide();
                  
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