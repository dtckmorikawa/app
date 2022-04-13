@extends("layouts.app")
@section("content")
<div class='text-center'>
<h4>トピック一覧</h4>
@include("blogetc::partials.new_search_form")
</div>

<div class='row'>
    <div class='col-sm-12 blogetc_container'>
        @forelse($posts as $post)
            @include("blogetc::partials.index_loop")
        @empty
            <div class='alert alert-danger'>まだトピックがありません。</div>
        @endforelse

        <div class='text-center col-sm-4 mx-auto pagination-div'>
            {{$posts->links()}}
        </div>
    </div>
</div>
@endsection