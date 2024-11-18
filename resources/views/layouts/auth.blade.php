<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/login.css') }}">

    <link rel='icon' href="{{ asset('img/icon.png') }}" type='image/x-icon' />
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>
<body class="loginmain">
    <div class="position-absolute postion-custom">
        <img id="mode-dark" src="{{asset("img/soleil.png")}}" alt="soleil" class="mode-img d-none" onclick="changemode('light')">
        <img id="mode-light" src="{{asset("img/lune.png")}}" alt="lune" class="mode-img" onclick="changemode('dark')">
    </div>
    <div class="loginborder">
        @yield('content')
    </div>
    <script src="{{asset('js/header.js')}}"></script>
    <script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
