<div class="position-absolute" id="dropdownmenu">
    <a href="{{route('user.edit')}}" class="dropdownitem">
        <img id="dropdownimg" src='{{asset('img/edit.png')}}'/>Modifier le profil
    </a>
    <div class="dropdownitem">
        <img id="dropdownimg" src='{{asset('img/notification.png')}}'/>Notification
    </div>
    <a href='{{route('logout')}}' class="dropdownitem">
        <img id="dropdownimg" src='{{asset('img/logout.png')}}'/>Deconnexion
    </a>
</div>
<div class="header w-100 d-flex justify-content-between align-items-center space-around">



    <div class="d-flex justify-content-center align-items-center">
    <img src="{{ asset('img/logo.png') }}" style="height: 100px;"/>
    <a href='{{route('home')}}'><h1>Partenato</h1></a>
    </div>
    <div class="d-flex w-30 justify-content-center align-items-center">

        <img id="chevronimg" src="{{ asset('img/down-chevron.png') }}"/>
        <img id="userimg" onclick="showmenu()" src="{{ asset('img/user.png') }}"/>
        <img id="mode-dark" src="{{asset("img/soleil.png")}}" alt="soleil" class="mode-img d-none" onclick="changemode('light')">
        <img id="mode-light" src="{{asset("img/lune.png")}}" alt="lune" class="mode-img" onclick="changemode('dark')">
    </div>

    <script src="{{asset('js/header.js')}}"></script>
</div>
