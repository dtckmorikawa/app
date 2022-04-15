<div style='' class='search-form-outer'>

<form class='text-center' 
        action = '{{route("blogetc.admin.categories.searchcatnew")}}'
        method='post'>
<h4>カテゴリ検索</h4>
    @csrf
    <div class="form-group">
            <label>カテゴリ名
                    <input type="text" name="title" value="{{ old('title' , isset($title) ? $title : '' ) }}">
            </label>
            <label>作者
                    <input type="text" name="user_name" value="{{ old('user_name' ,isset($user_name) ? $user_name : '' ) }}">
            </label>
            <input type="submit" class="btn-small btn-dark" value="検索" >
    </div>
<form>

</div>