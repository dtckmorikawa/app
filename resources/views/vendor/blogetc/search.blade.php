@extends("layouts.app",['title'=>$title])
@section("content")

     <div class='row'>
        <div class='col-sm-12'>
            <h2>検索結果：{{$query}}</h2>

            @forelse($search_results as $result)

                <?php $post = $result->indexable; ?>
                @if($post && is_a($post,\WebDevEtc\BlogEtc\Models\BlogEtcPost::class))
                    <h2>検索結果 #{{$loop->count}}</h2>
                    @include("blogetc::partials.index_loop")
                @else

                    <div class='alert alert-danger'>検索に失敗しました</div>
                @endif
            @empty
                <div class='alert alert-danger'>検索結果が０です</div>
            @endforelse


            @include("blogetc::sitewide.search_form")

        </div>
    </div>


@endsection