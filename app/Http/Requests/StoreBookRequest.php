<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Log;

class StoreBookRequest extends BaseBookRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        Log::debug('StoreBookRequest:: rules is called');
        $return = $this->baseBookRules();
        $return['slug'] [] = Rule::unique("books", "slug");
        return $return;
    }


}
