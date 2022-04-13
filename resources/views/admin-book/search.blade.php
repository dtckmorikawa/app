@extends("blogetc_admin::layouts.admin_layout")
@section("content")
@include("partials.admin_book_search")
<div class='text-center'>
    <small>作者が自分のブックのみ編集、削除できます。</small>
</div>
    @forelse ($books as $book)
        @if($book->user_id == Auth::user()->id)
            <div class="card m-4"  style="">
                <div class="card-body">
                    <h5 class='card-title'>
                        @if($book->is_published==1)
                            <a href='{{route("book.view", $book->slug)}}'>{{$book->book_name}}</a>
                        @else
                            {{$book->book_name}}
                        @endif
                    </h5>
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <dt class="">作者</dt>
                            <dd class="">{{$book->book_author_string()}}</dd>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <dt class="">作成日時</dt>
                            <dd class="">{{$book->created_at}}</dd>    
                        </div>    
                        <div class="col-sm-12 col-md-4">
                            <dt class="">最終更新日時</dt>
                            <dd class="">{{$book->updated_at}}</dd>
                        </div>
                    </div>
                    <div class="boxContainer">
                        @if($book->is_published==1)
                            <a href="{{route("book.view", $book->slug)}}" 
                                class="use_icon boxContents card-link btn btn-outline-secondary" style="height:30px">
                                &#xf06e; ブックを見る</a>
                        @endif
                    
                        {!! Form::open(['url' => route("adminbook.edit", $book->slug)]) !!}
                            {!! Form::submit('&#xf044; ブックを編集する', ['class' => 'boxContents use_icon card-link btn btn-primary']) !!}
                            <input type="hidden" name="user_id" value={{ Auth::user()->id}} >
                        {!! Form::close() !!}

                        <form onsubmit="return confirm('本当にこのブックを削除しますか?\n この操作にやり直しはできません。');"
                            method='post' action='{{route("adminbook.delete", $book->slug)}}' class='boxContents float-right'>
                            @csrf
                            @method("DELETE")
                            <input type='submit' class='btn btn-danger use_icon' value='&#xf1f8; 削除'>
                        </form>
                    </div>
                </div>
            </div>
        @else
            @if($book->is_published == 1)
                <div class="card m-4"  style="">
                    <div class="card-body">
                        <h5 class='card-title'>
                            @if($book->is_published==1)
                                <a href='{{route("book.view", $book->slug)}}'>{{$book->book_name}}</a>
                            @else
                                {{$book->book_name}}
                            @endif
                        </h5>
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <dt class="">作者</dt>
                                <dd class="">{{$book->book_author_string()}}</dd>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <dt class="">作成日時</dt>
                                <dd class="">{{$book->created_at}}</dd>    
                            </div>    
                            <div class="col-sm-12 col-md-4">
                                <dt class="">最終更新日時</dt>
                                <dd class="">{{$book->updated_at}}</dd>
                            </div>
                        </div>
                        <div class="boxContainer">
                            <a href="{{route("book.view", $book->slug)}}" 
                                class="use_icon boxContents card-link btn btn-outline-secondary" style="height:30px">
                                &#xf06e; ブックを見る</a>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    @empty
    <div class='alert alert-danger'>ブックがありません。ブックを追加してください。</div>
    @endforelse
    
    <div class='text-center pagination-div'>
        {{$books->appends( [] )->links()}}
    </div> 
</div>
@endsection