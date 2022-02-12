@extends('graficos.master_graficos')
@section('content')
@include('inventario.partials.iconos')


<div class="container">
    <h1>Gráficos x mes</h1>
    <div>
        <canvas id="myChart"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</div>

<script>
    const labels = [];
    for (let index = 0; index < array.length; index++) {
        const element = array[index];
        
    }

    const data = {
    labels: labels,
    datasets: [{
        label: 'My First dataset',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [0, 10, 5, 2, 20, 30, 45],
    }]
    };

    const config = {
    type: 'line',
    data: data,
    options: {}
    };
</script>

<script>
    const myChart = new Chart(
    document.getElementById('myChart'),
    config
    );
</script>


@endsection