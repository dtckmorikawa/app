<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Log;

class baseBookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function baseBookRules()
    {
        Log::debug('baseBookRequest:: baseBookRules is called');
        $return = [
            'book_name' => ['required', 'string', 'min:1', 'max:200'],
            //'slug' => ['required', 'alpha_dash', 'max:100', 'min:1'],
            'book_description' => ['nullable', 'string', 'min:1', 'max:5000'],
        ];
        return $return;
    }
}
