<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        <div class="header-inner">
            <span class="site-title">FashionablyLate</span>
            @if (Route::currentRouteName() === 'register')
                <a href="{{ route('login') }}" class="header-link-btn">login</a>
            @elseif (Route::currentRouteName() === 'login')
                <a href="{{ route('register') }}" class="header-link-btn">register</a>
            @endif
        </div>
    </header>
    <main>
        @yield('content')
    </main>
    @yield('scripts')
</body>
</html>