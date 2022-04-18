<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use WebDevEtc\BlogEtc\Interfaces\BaseRequestInterface;
use WebDevEtc\BlogEtc\Requests\BaseRequest;

use App\UploadedVideo;
use Log;

/**
 * Class BaseRequest
 */
class UploadVideoRequest extends BaseRequest
{
    /**
     *  rules for uploads
     *
     * @return array
     */
    public function rules()
    {
        Log::debug('UploadVideoRequest is called');
        
        /*$rules = [
            'sizes_to_upload' => [
                'required',
                'array',
            ],
            'sizes_to_upload.*' => [
                'string',
                'max:100',
            ],
            'upload' => [
                'required',
                'video',
            ],
            'video' => [
                'required',
                'string',
                'min:1',
                'max:150',
            ],
        ];*/
        $rules = [];
        return $rules;
    }
}
