@extends("layouts.app",['title'=>"Saved comment"])
@section("content")

    <div class='text-center'>
        <h3>コメントが保存されました！</h3>

        @if(!config("blogetc.comments.auto_approve_comments",false) )
            <p>管理者がコメントを承認すると、ここに表示されるようになります。</p>
        @endif

        <a href='{{$blog_post->url()}}' class='btn btn-primary'>戻る</a>
    </div>

@endsection