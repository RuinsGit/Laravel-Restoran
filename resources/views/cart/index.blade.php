@extends('layouts.app')

@section('content')
    <h1>Sepet</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session()->has('cart') && count(session()->get('cart')) > 0)
        <table class="table">
            <thead>
            <tr>
                <th>Fotoğraf</th>
                <th>Ürün Adı</th>
                <th>Açıklama</th>
                <th>Fiyat</th>
            </tr>
            </thead>
            <tbody>
            @foreach(session()->get('cart') as $product)
                <tr>
                    <td>
                        <img src="{{ $product['image_url'] }}" alt="{{ $product['name'] }}" width="50">
                    </td>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['description'] ?? 'Açıklama yok' }}</td> <!-- Açıklama kontrolü -->
                    <td>{{ $product['price'] }} TL</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <form action="{{ route('cart.confirm') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Sepeti Onayla</button>
        </form>
    @else
        <p>Sepetiniz boş.</p>
    @endif
@endsection
