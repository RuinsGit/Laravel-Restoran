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
<div class="container mt-5">
    <h1>Ürünler</h1>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="fotos"><img class="foto" src="{{ $product->image_url }}"></div>
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">Fiyat: {{ $product->price }} TL</p>
                        <button class="btn btn-primary add-to-cart" data-id="{{ $product->id }}">Sepete Ekle</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="logut">
    <a class="logut" href="{{ route('login.form') }}">Cix</a>
</div>

<script>
    $(document).ready(function() {
        // CSRF token'ını ayarla
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.add-to-cart', function() {
            var productId = $(this).data('id');
            $.post('/cart/add/' + productId, function(response) {
                alert(response.message);
            }).fail(function(response) {
                alert(response.responseJSON.message);
            });
        });
    });
</script>
</body>
</html>



