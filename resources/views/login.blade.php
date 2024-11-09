
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/login.css') }}">
    <script src="{{ asset('js/auth.js') }}"></script>
</head>
<body class="loginmain">
    <div class="loginborder">
        <h1>Connexion</h1>
        <br>
        <form method="post" action="{{ route('login')}}" style="display: flex;flex-direction: column;">
            @csrf
            <label for="username">Nom d'utilisateur</label>
            <input required name="username"/>
            <label for="password">Mot de passe</label>
            <div class="passdiv">
                <input required class="inputpass" type="password" name="password"/>
                <img class="passimg" src="img/eyeo.svg" style="height: 32px;margin-right: 10px" onclick="togglePasswordVisibilityLogin()"/>
            </div>
            <br>
            <button type="submit">Se connecter</button>
                @error('username')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
                @error('password')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            <br>
            <a href="register">Pas encore inscrit ?</a>
        </form>
    </div>
</body>
</html>
