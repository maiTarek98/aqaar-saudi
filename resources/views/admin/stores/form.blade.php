<input type="number" name="added_by" value="{{ id('admin') }}" class="form-control" hidden>
<div class="row g-3">    
    
    <div class="col-7 col-lg-auto">
        <div class="box-wrapper">
            <label for="stores_image" class="form-label">@lang('main.stores.stores_image') <span class="text-danger">*</span></label>
            <div class="box">
                <div class="js--image-preview">
                    @if($item->getFirstMediaUrl('stores_image','thumb'))
                        <img src="{{$item->getFirstMediaUrl('stores_image','thumb')}}">
                    @endif
                </div>
                <div class="upload-options">
                    <label>
                        <input type="file" id="stores_image" name="stores_image" class="image-upload" accept="image/*" />
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="m-0 col-lg-6"></div>

    <div class="col-md-6"> 
        <div class="form-group">
            <label for="">
                @lang('main.stores.user_id') <span class="text-danger">*</span>
            </label>
            <div class="input-group">
                <select class="form-select" name="user_id">
                    <option value="" hidden>@lang('main.stores.user_id')</option>
                    @if(request()->route()->getName() == 'stores.edit')
                        @foreach(\App\Models\User::where('account_type','vendors')->whereHas('store')->get() as $value)
                        <option disabled value="{{$value->id}}" @if($value->id == $item->user_id || $value->id == request('user_id')) selected @endif>{{$value->name}}</option>
                        @endforeach
                    @else
                        @foreach(\App\Models\User::where('account_type','vendors')->whereDoesntHave('store')->get() as $value)
                        <option value="{{$value->id}}" @if($value->id == $item->user_id || $value->id == request('user_id')) selected @endif>{{$value->name}}</option>
                        @endforeach
                    @endif
                </select>
                <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="@lang('main.stores.create new vendor')">
                    <a role="button" data-bs-toggle="modal" data-bs-target="#acceptVendor">
                        <i class="fas fa-plus"></i>
                    </a>
                </span>
            </div>
        </div>                     
        <div class="help-block with-errors"></div>
    </div>
    <div class="col-md-6">      
    @php $has_user =\App\Models\User::where('id', request('user_id'))->first(); 
    @endphp                
        <div class="form-group">
            <label>@lang('main.stores.name')<span class="text-danger">*</span></label>
            <input type="text" name="name" value="{{ ($has_user?->pending_vendor) ? $has_user->pending_vendor?->brand_name : old('name', $item->name) }}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="" required>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    

    <div class="col-md-12">                      
                    <div class="form-group">
                        <label class="float-right">@lang('main.stores.status') <span class="text-danger">*</span></label>
                        <select name="status" class="form-select">
                            <option value="show" {{ $item->status == 'show' ? 'selected' : '' }}>@lang('main.show')</option>
                            <option value="hide" {{ $item->status == 'hide' ? 'selected' : '' }}>@lang('main.hide')</option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>  
</div>                            
<div class="order-action mt-4 d-flex gap-3">                
    <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm"><i class="fa-regular fa-floppy-disk"></i> @lang('main.save')</button>
    <button type="reset" class="btn btn-danger px-5 rounded-pill shadow-sm"><i class="fa-solid fa-rotate-left"></i> @lang('main.reset')</button>
</div>
