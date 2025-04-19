<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// ユーザー登録
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// ログイン
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

// 管理画面（認証が必要）
Route::middleware('auth')->group(function () {
    Route::get('/admin', [ContactController::class, 'index'])->name('admin');
    Route::get('/contacts/{id}', [ContactController::class, 'show']);
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy']);
    Route::get('/contacts/export', [ContactController::class, 'export']);
});

// お問い合わせフォーム
Route::get('/contact', [ContactController::class, 'index'])->name('contact.form');
Route::post('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/contact/thanks', function () {
    return view('contact.thanks');
})->name('contact.thanks');