@extends('layouts.base')

@section('header')
    <link rel="stylesheet"  href="{{ asset('/css/editprofil.css')}}">
@endsection

@section('title')
    Modifier le profil
@endsection


@section('content')
    <div class="container maindiv">
        <h1>Modifier le profil</h1>
        <form action="{{ route('user.update') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Email</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
            </div>
            <button type="submit" class="btn btn-theme">Changer</button>
        </form>
        <h1 class="mt-5">Changer de mot de passe</h1>
        <form action='{{ route('user.updatepassword') }}' method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nouveau mot de passe</label>
                <input type="password" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Confirmer le mot de passe</label>
                <input type="password" class="form-control" id="name" name="name">
            </div>
            <button type="submit" class="btn btn-theme">Changer</button>
    </div>
@endsection
