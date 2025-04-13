 <input type="number" name="added_by" value="{{ id('admin') }}" class="form-control" hidden>

<div class="row g-3">  
    <div class="col-6 col-lg-auto">
        <div class="box-wrapper">
            <label for="commercial_registration_image" class="form-label">@lang('main.pending_vendors.commercial_registration_image') </label>
            <div class="box">
                <div class="js--image-preview">
                    @if($item->getFirstMediaUrl('commercial_registration_image','thumb'))
                        <img src="{{$item->getFirstMediaUrl('commercial_registration_image','thumb')}}">
                    @endif
                </div>
                <div class="upload-options">
                    <label>
                        <input type="file" id="commercial_registration_image" name="commercial_registration_image" class="image-upload" accept="image/*" />
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="m-0 col-lg-6"></div>   

    <div class="col-md-6">                      
        <div class="form-group">
            <label class="float-start">@lang('main.pending_vendors.full_name') <span class="text-danger">*</span></label>
            <input type="text" name="full_name" value="{{ old('full_name', $item->full_name) }}" class="form-control @error('full_name') is-invalid @enderror" id="full_name" placeholder="" required>
            <div class="help-block with-errors"></div>
        </div>
    </div>
   
    <div class="col-md-6">                      
        <div class="form-group">
            <label class="float-start">@lang('main.pending_vendors.shipping_address') <span class="text-danger">*</span></label>
            <input type="text" name="shipping_address" value="{{ old('shipping_address', $item->shipping_address) }}" class="form-control @error('shipping_address') is-invalid @enderror" id="shipping_address" placeholder="" required>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-6">                      
        <div class="form-group">
            <label class="float-start">@lang('main.pending_vendors.brand_name') <span class="text-danger">*</span></label>
            <input type="text" name="brand_name" value="{{ old('brand_name', $item->brand_name) }}" class="form-control @error('brand_name') is-invalid @enderror" id="brand_name" placeholder="" required>
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="col-md-6">                      
        <div class="form-group">
            <label class="float-start">@lang('main.pending_vendors.commercial_registration_no')</label>
            <input type="text" name="commercial_registration_no" value="{{ old('commercial_registration_no', $item->commercial_registration_no) }}" class="form-control @error('commercial_registration_no') is-invalid @enderror" id="commercial_registration_no" placeholder="" >
            <div class="help-block with-errors"></div>
        </div>
    </div>
    
    <div class="col-md-6">                      
        <div class="form-group">
            <label class="float-start">@lang('main.pending_vendors.mobile') <span class="text-danger">*</span></label>
            <input type="text" maxlength="10" name="mobile" value="{{ old('mobile', $item->mobile) }}" class="form-control @error('mobile') is-invalid @enderror" id="mobile" placeholder="" required>
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="col-md-6">                      
        <div class="form-group">
            <label class="float-start">@lang('main.pending_vendors.email') <span class="text-danger">*</span></label>
            <input type="text" name="email" value="{{ old('email', $item->email) }}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="" required>
            <div class="help-block with-errors"></div>
        </div>
    </div>
</div> 
                           
<div class="order-action mt-4 d-flex gap-3">                
    <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm"><i class="fa-regular fa-floppy-disk"></i> @lang('main.save')</button>
    <button type="reset" class="btn btn-danger px-5 rounded-pill shadow-sm"><i class="fa-solid fa-rotate-left"></i> @lang('main.reset')</button>
</div>