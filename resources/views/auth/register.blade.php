<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
<div class="login">
    <div class="login-middle">
        <div class="login-text">REGISTER</div>

        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="form" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="labels">

                <input type="text" name="name" required class="login-style" placeholder="Name & Surname">
            </div>
            <div class="labels">

                <input type="email" name="email" required class="login-style" placeholder="Email">
            </div>
            <div class="labels">

                <input type="password" name="password" required class="login-style" placeholder="Password">
            </div>
            <div class="labels">

                <input type="password" name="password_confirmation" required class="login-style" placeholder=" Re password">
            </div>
            <button type="submit" class="submit">Sign Up</button>
            <p class="reg">Do you have an account? <a class="links" href="{{ route('login.form') }}">Login</a></p>
        </form>
    </div>
</div>
</body>
</html>
