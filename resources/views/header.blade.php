<div class="header w-100 d-flex justify-content-between align-items-center space-around">
    <div class="d-flex justify-content-center align-items-center">
    <img src="{{ asset('img/logo.png') }}" style="height: 100px;"/>
    <h1>Partenato</h1>
    </div>
    <div class="d-flex w-30 justify-content-center align-items-center">
        <img id="chevronimg" src="{{ asset('img/down-chevron.png') }}"/>
        <img id="userimg"  src="{{ asset('img/user.png') }}"/>
        <img id="mode-dark" src="img/soleil.png" alt="soleil" class="mode-img d-none" onclick="changemode('light')">
        <img id="mode-light" src="img/lune.png" alt="lune" class="mode-img" onclick="changemode('dark')">
    </div>

    <script src="{{asset('js/header.js')}}"></script>
</div>
