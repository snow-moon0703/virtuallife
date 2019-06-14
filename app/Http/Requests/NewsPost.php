<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsPost extends FormRequest
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
            'title'     => 'required|string|max:20',
            'img'       => 'required|image',
            'startdate' => 'required|date',
            'enddate'   => 'required|date|after:startdate',
            'content'   => 'required|string|max:400',
        ];
    }
    // public function messages()
    // {
    //     return [
    //         // 'title.required'     => '請輸入文章標題',
    //         // 'img.required'       => '請上傳圖片',
    //         // 'startdate.required' => '請輸入開始時間',
    //         // 'enddate.required'   => '請輸入結束時間',
    //         // 'content.required'   => '請輸入文章內容',
    //         // 'content.max'        => '文章內容最大為400字',
    //     ];
    // }
}
