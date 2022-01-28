<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SELECT DEPENDIENTES DE TRES NIVELES</title>
</head>
<body>
    <div>
        <select name="" id="_producto">
            @foreach ($productos as $item)
            <option value="{{$item->familia}}">{{$item->familia}}</option>
            @endforeach
        </select>
        <select name="" id="_familia"></select>
    </div>
<script>
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
    document.getElementById('_producto').addEventListener('change',(e)=>{
        fetch('familias',{
            method : 'POST',
            body: JSON.stringify({texto : e.target.value}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            var opciones ="<option value=''>Elegir</option>";
            for (let i in data.lista) {
               opciones+= '<option value="'+data.lista[i].id+'">'+data.lista[i].nombre+'</option>';
            }
            document.getElementById("_familia").innerHTML = opciones;
        }).catch(error =>console.error(error));
    })

</script>   
</body>
</html>