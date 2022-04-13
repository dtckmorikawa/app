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
                <div class="col-sm-12 col-md-4"> 
                    <dt class="">承認状態</dt>
                    <dd class="">
                        {!!($post->is_approved ? "Yes" : '<span class="border border-danger rounded p-1">No</span>')!!}
                    </dd>
                </div>
            </div>
        </dl> 
        <div class="boxContainer float-right">
            <a href="{{$post->url()}}" class="use_icon boxContents card-link btn btn-primary"　style="height:30px">
                表示する</a>
        </div>
    </div>
</div>