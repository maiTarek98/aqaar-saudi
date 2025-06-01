<input type="number" name="admin_id" value="{{ Auth::guard('admin')->user()->id }}" class="form-control" hidden>
@if(request('q') == 'site_data')
<!-- Site data -->
<div class="row g-2 g-md-3 mb-3">
    <div class="col-7 col-md-auto">
        <div class="box-wrapper">
                <label for="logo" class="form-label">@lang('main.settings.logo') <span class="text-danger">*</span></label>
                <div class="box">
                    <div class="js--image-preview">
                        @if (!empty($settings->logo))
                            <img src="{{ url('/storage/' . $settings->logo) }}" style="max-width:220px;width:100%">
                        @endif
                    </div>
                    <div class="upload-options">
                        <label>
                            <input type="file" id="logo" name="logo" class="image-upload" accept="image/*" />
                        </label>
                    </div>
                </div>
            </div>
    </div>
    <div class="col-5 col-md-auto">
        <div class="box-wrapper">
                <label for="favicon" class="form-label">@lang('main.settings.favicon') <span class="text-danger">*</span></label>
                <div class="box">
                    <div class="js--image-preview">
                        @if (!empty($settings->favicon))
                            <img src="{{ url('/storage/' . $settings->favicon) }}" style="max-width:60px">
                        @endif

                    </div>
                    <div class="upload-options">
                        <label>
                            <input type="file" id="favicon" name="favicon" class="image-upload" accept="image/*" />
                        </label>
                    </div>
                </div>
            </div>
    </div>

    <div class="col">
        <div class="mb-3">
            <label for="site_name_ar" class="form-label">@lang('main.settings.site_name_ar') <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="site_name_ar" name="site_name_ar" value="{{old('site_name_ar',$settings->site_name_ar)}}" required>
       </div>
       <div class="mb-3">
           <label for="site_name_en" class="form-label">@lang('main.settings.site_name_en') <span class="text-danger">*</span></label>
           <input type="text" class="form-control" id="site_name_en" name="site_name_en" value="{{old('site_name_en',$settings->site_name_en)}}" required>
      </div>
    </div> 
</div>
@endif
@if(request('q') == 'contact_info')
<!-- Contact information -->
<h2 class="mb-3 fs-6 fw-bold">بيانات الاتصال</h2>
<div class="row g-2 g-md-3 row-cols-2 row-cols-lg-4">
    <div class="col">
        <div class="card basic">
            <div class="card-body">
                <img src="{{ url('/dashboard') }}/dist/img/email.png" alt="" width="48">
                <label for="email" class="form-label">@lang('main.settings.email')<span class="text-danger">*</span></label>
                <input type="email" class="form-control mt-2" id="email" name="email" value="{{old('email',$settings->email)}}" placeholder="@lang('main.settings.email')" required>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card basic">
            <div class="card-body">
                <img src="{{ url('/dashboard') }}/dist/img/phone.png" alt="" width="48">
                <label for="phone" class="form-label">@lang('main.settings.phone')<span class="text-danger">*</span></label>
                <input type="text" class="form-control mt-2" maxlength="10" id="phone" name="phone" value="{{old('phone',$settings->phone)}}" placeholder="@lang('main.settings.phone')" required>
            </div>
        </div>
    </div>
    <div class="col d-none">
        <div class="card basic">
            <div class="card-body">
                <img src="{{ url('/dashboard') }}/dist/img/location.png" alt="" width="48">
                <label for="address_link" class="form-label">address_link<span class="text-danger">*</span></label>
                <input type="text" class="form-control mt-2" id="address_link" name="address_link" value="{{old('address_link')}}" placeholder="@lang('main.settings.address_link')" >
            </div>
        </div>
    </div>
    
    <div class="col">
        <div class="card basic">
            <div class="card-body">
                <img src="{{ url('/dashboard') }}/dist/img/location.png" alt="" width="48">
                <label for="address_ar" class="form-label">@lang('main.settings.address_ar')<span class="text-danger">*</span></label>
                <input type="text" class="form-control mt-2" id="address_ar" name="address_ar" value="{{old('address_ar',$settings->address_ar)}}" placeholder="@lang('main.settings.address_ar')" >
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card basic">
            <div class="card-body">
                <img src="{{ url('/dashboard') }}/dist/img/location.png" alt="" width="48">
                <label for="address_en" class="form-label">@lang('main.settings.address_en')<span class="text-danger">*</span></label>
                <input type="text" class="form-control mt-2" id="address_en" name="address_en" value="{{old('address_en',$settings->address_en)}}" placeholder="@lang('main.settings.address_en')" >
            </div>
        </div>
    </div>
