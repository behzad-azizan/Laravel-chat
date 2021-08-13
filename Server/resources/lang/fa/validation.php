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

    'accepted'             => ':attribute باید پذیرفته شده باشد.',
    'active_url' => 'آدرس :attribute معتبر نیست.',
    'after'                => ':attribute باید تاریخی بعد از :date باشد.',
    'alpha'                => ':attribute باید شامل حروف الفبا باشد.',
    'alpha_dash'           => ':attribute باید شامل حروف الفبا و عدد و خظ تیره(-) باشد.',
    'alpha_num'            => ':attribute باید شامل حروف الفبا و عدد باشد.',
    'array'                => ':attribute باید شامل آرایه باشد.',
    'before'               => ':attribute باید تاریخی قبل از :date باشد.',
    'between'              => [
        'numeric' => ':attribute باید بین :min و :max باشد.',
        'file'    => ':attribute باید بین :min و :max کیلوبایت باشد.',
        'string'  => ':attribute باید بین :min و :max کاراکتر باشد.',
        'array'   => ':attribute باید بین :min و :max آیتم باشد.',
    ],
    'boolean' => 'فیلد :attribute فقط میتواند 0 و یا 1 باشد',
    'confirmed'            => ':attribute با تاییدیه مطابقت ندارد.',
    'date'                 => ':attribute یک تاریخ معتبر نیست.',
    'date_format'          => ':attribute با الگوی :format مطاقبت ندارد.',
    'different'            => ':attribute و :other باید متفاوت باشند.',
    'digits'               => ':attribute باید :digits رقم باشد.',
    'digits_between'       => ':attribute باید بین :min و :max رقم باشد.',
    'dimensions'           => 'ابعاد تصویر ارسالی برای فیلد :attribute نامعتبر است.',
    'distinct'             => 'فیلد :attribute دارای یک مقدار تکراری می‌باشد.',
    'email' => 'فرمت :attribute معتبر نیست',
    'exists'               => ':attribute انتخاب شده، معتبر نیست.',
    'filled'               => 'فیلد :attribute الزامی است',
    'image'                => ':attribute باید تصویر باشد.',
    'in'                   => ':attribute انتخاب شده، معتبر نیست.',
    'in_array'             => 'فیلد :attribute در :other وجود ندارد.',
    'integer'              => ':attribute باید نوع داده ای عددی (integer) باشد.',
    'ip'                   => ':attribute باید IP آدرس معتبر باشد.',
    'json'                 => 'فیلد :attribute باید یک رشته از نوع JSON باشد.',
    'max'                  => [
        'numeric' => ':attribute نباید بزرگتر از :max باشد.',
        'file'    => ':attribute نباید بزرگتر از :max کیلوبایت باشد.',
        'string'  => ':attribute نباید بیشتر از :max کاراکتر باشد.',
        'array'   => ':attribute نباید بیشتر از :max آیتم باشد.',
    ],
    'mimes'                => ':attribute باید یکی از فرمت های :values باشد.',
    'mimetypes'                => ':attribute باید یکی از فرمت های :values باشد.',
    'min'                  => [
        'numeric' => ':attribute نباید کوچکتر از :min باشد.',
        'file'    => ':attribute نباید کوچکتر از :min کیلوبایت باشد.',
        'string'  => ':attribute نباید کمتر از :min کاراکتر باشد.',
        'array'   => ':attribute نباید کمتر از :min آیتم باشد.',
    ],
    'not_in'               => ':attribute انتخاب شده، معتبر نیست.',
    'numeric'              => ':attribute باید شامل عدد باشد.',
    'present'              => 'فیلد :attribute باید در پارامترهای ارسالی وجود داشته باشد.',
    'regex'                => ':attribute یک فرمت معتبر نیست',
    'required'             => 'فیلد :attribute الزامی است',
    'required_if'          => 'فیلد :attribute هنگامی که :other برابر با :value است، الزامیست.',
    'required_unless'      => 'فیلد :attribute ضروری است، مگر آنکه :other در :values وجود داشته باشد.',
    'required_with'        => ':attribute الزامی است زمانی که :values موجود است.',
    'required_with_all'    => ':attribute الزامی است زمانی که :values موجود است.',
    'required_without'     => ':attribute الزامی است زمانی که :values موجود نیست.',
    'required_without_all' => ':attribute الزامی است زمانی که :values موجود نیست.',
    'same'                 => ':attribute و :other باید مانند هم باشند.',
    'size'                 => [
        'numeric' => ':attribute باید برابر با :size باشد.',
        'file'    => ':attribute باید برابر با :size کیلوبایت باشد.',
        'string'  => ':attribute باید برابر با :size کاراکتر باشد.',
        'array'   => ':attribute باسد شامل :size آیتم باشد.',
    ],
    'string'               => 'فیلد :attribute باید یک رشته باشد.',
    'timezone'             => 'فیلد :attribute باید یک منطقه صحیح باشد.',
    'unique'               => ':attribute قبلا انتخاب شده است.',
    'url'                  => 'فرمت آدرس :attribute اشتباه است.',
    'special_channel_member_count' => 'تعداد اعضای کانال شما کمتر از حد مجاز برای کانال های طلایی میباشد. لطفا نوع کانال خود را به معمولی تغییر دهید.',
    'tmp_file_exists' => 'فایل آپلود نشده است!',
    'required_for_default_language' => 'فیلد :attribute برای زبان پیشفرض وارد نشده است.',
    'phone' => 'فیلد :attribute نامعتبر است.',
    'mobile' => 'فیلد :attribute باید با فرمت موبایل وارد شود.',
    'file' => 'فیلد :attribute باید فایل باشد',
    'order_file_invalid_mime' => 'پسوند فایل ارسالی باید :mimes باشد.',

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
        'name'                  => 'نام',
        'username'              => 'نام کاربری',
        'email'                 => 'پست الکترونیکی',
        'first_name'            => 'نام',
        'last_name'             => 'نام خانوادگی',
        'password'              => 'رمز عبور',
        'password_confirmation' => 'تاییدیه ی رمز عبور',
        'city'                  => 'شهر',
        'country'               => 'کشور',
        'address'               => 'نشانی',
        'phone'                 => 'تلفن',
        'mobile'                => 'تلفن همراه',
        'age'                   => 'سن',
        'sex'                   => 'جنسیت',
        'gender'                => 'جنسیت',
        'day'                   => 'روز',
        'month'                 => 'ماه',
        'year'                  => 'سال',
        'hour'                  => 'ساعت',
        'minute'                => 'دقیقه',
        'second'                => 'ثانیه',
        'title'                 => 'عنوان',
        'text'                  => 'متن',
        'content'               => 'محتوا',
        'description'           => 'توضیحات',
        'excerpt'               => 'گلچین کردن',
        'date'                  => 'تاریخ',
        'time'                  => 'زمان',
        'available'             => 'موجود',
        'size'                  => 'اندازه',
        'oldPassword'           =>'رمز جاری',
        'body'                  => 'متن',
        'thumbnail_path'        => 'تصویر آگهی',
        'financial_type'        => 'روش مالی',
        'dest_type'             => 'نوع لینک',
        'link'                  => 'لینک',
        'type'                  => 'نوع',
        'thumb_type'            => 'نوع کاور',
        'status'                => 'وضعیت',
        'total_clicks'          => 'تعداد کلیک',
        'publish_hour'          => 'ساعت انتشار در کانال',
        'message'               => 'پیام',
        'teleg_id'              => 'لینک کانال',
        'picture'               => 'عکس',
        'has_targeted'          => 'تنظیمات هدفمندی کانال',
        'ads_on_day'            => 'تعداد آکهی در روز',
        'previous_password'     => 'پسورد قبلی',
        'fname'                 => 'نام',
        'lname'                 => 'نام خانوادگی',
        'father_name'           => 'نام پدر',
        'amount'                => 'مبلغ',
        'log'                   => 'توضیحات',
        'few_hours'             => 'مدت زمان انتشار آگهی در کانال',
        'click_count'           => 'تعداد کلیک',
        'view_count'            => 'تعداد بازدید',
        'captcha'               => 'کد امنیتی',
        'national_code'         => 'کد ملی',
        'level'                 => 'سطح مهارتی',
        'birth_date'            => 'تاریخ تولد',
        'issue_place'           => 'محل صدور',
        'parent_id'             => 'شناسه والد'
    ]

];
