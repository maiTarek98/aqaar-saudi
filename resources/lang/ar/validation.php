<?php

return [
	/*
		|--------------------------------------------------------------------------
		| Validation Language Lines
		|--------------------------------------------------------------------------
		|
		| The following language lines contain the default error messages used by
		| the validator class. Some of these rules have multiple versions such
		| as the size rules. Feel free to tweak each of these messages.
		|
	*/
	'mobile_' => ':attribute غير صحيح',
	'docx' => 'يجب :attribute ان يكون ملف من نوع Microsoft Office .docx او doc',
	'potm' => 'يجب :attribute ان يكون ملف من نوع Microsoft Office .potm',
	'ppsm' => 'يجب :attribute ان يكون ملف من نوع Microsoft Office .ppsm',
	'sldm' => 'يجب :attribute ان يكون ملف من نوع Microsoft Office .sldm',
	'pptm' => 'يجب :attribute ان يكون ملف من نوع Microsoft Office .pptm',
	'ppam' => 'يجب :attribute ان يكون ملف من نوع Microsoft Office .ppam',
	'ppt' => 'يجب :attribute ان يكون ملف من نوع Microsoft Office .ppt',
	'xltx' => 'يجب :attribute ان يكون ملف من نوع Microsoft Office .xltx',
	'xlsx' => 'يجب :attribute ان يكون ملف من نوع Microsoft Office .xlsx',
	'xls' => 'يجب :attribute ان يكون ملف من نوع Microsoft Office .xls',
	'office' => 'يجب :attribute ان يكون ملف  من الانواع التالية Microsoft Office  docx,potm,ppsm,sldm,pptm,ppam,ppt,xltx,xlsx,xls',

	'pdf' => 'يجب :attribute ان يكون ملف من نوع .pdf',
	'video' => 'يجب :attribute ان يكون ملف فيديو من الانواع التالية vob,avi,wmv,mkv,mk3d,mks,webm,3gp,qt,mov,mpeg,mpg,mpe,m1v,m2v,mp4,mp4v,mpg4',
	'mp4' => 'يجب :attribute ان يكون ملف فيديو من نوع mp4,mp4v,mpg4',
	'mpeg' => 'يجب :attribute ان يكون ملف فيديو من نوع mpeg,mpg,mpe,m1v,m2v',
	'mov' => 'يجب :attribute ان يكون ملف فيديو من نوع qt,mov',
	'3gp' => 'يجب :attribute ان يكون ملف فيديو من نوع .3gp',
	'webm' => 'يجب :attribute ان يكون ملف فيديو من نوع .webm',
	'mkv' => 'يجب :attribute ان يكون ملف فيديو من نوع .mkv,mk3d,mks',
	'wmv' => 'يجب :attribute ان يكون ملف فيديو من نوع .wmv',
	'avi' => 'يجب :attribute ان يكون ملف فيديو من نوع .avi',
	'vob' => 'يجب :attribute ان يكون ملف فيديو من نوع .vob',
	'audio' => 'يجب :attribute ان يكون ملف صوت من الانواع التالية xm,wav,ogg,adp,mp3',
	'mp3' => 'يجب :attribute ان يكون ملف صوتي من الانواع الاتية mpga mp2 mp2a mp3 m2a m3a',
	'xm' => 'يجب :attribute ان يكون ملف صوتي من الانواع الاتية xm',
	'wav' => 'يجب :attribute ان يكون ملف صوتي من الانواع الاتية wav',
	'ogg' => 'يجب :attribute ان يكون ملف صوتي من الانواع الاتية ogg',
	'adp' => 'يجب :attribute ان يكون ملف صوتي من الانواع الاتية adp',

	'accepted' => 'يجب قبول :attribute',
	'active_url' => ':attribute لا يُمثّل رابطًا صحيحًا',
	'after' => 'يجب على :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
	'after_or_equal' => ':attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
	'alpha' => 'يجب أن لا يحتوي :attribute سوى على حروف',
	'alpha_dash' => 'يجب أن لا يحتوي :attribute على حروف، أرقام ومطّات.',
	'alpha_num' => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط',
	'array' => 'يجب أن يكون :attribute ًمصفوفة',
	'before' => 'يجب على :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
	'before_or_equal' => ':attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date',
	'between' => [
		'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
		'file' => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
		'string' => 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max',
		'array' => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max',
	],
	'boolean' => 'يجب أن تكون قيمة :attribute إما true أو false ',
	'confirmed' => 'حقل التأكيد غير مُطابق للحقل :attribute',
	'date' => ':attribute ليس تاريخًا صحيحًا',
	'date_format' => 'لا يتوافق :attribute مع الشكل :format.',
	'different' => 'يجب أن يكون الحقلان :attribute و :other مُختلفان',
	'digits' => 'يجب أن يحتوي :attribute على :digits رقمًا/أرقام',
	'digits_between' => 'يجب أن يحتوي :attribute بين :min و :max رقمًا/أرقام ',
	'dimensions' => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.',
	'distinct' => 'للحقل :attribute قيمة مُكرّرة.',
	'email' => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية',
	'exists' => 'القيمة المحددة :attribute غير موجودة',
	'file' => 'الـ :attribute يجب أن يكون ملفا.',
	'filled' => ':attribute إجباري',
	'image' => 'يجب أن يكون :attribute صورةً',
	'in' => ':attribute لاغٍ',
	'in_array' => ':attribute غير موجود في :other.',
	'integer' => 'يجب أن يكون :attribute عددًا صحيحًا',
	'ip' => 'يجب أن يكون :attribute عنوان IP صحيحًا',
	'ipv4' => 'يجب أن يكون :attribute عنوان IPv4 صحيحًا.',
	'ipv6' => 'يجب أن يكون :attribute عنوان IPv6 صحيحًا.',
	'json' => 'يجب أن يكون :attribute نصآ من نوع JSON.',
	'max' => [
		'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر لـ :max.',
		'file' => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت',
		'string' => 'يجب أن لا يتجاوز طول النّص :attribute :max حروفٍ/حرفًا',
		'array' => 'يجب أن لا يحتوي :attribute على أكثر من :max عناصر/عنصر.',
	],
	'mimes' => 'يجب أن يكون ملفًا من نوع : :values.',
	'mimetypes' => 'يجب أن يكون ملفًا من نوع : :values.',
	'min' => [
		'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر لـ :min.',
		'file' => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت',
		'string' => 'يجب أن يكون طول النص :attribute على الأقل :min حروفٍ/حرفًا',
		'array' => 'يجب أن يحتوي :attribute على الأقل على :min عُنصرًا/عناصر',
	],
	'not_in' => ':attribute غير صالحة.',
	'numeric' => 'يجب على :attribute أن يكون رقمًا',
	'present' => 'يجب تقديم :attribute',
	'regex' => 'صيغة :attribute .غير صحيحة',
	'required' => ':attribute مطلوب.',
	'required_if' => ':attribute مطلوب في حال ما إذا كان :other يساوي :value.',
	'required_unless' => ':attribute مطلوب في حال ما لم يكن :other يساوي :values.',
	'required_with' => ':attribute مطلوب إذا توفّر :values.',
	'required_with_all' => ':attribute مطلوب إذا توفّر :values.',
	'required_without' => ':attribute مطلوب إذا لم يتوفّر :values.',
	'required_without_all' => ':attribute مطلوب إذا لم يتوفّر :values.',
	'same' => 'يجب أن يتطابق :attribute مع :other',
	'size' => [
		'numeric' => 'يجب أن تكون قيمة :attribute مساوية لـ :size',
		'file' => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت',
		'string' => 'يجب أن يحتوي النص :attribute على :size حروفٍ/حرفًا بالظبط',
		'array' => 'يجب أن يحتوي :attribute على :size عنصرٍ/عناصر بالظبط',
	],
	'string' => 'يجب أن يكون :attribute نصآ.',
	'timezone' => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا',
	'unique' => 'قيمة :attribute مُستخدمة من قبل فى سجلاتنا ادخل :attribute فريد وغير مكرر',
	'uploaded' => 'فشل في تحميل الـ :attribute',
	'url' => 'صيغة الرابط :attribute غير صحيحة',
	'lt' => [
		'numeric' => ':attribute يجب أن يكون أقل من :value.',
		'file' => ':attribute يجب أن يكون أقل من :value كيلوبايت.',
		'string' => ' :attribute يجب أن يكون أقل من :value الأحرف.',
		'array' => ' :attribute يجب أن يكون أقل من :value العناصر.',
	],
	'lte' => [
		'numeric' => ' :attribute يجب أن يكون أصغر من أو يساوي :value.',
		'file' => ' :attribute يجب أن يكون أصغر من أو يساوي :value كيلوبايت.',
		'string' => ' :attribute يجب أن يكون أصغر من أو يساوي :value الأحرف.',
		'array' => ' :attribute يجب ألا يحتوي على أكثر من :value العناصر.',
	],
	'gt' => [
		'numeric' => ' :attribute يجب أن يكون أكبر من :value.',
		'file' => ' :attribute يجب أن يكون أكبر من :value كيلوبايت.',
		'string' => ' :attribute يجب أن يكون أكبر من :value الأحرف.',
		'array' => ' :attribute يجب أن يكون أكثر من :value العناصر.',
	],
	'gte' => [
		'numeric' => ' :attribute يجب أن يكون أكبر من أو يساوي :value.',
		'file' => ' :attribute يجب أن يكون أكبر من أو يساوي :value كيلوبايت.',
		'string' => ' :attribute يجب أن يكون أكبر من أو يساوي :value الأحرف.',
		'array' => ' :attribute يجب ان يملك :value من العناصر أو أكثر.',
	],
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
	'values' => [
		'account_type' => [
			'workshop' => 'ورشة',
			'delegate' => 'مندوب',
			'user' => 'مستخدم',
		],
		'user_type' => [
		    'agent' => 'وكيل',    
	        'co-owner' => 'أحد ملاك',    
	        'owner' => 'مالك',    
	        'other' => 'أخري',    

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

	'attributes' => [
		'name' => 'الاسم',
		'username' => 'اسم المُستخدم',
		'email' => 'البريد الالكتروني',
		'first_name' => 'الاسم الأول',
		'last_name' => 'اسم العائلة',
		'password' => 'كلمة السر',
		'password_confirmation' => 'تأكيد كلمة السر',
		'city' => 'المدينة',
		'country' => 'الدولة',
		'address' => 'عنوان السكن',
		'phone' => 'الهاتف',
		'mobile' => 'الجوال',
		'age' => 'العمر',
		'sex' => 'الجنس',
		'gender' => 'النوع',
		'day' => 'اليوم',
		'month' => 'الشهر',
		'year' => 'السنة',
		'hour' => 'ساعة',
		'minute' => 'دقيقة',
		'second' => 'ثانية',
		'title' => 'العنوان',
		'content' => 'المُحتوى',
		'description' => 'الوصف',
		'excerpt' => 'المُلخص',
		'date' => 'التاريخ',
		'time' => 'الوقت',
		'available' => 'مُتاح',
		'size' => 'الحجم',
		'new_password' => 'كلمة المرور الجديدة',
		'confirm_password' => 'تأكيد كلمة المرور',
		'banner_name' => 'أسم البانر',
		'banner_image' => 'صورة البانر',

		'brand_name_ar' => 'أسم براند السياره باللغه العربيه',
		'brand_name_en' => 'أسم براند السياره باللغه الانجليزيه',
		'brand_status' => 'حالة البراند',

        'model_name_ar' => 'أسم موديل السياره باللغه العربيه',
		'model_name_en' => 'أسم موديل السياره باللغه الانجليزيه',

		'brand_id' => 'أسم براند السياره',

		'permission' => 'الصلاحيات',

		'roles_name' => 'الأذونات',

		'permission' => 'الصلاحيات',
		'country_name_ar' => 'اسم الدولة باللغة العربيه',
		'country_name_en' => 'اسم الدولة باللغة الانجليزية',
		'country_iso' => 'ISO الدولة',
		'country_code' => 'كود الدولة',

		'city_name_ar' => 'اسم المدينة باللغة العربيه',
		'city_name_en' => 'اسم المدينة باللغة الانجليزية',
		'country_id' => 'اختر الدولة',
		'city_id' => 'اختر المدينة',
		'account_type' => 'نوع الحساب',
		'offer_price'=>'سعر العرض',
		'offer_start_at'=>'تاريخ بداية العرض',
		'offer_description'=>'وصف العرض',
		'offer_end_at'=>'تاريخ نهاية العرض',
		'user_id'=>'الاسم',
		'offer_title'=>'عنوان العرض',
		'ad_name'=>'عنوان الاعلان',
		'category_id'=>'الفئة',
		'subcategory'=>'نوع الاعلان',
		'carmodel_id'=>'موديل السياره',
		'ad_photo'=>'صورة الاعلان',
		'ad_description'=>'تفاصيل الاعلان',
		'price'=>'سعر ',
		'manufacture_date'=>'سنة الصنع',
		'today' => 'اليوم',
		'carbrand_id' => 'براند السيارة',
		'category_name_ar' => 'اسم القسم باللغة العربية',
		'category_name_en' => 'اسم القسم باللغة الانجليزية',
		'category_image' => 'صورة القسم',
		'section_name_ar' => 'اسم القسم باللغة العربية',
		'section_name_en' => 'اسم القسم باللغة الانجليزية',
		'account_name'  => 'اسم الحساب البنكى',
		'account_number' => 'رقم الحساب البنكى',
    	'bank_image' => 'صورة شعار البنك',
        'job_title' => 'عنوان الوظيفة',
        'job_experience' => ' سنين الخبرة المتطلبة',
        'location' => 'مكان الوظيفة',
        'upload_cv' => 'ارفق السيرة الذاتيه',
        'name_ar' => 'العنوان باللغة العربية',
        'name_en' => 'العنوان باللغة الانجليزية',
        'description_en' => 'الوصف باللغة العربية',    
        'description_ar' => 'الوصف باللغة الانجليزية',    
        'base_image' => 'الصورة الرئيسية',    
        'category_description_en' => 'الوصف باللغة العربية',    
        'category_description_ar' => 'الوصف باللغة الانجليزية',    
        'category_icon' => 'صورة أيقونه',    
        'message' => 'الرسالة',    
        'identifier' => 'الحقل',    
        'title_ar' => 'العنوان باللغة العربية',    
        'title_en' => 'العنوان باللغة الانجليزية',    
        'feature_title_ar' => 'عنوان فرعي باللغة العربية',    
        'feature_title_en' => 'عنوان فرعي باللغة الانجليزية',    
        'feature_ar' => 'عنوان الصفة باللغة العربية',    
        'feature_en' => 'عنوان الصفة باللغة الانجليزية',    
        'image' => 'إرفاق صورة',    
		'vodafone_cash_mobile' => 'رقم فودافون كاش',
		'mobile' => 'رقم الهاتف',
		'another_mobile' => 'رقم هاتف أخر',
		'connected_mobile' => 'رقم التواصل الطوارئ',
        'full_name' => 'الإسم', 
		'shipping_address' => 'عنوان الشحن', 
		'brand_name' => 'اسم العلامة التجارية', 
		'commercial_registration_no' => 'رقم السجل التجاري', 
		'commercial_registration_image' => 'البطاقة الضريبية', 
		'tax_no' => 'أرقام تراخيص المنتجات', 
		'tax_image' => 'صور التراخيص', 
		'bank_account_no' => 'الحساب البنكي',    
        'current_password' => 'كلمة السر الحالية',    
        'discount' => 'الخصم',    
        'brands_image' => 'صورة العلامة التجارية',    
        'user_type' => 'نوع الحساب',    
        'agency_number' => 'رقم الوكالة',    
        'id_number' => 'رقم الهوية',    
        'product_for' => 'غرض البيع',    
        'type' => 'نظام البيع',    
        '' => '',    
        '' => '',    
        '' => '',    
        '' => '',    
        '' => '',    
        '' => '',    
        '' => '',    
        '' => '',    
        '' => '',    
        '' => '',    
        '' => '',    
        '' => '',    
        '' => '',    
        '' => '',    
        '' => '',    

	],
];
