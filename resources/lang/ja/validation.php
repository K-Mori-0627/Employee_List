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

    'accepted'             => ':attributeが未承認です。',
    'active_url'           => ':attributeは有効なURLではありません。',
    'after'                => ':attributeは:dateより後の日付にしてください。',
    'after_or_equal'       => ':attributeは:date以降の日付にしてください。',
    'alpha'                => ':attributeは英字のみ有効です。',
    'alpha_dash'           => ':attributeは「英字」「数字」「-(ダッシュ)」「_(下線)」のみ有効です。',
    'alpha_num'            => ':attributeは「英字」「数字」のみ有効です。',
    'array'                => ':attributeは配列タイプのみ有効です。',
    'before'               => ':attributeは:dateより前の日付にしてください。',
    'before_or_equal'      => ':attributeは:date以前の日付にしてください。',
    'between'              => [
        'numeric' => ':attributeは:min～:maxまでの数値まで有効です。',
        'file'    => ':attributeは:min～:maxキロバイトまで有効です。',
        'string'  => ':attributeは:min～:max文字まで有効です。',
        'array'   => ':attributeは:min～:max個まで有効です。',
    ],
    'boolean'              => ':attributeの値はtrueもしくはfalseのみ有効です。',
    'confirmed'            => ':attributeを確認用と一致させてください。',
    'date'                 => ':attributeを有効な日付形式にしてください。',
    'date_equals'          => ':attributeは:dateと等しい日付である必要があります。',
    'date_format'          => ':attributeを:format書式と一致させてください。',
    'different'            => ':attributeを:otherと違うものにしてください。',
    'digits'               => ':attributeは:digits桁のみ有効です。',
    'digits_between'       => ':attributeは:min～:max桁のみ有効です。',
    'dimensions'           => ':attributeルールに合致する画像サイズのみ有効です。',
    'distinct'             => ':attributeに重複している値があります。',
    'email'                => ':attributeメールアドレスの書式のみ有効です。',
    'ends_with'            => ':attributeは次のいずれかで終了する必要があります。:values',
    'exists'               => ':attribute無効な値です。',
    'file'                 => ':attributeアップロード出来ないファイルです。',
    'filled'               => ':attribute値を入力してください。',
    'gt'                   => [
        'numeric' => ':attributeは:valueより大きい必要があります。',
        'file'    => ':attributeは:valueキロバイトより大きい必要があります。',
        'string'  => ':attributeは:value文字より多い必要があります。',
        'array'   => ':attributeには:value個より多くの項目が必要です。',
    ],
    'gte'                  => [
        'numeric' => ':attributeは:value以上である必要があります。',
        'file'    => ':attributeは:valueキロバイト以上である必要があります。',
        'string'  => ':attributeは:value文字以上である必要があります。',
        'array'   => ':attributeにはvalue個以上の項目が必要です。',
    ],
    'image'                => ':attribute画像は「jpg」「png」「bmp」「gif」「svg」のみ有効です。',
    'in'                   => ':attribute無効な値です。',
    'in_array'             => ':attributeは:otherと一致する必要があります。',
    'integer'              => ':attributeは整数のみ有効です。',
    'ip'                   => ':attributeIPアドレスの書式のみ有効です。',
    'ipv4'                 => ':attributeIPアドレス(IPv4)の書式のみ有効です。',
    'ipv6'                 => ':attributeIPアドレス(IPv6)の書式のみ有効です。',
    'json'                 => ':attribute正しいJSON文字列のみ有効です。',
    'lt'                   => [
        'numeric' => ':attributeは:value未満である必要があります。',
        'file'    => ':attributeは:valueキロバイト未満である必要があります。',
        'string'  => ':attributeは:value文字未満である必要があります。',
        'array'   => ':attributeは:value未満の項目を持つ必要があります。',
    ],
    'lte'                  => [
        'numeric' => ':attributeは:value以下である必要があります。',
        'file'    => ':attributeは:valueキロバイト以下である必要があります。',
        'string'  => ':attributeは:value文字以下である必要があります。',
        'array'   => ':attributeは:value以上の項目を持つ必要があります。',
    ],
    'max'                  => [
        'numeric' => ':attributeは:max以下のみ有効です。',
        'file'    => ':attributeは:maxKB以下のファイルのみ有効です。',
        'string'  => ':attributeは:max文字以下のみ有効です。',
        'array'   => ':attributeは:max個以下のみ有効です。',
    ],
    'mimes'                => ':attributeは:valuesタイプのみ有効です。',
    'mimetypes'            => ':attributeは:valuesタイプのみ有効です。',
    'min'                  => [
        'numeric' => ':attributeは:min以上のみ有効です。',
        'file'    => ':attributeは:minKB以上のファイルのみ有効です。',
        'string'  => ':attributeは:min文字以上のみ有効です。',
        'array'   => ':attributeは:min個以上のみ有効です。',
    ],
    'not_in'               => ':attribute無効な値です。',
    'not_regex'            => ':attributeの形式が無効です。',
    'numeric'              => ':attributeは数字のみ有効です。',
    'present'              => ':attributeが存在しません。',
    'regex'                => ':attribute無効な値です。',
    'required'             => ':attributeは必須です。',
    'required_if'          => ':attributeは:otherが:valueには必須です。',
    'required_unless'      => ':attributeは:otherが:valuesでなければ必須です。',
    'required_with'        => ':attributeは:valuesが入力されている場合は必須です。',
    'required_with_all'    => ':attributeは:valuesが入力されている場合は必須です。',
    'required_without'     => ':attributeは:valuesが入力されていない場合は必須です。',
    'required_without_all' => ':attributeは:valuesが入力されていない場合は必須です。',
    'same'                 => ':attributeは:otherと同じ場合のみ有効です。',
    'size'                 => [
        'numeric' => ':attributeは:sizeのみ有効です。',
        'file'    => ':attributeは:sizeKBのみ有効です。',
        'string'  => ':attributeは:size文字のみ有効です。',
        'array'   => ':attributeは:size個のみ有効です。',
    ],
    'starts_with'          => ':attributeは次のいずれかで始まる必要があります。 :values',
    'string'               => ':attributeは文字列のみ有効です。',
    'timezone'             => ':attribute正しいタイムゾーンのみ有効です。',
    'unique'               => ':attributeは既に存在します。',
    'uploaded'             => ':attributeアップロードに失敗しました。',
    'url'                  => ':attributeは正しいURL書式のみ有効です。',
    'uuid'                 => ':attributeは正しいUUIDのみ有効です。',

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

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'account' => 'アカウント',
        'login_id' => 'ログインID',
        'current' => '現在のパスワード',
        'password' => 'パスワード',
        'name' => '名前',
        'name_kana' => '名前（かな）',
        'name_roma' => '名前（英字）',
        'email' => 'メールアドレス',
        'role' => '役職',
        'department' => '部署',
        'title' => 'タイトル',
        'text' => '本文',
    ],

];
