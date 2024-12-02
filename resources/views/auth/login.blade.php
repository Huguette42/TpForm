{{--
    Nom du fichier : login.blade.php
    Description    : Page de Connexion
    Auteur         : Hugo Jeanselme

    Utilisation :
    - Connexion
--}}



{{--
    Utilisation de la template : auth, dans layouts

    Plusieurs sections sont définies : title, content
--}}


@extends('layouts.auth')

@section('title')
Connexion
@endsection

@section('content')

    <h1>Connexion</h1><br>

    <form method="post" action="{{ route('login')}}" style="display: flex;flex-direction: column;">
        @csrf

        <label for="Email">Email</label>

        <input required name="Email"/>


        <label for="Mot_de_passe">Mot de passe</label>

        <div class="passdiv">

            <input required class="inputpass" type="password" name="Mot_de_passe"/>

            <img class="passimg" src="img/eyeo.svg" style="height: 32px;margin-right: 10px" onclick="togglePasswordVisibility(1)"/>

        </div><br>

        <button class="btn mt-3" type="submit">Se connecter</button><br>

        {{--
            Affichage des erreurs
        --}}

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
