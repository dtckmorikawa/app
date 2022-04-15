@if(\Auth::check() && \Auth::user()->canManageBlogEtcPosts())
    @if($post->user_id == \Auth::user()->id)
        {!! Form::open(['url' =>$post->edit_url()]) !!}
            {!! Form::submit('更新する', ['class' => 'btn btn-outline-secondary btn-sm pull-right float-right']) !!}
            <input type="hidden" name="user_id" value={{ Auth::user()->id}} >
        {!! Form::close() !!}
    @endif
    <a style="margin: 0px 5px 0px 5px" 
        href="{{ route('blogetc.admin.create_post_with_base', ['blogPostId' => $post->id])}}" 
        class="btn btn-dark btn-sm pull-right float-right">流用する</a>
@endif
@if(\Auth::check() && \Auth::user()->canAuthorizePosts())
    @if($post->is_approved == 0)
        <a style="margin: 0px 5px 0px 5px" 
            href="{{ route('blogetc.approvePost', ['blogPostSlug' => $post->slug])}}" 
            class="btn btn-primary btn-sm pull-right float-right">承認する</a>
    @else    
        <a style="margin: 0px 5px 0px 5px" 
            href="{{ route('blogetc.disApprovePost', ['blogPostSlug' => $post->slug])}}" 
            class="btn btn-danger btn-sm pull-right float-right">承認を取消す</a>
    @endif
@endif
{{--added--}}

    {!! Form::open(['url' => $print_url]) !!}
        {!! Form::submit('PDFにする', ['class' => 'btn btn-dark btn-sm pull-right float-right']) !!}
        <input type="hidden" name="user_email" value={{ Auth::user()->email}} >
    {!! Form::close() !!}

{{--until here--}}

<div class="blog_body_content">
<h2 id="{{$post->slug}}" class='blog_title'>{{$post->title}}</h2>
<h5 class='blog_subtitle'>{{$post->subtitle}}</h5>
<?=$post->image_tag("medium", false, 'd-block mx-auto'); ?>

<p class="blog_body_content">
    {!! $post->post_body_output() !!}
</p>
</div>

<hr/>

{{--投稿済み <strong>{{$post->posted_at->diffForHumans()}}</strong>--}}
トピックID <strong>{!!$post->slug!!}</strong>

@includeWhen($post->author,"blogetc::partials.author",['post'=>$post])
@includeWhen($post->categories,"blogetc::partials.categories",['post'=>$post])

@if(config("blogetc.comments.type_of_comments_to_show","built_in") !== 'disabled')
    <div class="" id='maincommentscontainer'>
        @include("blogetc::partials.show_comments")
    </div>
    @else
    {{--Comments are disabled--}}
@endif