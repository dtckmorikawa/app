<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


use Log;

class DeleteBookRequest extends BaseAuthRequest{


    /**
     * No rules needed for this DELETE request - we just need to implement it due to the interface requirement
     *
     * @return array
     */
    public function rules()
    {
        Log::debug('DeleteBookRequest is called');
        return [];
    }
}
