
@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<div class="thanks-container">
    <h2>お問い合わせありがとうございました</h2>
    <button onclick="location.href='{{ route('contact.form') }}'">HOME</button>
</div>
@endsection