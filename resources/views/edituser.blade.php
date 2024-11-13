<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"  href="{{ asset('/css/header.css')}}">
    <link rel="stylesheet"  href="{{ asset('/css/editprofil.css')}}">
    <title>Edit Profile</title>
</head>
<body>
@include('header')
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
</body>
</html>
