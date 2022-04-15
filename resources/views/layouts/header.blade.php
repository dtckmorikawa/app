<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ほわEditor</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li style="position: relative; z-index: 2;" class="nav-item dropdown">
                        <a id="navbarDropdown" 
                                class="nav-link dropdown-toggle" 
                                href="#" role="button" 
                                data-toggle="dropdown" 
                                aria-haspopup="true" 
                                aria-expanded="false" v-pre>
                                MENU<span class="caret"></span>
                        </a>
                        
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a target="main" class="dropdown-item" href="{{ route('welcome') }}">Top</a>
                            <a target="main" class="dropdown-item" href="{{ route('blogetc.index') }}">トピックの閲覧</a>
                            <a target="main" class="dropdown-item" href="{{ route('book.index') }}">ブックの閲覧</a>
                            <a target="main" class="dropdown-item" href="{{ route('difftest') }}">テキスト比較</a>
                            @if(\Auth::check() && \Auth::user()->canManageBlogEtcPosts())
                                <a target="main" class="dropdown-item" href="{{ route('blogetc.admin.index') }}">トピックの投稿</a>
                                <a target="main" class="dropdown-item" href="{{ route('adminbook.index') }}">ブックの作成</a>
                                <a target="main" class="dropdown-item" href="{{ route('blogetc.admin.categories.index') }}">カテゴリの作成</a>
                            @endif
                        </div>
                    </li>
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a target="main" class="nav-link" href="{{ route('login') }}">ログイン</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a target="main" class="nav-link" href="{{ route('register') }}">登録</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" 
                                class="nav-link dropdown-toggle" 
                                href="#" role="button" 
                                data-toggle="dropdown" 
                                aria-haspopup="true" 
                                aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a target="main" class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    ログアウト
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!--<div id="app">
        <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
            <div class="container">
                <a target="main"
                   class="navbar-brand" 
                   href="{{ route('welcome') }}" 
                   style="color: #0099ff;">
                    ほわEditor
                </a>
                <button class="navbar-toggler" type="button"
                    data-toggle="collapse"
                    data-target="#navmenu1"
                    aria-controls="navmenu1"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-start" id="navmenu1">
                    <div class="navbar-nav">
                        <a target="main" class="nav-item nav-link" href="{{ route('welcome') }}">Top</a>
                        <a target="main" class="nav-item nav-link" href="{{ route('blogetc.index') }}">トピックの閲覧</a>
                        <a target="main" class="nav-item nav-link" href="{{ route('book.index') }}">ブックの閲覧</a>
                        <a target="main" class="nav-item nav-link" href="{{ route('difftest') }}">テキスト比較</a>
                        @if(\Auth::check() && \Auth::user()->canManageBlogEtcPosts())
                            <a target="main" class="nav-item nav-link" href="{{ route('blogetc.admin.index') }}">トピックの投稿</a>
                            <a target="main" class="nav-item nav-link" href="{{ route('adminbook.index') }}">ブックの作成</a>
                            <a target="main" class="nav-item nav-link" href="{{ route('blogetc.admin.categories.index') }}">カテゴリの作成</a>
                        @endif
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto" >
                        @guest
                            <li class="nav-item">
                                <a target="main" class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a target="main" class="nav-link" href="{{ route('register') }}">{{ __('登録') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                            </li>
                            <li>
                                <a  class="btn-dark nav-item nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();" style="color:white">
                                    {{ __('ログアウト') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;" target="_top">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>-->
    </div>

</body>
</html>
