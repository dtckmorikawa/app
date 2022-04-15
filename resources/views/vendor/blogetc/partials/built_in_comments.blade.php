@forelse($comments as $comment)



    <div class="card bg-light mb-3">
        <div class="card-header">
            {{$comment->author()}}

            @if(config("blogetc.comments.ask_for_author_website") && $comment->author_website)
                (<a href='{{$comment->author_website}}' target='_blank' rel='noopener'>Webサイト</a>)
            @endif

            <span class="float-right" title='{{$comment->created_at}}'><small>{{$comment->created_at->diffForHumans()}}</small></span>
        </div>
        <div class="card-body bg-white">
            <p class="card-text">{!! nl2br(e($comment->comment))!!}</p>
        </div>
    </div>





@empty
    {{--<div class='alert alert-info'>まだコメントがありません。コメントを最初に投稿しましょう。</div>--}}
@endforelse

@if(count($comments)> config("blogetc.comments.max_num_of_comments_to_show",500) - 1)
    <p><em>直近 {{config("blogetc.comments.max_num_of_comments_to_show",500)}} つのコメントが表示されます。</em>
    </p>
@endif

