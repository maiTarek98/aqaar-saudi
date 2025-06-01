<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
        if(request('q') == 'site_data'){
            $rules = [
                'site_name_ar' => 'required|string|min:2|max:60',
                'site_name_en' => 'required|string|min:2|max:60',
                'logo' => 'sometimes|nullable|image',
                'favicon' => 'sometimes|nullable|image',
            ];
        }elseif(request('q') == 'contact_info'){
              $rules = [   'email' => 'required|email',
                'phone' => 'required|numeric',
                'whatsapp_phone' => 'required|numeric',
                'address_ar' => 'required|string|min:2|max:255',
                'address_en' => 'required|string|min:2|max:255',
                'twitter_link' => 'required|url',
                'facebook_link' => 'required|url',
                'instagram_link' => 'required|url',
                // 'whatsapp_link' => 'required|url',
                'tiktok_link' => 'required|url',
                'linkedin_link' => 'required|url',
                'youtube_link' => 'required|url',
                'snapchat_link' => 'required|url',
                // 'ios_link' => 'required|url',
                // 'android_link' => 'required|url',
            ];
        }elseif(request('q') == 'bank_data'){
             $rules = [
                'bank_account_number' => 'sometimes|nullable|numeric',
                'instapay_number' => 'sometimes|nullable|numeric',
                'vodafone_cash_number' => 'sometimes|nullable|numeric',
            ];
        }
        elseif(request('q') == 'card_control'){
             $rules = [
                'card_text_a' => 'sometimes|nullable|string',
                'card_text_b' => 'sometimes|nullable|string',
                'card_text_c' => 'sometimes|nullable|string',
                'card_text_d' => 'sometimes|nullable|string',
                'aqar_screen_control' => 'sometimes|nullable|string',
            ];
        }
        if(request()->segment(3) == 'update-landing'){
            if(request('type') == 'banner'){
                $rules = [
                        'banner_title_ar' => 'required|string|min:3|max:1000',
                        'banner_title_en' => 'required|string|min:3|max:1000',
                        'banner_text_ar' => 'required|string|min:3|max:8000',
                        'banner_text_en' => 'required|string|min:3|max:8000',

                        'banner_image' => 'sometimes|nullable|image',
                    ];
            }elseif(request('type') == 'beneficiaries'){
                $rules = [
                        'beneficiaries_title_ar' => 'required|string|min:3|max:1000',
                        'beneficiaries_title_en' => 'required|string|min:3|max:1000',
                        'beneficiaries_text_ar' => 'required|string|min:3|max:8000',
                        'beneficiaries_text_en' => 'required|string|min:3|max:8000',
                    ];
            }elseif(request('type') == 'feature'){
                $rules = [
                        'feature_title_one_ar' => 'required|string|min:3|max:1000',
                        'feature_title_one_en' => 'required|string|min:3|max:1000',
                        'feature_text_one_ar' => 'required|string|min:3|max:8000',
                        'feature_text_one_en' => 'required|string|min:3|max:8000',
                        'feature_image_one' => 'sometimes|nullable|image',
                        
                        'feature_title_two_ar' => 'required|string|min:3|max:1000',
                        'feature_title_two_en' => 'required|string|min:3|max:1000',
                        'feature_text_two_ar' => 'required|string|min:3|max:8000',
                        'feature_text_two_en' => 'required|string|min:3|max:8000',
                        'feature_image_two' => 'sometimes|nullable|image',

                        'feature_title_three_ar' => 'required|string|min:3|max:1000',
                        'feature_title_three_en' => 'required|string|min:3|max:1000',
                        'feature_text_three_ar' => 'required|string|min:3|max:8000',
                        'feature_text_three_en' => 'required|string|min:3|max:8000',
                        'feature_image_three' => 'sometimes|nullable|image',

                    ];
            }
            elseif(request('type') == 'about'){
                $rules = [
                        'about_title_one_ar' => 'required|string|min:3|max:1000',
                        'about_title_one_en' => 'required|string|min:3|max:1000',
                        'about_text_one_ar' => 'required|string|min:3|max:8000',
                        'about_text_one_en' => 'required|string|min:3|max:8000',
                        'about_image_one' => 'sometimes|nullable|image',
                        
                        'about_title_two_ar' => 'required|string|min:3|max:1000',
                        'about_title_two_en' => 'required|string|min:3|max:1000',
                        'about_text_two_ar' => 'required|string|min:3|max:8000',
                        'about_text_two_en' => 'required|string|min:3|max:8000',
                        'about_image_two' => 'sometimes|nullable|image',
                    ];
            }
        }else if(request()->segment(3) == 'update-seo'){
            $rules = [
                'meta_title_ar' => 'sometimes|nullable|string|min:2|max:1200',
                'meta_title_en' => 'sometimes|nullable|string|min:2|max:1200',
                'keywords' => 'sometimes|nullable|string|min:2|max:2200',
                'meta_description_ar' => 'sometimes|nullable|string|min:2|max:1200',
                'meta_description_en' => 'sometimes|nullable|string|min:2|max:1200',
            ];
        }

        if (session()->has('type')) {
            if(session()->get('type') == 'application'){
                $rules['account_name'] = 'required|string';
                $rules['workshop_commission'] = 'required|integer';
                $rules['user_commission'] = 'required|integer';
                $rules['delegate_commission'] = 'required|integer';
                $rules['tax'] = 'required|integer';
                $rules['account_number'] = 'required|integer';
                $rules['bank_image'] = 'sometimes|nullable|image';
            }
            if(session()->get('type') == 'website'){
                $rules['slider_title_ar'] = 'required|string';
                $rules['slider_title_en'] = 'required|string';
                $rules['slider_text_ar'] = 'required|string';
                $rules['slider_text_en'] = 'required|string';
                $rules['slider_img'] = 'sometimes|nullable|image';
                $rules['disclaimer_ar'] = 'required|string';
                $rules['disclaimer_en'] = 'required|string';
                $rules['site_account_verify'] = 'required|string|in:sms,email';
                $rules['embed_map'] = 'sometimes|nullable|string';
                $rules['map_link'] = 'sometimes|nullable|url';

            }
        }

        return $rules;
    }
}