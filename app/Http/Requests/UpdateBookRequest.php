<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\Books;
use Log;

class UpdateBookRequest extends BaseBookRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $return = $this->baseBookRules();
        $return['slug'] [] = Rule::unique("books", "slug")->ignore($this->route()->parameter("bookId"));
        return $return;

    }
}
