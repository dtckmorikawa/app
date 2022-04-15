<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ほわEditor</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>


        <!-- Added for chat-->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous">
        </script>

        <!--Styles-->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style media="screen">
            .differ {
                width:100%;
                margin:0;
                background:#f9f9f9;
                border:1px solid #ddd;
                font-size:inherit;
                border-collapse:separate;
                border-spacing:0;
                border:1px solid #ddd;
            }

            .differ td {
                padding:1px 4px;
                font-size:inherit;
                border-top:1px dotted #eee;
                border-left:1px solid #ddd;
            }

            .differ .-line:first-child td {
                border-top:0;
            }

            .differ .-line td:first-child {
                border-left:0;
            }

            .differ .-number {
                width:5%;
                padding-top:.4em;
                white-space:nowrap;
                text-align:right;
                vertical-align:top;
                font-size:80%;
                font-family:Arial;
                border-top:1px solid #e6e6e6;
                color:#999;
            }
            .differ .-text {
                padding-left:8px;
                border-left:3px double #ddd;
                background:#fff;
            }
            .differ .-is-differ .-text {
                background:#FFFBE6;
            }
            .differ .-no-differ .-text {
                color:#777;
            }
            .differ .-word {
                display:inline-block;
                vertical-align:middle;
                /*font-weight:bold;*/
            }
            .differ .-word.-source {
                color:green;
                background: #dfd;
            }
            .differ .-word.-change {
                color:red;
                background: #fdd;
            }
            .output {
                margin-top:40px;
            }
            .refresh{
                margin-top:20px;
                text-align:center;
            }
        </style>
        <!-- Until Here -->
    </head>

    <body>

        <div class="refresh">
            <h3>差分チェック</h3>
        </div>

        <form action="{{ route('diffrefresh')}}" method="POST">
            <div class="refresh">
                <button type="submit" class="btn btn-sm btn-dark">差分を表示</button>
            </div>
        {{ csrf_field() }}
        <div class="container">
            <div class="row text-center">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>新しい</label>
                        <textarea class="form-control" rows="10" name="change"></textarea>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>古い</label>
                        <textarea class="form-control" rows="10" name="source"></textarea>
                    </div>
                </div>
            </div>

            <div class="row output">
                <div id="out_source" class="col-sm-6">
                    @if ($marker=0)
                        差分結果がここに表示されます。
                    @else
                        {!! $html['change'] !!}
                    @endif
                </div>

                <div id="out_change" class="col-sm-6">
                    @if ($marker=0)
                        差分結果がここに表示されます。
                    @else
                        {!! $html['source'] !!}
                    @endif
                </div>
            </div>
        </div>
        </form>
    </body>
</html>
