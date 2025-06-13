@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="register-bg">
    <div class="register-container">
        <h2 class="register-title">Register</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">お名前</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required placeholder="例: 山田　太郎" autocomplete="off">
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="例: test@example.com" autocomplete="off">
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input id="password" type="password" name="password" required placeholder="例: coachtech1106" autocomplete="off">
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password-confirm">パスワード（確認）</label>
                <input id="password-confirm" type="password" name="password_confirmation" required placeholder="もう一度パスワードを入力" autocomplete="off">
            </div>
            <button type="submit" class="register-btn">登録</button>
        </form>
    </div>
</div>
@endsection
