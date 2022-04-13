@extends("layouts.app")
@section("content")
@include("partials.book_search")

    @forelse ($books as $book)
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
                        <div class="col-sm-12 col-md-3">
                            <dt class="">作者</dt>
                            <dd class="">{{$book->book_author_string()}}</dd>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <dt class="">作成日時</dt>
                            <dd class="">{{$book->created_at}}</dd>    
                        </div>    
                        <div class="col-sm-12 col-md-3">
                            <dt class="">最終更新日時</dt>
                            <dd class="">{{$book->updated_at}}</dd>
                        </div>
                        {{-- 
                        <div class="col-sm-12 col-md-3">
                            <dt class="">承認状態</dt>
                            {!!($book->is_approved ? "Yes" : '<span class="border border-danger rounded p-1">No</span>')!!}
                        </div>
                         --}}
                    </div>
                    <div class="boxContainer">
                        <a href="{{route("book.view", $book->slug)}}" 
                            class="use_icon boxContents card-link btn btn-outline-secondary" style="height:30px">
                            <i class="far fa-eye"></i> ブックを見る</a>
                    </div>
                </div>
            </div>
        @endif
    @empty
    <div class='alert alert-danger'>ブックがありません。ブックを追加してください。</div>
    @endforelse

    <div class='text-center pagination-div'>
        {{$books->appends( [] )->links()}}
    </div>
@endsection