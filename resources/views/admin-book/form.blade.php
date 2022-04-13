<script>
    SHOULD_AUTO_GEN_SLUG = false;

    /* Generate the slug field, if it was not touched by the user (or if it was an empty string) */
    function populate_slug_field() {

//        alert("A");
        var bk_slug = document.getElementById('book_slug');

        if (bk_slug.value.length < 1) {
            // if the slug field is empty, make sure it auto generates
            SHOULD_AUTO_GEN_SLUG = true;
        }

        if (SHOULD_AUTO_GEN_SLUG) {
            // the slug hasn't been manually changed (or it was set above), so we should generate the slug
            // This is done in two stages - one to remove non words/spaces etc, the another to replace white space (and underscore) with a -
            bk_slug.value =document.getElementById("book_book_name").value.toLowerCase()
                    .replace(/[^\w-_ ]+/g, '') // replace with nothing
                    .replace(/[_ ]+/g, '-') // replace _ and spaces with -
                    .substring(0,99); // limit str length

        }

    }
</script>
<div class="form-group">
    <input type="hidden" 
            class="form-control"
            id="book_user_id"
            name="user_id" 
            value="{{ Auth::user()->id }}" >
</div>
<div class="form-group">
    <label for="book_book_name">タイトル（必須）</label>
    <input type="text"
           class="form-control"
           id="book_book_name"
           oninput="populate_slug_field();"
           required
           aria-describedby="book_book_name_help"
           name='book_name'
           value="{{old("book_name",$book->book_name)}}"
    required>
    <small id="book_book_name_help" class="form-text text-muted">＆（アンパサンド）、/（スラッシュ） 、およびスペースは使用できません。</small>
</div>


<div class="form-group">
    <label for="book_slug">ブック id</label>
    <!--<input
            maxlength='100'
            pattern="[a-zA-Z0-9-]+"
            type="text"
            class="form-control"
            id="book_slug"
            oninput="SHOULD_AUTO_GEN_SLUG=false;"
            aria-describedby="book_slug_help"
            name='slug'
            value="{{old("slug",$book->slug)}}">-->
    <h5 class="form-control" style=''>{{$book->slug}}</h5>
    <small id="book_slug_help" class="form-text text-muted">
        自動生成されます。編集不可。
    </small>
</div>


<div class="form-group">
    <label for="book_description">ブックの説明（任意）</label>
    <small id="book_book_name_help" class="form-text text-muted">改行はドキュメント上に反映されません。</small>
    <textarea name='book_description' 
              class='form-control' 
              id='book_description'>{{old("book_description",$book->book_description)}}</textarea>
</div>
<script>
    if (document.getElementById("book_slug").value.length < 1) {
        SHOULD_AUTO_GEN_SLUG = true;
    } else {
        SHOULD_AUTO_GEN_SLUG = false; // there is already a value in #book_slug, so lets pretend it was changed already.
    }
</script>
