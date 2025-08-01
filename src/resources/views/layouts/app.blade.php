<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Couchtech free market</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <a class="header__logo" href="/">
                    <img src="{{ asset('img/logo.svg') }}" alt="coachtech">
                </a>
                @if (!View::hasSection('hide-nav'))
                <div class="header-search">
                    <input type="text" name="keyword" placeholder="なにをお探しですか？" class="search-input">
                </div>
                <nav>
                    <ul class="header-nav">
                        <li class="header-nav__item">
                            <form class="form" action="/logout" method="post">
                                @csrf
                                <button class="header-nav__button">ログアウト</button>
                            </form>
                        </li>
                        <li class="header-nav__item">
                            <a class="header-nav__link--mypage" href="/mypage">マイページ</a>
                        </li>
                        <li class="header-nav__item">
                            <a class="header-nav__link--listing" href="/sell">出品</a>
                        </li>
                    </ul>
                </nav>
                @endif
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>