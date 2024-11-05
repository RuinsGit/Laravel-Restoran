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



<header id="header">
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Shop</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Login</a></li>
            <li ><a class="sepet" href="{{ route('cart.index') }}">Sepetiniz</a></li>
            <li ><a  href="{{ route('login.form') }}">Çıkış</a></li>


            <li class="li-text"> @if(Auth::check())

                    <div class="text1"> Hoş geldiniz,</div>

                    <div class="logined-main"> {{ Auth::user()->name }}!

                    </div>
                @else
                    <p class="logined-text">Giriş yapmadınız.</p>
                @endif</li>


        </ul>
    </nav>
</header>




<div class="icerik">


    <div class="urunler">
        <h2>Ürünler</h2>
        <div class="urun-listesi">




            <div class="row " >
                @foreach ($products as $product)
                    <div class="col-md-4" >
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




        </div>
    </div>
    <div class="slider">
        <div class="kaydirma-alani">
            <div class="row urun-karti" >
                @foreach ($products as $product)
                    <div class="col-md-12 product-slide" style="display: none;"> <!-- Tüm ürünleri gizli tut -->
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
        </div>
    </div>

</div>


{{--<div class="mt-3">--}}
{{--    <a href="{{ route('cart.index') }}" class="btn btn-secondary">Sepeti Görüntüle</a>--}}
{{--</div>--}}
{{--</div>--}}
















<script src="{{ asset('js/sebetx.js') }}"></script>
</body>
</html>





{{--<div class="slider">--}}
{{--    <div class="slides">--}}
{{--        <img src="{{'../images/back.jpg'}}" alt="Slide 1" class="active">--}}
{{--        <img src="{{'../images/back.jpg'}}" alt="Slide 2">--}}
{{--        <img src="{{'../images/back.jpg'}}" alt="Slide 3">--}}
{{--    </div>--}}
{{--</div>--}}
{{--</div>--}}
