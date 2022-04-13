@extends("layouts.app",['title'=>$title])
@section("content")

@include("partials.search_form")

    <div class='row'>
        <div class='col-sm-12 blogetc_container'>
            <div class='col-sm-12'>
                <h2 class="text-center">「{{$query}}」の検索結果</h2>
                @forelse($books as $book)
                    @include("partials.book_reader_index")       
                @empty
                    <div class='alert alert-danger'>検索結果が０です</div>
                @endforelse
            </div>
            <div class='text-center  col-sm-4 mx-auto'>
                {{ $books->links() }}
            </div>    
        </div>
    </div>
@endsection