{{--
    Nom du fichier : header.blade.php
    Description    : En-tête de l'application
    Auteur         : Hugo Jeanselme

    Utilisation :
    - Mode sombre et clair
    - Menu déroulant pour la deconnexion et la modification du profil
--}}


<script>
    const BASE_URL = {{asset('')}};
</script>


{{--
    Menu deroulant de navigation
--}}

<div class="dropdown position-absolute" id="dropdownmenu">

    <a href="{{route('user.edit')}}" class="dropdown__item">

        <img class="dropdown__image" src='{{asset('img/edit.png')}}'/>Modifier le profil

    </a>

    <div class="dropdown__item">

        <img class="dropdown__image" src='{{asset('img/notification.png')}}'/>Notification

    </div>

    <a href='{{route('logout')}}' class="dropdown__item">

        <img class="dropdown__image" src='{{asset('img/logout.png')}}'/>Deconnexion

    </a>

</div>


{{--
    En-tête de l'application
--}}

<div class="header w-100 d-flex justify-content-between align-items-center space-around">

    {{--
        Logo et nom de l'application
    --}}

    <div class="d-flex justify-content-center align-items-center">

        <img class="header__logo" src="{{ asset('img/logo.png') }}"/>

        <a class="header__link" href='{{route('home')}}'>

            <h1>Partenato</h1>

        </a>

    </div>

    {{--
        Activation menu déroulant et changement de mode
    --}}

    <div class="d-flex w-30 justify-content-center align-items-center">

        <img class="header__chevron" id="chevronimg" src="{{ asset("img/down-chevron.png") }}"/>

        <img class="header__user" id="userimg" src="{{ asset("img/user.png") }}" onclick="showmenu()"/>

        <img class="header__image-mode d-none" id="mode-dark" src="{{asset("img/soleil.png")}}" alt="soleil" onclick="changemode('light')">

        <img class="header__image-mode" id="mode-light" src="{{asset("img/lune.png")}}" alt="lune" onclick="changemode('dark')">

    </div>

    {{--
        Inclusion du script de l'en-tête
    --}}

    <script src="{{asset('js/header.js')}}"></script>

</div>
