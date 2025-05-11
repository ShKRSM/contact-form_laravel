@extends('layouts.app')

@section('title', '確認画面')

@section('content')
<div class="container">
    <h1>確認画面</h1>
    <form action="{{ route('contact.store') }}" method="POST">
        @csrf
        @foreach($validated as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach

        <div class="confirm-group">
            <label>お問い合わせの種類</label>
            <p>{{ $validated['category_id'] }}</p>
        </div>

        <div class="confirm-group">
            <label>性別</label>
            <p>
                @if($validated['gender'] == 1) 男性
                @elseif($validated['gender'] == 2) 女性
                @else その他
                @endif
            </p>
        </div>

        <div class="confirm-group">
            <label>氏名</label>
            <p>{{ $validated['last_name'] }} {{ $validated['first_name'] }}</p>
        </div>

        <div class="confirm-group">
            <label>メールアドレス</label>
            <p>{{ $validated['email'] }}</p>
        </div>

        <div class="confirm-group">
            <label>電話番号</label>
            <p>{{ $validated['tel'] }}</p>
        </div>

        <div class="confirm-group">
            <label>住所</label>
            <p>{{ $validated['address'] }}</p>
        </div>

        @if(isset($validated['building']))
        <div class="confirm-group">
            <label>建物名</label>
            <p>{{ $validated['building'] }}</p>
        </div>
        @endif

        <div class="confirm-group">
            <label>お問い合わせ内容</label>
            <p>{{ $validated['detail'] }}</p>
        </div>

        <div class="button-group">
            <button type="submit">送信</button>
            <button type="button" onclick="history.back()">修正する</button>
        </div>
    </form>
</div>
@endsection