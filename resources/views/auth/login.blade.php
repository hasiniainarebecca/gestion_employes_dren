<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Se Connecter</title>
    <link rel="stylesheet" href="{{asset('css/auth.css')}}">
</head>
<body>
    <div class="formBox">
        <h1>Authentification</h1>
    <form method="POST" action="{{ route('handleLogin') }}">
       @csrf
       @method('POST')

        <div class="inputBox">
            <input type="email" name="email" placeholder="Entrer votre adresse email" class="email">
            <label>Adresse Email</label>
        </div>
        <div class="inputBox">
            <input type="password" name="password" placeholder="Entrer votre mot de passe" class="email">
            <label>Mot de passe</label>
        </div>
            <input type="submit" value="Se Connecter"></br>
            @if(Session::get('success_msg'))
                <b style="font-size: 15px; color: rgb(57, 194, 64);">{{ Session::get('success_msg') }}</b>
            @endif
            @if(Session::get('error_msg'))
                <b style="font-size: 15px; color: rgb(185, 81, 81);">{{ Session::get('error_msg') }}</b>
            @endif
    </form>
</div> 
</body>