<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
</head>
<body>
<h1>Giriş Yap</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('login') }}" method="POST">
    @csrf
    <div>
        <label for="email">E-posta:</label>
        <input type="email" name="email" required>
    </div>
    <div>
        <label for="password">Şifre:</label>
        <input type="password" name="password" required>
    </div>
    <button type="submit">Giriş Yap</button>
</form>

<p>Hesabınız yok mu? <a href="{{ route('register.form') }}">Kayıt Ol</a></p>
</body>
</html>
