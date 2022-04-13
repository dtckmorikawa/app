<div style='max-width:90%;margin:10px auto; ' class=''>
    <form class='text-center' 
            action = '{{route("blogetc.admin.search_post")}}'
            method='post'>
        @csrf
        
        <h4>トピック検索</h4>
        <div class="form-group">
            <label>カテゴリ
                <select name="category_id">
                    <option value="0" @if(!isset($category_id)) selected  @endif></option>
                    @foreach($all_cats as $single_cat)
                        <option value="{{ $single_cat->id }}" 
                            @if(isset($category_id) && $category_id == $single_cat->id ) selected  @endif>
                            {{ $single_cat->category_name }}
                        </option>
                    @endforeach
                </select>
            </label>

            <label>タイトル
                <input type="text" name="title" value="{{ old('title' , isset($title) ? $title : '' ) }}">
            </label>

            <label>内容
                <input type='text' name='keyword' value='{{ old('contents' , isset($keyword) ? $keyword : '' ) }}'>
            </label>
            
            <label>作者
                 <input type="text" name="user_name" value="{{ old('user_name' ,isset($user_name) ? $user_name : '' ) }}">
            </label>
            
            <label>承認
                <select name="approved_status">
                    <option value="2" @if(isset($approved_status) && $approved_status == 2) selected  @endif></option>
                    <option value="1" @if(isset($approved_status) && $approved_status == 1) selected  @endif>承認済み</option>
                    <option value="0" @if(isset($approved_status) && $approved_status == 0) selected  @endif>未承認</option>
                </select>
            </label>
            
            <label>公開
                <select name="published_status">
                    <option value="2" @if(isset($published_status) && $published_status == 2) selected  @endif></option>
                    <option value="1" @if(isset($published_status) && $published_status == 1) selected  @endif>公開済み</option>
                    <option value="0" @if(isset($published_status) && $published_status == 0) selected  @endif>未公開</option>
                </select>
            </label>
            
            <input type="submit" class="btn-small btn-dark" value="検索" >
        </div>
    <form>
</div>