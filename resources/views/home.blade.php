<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"  href="{{ asset('/css/header.css')}}">
    <link rel="stylesheet"  href="{{ asset('/css/home.css')}}">
    <title>Document</title>
</head>
<body>
    @include('header')
    <div class="d-flex justify-content-end px-5 align-items-center">
    <a href="{{ route('contracts.get')}}"><button class="btn btn-lg btn-theme">Creer un contrat</button></a>
    </div>
    <div class="mt-5 d-flex justify-content-around align-items-center flex-column" id="contratdiv">
    @foreach ($contracts as $contract)
    <div class="contrat my-3 d-flex justify-content-around align-items-center p-3">
        <span>{{ $contract->contract_nature }}</span>
        <span>{{ $contract->contract_name }}</span>
        <span>{{ $contract->contract_adress }}</span>
        <button class="btn btn-theme" onclick='window.location="{{ url("contract/".$contract->id) }}"'>Voir</button>
        <button class="btn btn-theme" onclick='window.location="{{ url("contract/".$contract->id."/download") }}"'>PDF</button>

    </div>
    @endforeach
    </div>
</body>
</html>
