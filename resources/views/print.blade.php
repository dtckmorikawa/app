@extends("layouts.app",['title'=>$title])
@section("content")
{{--@include("blogetc::sitewide.search_form")--}}

    <div class='row'>
        <div class='col-sm-12 blogetc_container'>
            <div class="text-center">
                <p class='mb-1'>印刷したいドキュメントを選択してください。</p>                 
            </div>

            @forelse($posts as $post)
                @include("blogetc::partials.index_loop")
            @empty
                <div class='alert alert-danger'>まだトピックがありません。</div>
            @endforelse

            <div class='text-center  col-sm-4 mx-auto pagination-div'>
                {{$posts->appends( [] )->links()}}
            </div>

        </div>
    </div>
@endsection