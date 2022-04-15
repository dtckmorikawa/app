<div style='max-width:500px;margin:10px auto;' class='search-form-outer'>
    <form method='get' action='{{route("blogetc.search")}}' class='text-center'>
        <h4>文章検索</h4>
        <input type='text' name='s' placeholder='Search...' class='form-control' value='{{\Request::get("s")}}'>
        <input type='submit' value='Search' class='btn btn-primary m-2'>
    </form>
</div>