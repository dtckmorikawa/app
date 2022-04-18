<?php

namespace App\Http\Controllers;

use Log;
use File;
use Carbon\Carbon;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\UploadVideoRequest;

use App\UploadedVideo;
use WebDevEtc\BlogEtc\Middleware\UserCanManageBlogPosts;

use WebDevEtc\BlogEtc\Traits\UploadFileTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


/**
 * Class BlogEtcAdminController
 * @package WebDevEtc\BlogEtc\Controllers
 */
class VideoUploadController extends Controller
{

    use UploadFileTrait;

    /**
     * BlogEtcAdminController constructor.
     * need to be image_upload enabled for video upload
     */
    public function __construct()
    {
        Log::debug('VideoUploadController>__construct is called');

        $this->middleware(UserCanManageBlogPosts::class);

        if (!is_array(config("blogetc"))) {
            throw new \RuntimeException('The config/blogetc.php does not exist. Publish the vendor files for the BlogEtc package by running the php artisan publish:vendor command');
        }


        if (!config("blogetc.image_upload_enabled")) {
            throw new \RuntimeException("The blogetc.php config option has not enabled image uploading");
        }

    }

    /**
     * Show the main listing of uploaded videos
     * @return mixed
     */


    public function index()
    {
        Log::debug('VideoUploadController>index is called');
        return view('admin-video.index', ['uploaded_videos' => UploadedVideo::orderBy("id", "desc")->paginate(10)]);
    }

    /**
     * show the form for uploading a new video
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        Log::debug('VideoUploadController>create is called');
        return view("admin-video.create", []);
    }

    /**
     * Save a new uploaded video
     *
     * @param UploadVideoRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function store(UploadVideoRequest $request)
    {
        Log::debug('VideoUploadController>store is called');

        $video = $request->file('upload');
        $originalName = basename($video->getClientOriginalName(),'.mp4');
        $current_timestamp = Carbon::now()->timestamp;
        $filename = $current_timestamp . '-' . 'fullsize.mp4';
        $thumbnailName = $current_timestamp . '-' . 'fullsize.png';
        $path = public_path('blog_videos/');

        //save the video
        $video->move($path, $filename);

        //アップロードできているか確認
        if (!\File::exists($path . $filename)) {
            echo "アップに失敗しました！";
        }
       
        //save thumbnail of the video
        FFMpeg::fromDisk('public')
            ->open('blog_videos/' . $filename) 
            ->getFrameFromSeconds(1)
            ->export()
            ->toDisk('public')
            ->save('blog_videos/' . $thumbnailName);
            
        //サムネイルが作成できているか確認
        if (!\File::exists($path . $thumbnailName)) {
            echo "サムネイルがありません！";
        }

        // store the video upload to DB
        UploadedVideo::create([
            'video_title' => $request->get("video_title"),
            'source' => "VideoUpload",
            'uploader_id' => optional(\Auth::user())->id,
            'uploaded_video' => $filename,
        ]);
        
        $video_info = array('video_title'=> $request->get("video_title"),
                            'filename' => $filename
        );

        return view("admin-video.uploaded", ['video_info' => $video_info]);
    }

    public function browse()
    {
        Log::debug('VideoUploadController>browse is called');
        return view('admin-video.browse', ['uploaded_videos' => UploadedVideo::orderBy("id", "desc")->paginate(10)]);
    }

    public function search(Request $request)
    {
        Log::debug('video search is called');
        $query = $request->get('s');
        return view("admin-video.index", ['uploaded_videos' => UploadedVideo::search($query)->paginate(10)]);
    }

    public function searchinbrowser(Request $request)
    {
        Log::debug('video search is called');
        $query = $request->get('s');
        return view('admin-video.browse', ['uploaded_videos' => UploadedVideo::search($query)->paginate(10)]);
    }

}
