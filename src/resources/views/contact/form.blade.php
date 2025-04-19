@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<div class="contact-container">
    <h2>お問い合わせフォーム</h2>
    <form action="{{ route('contact.confirm') }}" method="POST">
        @csrf

        <label>姓 ※</label>
        <input type="text" name="first_name" value="{{ old('first_name') }}">
        @error('first_name') <span class="error">{{ $message }}</span> @enderror

        <label>名 ※</label>
        <input type="text" name="last_name" value="{{ old('last_name') }}">
        @error('last_name') <span class="error">{{ $message }}</span> @enderror

        <label>性別 ※</label>
        <select name="gender">
            <option value="1" selected>男性</option>
            <option value="2">女性</option>
            <option value="3">その他</option>
        </select>
        @error('gender') <span class="error">{{ $message }}</span> @enderror

        <label>メールアドレス ※</label>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email') <span class="error">{{ $message }}</span> @enderror

        <label>電話番号 ※</label>
        <input type="text" name="tel" value="{{ old('tel') }}">
        @error('tel') <span class="error">{{ $message }}</span> @enderror

        <label>お問い合わせの種類 ※</label>
        <select name="category_id">
            <option value="" selected>選択してください</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->content }}</option>
            @endforeach
        </select>
        @error('category_id') <span class="error">{{ $message }}</span> @enderror

        <label>お問い合わせ内容 ※</label>
        <textarea name="detail">{{ old('detail') }}</textarea>
        @error('detail') <span class="error">{{ $message }}</span> @enderror

        <button type="submit">確認画面</button>
    </form>
</div>
@endsection