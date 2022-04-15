@extends("layouts.app",['title'=>$book->book_name])
@section("content")
    <div class='row'>
        <div class='col-sm-12 col-md-12 col-lg-12'>
            @include("blogetc::partials.show_errors")
            @include("partials.book_detail")
        </div>
    </div>
    </div>

@endsection