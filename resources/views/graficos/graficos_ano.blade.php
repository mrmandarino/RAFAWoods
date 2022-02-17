@extends('graficos.master_graficos')
@section('content')
@include('inventario.partials.iconos')


<div class="container">
    <div class="div mt-2">

        <h4 class="text-center">Año: {{$ano}}</h4>
        <h5 class="text-center">Venta total del año: ${{$total_ano_separador}}</h5>
        <input type="text" class="visually-hidden" id="hidden_ano" value="{{$datos_json}}">
    </div>
    <div>
        <canvas id="myChart"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</div>

<script>
    var input_hidden = document.getElementById('hidden_ano');
    var datos_json_str = input_hidden.value;
    var datos_json_obj = JSON.parse(input_hidden.value);
    console.log(datos_json_obj);
</script>

<script>
    const labels = [
    'Enero',
    'Febrero',
    'Marzo',
    'Abril',
    'Mayo',
    'Junio',
    'Julio',
    'Agosto',
    'Septiembre',
    'Octubre',
    'Noviembre',
    'Diciembre',
    ];

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