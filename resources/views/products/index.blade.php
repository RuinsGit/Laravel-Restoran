@extends('layouts.app')

@section('content')
    <h1>Ürünler</h1>

    @if($products->isEmpty())
        <p>Ürün bulunmamaktadır.</p>
    @else
        <div class="product-list">
            @foreach($products as $product)
                <div class="product-item">
                    <h2>{{ $product->name }}</h2>
                    <p>{{ $product->description }}</p>
                    <p>Fiyat: {{ $product->price }} ₼</p>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                    @endif
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit">Sepete Ekle</button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
@endsection
