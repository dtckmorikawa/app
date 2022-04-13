<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>ほわEditor</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Meiryo', 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                overflow: hidden;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 40px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .box2 {
                padding: 0.5em 1em;
                margin: 2em 0;
                font-weight: regular;
                font-size: 12px;
                color: #6091d3;/*文字色*/
                background: #FFF;
                border: solid 3px #6091d3;/*線*/
                border-radius: 10px;/*角の丸み*/
                }
            .box2 p {
                margin: 0;
                padding: 0;
            }
            #main{
                position: relative;
                z-index: 1;
                border: none;
            }
            #menu{
                position: relative;
                z-index:  0;
                border: none;
            }
        </style>
        <style>
            df-messenger {
                --df-messenger-bot-message: #878fac;
                --df-messenger-button-titlebar-color: #569ADF;
                --df-messenger-chat-background-color: #fafafa;
                --df-messenger-font-color: white;
                --df-messenger-send-icon: #878fac;
                --df-messenger-user-message: #479b3d;
            }
        </style>
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
                        @if(\Auth::check())
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
                                    @if(\Auth::check() && \Auth::user()->canManageBlogEtcPosts())
                                        <a target="main" class="dropdown-item" href="{{ route('blogetc.admin.index') }}">トピックの管理</a>
                                        <a target="main" class="dropdown-item" href="{{ route('adminbook.index') }}">ブックの管理</a>
                                        <a target="main" class="dropdown-item" href="{{ route('blogetc.admin.categories.index') }}">カテゴリの管理</a>
                                    @endif
                                    @if(\Auth::check() && \Auth::user()->canManageRolls())
                                        <a target="main" class="dropdown-item" href="{{ route('adminrole.index') }}">ロールの管理</a>
                                    @endif
                                    @if(\Auth::check() && \Auth::user()->canAuthorizePosts())
                                        <a target="main" class="dropdown-item" href="{{ route('blogetc.index') }}">トピックの一覧</a>
                                        <a target="main" class="dropdown-item" href="{{ route('book.index') }}">ブックの一覧</a>
                                    @endif
                                    <a target="main" class="dropdown-item" href="{{ route('difftest') }}">テキスト比較</a>
                                </div>
                            </li>
                        @endif
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a target="main" class="nav-link" href="{{ route('login') }}">ログイン</a>
                            </li>
                            <!--@if (Route::has('register'))
                                <li class="nav-item">
                                    <a target="main" class="nav-link" href="{{ route('register') }}">登録</a>
                                </li>
                            @endif-->
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
            
         <iframe id="main" 
                name="main"
                src="{{ route('welcome') }}" 
                width="100%"
                height="100%"
                frameborder="0" ></iframe>
        
            <!-- Dialog flow -->
            <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
            <df-messenger
                chat-icon="{{ asset('Help.png') }}"
                intent="WELCOME"
                chat-title="WebDitaHelp"
                agent-id="c274f0c6-b882-4599-9f54-67665b73d6a8"
                language-code="ja"
                wait-open="true"
                @if(\Auth::check() && \Auth::user()->canManageBlogEtcPosts())
                    user-id = {{ Auth::user()->email }}
                    session-id = {{ Auth::user()->email }}
                @endif
            ></df-messenger>

    </body>
</html>
