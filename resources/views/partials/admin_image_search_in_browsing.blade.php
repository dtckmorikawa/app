    <div style='' class='search-form-outer col-md-10 offset-md-1'>
        <form method='get' action='{{route("admin.image.search.in.browser")}}' class='text-center'>
            <h4>イラスト検索</h4>
            <small>複数の単語で検索する時は、半角スペースで単語を区切ってください。</small>
            <input type='text' name='s' placeholder='検索' class='form-control' value='{{\Request::get("s")}}' required>
            <input type='submit' value='&#xf002; 検索' class='btn btn-primary m-2 use_icon'>
        </form>
    </div>