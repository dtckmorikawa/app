<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ほわEditor</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- added to close chat -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Meiryo', 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
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

            .subtitle {
                font-size: 20px;
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
                margin: 20px;
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
            .b_frame{
                border: 1;
                width: 400px;
                height: 530px;
                display: block;
                position: absolute;
                bottom: 60px;
                right: 10px;
            }
            .button_for_chat{
                position: absolute;
                bottom: 10px;
                right: 10px;
                border-width: 0px;
                background-color: rgb(0,0,0,0);
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
        <div class="flex-center position-ref full-height" style="z-index: 10;">
            <div class="content">

                <div class="box2">
                    <div class="title m-b-md">ほわEditor</div>
                    <div class="subtitle m-b-md">社内文書作成＆管理システム</div>
                </div>
                    <!--<h4><?php echo date("Y/m/d H:i:s"); ?></h4>
                        <p>管理者パネルにトピック検索とブック検索を追加しました</p>
                        <p>テキスト比較機能を追加しました</p><br>-->
            </div>
        </div>
    </body>
</html>
