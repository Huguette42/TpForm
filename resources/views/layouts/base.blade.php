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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{--
        Inclusion des fichier de base (Icon/Plugin Bootstrap/Css principale)
    --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"  href="{{ asset('/css/main.css')}}">
    <link rel='icon' href="{{ asset('img/icon.png') }}" type='image/x-icon' />

    {{--
        Possibilité pour chaque page d'ajouter des pages css
    --}}
    @yield('header')

    {{--
        Titre de chaque page a completer
    --}}

    <title>@yield('title')</title>

</head>
<body>

    {{--
        Le contenue est disposé entre le header et le footer
    --}}

    @include('header')

    @yield('content')

    @include('footer')

</body>
</html>
