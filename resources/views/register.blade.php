
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
    <script src="{{ asset('js/auth.js') }}"></script>
</head>
<body class="loginmain">
    <div class="loginborder">
        <h1>Inscription</h1>
        <br>
        <form method="POST" action="{{ route('register') }}" style="display: flex;flex-direction: column;">
            @csrf
            <label for="username">Nom d'utilisateur</label>
            <input name="username"/>

            <label for="password">Mot de passe</label>
            <div class="passdiv">
                <input class="inputpass" type="password" name="password"/>
                <img class="passimg" src="img/eyeo.svg" style="height: 32px;margin-right: 10px" onclick="togglePasswordVisibilityRegister(1)"/>
            </div>
            <label for="password2">Confirmation mot de passe</label>
            <div class="passdiv">
                <input class="inputpass" type="password" name="password2"/>
                <img class="passimg2" src="img/eyeo.svg" style="height: 32px;margin-right: 10px" onclick="togglePasswordVisibilityRegister(2)"/>
            </div>
            <br>
            <button type="submit">S'inscrire</button>
            <br>
            <a href="login">Déjà inscrit ?</a>
        </form>
    </div>
</body>
</html>

