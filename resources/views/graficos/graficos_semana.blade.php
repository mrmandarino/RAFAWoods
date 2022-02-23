@extends('graficos.master_graficos')
@section('content')
@include('inventario.partials.iconos')


<div class="container">
    <div class="div mt-2">

        <h4 class="text-center">Semana del año: {{$year}} mes: {{$month}} día: {{$day}}</h4>
        <h5 class="text-center">Venta de la semana: ${{$total_semana_separador}} | Utilidad bruta de la semana: ${{$total_utilidad_separador}}</h5>
        <input type="text" class="visually-hidden" id="hidden" value="{{$datos_json}}">
    </div>
    <div>
        <canvas id="myChart"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</div>

<script>
    var input_hidden = document.getElementById('hidden');
    var datos_json_str = input_hidden.value;
    var datos_json_obj = JSON.parse(input_hidden.value);
    console.log(datos_json_obj);
   
    
</script>

<script>
    const labels = [
    'Lunes '+datos_json_obj.num_dias.lunes,
    'Martes '+datos_json_obj.num_dias.martes,
    'Miercoles '+datos_json_obj.num_dias.miercoles,
    'Jueves '+datos_json_obj.num_dias.jueves,
    'Viernes '+datos_json_obj.num_dias.viernes,
    'Sábado '+datos_json_obj.num_dias.sabado,
    'Domingo '+datos_json_obj.num_dias.domingo,
    ];

    const data = {
    labels: labels,
    datasets: [{
        label: 'Total de ventas por día',
        data: [datos_json_obj.ventas_totales.lunes, datos_json_obj.ventas_totales.martes, datos_json_obj.ventas_totales.miercoles, datos_json_obj.ventas_totales.jueves, datos_json_obj.ventas_totales.viernes, datos_json_obj.ventas_totales.sabado, datos_json_obj.ventas_totales.domingo],
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.2
    },{
        label: 'Utilidad bruta total por día',
        data: [datos_json_obj.total_utilidad_semana.lunes, datos_json_obj.total_utilidad_semana.martes, datos_json_obj.total_utilidad_semana.miercoles, datos_json_obj.total_utilidad_semana.jueves, datos_json_obj.total_utilidad_semana.viernes, datos_json_obj.total_utilidad_semana.sabado, datos_json_obj.total_utilidad_semana.domingo],
        fill: false,
        borderColor: 'rgb(153, 102, 255)',
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