<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>管理者 - {{ config('app.name', 'Howa-Editor') }}</title>

    <!-- jQuery is only used for hide(), show() and slideDown(). All other features use vanilla JS -->
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>

    <!--Jquery sortable test-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
    
    <script defer src="https://use.fontawesome.com/releases/v5.6.3/js/all.js"></script>
    
    <script src="{{ asset('js/jquery-sortable.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-sortable.css') }}" media="all" /> 
    
    <script type="text/javascript">
        $(function  () {
            
            $("ul.serialization").sortable({
                group: 'connect-area'
            });

            $("ul.all-posts-sortable").sortable({
                group: 'connect-area'
            });

            $(".delete").click(function(){
                $(this).parent().remove();
            });
                
            $("#testsub").click(function() {
                //階層チェック
                /*const getDepth = ({ children }) => 1+
                (children ? Math.max(...children.map(getDepth)) : 0)*/

                var listHTML=$('#structure').html();
                str=listHTML.replace(/\n/g,"");
                       
                $("#book_structure").val(str);
                $("form").submit();
            });
        });
    </script>
    <script type="text/javascript">
        $(function(){
            var $btn = $('.btn [data-filter]'),
            $list = $('.list [data-category]');
   
            $btn.on('click', function(e) {
                e.preventDefault();
     
                var $btnTxt = $(this).attr('data-filter');
     
                if ($btnTxt == 'all'){
                    $list.fadeOut().promise().done(function() {
                    $list.addClass('animate').fadeIn();
                    });
                } else {
                    $list.fadeOut().promise().done(function() {
                        $list.filter('[data-category = "' + $btnTxt + '"]').addClass('animate').fadeIn();
                    });
                }
            });
        })
    </script>

    <style type="text/css">
        div.structure_box{
            padding:10px;
            background-color: #cccccc;
        }
        .use_icon {
	        display: inline-block;
	        font-family: FontAwesome;
	        font-style: normal;
	        font-weight: normal;
	        line-height: 1;
	        -webkit-font-smoothing: antialiased;
	        -moz-osx-font-smoothing: grayscale;
        }.list {
            width: 100%;
            height: 48vh;
            background: lightgray;

            /* 縦方向のスクロールバーを表示 */
            overflow-y: scroll;

            /* IE などのスクロールバーの色設定 */
            scrollbar-face-color: #999;
            scrollbar-track-color: #eee;

            /* スマホ用の慣性スクロール */
            -webkit-overflow-scrolling: touch;
        }ul.ddmenu {
            width: 110%;
            margin: 0px;
            padding: 0px;
        }ul.ddmenu li {
            width: 110%;                /* メニュー項目の横幅*/
            /*display: inline-block;  /* ★1:横並び */
            list-style-type: none;  /* ★2:リストの先頭記号を消す */
            position: relative;     /* ★3:サブメニュー表示の基準位置にする */
        }ul.ddmenu a {
            background-color: #999; /* メニュー項目の背景色*/
            color: white;              /* メニュー項目の文字色(白色) */
            line-height: 40px;         /* メニュー項目のリンクの高さ(40px) */
            text-align: center;        /* メインメニューの文字列の配置(中央寄せ) */
            text-decoration: none;     /* メニュー項目の装飾(下線を消す) */
            font-weight: bold;         /* 太字にする */
            display: block;            /* ★4:項目内全域をリンク可能にする */
        }ul.ddmenu a:hover {
            background-color: #eee; /* メニュー項目にマウスが載ったときの背景色(淡いピンク) */
            color: #999;            /* メニュー項目にマウスが載ったときの文字色(濃い赤色) */
        }ul.ddmenu ul {
            display: none;       /* ★1:標準では非表示にする */
            margin: 0px;         /* ★2:サブメニュー外側の余白(ゼロ) */
            padding: 10px;        /* ★3:サブメニュー内側の余白(ゼロ) */
            position: absolute;  /* ★4:絶対配置にする */
        }ul.ddmenu li:hover ul {
            display: block;      /* ★5:マウスポインタが載っている項目の内部にあるリストを表示する */
        }
    </style>

    <!--/////////////////////Until Here/////////////////////-->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito" crossorigin="anonymous">

    <!-- Styles -->
    @if(file_exists(public_path("blogetc_admin_css.css")))
        <link href="{{ asset('blogetc_admin_css.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        {{--Edited your css/app.css file? Uncomment these lines to use plain bootstrap:--}}
        {{--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}
        {{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">--}}
    @endif

</head>
<body>
<div id="app">
   <main class="py-4">
        <div class='container'>
            <div class='row'>
                <div class='col-md-3'>
                    @include("blogetc_admin::layouts.sidebar")
                </div>
                <div class='col-md-9 '>
                    @if (isset($errors) && count($errors))
                        <div class="alert alert-danger">
                            <b>エラーが発生しました。</b>
                            <ul class='m-0'>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{--REPLACING THIS FILE WITH YOUR OWN LAYOUT FILE? Don't forget to include the following section!--}}

                    @if(\WebDevEtc\BlogEtc\Helpers::has_flashed_message())
                        <div class='alert alert-info'>
                            <h3>{{\WebDevEtc\BlogEtc\Helpers::pull_flashed_message() }}</h3>
                        </div>
                    @endif
                    @yield('content')
                 </div>
            </div>
        </div>
    </main>
</div>

{{--<div class='text-center mt-5 pt-5 mb-3 text-muted'>
    <small><a href='https://webdevetc.com/'>Laravel Blog Package provided by Webdevetc</a></small>
</div> --}}


@if( config("blogetc.use_wysiwyg") && config("blogetc.echo_html") && (in_array( \Request::route()->getName() ,[ 'blogetc.admin.create_post' , 'blogetc.admin.edit_post'  ])))
    <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"
            integrity="sha384-BpuqJd0Xizmp9PSp/NTwb/RSBCHK+rVdGWTrwcepj1ADQjNYPWT2GDfnfAr6/5dn"
            crossorigin="anonymous">
    </script>
    <script>
        if( typeof(CKEDITOR) !== "undefined" ) {
            CKEDITOR.replace('post_body',
            //added//
            {
                language: 'ja',
                imageUploadUrl: "{{route('uploadwithdd', ['_token' => csrf_token() ])}}",
                filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form',
                filebrowserBrowseUrl: '{{ route('browsevideo') }}',
                filebrowserImageBrowseUrl: '{{ route('browseimage') }}',
                height: 400,
                filebrowserWindowWidth: 640,
                filebrowserWindowHeight: 480,
            });
        }
    </script>
@endif
</body>
</html>

