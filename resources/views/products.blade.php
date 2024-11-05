<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürünler</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>

<h1>Ürünler Sayfası</h1>

<!-- Kullanıcının adını göster -->
@if(Auth::check())
    <p>Hoş geldiniz, {{ Auth::user()->name }}!</p>
@else
    <p>Giriş yapmadınız.</p>
@endif




<div class="container mt-5">
    <h1>Ürünler</h1>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="fotos"><img class="foto" src="{{ $product->image_url }}" alt="{{ $product->name }}"></div>
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">Fiyat: {{ $product->price }} TL</p>
                        <button class="btn btn-primary add-to-cart" data-id="{{ $product->id }}">Sepete Ekle</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Sepet İçeriği -->
    <div class="mt-5" id="cart-container">
        <h2>Sepetiniz</h2>
        <table class="table" id="cart-items">
            <thead>
            <tr>
                <th>Ürün Adı</th>
                <th>Fiyat</th>
                <th>Fotoğraf</th>
                <th>İşlem</th> <!-- Silme butonu için başlık -->
            </tr>
            </thead>
            <tbody>
            <!-- Sepet ürünleri burada yüklenecek -->
            @foreach(session('cart', []) as $id => $product)
                <tr>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['price'] }} TL</td>
                    <td><img src="{{ $product['image_url'] }}" alt="{{ $product['name'] }}" width="50"></td>
                    <td>
                        <button class="btn btn-danger remove-from-cart" data-id="{{ $id }}">Sil</button> <!-- Sil butonu -->
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <button class="btn btn-success" id="confirm-cart">Sepeti Onayla ve WhatsApp'tan Gönder</button>
    </div>

    <div class="mt-3">
        <a href="{{ route('cart.index') }}" class="btn btn-secondary">Sepeti Görüntüle</a>
    </div>
</div>

<div class="logout">
    <a class="logout" href="{{ route('login.form') }}">Çıkış</a>
</div>

<script src="{{ asset('js/sebetx.js') }}"></script>
</body>
</html>
