<div style='max-width:500px;margin:10px auto;' class='search-form-outer'>
    <form method='get' action='{{route("book.search")}}' class='text-center'>
        <h4>ブック検索</h4>
        <small>複数の単語で検索する時は、半角スペースで単語を区切ってください。</small>
        <input type='text' name='s' placeholder='検索' class='form-control' value='{{\Request::get("s")}}' required>
        <input type='submit' value='検索' class='btn btn-primary m-2'>
    </form>
</div>