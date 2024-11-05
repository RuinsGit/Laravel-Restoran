<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepet</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Sepet</h1>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table" id="cart-items">
        <thead>
        <tr>
            <th>Ürün Adı</th>
            <th>Fiyat</th>
            <th>Miktar</th>
            <th>Fotoğraf</th>
        </tr>
        </thead>
        <tbody>
        @if (!empty($cart) && count($cart) > 0)
            @foreach ($cart as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['price'] }} TL</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td><img src="{{ $item['image_url'] }}" width="50" alt="{{ $item['name'] }}"></td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4">Sepetiniz boş.</td>
            </tr>
        @endif
        </tbody>
    </table>

    <a href="{{ route('products') }}" class="btn btn-secondary">Alışverişe Devam Et</a>
    <form action="{{ route('cart.confirm') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-success">Sepeti Onayla</button>
    </form>
</div>
</body>
</html>
