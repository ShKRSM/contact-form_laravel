@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<div class="login-container">
    <h1>FashionablyLate</h1>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <label for="email">メールアドレス</label>
        <input type="email" id="email" name="email" placeholder="例: test@example.com" required>
        @error('email')
            <span class="error">{{ $message }}</span>
        @enderror

        <label for="password">パスワード</label>
        <input type="password" id="password" name="password" placeholder="例: coachtech106" required>
        @error('password')
            <span class="error">{{ $message }}</span>
        @enderror

        <button type="submit">ログイン</button>
    </form>

    <div class="header-links">
        <a href="{{ route('register') }}" class="register-link">register</a>
    </div>
</div>
@endsection