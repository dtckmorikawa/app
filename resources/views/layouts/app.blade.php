<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ほわEditor</title>

    <!-- Scripts -->
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/toc-0.3.2/dist/toc.min.js') }}" defer></script>
    <script defer src="https://use.fontawesome.com/releases/v5.6.3/js/all.js"></script>
    <!-- Showing Message for PDF creation -->
    <script type="text/javascript">
        var target = $("outputmsg");
        $(function(){
            $('#selectDoctype').change(function(){
                var docval = $(this).val();
                var docselect = "";
                if (docval == "1"){
                    docselect=" PDFの作成には数分かかります "
                    $("#outputmsg").text(docselect);
                    $("#outputmsg").css('visibility','visible');
                } else if (docval == "0"){
                    $("#outputmsg").css('visibility','hidden');
                }
            });
        });
    </script>

    <!-- External CSS Switching -->
    <script type="text/javascript">
        var ContractCssurl='{{ asset('css/blogBodyContentContract.css') }}'; //default is contract
        var RuleCssurl='{{ asset('css/blogBodyContentRule.css') }}';
        var ManualCssurl='{{ asset('css/blogBodyContentManual.css') }}';

        $(function(){
            $('#selectCSS').change(function(){
                var val = $(this).val();
                var cssurl = '';
                if (val == "0") {
                    cssurl = ContractCssurl;
                    $('#toc').hide();
                } else if (val == "1") {
                    cssurl = RuleCssurl;
                    $('#toc').toc({
                        'container': '#body',
                        'selectors': 'h2',
                    });
                } else if (val == "2") {
                    cssurl = ManualCssurl;
                    $('#toc').toc({
                        'container': '#body',
                        'selectors': 'h2',
                    });
                }
                //load specified CSS
                $("#switchCSS").attr("href" , cssurl);
            });
        });
    </script>
    <script type="text/javascript">
        sendHeight();
        function sendHeight(){
            var h = document.documentElement.scrollHeight;
            parent.postMessage(h, "*");
        }
    </script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link id="switchCSS" href="{{ asset('css/blogBodyContentContract.css') }}" rel="stylesheet">
    <style>
        .b_frame{
            border: 0px;
            width: 400px;
            height: 530px;
            display: block;
            position: fixed;
            bottom: 60px;
            right: 10px;
        }
        .button_for_chat{
            border-width: 0px;
            position: fixed;
            bottom: 10px;
            right: 10px;
            background-color: rgb(0,0,0,0);
            padding: 0;
        }
        .balloon1-top {
            float:right;
            position: relative;
            display: inline-block;
            margin: 0 0 0 auto;
            padding: 7px 0px;
            min-width: 120px;
            max-width: 100%;
            color: #555;
            font-size: 13px;
            background: #e0edff;
            visibility: hidden;
        }
        .balloon1-top:before {
            content: "";
            position: absolute;
            top: -30px;
            left: 50%;
            margin-left: -15px;
            border: 15px solid transparent;
            border-bottom: 15px solid #e0edff;
        }
        .balloon1-top p {
            margin: 0;
            padding: 0;
        }
        .pagination { 
            justify-content: center;
        }
        .use_icon {
	        display: inline-block;
	        font-family: FontAwesome;
	        font-style: normal;
	        font-weight: normal;
	        line-height: 1;
	        -webkit-font-smoothing: antialiased;
	        -moz-osx-font-smoothing: grayscale;
        }
    </style>

</head>
<body style="padding: 5px 5px 60px 5px">
    <div id="app">
        <main class="py-4">
            @yield('content')
            @yield('print')
        </main>
    </div>
</body>
</html>
