{{--added--}}
<div class="blog_body_menu">
<ul>
<li>
{!! Form::open(['url' => $book_print_url]) !!}
    <div class="form-group">
        {!! Form::select('mapType', ['契約書', '規約', '取説'], null, ['id'=>'selectCSS'] ) !!}
        {!! Form::select('docType', ['HTML', 'PDF'],null,['id'=>'selectDoctype'] ) !!}
        {!! Form::submit('作成', ['class' => 'btn btn-dark btn-sm']) !!}
        <input type="hidden" name="user_email" value={{ Auth::user()->email}} >
    </div>
{!! Form::close() !!}
</li>
@if(\Auth::check() && \Auth::user()->canManageBlogEtcPosts())
    <li>
        {!! Form::open(['url' => route("adminbook.create_with_base", $book->slug)]) !!}
            {!! Form::submit('流用する', ['class' => 'btn btn-dark btn-sm']) !!}
            <input type="hidden" name="my_id" value={{ Auth::user()->id}} >
        {!! Form::close() !!}    
    </li>
    @if($book->user_id == Auth::user()->id)
        <li>
            {!! Form::open(['url' => route("adminbook.edit", $book->slug)]) !!}
                {!! Form::submit('更新する', ['class' => 'btn btn-dark btn-sm']) !!}
                <input type="hidden" name="user_id" value={{ Auth::user()->id}} >
            {!! Form::close() !!}
        </li>
    @endif
@endif
{{-- 
@if(\Auth::check() && \Auth::user()->canAuthorizePosts())
    @if($book->is_approved == 0)
        <a style="margin: 0px 5px 0px 5px" 
            href="{{ route('book.ApproveBook', ['blogPostSlug' => $book->slug])}}" 
            class="btn btn-primary btn-sm pull-right float-right">承認する</a>
    @else    
        <a style="margin: 0px 5px 0px 5px" 
            href="{{ route('book.DisApproveBook', ['blogPostSlug' => $book->slug])}}" 
            class="btn btn-danger btn-sm pull-right float-right">承認を取消す</a>
    @endif
@endif
 --}}
</ul>
<br/>
<br/>
<div class="balloon1-top" id="outputmsg">
</div>
</div>
{{--until here--}}


{{-- Book --}}
<div class="blog_body_content">
    <h1 class='blog_title'>{{$book->book_name}}</h1>
    <h2 class='blog_subtitle'>{{$book->book_description}}</h2>

    {{-- TOC shown only for Rules and Manuals --}}
    <div id="toc"></div>

    {{-- Contents --}}
    <div id="body">{!! $book_body !!} </div>
</div>

<hr/>

投稿済み <strong>{{$book->created_at->diffForHumans()}}</strong>

{{--@includeWhen($book->author,"blogetc::partials.author",['post'=>$post])
@includeWhen($book->categories,"blogetc::partials.categories",['post'=>$post])--}}
