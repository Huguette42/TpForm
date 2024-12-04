{{--
    Nom du fichier : auth.blade.php
    Description    : Page de template pour les autres pages
    Auteur         : Hugo Jeanselme

    Utilisation :
    - Joue le role de squelette prerempli pour les autres pages cela evite la duplication de code
    - Les champ a completer son representer par les balises blade "yield"
--}}


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    {{--
        Inclusion des fichier de base (Icon/Plugin Bootstrap/Css principale) et du css login
    --}}

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/login.css') }}">
    <link rel='icon' href="{{ asset('img/icon.png') }}" type='image/x-icon' />
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{--
        Titre de chaque page a completer
    --}}

    <title>@yield('title')</title>

</head>
<body class="loginmain">

    {{--
        Mode d'affichage (Clair/Sombre)
    --}}

    <div class="position-absolute postion-custom">

        <img class="header__image-mode d-none" id="mode-dark" src="{{asset("img/soleil.png")}}" alt="soleil" onclick="changemode('light')">

        <img class="header__image-mode" id="mode-light" src="{{asset("img/lune.png")}}" alt="lune" onclick="changemode('dark')">

    </div>

    {{--
        Contenue principale
    --}}

    <div class="loginborder">
        @yield('content')
    </div>

    {{--
        Script necessaire au page de connection/inscription
    --}}

    <script src="{{asset('js/header.js')}}"></script>
    <script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
