<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Kayıt ekranını göster
    public function showRegisterForm()
    {
        return view('auth.register'); // Kayıt formunu göster
    }

    // Kayıt işlemini yap
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Şifreyi şifrele
        ]);

        Auth::login($user); // Kullanıcıyı giriş yaptır

        return redirect()->route('products')->with('success', 'Hoş geldiniz, ' . $user->name . '!'); // Ürünler sayfasına yönlendir
    }

    // Giriş ekranını göster
    public function showLoginForm()
    {
        return view('auth.login'); // Giriş formunu göster
    }

    // Giriş işlemini yap
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Giriş yapan kullanıcı bilgisi
            return redirect()->route('products')->with('success', 'Hoş geldiniz, ' . $user->name . '!'); // Ürünler sayfasına yönlendir
        }

        return redirect()->back()->withErrors([
            'email' => 'Geçersiz e-posta veya şifre.',
        ]);
    }

    // Çıkış yap
    public function logout()
    {
        Auth::logout(); // Kullanıcıyı çıkış yaptır
        return redirect()->route('login.form')->with('success', 'Başarıyla çıkış yaptınız.'); // Giriş sayfasına yönlendir
    }
}
