<div style='max-width:500px;margin:10px auto;' class='search-form-outer'>
    <form method='get' action='{{route("topic.search")}}' class='text-center'>
        <h4>トピック検索</h4>
        <small>複数の単語で検索する時は、半角スペースで単語を区切ってください。</small>
        @if (!isset($query))
            <input type='text' name='s' placeholder='検索' class='form-control' value='{{\Request::get("s")}}' required>
        @else
            <input type='text' name='s' placeholder='検索' class='form-control' value='{{$query}}' required>
        @endif
        <input class='btn btn-primary m-2 use_icon' type='submit' value='検索'>
    </form>
</div>