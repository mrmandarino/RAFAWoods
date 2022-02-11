<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <canvas id="myChart"></canvas>
    </div>
      
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = [
        'Lunes',
        'February',
        'March',
        'April',
        'May',
        'June',
        ];
    
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
    
</html>