<div class="card">
    <div class="card-body">
        <input type="number" name="added_by" value="{{ id('admin') }}" class="form-control" hidden>
        <div class="row g-3"> 
            <div class="col-7 col-lg-auto">
                <div class="box-wrapper">
                    <label for="brands_image" class="form-label">@lang('main.brands.brands_image') <span class="text-danger">*</span></label>
                    <div class="box">
                        <div class="js--image-preview">
                            @if($item->getFirstMediaUrl('brands_image','thumb'))
                                <img src="{{$item->getFirstMediaUrl('brands_image','thumb')}}">
                            @endif
                        </div>
                        <div class="upload-options">
                            <label>
                                <input type="file" id="brands_image" name="brands_image" class="image-upload" accept="image/*" />
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-0 col-lg-6"></div>
            
        
           <div class="col-sm-6">
                <div class="form-group">
                    <label for="status"> @lang('main.brands.status')</label><span class="text-danger">*</span>
                    <select name="status" class="form-select">
                        <option value="show" @if($item->status == 'show') selected @endif>@lang('main.show')</option>
                        <option value="hide" @if($item->status == 'hide') selected @endif>@lang('main.hide')</option>
                    </select>
                </div>
            </div> 
        
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="in_home"> @lang('main.brands.in_home')</label><span class="text-danger">*</span>
                    <select name="in_home" class="form-select">
                        <option value="yes" @if($item->in_home == 'yes') selected @endif>@lang('main.yes')</option>
                        <option value="no" @if($item->in_home == 'no') selected @endif>@lang('main.no')</option>
                    </select>
                </div>
            </div> 
           
            <div class="col-md-6">                      
                <div class="form-group">
                    <label class="float-start">@lang('main.brands.title') (@lang('main.ar')) <span class="text-danger">*</span></label>
                    <input type="text" name="title_ar" value="{{ old('title_ar', $item->title_ar) }}" class="form-control @error('title_ar') is-invalid @enderror" id="title_ar" placeholder="" required>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6">                      
                <div class="form-group">
                    <label class="float-start">@lang('main.brands.title') (@lang('main.en')) <span class="text-danger">*</span></label>
                    <input type="text" name="title_en" value="{{ old('title_en', $item->title_en) }}" class="form-control @error('title_en') is-invalid @enderror" id="title_en" placeholder="" required>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        
        </div>                            

        <div class="order-action mt-4 d-flex gap-3">                
            <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm"><i class="fa-regular fa-floppy-disk"></i> @lang('main.save')</button>
            <button type="reset" class="btn btn-danger px-5 rounded-pill shadow-sm"><i class="fa-solid fa-rotate-left"></i> @lang('main.reset')</button>
        </div>
    </div>
 </div>
