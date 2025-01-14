<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page de confirmation</title>
    <link rel="stylesheet" href="{{asset('css/auth.css')}}">
</head>
<body>
    <div class="formBox">
        <h1>Page de confirmation</h1>
    <form method="POST" action="{{ route('submitDefineAccess',['email' => $email]) }}">
       @csrf
       @method('POST')

       <div class="inputBox">
            <input type="email" name="email" placeholder="Entrer votre adresse email" class="email" value="{{ $email }}" >
            <label>Adresse email</label>
        </div>
        <div class="inputBox">
            <input type="password" name="password" placeholder="Entrer votre mot de passe" class="email">
            <label>Mot de passe</label>
            @error('password')
                <span style="font-size: 15px; color: rgb(185, 81, 81);;">{{ $message }}</span>
            @enderror
        </div>
        <div class="inputBox">
            <input type="password" name="confirm_password" placeholder="Entrer votre mot de passe de confirmation" class="email">
            <label>Mot de passe de confirmation</label>
            @error('confirm_password')
                <span style="font-size: 15px; color: rgb(185, 81, 81);">{{ $message }}</span>
            @enderror
        </div>
            <input type="submit" value="confirmer"></br>
            @if(Session::get('error_msg'))
                <b style="font-size: 15px; color: rgb(185, 81, 81);">{{ Session::get('error_msg') }}</b>
            @endif
    </form>
</div> 
</body>