@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<div class="contact-bg">
    <div class="contact-container">
        <h1 class="contact-title">Contact</h1>
        <form action="{{ route('contact.confirm') }}" method="POST" class="contact-form">
            @csrf
            <table class="contact-table">
                <tr>
                    <th><label for="last_name">お名前 <span class="required">※</span></label></th>
                    <td>
                        <div class="name-row">
                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="例: 山田" required>
                            <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="例: 太郎" required>
                        </div>
                        @error('last_name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                        @error('first_name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th><label>性別 <span class="required">※</span></label></th>
                    <td>
                        <div class="radio-group">
                            <label>
                                <input type="radio" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}> 男性
                            </label>
                            <label>
                                <input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}> 女性
                            </label>
                            <label>
                                <input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}> その他
                            </label>
                        </div>
                        @error('gender')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th><label for="email">メールアドレス <span class="required">※</span></label></th>
                    <td>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="例: test@example.com" required>
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th><label>電話番号 <span class="required">※</span></label></th>
                    <td>
                        <div class="tel-row">
                            <input type="text" name="tel1" maxlength="4" value="{{ old('tel1') }}" placeholder="080" required>
                            <span class="tel-hyphen">-</span>
                            <input type="text" name="tel2" maxlength="4" value="{{ old('tel2') }}" placeholder="1234" required>
                            <span class="tel-hyphen">-</span>
                            <input type="text" name="tel3" maxlength="4" value="{{ old('tel3') }}" placeholder="5678" required>
                        </div>
                        @error('tel1')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                        @error('tel2')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                        @error('tel3')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th><label for="address">住所 <span class="required">※</span></label></th>
                    <td>
                        <input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" required>
                        @error('address')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th><label for="building">建物名</label></th>
                    <td>
                        <input type="text" name="building" id="building" value="{{ old('building') }}" placeholder="例: 千駄ヶ谷マンション101">
                        @error('building')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th><label for="category_id">お問い合わせの種類 <span class="required">※</span></label></th>
                    <td>
                        <select name="category_id" id="category_id" required>
                            <option value="">選択してください</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->content }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th><label for="detail">お問い合わせ内容 <span class="required">※</span></label></th>
                    <td>
                        <textarea name="detail" id="detail" maxlength="120" required placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                        @error('detail')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
            </table>
            <div class="contact-btn-row">
                <button type="submit" class="contact-btn">確認画面</button>
            </div>
        </form>
    </div>
</div>
@endsection