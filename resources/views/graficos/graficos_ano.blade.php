@extends('graficos.master_graficos')
@section('content')
@include('inventario.partials.iconos')


<div class="container">
    <h1 class="text-center">Rendimiento en ventas</h1>
    <h5 class="text-center">año: {{$year}}</h5>
    <input type="text" class="visually-hidden" id="hidden" value="{{$datos_json}}">
    <div>
        <canvas id="myChart"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</div>

<script>
    var input_hidden = document.getElementById('hidden');
    var datos_json_str = input_hidden.value;
    var datos_json_obj = JSON.parse(input_hidden.value);
   
    
    
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
        backgroundColor: [
        
        'rgba(54, 162, 235, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(54, 162, 235, 0.2)'
        
        ],
        borderColor: [
        'rgb(54, 162, 235)',
        'rgb(54, 162, 235)',
        'rgb(54, 162, 235)',
        'rgb(54, 162, 235)',
        'rgb(54, 162, 235)',
        'rgb(54, 162, 235)',
        'rgb(54, 162, 235)'
        
        ],
        borderWidth: 1
    }]
    };

    const config = {
    type: 'bar',
    data: data,
    options: {
        scales: {
        y: {
            beginAtZero: true
        }
        }
    },
    };
</script>

<script>
    const myChart = new Chart(
    document.getElementById('myChart'),
    config
    );
</script>


@endsection