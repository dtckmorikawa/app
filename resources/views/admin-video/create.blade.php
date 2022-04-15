@extends("blogetc_admin::layouts.admin_layout")
@section("content")


    <h5>管理者 - 動画のアップロード</h5>

    <p>動画をアップロードしてください。</p>


    <form method='post' action='{{route("admin.videos.store")}}' enctype="multipart/form-data">

        @csrf


        <div class="form-group mb-4 p-2">

            <label for="upload">動画のタイトル</label>
            <small id="video_title_help" class="form-text text-muted">動画のタイトル</small>
            <input required class="form-control" type="text" name="video_title" id="video_title"
                   aria-describedby="video_title_help">

        </div>


        <div class="form-group mb-4 p-2">

            <label for="upload">動画のアップロード</label>
            <small id="blog_upload_help" class="form-text text-muted">動画のアップロード</small>
            <input required class="form-control" type="file" name="upload" id="upload"
                   aria-describedby="upload_help">

        </div>


        <div class="form-group mb-4 p-2">

            <label >サイズの調整</label>

            <div>
                <input type='checkbox' name='sizes_to_upload[full_size]' value='true' checked id='size_full_size'>
            <label for='size_full_size'>実寸</label>
                </div>


            {{--@foreach((array)config('blogetc.image_sizes') as $size => $image_size_details)
            <div>
                <input type='checkbox' name='sizes_to_upload[{{$size}}]' value='true' checked id='size_{{$size}}'>
                <label for='size_{{$size}}'>{{$image_size_details['name']}} - {{$image_size_details['w']}} x {{$image_size_details['h']}}px</label>
            </div>
                @endforeach--}}

        </div>
        <div class="form-group mb-4 p-2">
            <!--<label>保存</label>-->

            <input type='submit' class='btn btn-primary' value='保存'>

        </div>
    </form>



@endsection