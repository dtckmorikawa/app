<div style='max-width:500px;margin:10px auto;' class='search-form-outer'>
    <form method='get' action='{{route("adminrole.search")}}' class='text-center'>
        <h4>ユーザー名検索</h4>
        <small>ユーザーの姓または名を入力し、検索ボタンをクリックしてください。</small>
        <input type="text" class="form-control" name="name" value="{{\Request::get("name")}}">
        <input type='submit' value='検索' class='btn btn-primary m-2 use_icon'>
    </form>
</div>