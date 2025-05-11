@extends('layouts.app')

@section('title', 'Admin')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <div class="admin-logo">FashionablyLate</div>
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">logout</button>
        </form>
    </div>
    <div class="admin-title">Admin</div>

    <div class="admin-search-block">
        <form method="GET" action="{{ route('admin.index') }}" class="admin-search-form">
            <input type="text" name="name" value="{{ request('name') }}" class="admin-input" placeholder="名前やメールアドレスを入力してください">
            <select name="gender" class="admin-select">
                <option value="">性別</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
            </select>
            <select name="category_id" class="admin-select">
                <option value="">お問い合わせの種類</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>
            <input type="date" name="date" value="{{ request('date') }}" class="admin-input admin-date" placeholder="年/月/日">
            <button type="submit" class="admin-btn admin-btn-search">検索</button>
            <a href="{{ route('admin.index') }}" class="admin-btn admin-btn-reset">リセット</a>
        </form>
        <div class="admin-bottom-row">
            <div class="admin-export-area">
                <a href="{{ route('admin.export', request()->all()) }}" class="admin-btn admin-btn-export">エクスポート</a>
            </div>
            <div class="admin-pagination">
                {{ $contacts->appends(request()->query())->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>

    <div class="admin-table-area">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->last_name }}　{{ $contact->first_name }}</td>
                    <td>
                        @if($contact->gender == 1) 男性
                        @elseif($contact->gender == 2) 女性
                        @else その他
                        @endif
                    </td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->content }}</td>
                    <td>
                        <button type="button" class="admin-btn-detail" data-id="{{ $contact->id }}">詳細</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection