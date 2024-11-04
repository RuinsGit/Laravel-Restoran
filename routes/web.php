<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

// Ana sayfa
Route::get('/', function () {
    return redirect()->route('login.form'); // Ana sayfada login formuna yönlendir
});

// Ürünler için
Route::get('/products', [ProductController::class, 'index'])->middleware('auth')->name('products');

// Sepete ekleme
Route::post('/cart/add/{id}', [CartController::class, 'add']);

// Kayıt işlemleri
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Giriş işlemleri
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Çıkış işlemi
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

