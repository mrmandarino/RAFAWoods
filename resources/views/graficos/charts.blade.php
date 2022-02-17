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
    
    
    const data = {
    datasets: [{
        label: 'First Dataset',
        data: [{
        x: 20,
        y: 30,
        r: 15
        }, {
        x: 40,
        y: 10,
        r: 10
        },{
        x: 50,
        y: 20,
        r: 30
        }
        
        
        ],
        backgroundColor: 'rgb(75, 192, 192)'
    }]
    };
    
        const config = {
        type: 'bubble',
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