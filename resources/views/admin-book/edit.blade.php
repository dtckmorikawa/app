@extends("layouts.edit-book-layout")
@section("content")
    <h5>管理者 - ブックの編集</h5>
    <div>
        @if($booklock==0)
            {!! Form::open(['url' => route("adminbook.booklock", $book->slug)]) !!}
            {!! Form::submit('&#xf044; ロックをかける', ['class' => 'boxContents use_icon card-link btn btn-primary']) !!}
            <input type="hidden" name="user_id" value={{ Auth::user()->id}} >
            {!! Form::close() !!}
            <small class="form-text text-muted">ブックを編集するにはロックをかけてください。</small>
        @else
            <p style="margin: 20px 0px 50px 0px;">ユーザーID{{ $booklock }}が編集中です。</p>
        @endif
    </div>
    <form method='post' action='{{route("adminbook.update",$book->slug)}}' enctype="multipart/form-data" >
        @csrf
        @method("patch")
        @include("admin-book.form", ['book' => $book])<br>        
        <div class="form-group">
            <label for="book_structure">目次の登録</label>
            <small class="form-text text-muted">このブックの目次を作成してください。章、節、項の３レベルまで対応しています。</small>
            {{--added--}}
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        @include("partials.structuredPosts", ['structured_posts'=>$structured_posts, 'book_map'=>$book_map])
                    </div>
                    <div class="col-lg-6">
                        @include("partials.allPosts", ['posts' => $posts, 'categories' => $categories,'cat_id' => $cat_id,])
                    </div>
                </div>
            </div>
            @if($booklock== Auth::user()->id)
                <input type="hidden" id="book_structure" name="book_structure"/>
                <input type="hidden" name="is_locked" value={{ Auth::user()->id}} >
                <input style="margin: 20px 0px 50px 0px;" id='testsub' type='submit' class='btn btn-primary' value='更新' >
            @elseif($booklock==0)
                <p style="margin: 20px 0px 50px 0px;">ブックを編集するにはロックをかけてください。</p>
            @else
                <p style="margin: 20px 0px 50px 0px;">ユーザーID{{ $booklock }}が編集中です。</p>
            @endif
            {{--until here --}}
        </div>
    </form>
@endsection

