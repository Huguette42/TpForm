@extends('layouts.base')

@section('title', 'Verify Email')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/verifyEmail.css') }}">
@endsection

@section('content')
<div class="d-flex justify-content-center py-4">
    <div class="block p-5">
        <h1 class="title">Merci de verifier votre email</h1>

        <p class="mb-4">Un email viens de vous être envoyé. Vous ne l'avez pas reçus ?</p>

        <form action="{{ route('verification.send') }}" method="post">
            @csrf
            <button class="btn btn-color">Renvoyer l'email</button>
        </form>
        <br>

        <h3 class="mt-4">Vous avez déjà vérifié votre adresse e-mail ?</h3>
        <p class="mb-4">Vous pouvez continuer en cliquant sur le bouton ci-dessous</p>
        <a href="{{ route('home') }}" class="btn btn-color">Continuer</a>

    </div>
</div>
@endsection
