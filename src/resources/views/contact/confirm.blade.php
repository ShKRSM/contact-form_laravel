@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<div class="confirm-container">
    <h2>確認画面</h2>
    <table>
        <tr><th>お名前</th><td>{{ $validatedData['first_name'] }} {{ $validatedData['last_name'] }}</td></tr>
        <tr><th>性別</th><td>{{ $validatedData['gender'] == 1 ? '男性' : ($validatedData['gender'] == 2 ? '女性' : 'その他') }}</td></tr>
        <tr><th>メールアドレス</th><td>{{ $validatedData['email'] }}</td></tr>
        <tr><th>電話番号</th><td>{{ $validatedData['tel'] }}</td></tr>
        <tr><th>住所</th><td>{{ $validatedData['address'] }}</td></tr>
        <tr><th>建物名</th><td>{{ $validatedData['building'] ?? 'なし' }}</td></tr>
        <tr><th>お問い合わせの種類</th><td>{{ $validatedData['category_id'] }}</td></tr>
        <tr><th>お問い合わせ内容</th><td>{{ $validatedData['detail'] }}</td></tr>
    </table>

    <form action="{{ route('contact.submit') }}" method="POST">
        @csrf
        @foreach ($validatedData as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <button type="submit">送信</button>
    </form>

    <a href="{{ route('contact.form') }}">修正</a>
</div>
@endsection