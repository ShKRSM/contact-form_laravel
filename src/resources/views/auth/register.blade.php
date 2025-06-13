@extends('layouts.app')

@section('content')
<div class="register-container">
    <h2 class="register-title">Register</h2>

    <form method="POST" action="{{ route('register') }}" class="register-form">
        @csrf

        <!-- 名前 -->
        <div class="form-group">
            <label for="name">お名前</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="例: 山田　太郎">
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- メールアドレス -->
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="例: test@example.com">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- パスワード -->
        <div class="form-group">
            <label for="password">パスワード</label>
            <input id="password" type="password" name="password" required placeholder="例: coachtech1106">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- パスワード確認 -->
        <div class="form-group">
            <label for="password-confirm">パスワード（確認）</label>
            <input id="password-confirm" type="password" name="password_confirmation" required placeholder="もう一度パスワードを入力">
        </div>

        <!-- 登録ボタン -->
        <div class="form-button">
            <button type="submit" class="btn-register">登録</button>
        </div>
    </form>
</div>
@endsection
