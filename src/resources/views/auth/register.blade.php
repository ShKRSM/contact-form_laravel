@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<div class="register-container">
    <h2>新規ユーザー登録</h2>
    <form action="{{ route('register') }}" method="POST">
        @csrf

        <label for="name">お名前</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        @error('name')
            <span class="error">{{ $message }}</span>
        @enderror

        <label for="email">メールアドレス</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <span class="error">{{ $message }}</span>
        @enderror

        <label for="password">パスワード</label>
        <input type="password" id="password" name="password" required>
        @error('password')
            <span class="error">{{ $message }}</span>
        @enderror

        <button type="submit">登録</button>
    </form>
    
    <a href="{{ route('login') }}" class="login-link">ログインページへ</a>
</div>
@endsection