@extends("blogetc_admin::layouts.admin_layout")
@section("content")


    <h5>管理者 - 動画のアップロード</h5>

    <p>動画のアップロードが成功しました。</p>

    @empty($video_info)
        <div class='alert alert-danger'>動画のアップロードに失敗しました。</div>
    @else
        <div>
            <h5>{{$video_info['video_title']}}</h5>
            <video src='{{asset(config("blogetc.video_upload_dir") . "/". $video_info['filename'])}}' autoplay controls muted loop width="90%"></video>
        </div>
       
    @endempty

@endsection