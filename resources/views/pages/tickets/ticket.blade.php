<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>TicKeT</title>
</head>

<body>
<!-- <div > -->

<table class="table border" style="width: 50%;">
{{--    @foreach($tickets as $ticket)--}}
        <tr>
            <th class="border">Client:&ensp; <em>{{$tickets->cliet}}</em></th>
            <th class="border" colspan="3">Fecha: &ensp; <em>{{$tickets->created_at}}</em></th>
        </tr>
        <tr>
            <td rowspan="3" class="border text-center">
                <br><br><br>
                <b>Yout TicKeT</b>
            </td>
            <td colspan="2">
                <p><b>Bus:</b> <em>{{$tickets->bus}}</em></p>
            </td>
            <td colspan="2">
                <p><b>Destino:</b> <em>{{$tickets->city}}</em></p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p><b>Cantidad de Voletos:</b> <em>{{$tickets->quantity}}</em></p>
            </td>
            <td colspan="2">
                <p><b>Precio Unitario:</b> <em>{{$tickets->price}}</em> Bs. </p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p><b>Precio Total:</b> <em>{{$tickets->total}}</em> Bs. </p>
            </td>
            <td colspan="2">
                <!-- <p>Londres</p> -->
            </td>
        </tr>
{{--    @endforeach--}}
</table>
<!-- </div> -->
<br><br>
<div>
    <button onclick="window.print()" class="btn btn-success">print</button>
    <a href="{{route('tickets.create')}}" class="btn btn-danger">Back</a>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
</body>

</html>
