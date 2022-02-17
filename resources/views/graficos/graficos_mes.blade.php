@extends('graficos.master_graficos')
@section('content')
@include('inventario.partials.iconos')


<div class="container">
    <div class="div mt-2">

        <h4 class="text-center">Año: {{$year}} mes: {{$month}}</h4>
        <h5 class="text-center">Venta total del mes: ${{$total_mes_separador}}</h5>
        <input type="text" class="visually-hidden" id="hidden_mes" value="{{$datos_json}}">
    </div>
    <div>
        <canvas id="myChart"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</div>

<script>
    var input_hidden = document.getElementById('hidden_mes');
    var datos_json_str = input_hidden.value;
    var datos_json_obj = JSON.parse(input_hidden.value);
    console.log(datos_json_obj);
   
    
</script>

<script>
    const labels = datos_json_obj.num_dias;
    // const labels = [
    // 'Lunes '+datos_json_obj.num_dias.lunes,
    // 'Martes '+datos_json_obj.num_dias.martes,
    // 'Miercoles '+datos_json_obj.num_dias.miercoles,
    // 'Jueves '+datos_json_obj.num_dias.jueves,
    // 'Viernes '+datos_json_obj.num_dias.viernes,
    // 'Sábado '+datos_json_obj.num_dias.sabado,
    // 'Domingo '+datos_json_obj.num_dias.domingo,
    // ];

    const data = {
    labels: labels,
    datasets: [{
        label: 'Total de ventas por día',
        data: datos_json_obj.ventas_totales,
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.2
    }]
    };

    const config = {
    type: 'line',
    data: data,
    };
</script>

<script>
    const myChart = new Chart(
    document.getElementById('myChart'),
    config
    );
</script>


@endsection