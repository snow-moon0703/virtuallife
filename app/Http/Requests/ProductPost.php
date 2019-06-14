<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProductPost extends FormRequest
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
            // 'img.*'   => 'required|image',
            'file'    => 'required|file',
            'name'    => 'required|string|min:1|max:20',
            'type'    => 'required',
            'summary' => 'required|string|min:1|max:400',
            'price'   => 'required|numeric|min:0',
            'rating'  => 'required',
            'video'   => 'mimes:x-matroska,mp4,x-msvideo,webm',
            'img0'    => 'required|image',
            'img1'    => 'image',
            'img2'    => 'image',
            'img3'    => 'image',
            'img4'    => 'image',
            'img5'    => 'image',
        ];
    }

    public function messages()
    {
        return [
            // 'summary.max' => '商品簡介不可超過400字',
            // 'name.max'    => '商品名稱不可超過20字',
            // 'price.min'   => '過低',
        ];
    }
}
