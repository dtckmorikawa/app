@extends("blogetc_admin::layouts.admin_layout")
@section("content")
@include("partials.admin_video_search")

    <h5>管理者 - 動画の一覧</h5>
    <br>
    
    <div>
    <ul class="list-group">
    @foreach($uploaded_videos as $uploadedVideo)
        <div style='border-radius:15px; border:2px solid #efefef;'>
            <li class="list-group-item">
                <div>
                    <h3>{{$uploadedVideo->video_title}}</h3>
                </div>
                <div class='row'>
                    <div class='col-md-6'>
                        <h4>
                            <small title='{{$uploadedVideo->created_at}}'>
                                        登録日時： {{$uploadedVideo->created_at}}
                            </small>
                        </h4>
                        <input type="text" id="clip_copy_{{$loop->iteration}}" value="{{asset(config("blogetc.video_upload_dir") . "/". $uploadedVideo['uploaded_video'])}}">
                        <button class="clip_copy_btn btn" data-clipboard-target="#clip_copy_{{$loop->iteration}}" >URLコピー</button>
                    </div>
                    <div class='col-md-6'>
                        <p>
                            <video src='{{asset(config("blogetc.video_upload_dir") . "/". $uploadedVideo['uploaded_video'])}}' controls autoplay muted loop width="90%"></video>
                        </p>
                    </div>
                </div>            
            </li>
        </div>
    @endforeach
    </ul>
    </div>
    
    
    <div class='text-center pagination-div'>
        {{$uploaded_videos->appends( [] )->links()}}
    </div>


@endsection