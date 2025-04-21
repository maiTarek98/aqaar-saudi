<input type="number" name="admin_id" value="{{ id('admin') }}" class="form-control" hidden>
<div class="row g-3"> 
   
    <div class="col-md-6">                      
        <div class="form-group">
            <label class="float-start">@lang('main.pages.title') (@lang('main.ar')) <span class="text-danger">*</span></label>
            <input type="text" name="title_ar" value="{{ old('title_ar', $item->title_ar) }}" class="form-control @error('title_ar') is-invalid @enderror" id="title_ar" placeholder="" required>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-6">                      
        <div class="form-group">
            <label class="float-start">@lang('main.pages.title') (@lang('main.en')) <span class="text-danger">*</span></label>
            <input type="text" name="title_en" value="{{ old('title_en', $item->title_en) }}" class="form-control @error('title_en') is-invalid @enderror" id="title_en" placeholder="" required>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-12">                      
    <div class="form-group">
        <label class="float-right">@lang('main.pages.content') (@lang('main.ar'))</label>
        <textarea type="text" name="content_ar" class="form-control @error('content_ar') is-invalid @enderror" id="content_ar">{{ old('content_ar', $item->content_ar) }}</textarea>
        <div class="help-block with-errors"></div>
    </div>
</div>
<div class="col-md-12">                      
    <div class="form-group">
        <label class="float-right">@lang('main.pages.content') (@lang('main.en'))</label>
        <textarea type="text" name="content_en" class="form-control @error('content_en') is-invalid @enderror" id="content_en">{{ old('content_en', $item->content_en) }}</textarea>
        <div class="help-block with-errors"></div>
    </div>
</div>
<div class="col-md-12">                      
                    <div class="form-group">
                        <label class="float-right">@lang('main.pages.status') <span class="text-danger">*</span></label>
                        <select name="status" class="form-control">
                            <option value="show" {{ $item->status == 'show' ? 'selected' : '' }}>@lang('main.pages.published')</option>
                            <option value="hide" {{ $item->status == 'hide' ? 'selected' : '' }}>@lang('main.pages.inactive')</option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>  
</div>                            
<div class="order-action mt-4 d-flex gap-3">                
    <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm"><i class="fa-regular fa-floppy-disk"></i> @lang('main.save')</button>
    <button type="reset" class="btn btn-danger px-5 rounded-pill shadow-sm"><i class="fa-solid fa-rotate-left"></i> @lang('main.reset')</button>
</div>