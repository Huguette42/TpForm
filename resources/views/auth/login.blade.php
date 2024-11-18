@extends('layouts.auth')

@section('title')
Connexion
@endsection

@section('content')

    <h1>Connexion</h1>
    <br>
    <form method="post" action="{{ route('login')}}" style="display: flex;flex-direction: column;">
        @csrf

        <label for="Email">Email</label>
        <input required name="Email"/>

        <label for="Mot_de_passe">Mot de passe</label>
        <div class="passdiv">
            <input required class="inputpass" type="password" name="Mot_de_passe"/>
            <img class="passimg" src="img/eyeo.svg" style="height: 32px;margin-right: 10px" onclick="togglePasswordVisibilityLogin()"/>
        </div><br>

        <button class="btn" type="submit">Se connecter</button>
        <br>
        @if (session()->has('error'))
            <p class="text-danger">{{ session()->get('error') }}</p>
        @endif
        @error('Email')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        @error('Mot_de_passe')
            <p class="text-danger">{{ $message }}</p>
        @enderror


        <a href="register">Pas encore inscrit ?</a>
    </form>
@endsection
