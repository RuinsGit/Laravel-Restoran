<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>

<div class="login">

    <div class="login-middle">

        <div class="login-text">
            LOGIN

        </div>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="form" action="{{ route('login') }}" method="POST">
            @csrf


            <div class="labels">

                <input type="email" name="email" required class="login-style" placeholder="Email">
            </div>
            <div class="labels">

                <input type="password" name="password" required class="login-style" placeholder="Passeword">
            </div>
            <button type="submit" class="submit">Login</button>

            <p class="reg">Dont have on accaunt? <a class="links" href="{{ route('register.form') }}">Register</a></p>
        </form>


    </div>
</div>
</body>
</html>
