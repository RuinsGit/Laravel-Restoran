<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

// Ana sayfa -> Login formuna yönlendirme
Route::get('/', function () {
    return redirect()->route('login.form');
});

// Ürün sayfası (giriş yapıldıktan sonra erişilebilir)
Route::get('/products', [ProductController::class, 'index'])->middleware('auth')->name('products');

// Sepete ürün ekleme
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

// Sepet görüntüleme ve onaylama
Route::get('/cart', [CartController::class, 'viewCart'])->middleware('auth')->name('cart.index');
Route::post('/cart/confirm', [CartController::class, 'confirmCart'])->middleware('auth')->name('cart.confirm');

// Kayıt işlemleri
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Giriş işlemleri
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Çıkış işlemi
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Sepetten ürün silme
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Sepet içeriğini alma
Route::get('/cart/items', [CartController::class, 'getCartItems'])->name('cart.items');

// Index sayfası
Route::get('/index', function () {
    return view('index'); // 'index.blade.php' dosyasının bulunduğu klasör
})->middleware('auth')->name('index');
