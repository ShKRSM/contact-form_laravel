@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="login-bg">
    <div class="login-container">
        <h2 class="login-title">Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="例: test@example.com">
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input id="password" type="password" name="password" required placeholder="例: coachtech1106">
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="login-btn">ログイン</button>
        </form>
    </div>
</div>
@endsection