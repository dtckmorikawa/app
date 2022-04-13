@extends("blogetc_admin::layouts.admin_layout")
@section("content")
@include("partials.admin_topic_search")
<div class="text-center">
    <small>作者が自分でないトピックは、公開中の物だけ閲覧できます</small>
</div>

{{--search result--}}
@forelse($posts as $post)
@if($post->is_published==0)
    @if($post->user_id==Auth::user()->id)
        <div class="card m-4" style="">
            <div class="card-body">
                <h5 class='card-title'><a href='{{$post->url()}}'>{{$post->title}}</a></h5>
                <h5 class='card-subtitle mb-2 text-muted'>{{$post->subtitle}}</h5>
                <p class="card-text">{{$post->html}}</p>

                <?=$post->image_tag("thumbnail", false, "float-right");?>
                <dl class="">
                    <div class='row'>
                        <div class="col-sm-12 col-md-4">
                            <dt class="">作者</dt>
                            <dd class="">{{$post->author_string()}}</dd>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <dt class="">ID</dt>
                            <dd class="">{{$post->slug}}</dd>
                        </div>
                        <div class="col-sm-12 col-md-4"> 
                            <dt class="">公開状態</dt>
                            <dd class="">
                                {!!($post->is_published ? "Yes" : '<span class="border border-danger rounded p-1">No</span>')!!}
                            </dd>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-sm-12 col-md-4">
                            <dt class="">最終更新日</dt>
                            <dd class="">{{$post->updated_at}}</dd>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <dt class="">カテゴリー</dt>
                            <dd class="">
                                @if(count($post->categories))
                                    @foreach($post->categories as $category)
                                        <a class='btn btn-outline-secondary btn-sm m-1' href='{{$category->edit_url()}}'>
                                            <i class="fas fa-object-group" aria-hidden="true"></i>
                                            {{$category->category_name}}
                                        </a>
                                    @endforeach
                                @else なし
                                @endif
                            </dd>
                        </div>
                    </div>
                </dl> 
                <div class="boxContainer">
                    <a href="{{$post->url()}}" class="use_icon boxContents card-link btn btn-outline-secondary"　style="height:30px">
                        &#xf06e; トピックを見る</a>

                    {!! Form::open(['url' =>$post->edit_url()]) !!}
                        {!! Form::submit('&#xf044; トピックを編集する', ['class' => 'boxContents use_icon card-link btn btn-primary']) !!}
                        <input type="hidden" name="user_id" value={{ Auth::user()->id}} >
                    {!! Form::close() !!}
        
                    <form onsubmit="return confirm('この投稿を削除しても良いですか？\n この操作は取り消しできません。');"
                        method='post' action='{{route("blogetc.admin.delete", $post->id)}}' class='boxContents float-right'>
                        @csrf
                        @method("DELETE")
                        <input type="hidden" name="user_id" value={{ Auth::user()->id}} >
                        <input type='submit' class='btn btn-danger use_icon' value='&#xf1f8; 削除'>
                    </form>
                </div>
            </div>
        </div>
    @endif
@else
    <div class="card m-4" style="">
        <div class="card-body">
            <h5 class='card-title'><a href='{{$post->url()}}'>{{$post->title}}</a></h5>
            <h5 class='card-subtitle mb-2 text-muted'>{{$post->subtitle}}</h5>
            <p class="card-text">{{$post->html}}</p>

            <?=$post->image_tag("thumbnail", false, "float-right");?>
            <dl class="">
                <div class='row'>
                    <div class="col-sm-12 col-md-4">
                        <dt class="">作者</dt>
                        <dd class="">{{$post->author_string()}}</dd>
                    </div>
                <div class="col-sm-12 col-md-4">
                    <dt class="">ID</dt>
                    <dd class="">{{$post->slug}}</dd>
                </div>
                <div class="col-sm-12 col-md-4"> 
                    <dt class="">公開状態</dt>
                    <dd class="">
                        {!!($post->is_published ? "Yes" : '<span class="border border-danger rounded p-1">No</span>')!!}
                    </dd>
                </div>
            </div>
            <div class='row'>
                <div class="col-sm-12 col-md-4">
                    <dt class="">最終更新日</dt>
                    <dd class="">{{$post->updated_at}}</dd>
                </div>
                <div class="col-sm-12 col-md-4">
                    <dt class="">カテゴリー</dt>
                    <dd class="">
                        @if(count($post->categories))
                            @foreach($post->categories as $category)
                                <a class='btn btn-outline-secondary btn-sm m-1' href='{{$category->edit_url()}}'>
                                    <i class="fas fa-object-group" aria-hidden="true"></i>
                                    {{$category->category_name}}
                                </a>
                            @endforeach
                        @else なし
                        @endif
                    </dd>
                </div>
            </div>
        </dl>
        <div class="boxContainer">
            <a href="{{$post->url()}}" class="use_icon boxContents card-link btn btn-outline-secondary"　style="height:30px">
                &#xf06e; トピックを見る</a>
        </div>
    </div>
</div>
@endif
@empty

    <div class='alert alert-danger'>検索結果が０です</div>
@endforelse

{{--pagenation links--}}
<div class='text-center'>
    {{ $posts->links() }}
</div>

@endsection