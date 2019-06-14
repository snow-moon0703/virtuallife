<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class ArticlePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:20',
            'text'  => 'required|string|max:400',
        ];
    }

    // public function messages()
    // {
    //     return [
    //         // 'title.max'      => '標題不得超過20字',
    //         // 'text.max'       => '內容不得超過400字',
    //     ];
    // }
}
