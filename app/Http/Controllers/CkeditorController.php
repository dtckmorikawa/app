<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use WebDevEtc\BlogEtc\Controllers\BlogEtcImageUploadController;
use WebDevEtc\BlogEtc\Middleware\UserCanManageBlogPosts;
use WebDevEtc\BlogEtc\Requests\UploadImageRequest;
use WebDevEtc\BlogEtc\Traits\UploadFileTrait;//added
use WebDevEtc\BlogEtc\Models\BlogEtcUploadedPhoto;//added
use WebDevEtc\BlogEtc\Helpers;

use App\Rules\Hankaku;

use File;//added
use Log;
use FFMpeg;

use Carbon\Carbon;//added

use App\UploadedVideo;//added
use App\Requests\UploadVideoRequest; //added
 
class CKEditorController extends BlogEtcImageUploadController
{
    use UploadFileTrait;

    /**
     * BlogEtcAdminController constructor.
     * need to be image_upload enabled for video upload
     */
    public function __construct()
    {
        Log::debug('CKEditorController>__construct is called');

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

    public function image_or_video(Request $request)
    {
        Log::debug('image_or_video is called');
        
        $allowedImageExtensions = array('png','jpg','gif');
        $allowedVideoExtensions = array('mp4');

        if($request->hasFile('upload')) {
            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

                if(in_array($extension, $allowedImageExtensions)){
                    $this->add_image_filemgr($request);

                }elseif(in_array($extension, $allowedVideoExtensions)){
                    $this->add_video_filemgr($request);
                }
        
        }else{
            echo "ファイルのアップロードに失敗しました";
        }

    }

    public function add_image_filemgr($data)
    {      
        Log::debug('image_or_video is called');  
        //recieve data from dialog
        if($data->hasFile('upload')) {

            //get filename with extension
            $filenamewithextension = $data->file('upload')->getClientOriginalName();
      
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
      
            //get file extension
            $extension = $data->file('upload')->getClientOriginalExtension();
      
            //filename to store
            //$filenametostore = $filename.'_'.time().'.'.$extension;
            $filenametostore = $filename.'-fullsize'.'.'.$extension;
            
            //add required information
            $sizearr=['full_size' => 'true'];
            $data->merge([
                    'image_title' => $filename,
                    'sizes_to_upload'=>$sizearr,
            ]);   
            
            //Upload File
            $result = $this->ckeditor_fileupload($data);
            
            //make HTML output
            $CKEditorFuncNum = $data->input('CKEditorFuncNum');
            $url = asset('blog_images/'.$filenametostore); 
            $msg = '画像のアップロードが完了しました'; 
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output 
            @header('Content-type: text/html; charset=utf-8'); 
            echo $re;

        }

    }

    public function add_video_filemgr($data)
    {
        Log::debug('add_video_filemgr is called');
        $video = $data->file('upload');

        $originalName = basename($video->getClientOriginalName(),'.mp4');
        $current_timestamp = Carbon::now()->timestamp;
        $filename = $current_timestamp . '-' . 'fullsize.mp4';
        $thumbnailName = $current_timestamp . '-' . 'fullsize.png';
        $path = public_path('blog_videos/');

        //get filename with extension
        $filenamewithextension = $data->file('upload')->getClientOriginalName();
        //get filename without extension
        $video_title = pathinfo($filenamewithextension, PATHINFO_FILENAME);        

        //save the video
        $video->move($path, $filename);

        //アップロードできているか確認
        if (!\File::exists($path . $filename)) {
            echo "アップロードに失敗しました！";
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

        // update DB information
        UploadedVideo::create([
            'video_title' => $video_title,
            'source' => "VideoUpload",
            'uploader_id' => optional(\Auth::user())->id,
            'uploaded_video' => $filename,
        ]);

        $video_info = array('video_title'=> $data->get("video_title"),
                            'filename' => $filename
        );

        //make HTML output
        $CKEditorFuncNum = $data->input('CKEditorFuncNum');
        $url = asset('blog_videos/' . $filename); 
        $msg = '動画のアップロードに成功しました'; 
        $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

        // Render HTML output 
        @header('Content-type: text/html; charset=utf-8'); 
        echo $re;
    }

    public function image_or_video_dd(Request $request)
    {
        Log::debug('image_or_video_dd');  
        $allowedImageExtensions = array('png','jpg','gif');
        $allowedVideoExtensions = array('mp4');
        $data = $request->all();

        if($request->hasFile('upload')) {
            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //get file original name
            $filename = $request->file('upload')->getClientOriginalName();
            $filename = str_replace("." . $extension,"",$filename);
            log::debug($filename);

            //check if the filename doesnt include 2byte letters
            if (preg_match('/^[0-9a-zA-Z]*$/', $filename)){

                //if extension is right
                if(in_array($extension, $allowedImageExtensions)){
                    $this->add_image_dragdrop($request);

                }elseif(in_array($extension, $allowedVideoExtensions)){
                    Log::debug('video_dd');
                    $this->add_video_dragdrop($request);
                    
                }else{
                    Log::debug('invalid_file_type');
                    
                    //make HTML output
                    $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                    $url = "none"; 
                    $msg = 'ファイルのタイプが不正です。'; 
                    $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

                    // Render HTML output 
                    @header('Content-type: text/html; charset=utf-8'); 
                    echo $re;
                }

            }else{
                    Log::debug('invalid_file_name');

                    //make HTML output
                    $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                    $url = "none"; 
                    $msg = '画像の名前には半角英数字を使ってください。'; 
                    $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

                    // Render HTML output 
                    @header('Content-type: text/html; charset=utf-8'); 
                    echo $re;
            }
        }
    }

    public function add_image_dragdrop($data)
    {

        Log::debug('add_image_dragdrop');
        //recieve data from dialog
        if($data->hasFile('upload')) {
            
            //get filename with extension
            $filenamewithextension = $data->file('upload')->getClientOriginalName();
            $filenamewithextension = strtolower($filenamewithextension);
            log::debug($filenamewithextension);

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            log::debug($filename);

            //get file extension
            $extension = $data->file('upload')->getClientOriginalExtension();
      
            //filename to store
            //$filenametostore = $filename.'_'.time().'.'.$extension;
            $filenametostore = $filename.'-fullsize'.'.'.$extension;
            log::debug($filenametostore);

            //add required information
            $sizearr=['full_size' => 'true'];
            $data->merge([
                    'image_title' => $filename,
                    'sizes_to_upload'=>$sizearr,
            ]); 

            //Upload File
            $result = $this->ckeditor_fileupload($data);

            $filePath = asset('blog_images/'.$filenametostore);
            $output_data = [
                     'uploaded' => 1, 
                     'fileName' => $filename, 
                     'url' => $filePath
                    ];
            
            $CKEditorFuncNum = $data->input('CKEditorFuncNum');
            
            $re = "<script'>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$filePath');</script>";
            
            @header('Content-type: text/html; charset=utf-8'); 
            //Log::debug(json_encode($re));
            echo json_encode($output_data);

        }

    }

    public function add_video_dragdrop($data)
    {
        Log::debug('add_video_dragdrop');
    }

    public function ckeditor_fileupload($data)
    {
        Log::debug('ckeditor_fileupload');    
        $photo = $data->file('upload');
        $uploaded_image_details = [];
        $sizes_to_upload = $data->get("sizes_to_upload");

        // now upload a full size - this is a special case, not in the config file. We only store full size images in this class, not as part of the featured blog image uploads.
        if (isset($sizes_to_upload['full_size']) && $sizes_to_upload['full_size'] === 'true') {
            $uploaded_image_details['full_size'] = $this->UploadAndResize(null, $data->get("image_title"), 'fullsize', $photo);
        }
        
        foreach ((array)config('blogetc.image_sizes') as $size => $image_size_details) {

            if (!isset($sizes_to_upload[$size]) || !$sizes_to_upload[$size] || !$image_size_details['enabled']) {
                continue;
            }

            // this image size is enabled, and
            // we have an uploaded image that we can use
            $uploaded_image_details[$size] = $this->UploadAndResize(null, $data->get("image_title"), $image_size_details, $photo);
        }
        
        // store the image upload.
        BlogEtcUploadedPhoto::create([
            'image_title' => $data->get("image_title"),
            'source' => "ImageUpload",
            'uploader_id' => optional(\Auth::user())->id,
            'uploaded_images' => $uploaded_image_details,
        ]);
        
        return $uploaded_image_details;
    }






}