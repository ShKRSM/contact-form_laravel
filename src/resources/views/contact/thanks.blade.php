@extends('layouts.app')

@section('title', '送信完了')

@section('content')
<div class="container">
    <div class="thanks-container">
        <h1>お問い合わせありがとうございます</h1>
        <p>お問い合わせを受け付けました。</p>
        <a href="{{ route('contact.index') }}">HOME</a>
    </div>
</div>
@endsection