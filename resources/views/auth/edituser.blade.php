@extends('layouts.base')

@section('header')
    <link rel="stylesheet"  href="{{ asset('/css/editprofil.css')}}">
@endsection

@section('title')
    Modifier le profil
@endsection


@section('content')
<div class="main-block">
    <div class="container maindiv">
        <h1>Modifier le profil</h1>
        <form action="{{ route('user.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="lastname" class="form-label">Nom</label>
                <input type="text" class="form-control" name="lastname" value="{{ $user->lastname }}">
            </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">Prénom</label>
                <input type="text" class="form-control" name="firstname" value="{{ $user->firstname }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" value="{{ $user->email }}">
            </div>
            <button type="submit" class="btn btn-theme">Changer</button>
        </form>
        <h1 class="mt-5">Changer de mot de passe</h1>
        <form action='{{ route('user.updatepassword') }}' method="POST">
            @csrf
            @method('PUT')
            <label for="Mot_de_passe form-label">Mot de passe</label>
            <div class="passdiv ">
                <input class="inputpass form-control" type="password" oninput="validatePassword(this.value)" name="Mot_de_passe"/>
                <img class="passimg" src="img/eyeo.svg" style="height: 32px;margin-right: 10px" onclick="togglePasswordVisibilityRegister(1)"/>
            </div>

            <label for="Mot_de_passe_confirmation form-label">Confirmation mot de passe</label>
            <div class="passdiv">
                <input class="inputpass form-control" type="password" name="Mot_de_passe_confirmation"/>
                <img class="passimg" src="img/eyeo.svg" style="height: 32px;margin-right: 10px" onclick="togglePasswordVisibilityRegister(2)"/>
            </div>
            <div class="form-group">
                <ul>
                    <li id="minLength"><i class="fas fa-times
                         text-danger"></i> Minimum 8 characters</li>
                    <li id="uppercase">
                        Une lettre majuscule minimum
                    </li>
                    <li id="symbol">
                        Un symbole minimum (@$!%*?&=)
                    </li>
                </ul>
            </div>
            <span id="errorMessage" class="font-weight-bold
         text-danger"></span>
         <br>
         <br>
            <button type="submit" class="btn btn-theme">Changer</button>
            <script src="{{ asset('js/auth.js') }}"></script>
    </div>
</div>
@endsection
