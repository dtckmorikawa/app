@extends("layouts.app",['title'=>$title])
@section("content")

@include("partials.topic_search_form")

    <div class='row'>
        <div class='col-sm-12 blogetc_container'>
            @if(\Auth::check() && \Auth::user()->canManageBlogEtcPosts())
                <div class="text-center">
                    <p class='mb-1'>管理者としてログインしています。
                    <br>
                    <a href='{{route("blogetc.admin.index")}}' 
                        class='btn border  btn-outline-primary btn-sm '>
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                        管理者パネルを表示</a>
                    </p>
                </div>
            @endif
            <br>
            <div class='col-sm-12'>
                <h2 class="text-center">「{{$query}}」の検索結果</h2>
                
                <div class="text-center">
                    <a class='btn btn-outline-secondary btn-sm m-1' href="?s={{$query}}">Reset</a>
                    @foreach($categories as $category)
                        <a class='btn btn-outline-secondary btn-sm m-1' href="?s={{$query}}?catid={{$category->id}}">{{$category->category_name}}</a>
                    @endforeach
                </div>

                @forelse($posts as $post)
                    @include("blogetc::partials.index_loop") 
                @empty
                    <div class='alert alert-danger'>検索結果が０です</div>
                @endforelse
            </div>
            <div class='text-center  col-sm-4 mx-auto'>
                {{ $posts->links() }}
            </div>    
        </div>
    </div>
@endsection