<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
</head>
<body>
<h1>Kayıt Ol</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('register') }}" method="POST">
    @csrf
    <div>
        <label for="name">İsim:</label>
        <input type="text" name="name" required>
    </div>
    <div>
        <label for="email">E-posta:</label>
        <input type="email" name="email" required>
    </div>
    <div>
        <label for="password">Şifre:</label>
        <input type="password" name="password" required>
    </div>
    <div>
        <label for="password_confirmation">Şifre Onayı:</label>
        <input type="password" name="password_confirmation" required>
    </div>
    <button type="submit">Kayıt Ol</button>
</form>

<p>Hesabınız var mı? <a href="{{ route('login.form') }}">Giriş Yap</a></p>
</body>
</html>
