@extends('layouts.auth')

@section('title')
Inscription
@endsection

@section('content')
    <h1>Inscription</h1>
    <br>
    <form method="POST" action="{{ route('register') }}" style="display: flex;flex-direction: column;">
        @csrf

        <label for="Email">Email</label>
        <input name="Email"/>

        @error('Email')
                <p class="text-danger">{{ $message }}</p>
        @enderror

        <label for="Prénom">Prénom</label>
        <input name="Prénom"/>

        <label for="Nom">Nom</label>
        <input name="Nom"/>


        <label for="Mot_de_passe">Mot de passe</label>
        <div class="passdiv">
            <input class="inputpass" type="password" oninput="validatePassword(this.value)" name="Mot_de_passe"/>
            <img class="passimg" src="img/eyeo.svg" style="height: 32px;margin-right: 10px" onclick="togglePasswordVisibilityRegister(1)"/>
        </div>

        <label for="Mot_de_passe_confirmation">Confirmation mot de passe</label>
        <div class="passdiv">
            <input class="inputpass" type="password" name="Mot_de_passe_confirmation"/>
            <img class="passimg2" src="img/eyeo.svg" style="height: 32px;margin-right: 10px" onclick="togglePasswordVisibilityRegister(2)"/>
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
        @if (session()->has('error'))
            <p class="text-danger">{{ session()->get('error') }}</p>
        @endif
        @error('Prénom')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        @error('Nom')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        @error('Mot_de_passe')
                <p class="text-danger">{{ $message }}</p>
        @enderror

        @error('Mot_de_passe_confirmation')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <br>
        <button class="btn" type="submit">S'inscrire</button>
        <br>

        <a href="login">Déjà inscrit ?</a>
    </form>
@endsection

