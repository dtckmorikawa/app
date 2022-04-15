<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use WebDevEtc\BlogEtc\Interfaces\BaseRequestInterface;

/**
 * Class BaseRequest
 * @package WebDevEtc\BlogEtc\Requests
 */
abstract class BaseAuthRequest extends FormRequest implements BaseRequestInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check() && \Auth::user()->canManageBlogEtcPosts();
    }
}