</div> 
<hr>
<h2 class="my-3 fs-6 fw-bold">وسائل التواصل الاجتماعي</h2>
<div class="row g-2 g-md-3 row-cols-2 row-cols-lg-4">
    <div class="col">
        <div class="card basic">
            <div class="card-body">
                <img src="{{ url('/dashboard') }}/dist/img/facebook.png" alt="" width="48">
                <input type="url" class="form-control mt-2" id="facebook_link" name="facebook_link" placeholder="@lang('main.settings.facebook_link')" value="{{old('facebook_link',$social_settings->facebook_link)}}">
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card basic">
            <div class="card-body">
                <img src="{{ url('/dashboard') }}/dist/img/x.png" alt="" width="48">
                <input type="url" class="form-control mt-2" id="twitter_link" name="twitter_link" placeholder="@lang('main.settings.twitter_link')" value="{{old('twitter_link',$social_settings->twitter_link)}}">
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card basic">
            <div class="card-body">
                <img src="{{ url('/dashboard') }}/dist/img/snapchat.png" alt="" width="48">
                <input type="url" class="form-control mt-2" id="snapchat_link" name="snapchat_link" placeholder="@lang('main.settings.snapchat_link')" value="{{old('snapchat_link',$social_settings->snapchat_link)}}">
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card basic">
            <div class="card-body">
                <img src="{{ url('/dashboard') }}/dist/img/youtube.png" alt="" width="48">
                <input type="url" class="form-control mt-2" id="youtube_link" name="youtube_link" placeholder="@lang('main.settings.youtube_link')" value="{{old('youtube_link',$social_settings->youtube_link)}}">
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card basic">
            <div class="card-body">
                <img src="{{ url('/dashboard') }}/dist/img/linkedin.png" alt="" width="48">
                <input type="url" class="form-control mt-2" id="linkedin_link" name="linkedin_link" placeholder="@lang('main.settings.linkedin_link')" value="{{old('linkedin_link',$social_settings->linkedin_link)}}">
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card basic">
            <div class="card-body">
                <img src="{{ url('/dashboard') }}/dist/img/tiktok.png" alt="" width="48">
                <input type="url" class="form-control mt-2" id="tiktok_link" name="tiktok_link" placeholder="@lang('main.settings.tiktok_link')" value="{{old('tiktok_link',$social_settings->tiktok_link)}}">
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card basic">
            <div class="card-body">
                <img src="{{ url('/dashboard') }}/dist/img/instagram.png" alt="" width="48">
                <input type="url" class="form-control mt-2" id="instagram_link" name="instagram_link" placeholder="@lang('main.settings.instagram_link')" value="{{old('instagram_link',$social_settings->instagram_link)}}">
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card basic">
            <div class="card-body">
                <img src="{{ url('/dashboard') }}/dist/img/whatsapp.png" alt="" width="48">
                <input type="text" class="form-control mt-2" id="whatsapp_phone" maxlength="10" name="whatsapp_phone" value="{{old('whatsapp_phone',$settings->whatsapp_phone)}}" placeholder="@lang('main.settings.whatsapp_phone')">
            </div>
        </div>
    </div>
</div>
<hr>

@endif 
@if(request('q') == 'bank_data')
<!-- Bank account -->
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="bank_name" class="form-label">@lang('main.settings.bank_name')</label>
            <input type="text" class="form-control" id="bank_name" name="bank_name" value="{{old('bank_name')}}" >
       </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="bank_account_name" class="form-label">@lang('main.settings.bank_account_name')</label>
            <input type="text" class="form-control" id="bank_account_name" name="bank_account_name" value="{{old('bank_account_name')}}" >
       </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="iban_number" class="form-label">@lang('main.settings.iban_number')</label>
            <input type="text" class="form-control" id="iban_number" name="iban_number" value="{{old('iban_number')}}" >
       </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="bank_account_number" class="form-label">@lang('main.settings.bank_account_number')</label>
            <input type="text" class="form-control" id="bank_account_number" name="bank_account_number" value="{{old('bank_account_number')}}" >
       </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="instapay_number" class="form-label">@lang('main.settings.instapay_number')</label>
            <input type="text" class="form-control" id="instapay_number" name="instapay_number" value="{{old('instapay_number')}}" required>
       </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="vodafone_cash_number" class="form-label">@lang('main.settings.vodafone_cash_number')</label>
            <input type="text" class="form-control" id="vodafone_cash_number" name="vodafone_cash_number" value="{{old('vodafone_cash_number')}}" required>
       </div>
    </div>
</div>   
@endif




@if(request('q') == 'card_control')
<!-- Bank account -->
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="card_text_a" class="form-label">@lang('main.settings.card_text_a')</label>
            <input type="text" class="form-control" id="card_text_a" name="card_text_a" value="{{old('card_text_a', $settings->card_text_a)}}" >
       </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="card_text_b" class="form-label">@lang('main.settings.card_text_b')</label>
            <input type="text" class="form-control" id="card_text_b" name="card_text_b" value="{{old('card_text_b', $settings->card_text_b)}}" >
       </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="card_text_c" class="form-label">@lang('main.settings.card_text_c')</label>
            <input type="text" class="form-control" id="card_text_c" name="card_text_c" value="{{old('card_text_c', $settings->card_text_c)}}" >
       </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="card_text_d" class="form-label">@lang('main.settings.card_text_d')</label>
            <input type="text" class="form-control" id="card_text_d" name="card_text_d" value="{{old('card_text_d', $settings->card_text_d)}}" >
       </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3 form-check form-switch">
            <input type="checkbox" class="form-check-input" id="aqar_screen_control" name="aqar_screen_control"
                value="1" {{ old('aqar_screen_control', $settings->aqar_screen_control) ? 'checked' : '' }}>
            <label class="form-check-label" for="aqar_screen_control">@lang('main.settings.aqar_screen_control')</label>
        </div>
    </div>

</div>   
@endif
<div class="order-action mt-4 d-flex gap-3">                
    <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm"><i class="fa-regular fa-floppy-disk"></i> @lang('main.save')</button>
    <button type="reset" class="btn btn-danger px-5 rounded-pill shadow-sm"><i class="fa-solid fa-rotate-left"></i> @lang('main.reset')</button>
</div>