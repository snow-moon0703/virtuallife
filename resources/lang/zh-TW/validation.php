<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
     */

    'accepted'             => '必須接受 :attribute',
    'active_url'           => ':attribute 並非一個有效的網址',
    'after'                => ':attribute 必須要在 :date 之後',
    'after_or_equal'       => ':attribute 必須大於 :date.',
    'alpha'                => ':attribute 只能以字母組成',
    'alpha_dash'           => ':attribute 只能以字母、數字及斜線組成',
    'alpha_num'            => ':attribute 只能以字母及數字組成',
    'array'                => ':attribute 必須為陣列',
    'before'               => ':attribute 必須要在 :date 之前',
    'before_or_equal'      => ':attribute 必須小於 :date.',
    'between'              => [
        'numeric' => ' :attribute 必須介於 :min 至 :max 之間',
        'file'    => ' :attribute 必須介於 :min 至 :max kb之間',
        'string'  => ' :attribute 必須介於 :min 至 :max 個字元之間',
        'array'   => ' :attribute 必須介於 :min 至 :max 個元素',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => ':attribute 並非一個有效日期',
    'date_format'          => ':attribute 與 :format 格式不相符',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => ':attribute 的格式無效',
    'exists'               => 'The selected :attribute is invalid.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field must have a value.',
    'gt'                   => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file'    => 'The :attribute must be greater than :value kilobytes.',
        'string'  => 'The :attribute must be greater than :value characters.',
        'array'   => 'The :attribute must have more than :value items.',
    ],
    'gte'                  => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file'    => 'The :attribute must be greater than or equal :value kilobytes.',
        'string'  => 'The :attribute must be greater than or equal :value characters.',
        'array'   => 'The :attribute must have :value items or more.',
    ],
    'image'                => ':attribute 必須是一張圖片',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'lt'                   => [
        'numeric' => 'The :attribute must be less than :value.',
        'file'    => 'The :attribute must be less than :value kilobytes.',
        'string'  => 'The :attribute must be less than :value characters.',
        'array'   => 'The :attribute must have less than :value items.',
    ],
    'lte'                  => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file'    => 'The :attribute must be less than or equal :value kilobytes.',
        'string'  => 'The :attribute must be less than or equal :value characters.',
        'array'   => 'The :attribute must not have more than :value items.',
    ],
    'max'                  => [
        'numeric' => ':attribute 不能大於 :max',
        'file'    => ':attribute 不能大於 :max kb',
        'string'  => ':attribute 不能多於 :max 個字元',
        'array'   => ':attribute 最多有 :max 個元素',
    ],
    'mimes'                => ':attribute 必須為 :values 的檔案',
    'mimetypes'            => ':attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => ':attribute 不能小於 :min',
        'file'    => ':attribute 不能小於 :min kb',
        'string'  => ':attribute 不能小於 :min 個字元',
        'array'   => ':attribute 至少有 :min 個元素',
    ],
    'not_in'               => '所選擇的 :attribute 選項無效',
    'not_regex'            => ':attribute format is invalid.',
    'numeric'              => ':attribute 必須為一個數字',
    'present'              => ':attribute 必須存在',
    'regex'                => ':attribute 的格式錯誤',
    'required'             => ':attribute 不可為空',
    'required_if'          => ':attribute field is required when :other is :value.',
    'required_unless'      => ':attribute field is required unless :other is in :values.',
    'required_with'        => ':attribute field is required when :values is present.',
    'required_with_all'    => ':attribute field is required when :values is present.',
    'required_without'     => ':attribute field is required when :values is not present.',
    'required_without_all' => ':attribute field is required when none of :values are present.',
    'same'                 => ':attribute and :other must match.',
    'size'                 => [
        'numeric' => ':attribute 的大小必須是 :size',
        'file'    => ':attribute 的大小必須是 :size kb',
        'string'  => ':attribute 必須是 :size 個字元',
        'array'   => ':attribute 必須是 :size 個元素',
    ],
    'string'               => ':attribute 必須是一個字串',
    'timezone'             => ':attribute 必須是一個正確的時區值',
    'unique'               => ':attribute 已經存在',
    'uploaded'             => ':attribute failed to upload.',
    'url'                  => ':attribute 的格式錯誤',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
     */

    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
     */

    'attributes'           => [
        'name'                  => '名稱',
        'email'                 => '電子信箱',
        'password'              => '密碼',
        'file'                  => '檔案',
        'phone'                 => '電話',
        'gender'                => '性別',
        'country'               => '國家',
        'password'              => '密碼',
        'startdate'             => '開始時間',
        'enddate'               => '結束時間',
        'content'               => '內容',
        'summary'               => '簡介',
        'price'                 => '價格',
        'img'                  => '圖片',
        'img0'                  => '圖片',
        'img1'                  => '圖片',
        'img2'                  => '圖片',
        'img3'                  => '圖片',
        'img4'                  => '圖片',
        'video'                 => '影片',
        'password_confirmation' => '密碼',
        'account'               => '銀行帳號',
        'title'                 => '標題',
        'text'                  => '內容',
        // 'title'                 => '密碼',
    ],

];
