<input type="number" name="added_by" value="{{ id('admin') }}" class="form-control" hidden>
<div class="row g-3"> 
    @if(! request('parent_id'))
    <div class="col-7 col-lg-auto">
        <div class="box-wrapper">
            <label for="categorys_image" class="form-label">@lang('main.categorys.categorys_image') <span class="text-danger">*</span></label>
            <div class="box">
                <div class="js--image-preview">
                    @if($item->getFirstMediaUrl('categorys_image','thumb'))
                        <img src="{{$item->getFirstMediaUrl('categorys_image','thumb')}}">
                    @endif
                </div>
                <div class="upload-options">
                    <label>
                        <input type="file" id="categorys_image" name="categorys_image" class="image-upload" accept="image/*" />
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="m-0 col-lg-6"></div>

   <div class="col-sm-6">
        <div class="form-group">
            <label for="status"> @lang('main.categorys.status')</label><span class="text-danger">*</span>
            <select name="status" class="form-select">
                <option value="show" @if($item->status == 'show') selected @endif>@lang('main.show')</option>
                <option value="hide" @if($item->status == 'hide') selected @endif>@lang('main.hide')</option>
            </select>
        </div>
    </div> 

   <div class="col-sm-6">
        <div class="form-group">
            <label for="in_home"> @lang('main.categorys.in_home')</label><span class="text-danger">*</span>
            <select name="in_home" class="form-select">
                <option value="yes" @if($item->in_home == 'yes') selected @endif>@lang('main.yes')</option>
                <option value="no" @if($item->in_home == 'no') selected @endif>@lang('main.no')</option>
            </select>
        </div>
    </div> 
    @endif
    @if(request('parent_id'))
    <div class="col-md-6">                      
        <div class="form-group">
            <label class="float-start">@lang('main.categorys.title') (@lang('main.ar')) <span class="text-danger">*</span></label>
            <select class="form-control" name="parent_id">
                <option value="">@lang('main.choose')</option>
                @foreach(\App\Models\Category::where('type','shop')->whereNull('parent_id')->get() as $value)
                <option value="{{$value->id}}" @if($value->id == $item->parent_id) selected @endif>{{$value->title}}</option>
                @endforeach
            </select>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    @endif
    <div class="col-md-6">                      
        <div class="form-group">
            <label class="float-start">@lang('main.categorys.title') (@lang('main.ar')) <span class="text-danger">*</span></label>
            <input type="text" name="title_ar" value="{{ old('title_ar', $item->title_ar) }}" class="form-control @error('title_ar') is-invalid @enderror" id="title_ar" placeholder="" required>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-6">                      
        <div class="form-group">
            <label class="float-start">@lang('main.categorys.title') (@lang('main.en')) <span class="text-danger">*</span></label>
            <input type="text" name="title_en" value="{{ old('title_en', $item->title_en) }}" class="form-control @error('title_en') is-invalid @enderror" id="title_en" placeholder="" required>
            <div class="help-block with-errors"></div>
        </div>
    </div>

</div>                            
<div class="order-action mt-4 d-flex gap-3">                
    <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm"><i class="fa-regular fa-floppy-disk"></i> @lang('main.save')</button>
    <button type="reset" class="btn btn-danger px-5 rounded-pill shadow-sm"><i class="fa-solid fa-rotate-left"></i> @lang('main.reset')</button>
</div>