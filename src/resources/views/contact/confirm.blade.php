@extends('layouts.app')

@section('title', '確認画面')

@section('content')
<div class="contact-bg">
    <div class="contact-container">
        <h1 class="contact-title">確認画面</h1>
        <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
            @csrf
            @foreach($validated as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <table class="contact-table">
                <tr>
                    <th>お問い合わせの種類</th>
                    <td>
                        @php
                            $category = $categories->firstWhere('id', $validated['category_id']);
                        @endphp
                        {{ $category ? $category->content : $validated['category_id'] }}
                    </td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td>
                        @if($validated['gender'] == 1) 男性
                        @elseif($validated['gender'] == 2) 女性
                        @else その他
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>氏名</th>
                    <td>{{ $validated['last_name'] }} {{ $validated['first_name'] }}</td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>{{ $validated['email'] }}</td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>{{ $validated['tel'] }}</td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td>{{ $validated['address'] }}</td>
                </tr>
                @if(isset($validated['building']))
                <tr>
                    <th>建物名</th>
                    <td>{{ $validated['building'] }}</td>
                </tr>
                @endif
                <tr>
                    <th>お問い合わせ内容</th>
                    <td>{{ $validated['detail'] }}</td>
                </tr>
            </table>
            <div class="contact-btn-row">
                <button type="submit" class="contact-btn">送信</button>
                <button type="button" class="contact-btn" onclick="history.back()">修正する</button>
            </div>
        </form>
    </div>
</div>
@endsection