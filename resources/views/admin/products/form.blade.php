<input type="number" name="added_by" value="{{ Auth::guard('admin')->user()->id }}" class="form-control" hidden>
<div class="row g-3 mb-4"> 
    <input type="hidden" name="page" value="{{ request('page') }}" class="form-control">

    @if(\Route::currentRouteName() == 'products.edit')
    <input type="hidden" class="product_id" value="{{$product->id}}">
    @endif
    <input type="checkbox" name="agree" value="1" checked style="display: none;">
    <input type="hidden" name="status" @if(request('form_type') == 'site_property') value="shared_onsite" @else value="pending" @endif class="form-control" hidden>
    <input type="hidden" name="form_type" value="{{ request('form_type') }}" class="form-control">

    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title">@lang('main.products.product_values')</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm p-0 px-1 btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">   
                <div class="row g-3">
                    <div class="col-lg-7">
                        <div class="box-wrapper">
                            <label for="categorys_image" class="form-label">@lang('main.products.products_image') </label>
                            <div class="box">
                                <div class="js--image-preview">
                                    @if($product->getFirstMediaUrl('products_image','thumb'))
                                    <img loading="lazy" class="cursor-img" data-toggle="modal" data-target="#exampleModal{{ $product->id }}" id="image" src="{{$product->getFirstMediaUrl('products_image','thumb')}}" alt="@lang('main.NoImageUploaded')">
                                    @include('admin.components.modal_photo', [
                                    'image' => $product->getFirstMediaUrl('products_image','thumb'),
                                    'id' => $product->id,
                                    ])
                                    @endif
                                </div>
                                <div class="upload-options">
                                    <label>
                                        <input type="file" id="products_image" name="products_image" class="image-upload" accept="image/*" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                    {{--<div class="col-md-12">                      
                        <div class="form-group">
                            <label>@lang('main.products.status') </label>
                            <select name="status" class="form-select">
                                <option value="pending" {{ $product->status == 'pending' ? 'selected' : '' }}>@lang('main.products.pending')</option>
                                <option value="shared_onsite" {{ $product->status == 'shared_onsite' ? 'selected' : '' }}>@lang('main.products.shared_onsite')</option>
                                <option value="approved" {{ $product->status == 'approved' ? 'selected' : '' }}>@lang('main.products.approved')</option>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>  

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="is_private"> @lang('main.products.is_private')</label>
                            <select name="is_private" class="form-select">
                                <option value="1" @if($product->is_private == '1') selected @endif>@lang('main.yes')</option>
                                <option value="0" @if($product->is_private == '0') selected @endif>@lang('main.no')</option>
                            </select>
                        </div>
                    </div> --}}
                    @if(request('form_type') == 'site_property')
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="in_home"> @lang('main.products.in_home')</label>
                            <select name="in_home" class="form-select">
                                <option value="yes" @if($product->in_home == 'yes') selected @endif>@lang('main.yes')</option>
                                <option value="no" @if($product->in_home == 'no') selected @endif>@lang('main.no')</option>
                            </select>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>  
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title">@lang('main.products.product_address')</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm p-0 px-1 btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">    
                <div class="row g-3">
                    @php
                        $district = \App\Models\Location::find($product->area_id);
                        $city = $district?->parent;
                        $governorate = $city?->parent;

                        $selectedDistrict = $district?->id;
                        $selectedCity = $city?->id;
                        $selectedGovernorate = $governorate?->id;

                        $cities = $governorate 
                            ? \App\Models\Location::where('parent_id', $governorate->id)->where('type', 'city')->get()
                            : collect();

                        $districts = $city 
                            ? \App\Models\Location::where('parent_id', $city->id)->where('type', 'district')->get()
                            : collect();
                    @endphp

                    <div class="col-md-4">
                        <label>@lang('main.locations.governorate')</label>
                        <select name="" id="governorate_select" class="form-select">
                            <option value="">@lang('main.choose')</option>
                            @foreach(getGovernorates() as $gov)
                                <option value="{{ $gov->id }}" {{ (old('governorate_id', $product->area?->parent?->parent?->id ?? '') == $gov->id) ? 'selected' : '' }}>
                                    {{ $gov->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-4">
                        <label>@lang('main.locations.city')</label>
                        <select name="" id="city_select" class="form-select">
                            <option value="">@lang('main.choose')</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ (old('city_id', $product->area?->parent?->id ?? '') == $city->id) ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-4">
                        <label>@lang('main.locations.district')</label>
                        <select name="district_id" id="district_select" class="form-select">
                            <option value="">@lang('main.choose')</option>
                            @foreach($districts as $dist)
                                <option value="{{ $dist->id }}" {{ ($selectedDistrict == $dist->id) ? 'selected' : '' }}>
                                    {{ $dist->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if(request('form_type') == 'site_property')
                    <div class="col-md-12">                      
                        <div class="form-group">
                            <label>@lang('main.products.price')</label>
                            <input type="text" name="price" value="{{ old('price', $product->price) }}" class="form-control @error('price') is-invalid @enderror">
                        </div>
                    </div>
                    @endif
                    <div class="col-md-12">                      
                        <div class="form-group">
                            <label>@lang('main.products.map_location')</label>
                            <textarea type="text" name="map_location" class="form-control @error('map_location') is-invalid @enderror" id="map_location">{{ old('map_location', $product->map_location) }}</textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>                             
            </div>
        </div>                        
    </div>
    <div class="col-lg-8">
        @if(request('form_type') != 'site_property' && \Route::currentRouteName() == 'products.edit')
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title">بيانات صاحب الطلب</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm p-0 px-1 btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body row g-3">
                <div id="user-added-message">
                    اسم المستخدم : {{$product->admin?->name}}, رقم الجوال : <a href="tel:{{$product->admin?->mobile}}">{{$product->admin?->mobile}}</a>
                </div>
            </div>
        </div>
        @endif
        @if(request('form_type') != 'site_property' && \Route::currentRouteName() == 'products.create')
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title">بيانات صاحب الطلب</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm p-0 px-1 btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body row g-3">
                <div id="user-added-message"></div>
                <input type="hidden" name="added_by_user" id="main-id" value="">
                @php $request_data = $product->request_data; @endphp
                <div class="col-md-12 user_data">
                    <label>هل تريد إضافة مستخدم جديد؟</label>
                    <select id="userOption" class="form-control">
                        <option value="exist">أدخل بيانات مستخدم</option>
                        <option value="new">إضافة مستخدم جديد</option>
                    </select>
                </div>
                <div id="existingUserFields" class="card-body row g-3 mt-3">
                    <div class="col-md-12">                      
                        <div class="form-group">
                            <label>@lang('main.users.name')<span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $request_data['name'] ?? null) }}" class="form-control @error('name') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-md-12">                      
                        <div class="form-group">
                            <label>@lang('main.users.mobile')</label>
                            <input type="text" name="mobile" value="{{ old('mobile', $request_data['mobile'] ?? null) }}" class="form-control @error('mobile') is-invalid @enderror">
                        </div>
                    </div>
                </div>
                <div id="addUserButton" class="mt-3" style="display: none;">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        إضافة مستخدم جديد
                    </button>
                </div>
               
            </div>
        </div>
        @endif
        <div class="card my-3">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title">@lang('main.products.product_informations')</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm p-0 px-1 btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body row g-3">
             
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="product_for">
                            @lang('main.products.product_for')
                        </label>
                        <div class="input-group">
                            <select name="product_for" class="form-select">
                                <option value="">@lang('main.choose')</option>
                                <option value="sale" @if('sale' == old('product_for', $product->product_for)) selected @endif > @lang('main.products.sale')</option>
                                <option value="rent" @if('rent' == old('product_for', $product->product_for)) selected @endif > @lang('main.products.rent')</option>
                            </select>
                        </div>
                    </div>
                </div>
                @if(request('form_type') != 'site_property')
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="type">
                            @lang('main.products.type')
                        </label>
                        <div class="input-group">
                            <select name="type" id="product_type" class="form-select">
                                <option value="">@lang('main.choose')</option>
                                <option value="auction" @if('auction' == old('type', $product->type)) selected @endif >@lang('main.products.auction')</option>
                                <option value="shared" @if('shared' == old('type', $product->type)) selected @endif >@lang('main.products.shared')</option>
                                <option value="investment" @if('investment' == old('type', $product->type)) selected @endif >@lang('main.products.investment')</option>
                            </select>
                        </div>
                    </div>
                </div>
                @endif
                <div class="col-md-4 auction-fields">                      
                    <div class="form-group">
                        <label>@lang('main.products.start_date')</label>
                        <input type="date" name="start_date" value="{{ old('start_date', $product->start_date) }}" class="form-control @error('start_date') is-invalid @enderror" id="start_date">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-4 auction-fields">                      
                    <div class="form-group">
                        <label>@lang('main.products.end_date')</label>
                        <input type="date" name="end_date" value="{{ old('end_date', $product->end_date) }}" class="form-control @error('end_date') is-invalid @enderror" id="end_date">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4 shared-fields">                      
                    <div class="form-group">
                        <label>@lang('main.products.amount_shared')</label>
                        <input type="text" name="price_shared" value="{{ old('price', $product->price) }}" class="form-control @error('price') is-invalid @enderror" id="price">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4 auction-fields">                      
                    <div class="form-group">
                        <label>@lang('main.products.amount')</label>
                        <input type="text" name="price_auction" value="{{ old('price', $product->price) }}" class="form-control @error('price') is-invalid @enderror" id="price">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-4 investment-fields">                      
                    <div class="form-group">
                        <label>@lang('main.products.amount_investment')</label>
                        <input type="text" name="price_investment" value="{{ old('price', $product->price) }}" class="form-control @error('price') is-invalid @enderror" id="price">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label>@lang('main.products.investment_min')</label>
                        <input type="number" name="investment_min" value="{{ old('investment_min', $product->investment_min) }}" class="form-control @error('investment_min') is-invalid @enderror" id="investment_min">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">                      
                    <div class="form-group">
                        <label>@lang('main.products.title')<span class="text-danger">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $product->title) }}" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="" >
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">                      
                    <div class="form-group">
                        <label>@lang('main.products.description')</label>
                        <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description">{{ old('description', $product->description) }}</textarea>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
               
            </div>
        </div>
        <div class="card my-3">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title">@lang('main.products.products_images')</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm p-0 px-1 btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="upload-wrapper mb-3">
                    <div class="upload__box">
                        <div class="upload__btn-box">
                            <button type="button" class="upload__btn d-inline-block">
                                <i class="bi bi-cloud-upload text-muted fs-1"></i>
                                <h5 class="upload__box_title">
                                Drag and Drop Your Files to Start Transfer
                                </h5>
    
                                <p class="upload__box_text text-muted m-0">Or click here</p>
                                <input type="file" accept="images/*" name="document[]" multiple="" data-max_length="20" class="upload__inputfile">
                            </button>
                        </div>
                        
                        <div class="upload__img-wrap row g-3 row-cols-lg-5">
                            @if($product->getFirstMediaUrl('document','thumb'))
                                @foreach($product->getMedia('document') as $key => $media)
                                <?php $imageUrl=url('/storage/products_images/'.$media->id.'/'.$media->file_name);?>
                                <div class="col">
                                    <div class='upload__img-box'>
                                        <div 
                                        data-number='{{$key+1}}' 
                                        data-file='{{$media->file_name}}' 
                                        class='img-bg'>
                                            <div class='upload__img-close'></div>
                                            <img src="{{$imageUrl}}" >
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>@lang('main.products.link_video')</label>
                    <textarea type="text" name="link_video" class="form-control @error('link_video') is-invalid @enderror" id="link_video">{{ old('link_video', $product->link_video) }}</textarea>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title">@lang('main.products.product_descriptions')</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm p-0 px-1 btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">    
                <div class="row g-3">
                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.plan_number')</label>
                            <input type="text" name="plan_number" value="{{ old('plan_number', $product->feature?->plan_number) }}" class="form-control @error('plan_number') is-invalid @enderror" id="plan_number" placeholder="" >
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.plot_number')</label>
                            <input type="text" name="plot_number" value="{{ old('plot_number', $product->feature?->plot_number) }}" class="form-control @error('plot_number') is-invalid @enderror" id="plot_number" placeholder="" >
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.area')</label>
                            <input type="number" min="1" step="1" name="area" value="{{ old('area', $product->feature?->area) }}" class="form-control @error('area') is-invalid @enderror" id="area" placeholder="" >
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.area_after_development')</label>
                            <input type="number" min="1" step="1" name="area_after_development" value="{{ old('area_after_development', $product->feature?->area_after_development) }}" class="form-control @error('area_after_development') is-invalid @enderror" id="area_after_development" placeholder="" >
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.valuation')</label>
                            <input type="number" min="1" step="1" name="valuation" value="{{ old('valuation', $product->feature?->valuation) }}" class="form-control @error('valuation') is-invalid @enderror" id="valuation" placeholder="" >
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.valuation_date')</label>
                            <input type="date" name="valuation_date" value="{{ old('valuation_date', $product->feature?->valuation_date) }}" class="form-control @error('valuation_date') is-invalid @enderror" id="valuation_date" placeholder="" >
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.annual_rent')</label>
                            <input type="number" min="1" step="1" name="annual_rent" value="{{ old('annual_rent', $product->feature?->annual_rent) }}" class="form-control @error('annual_rent') is-invalid @enderror" id="annual_rent" placeholder="" >
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    @if(request('form_type') != 'site_property')
                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.represented_by') </label>
                            <select name="represented_by" class="form-select">
                                <option value="owner" {{ $product->feature?->represented_by == 'owner' ? 'selected' : '' }}>@lang('main.products.owner')</option>
                                <option value="agent" {{ $product->feature?->represented_by == 'agent' ? 'selected' : '' }}>@lang('main.products.agent')</option>
                                <option value="co-owner" {{ $product->feature?->represented_by == 'co-owner' ? 'selected' : '' }}>@lang('main.products.co-owner')</option>
                                <option value="other" {{ $product->feature?->represented_by == 'other' ? 'selected' : '' }}>@lang('main.products.other')</option>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div> 
                    @endif
                        <div class="form-group mb-4" id="sak_number_wrapper" style="display:none">
                            <label for="">@lang('main.users.sak_number')</label>
                            <input type="text" maxlength="10" name="sak_number" value="{{$product->feature?->sak_number}}" class="form-control @error('sak_number') is-invalid @enderror" id="sak_number" placeholder="@lang('main.users.sak_number')">
                            <span class="text-danger error-msg sak_number"></span>
                        </div>
        
                        <div class="form-group mb-4" id="agency_number_wrapper" style="display:none">
                            <label for="">@lang('main.users.agency_number')</label>
                            <input type="text" maxlength="10" name="agency_number" value="{{$product->feature?->agency_number}}" class="form-control @error('agency_number') is-invalid @enderror" id="agency_number" placeholder="@lang('main.users.agency_number')">
                            <span class="text-danger error-msg agency_number"></span>
                        </div>
                        <div class="form-group mb-4" id="val_number_wrapper" style="display:none">
                            <label for="">@lang('main.users.val_number')</label>
                            <input type="text"  name="val_number" value="{{$product->feature?->val_number}}" class="form-control @error('val_number') is-invalid @enderror" id="val_number" placeholder="@lang('main.users.val_number')">
                            <span class="text-danger error-msg val_number"></span>
                        </div>
                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.product_type') </label>
                            <select name="product_type" class="form-select">
                                <option value="residential" {{ $product->product_type == 'residential' ? 'selected' : '' }}>@lang('main.products.residential')</option>
                                <option value="commercial" {{ $product->product_type == 'commercial' ? 'selected' : '' }}>@lang('main.products.commercial')</option>
                                <option value="two" {{ $product->product_type == 'two' ? 'selected' : '' }}>@lang('main.products.two')</option>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>


                    {{--<div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.owner_type') </label>
                            <select name="owner_type" class="form-select">
                                <option value="individual" {{ $product->owner_type == 'individual' ? 'selected' : '' }}>@lang('main.products.individual')</option>
                                <option value="company" {{ $product->owner_type == 'company' ? 'selected' : '' }}>@lang('main.products.company')</option>
                                <option value="other" {{ $product->owner_type == 'other' ? 'selected' : '' }}>@lang('main.products.other')</option>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div> --}}
                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.remaining_lease_years')</label>
                            <input type="text" name="remaining_lease_years" value="{{ old('remaining_lease_years', $product->feature?->remaining_lease_years) }}" class="form-control @error('remaining_lease_years') is-invalid @enderror" id="remaining_lease_years" placeholder="" >
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.license_number')</label>
                            <input type="text" name="license_number" value="{{ old('license_number', $product->feature?->license_number) }}" class="form-control @error('license_number') is-invalid @enderror" id="license_number" placeholder="" >
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    
                    {{--<div class="col-md-4">  
                        <hr class="mt-0">                    
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <label>@lang('main.products.has_planning_diagram') </label>
                                <input type="checkbox" value="1" class="cm-toggle" id="" name="has_planning_diagram" {{ old('has_planning_diagram', optional($product->feature ?? null)->has_planning_diagram) ? 'checked' : '' }}>     
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <hr class="mt-0">                    
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <label>@lang('main.products.has_survey_decision') </label>
                                <input type="checkbox" value="1" class="cm-toggle" id="" name="has_survey_decision" {{ old('has_survey_decision', optional($product->feature ?? null)->has_survey_decision) ? 'checked' : '' }}>     
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <hr class="mt-0">                    
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <label>@lang('main.products.has_electronic_deed') </label>
                                <input type="checkbox" value="1" class="cm-toggle" id="" name="has_electronic_deed" {{ old('has_electronic_deed', optional($product->feature ?? null)->has_electronic_deed) ? 'checked' : '' }}>     
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <hr class="mt-0">                    
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <label>@lang('main.products.has_real_estate_market') </label>
                                <input type="checkbox" value="1" class="cm-toggle" id="" name="has_real_estate_marke"  {{ old('has_real_estate_marke', optional($product->feature ?? null)->has_real_estate_marke) ? 'checked' : '' }}>     
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <hr class="mt-0">                    
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <label>@lang('main.products.has_mortgage') </label>
                                <input type="checkbox" value="1" class="cm-toggle" id="" name="has_mortgage" {{ old('has_mortgage', optional($product->feature ?? null)->has_mortgage) ? 'checked' : '' }}>     
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <hr class="mt-0">                    
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <label>@lang('main.products.has_penalties') </label>
                                <input type="checkbox" value="1" class="cm-toggle" id="" name="has_penalties" {{ old('has_penalties', optional($product->feature ?? null)->has_penalties) ? 'checked' : '' }}>     
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>-}}

                    <div class="col-md-12">                      
                        <div class="form-group">
                            <label>@lang('main.products.penalty_type') </label>
                            <select name="penalty_type" class="form-select">
                                <option value="cash" {{ $product->penalty_type == 'cash' ? 'selected' : '' }}>@lang('main.products.cash')</option>
                                <option value="installment" {{ $product->penalty_type == 'installment' ? 'selected' : '' }}>@lang('main.products.installment')</option>
                                <option value="cash_installment" {{ $product->penalty_type == 'cash_installment' ? 'selected' : '' }}>@lang('main.products.cash_installment')</option>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div> 
                    {{--<div class="col-md-4">  
                        <hr class="mt-0">                    
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <label>@lang('main.products.valuation_type') </label>
                                <input type="checkbox" value="1" class="cm-toggle" id="" name="valuation_type" {{ old('valuation_type', optional($product->feature ?? null)->valuation_type) ? 'checked' : '' }}>     
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <hr class="mt-0">                    
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <label>@lang('main.products.accepts_mortgage') </label>
                                <input type="checkbox" value="1" class="cm-toggle" id="" name="accepts_mortgage" {{ old('accepts_mortgage', optional($product->feature ?? null)->accepts_mortgage) ? 'checked' : '' }}>     
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <hr class="mt-0">                    
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <label>@lang('main.products.usufruct_lease') </label>
                                <input type="checkbox" value="1" class="cm-toggle" id="" name="usufruct_lease"
                                {{ old('usufruct_lease', optional($product->feature ?? null)->usufruct_lease) ? 'checked' : '' }}>     
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <hr class="mt-0">                    
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <label>@lang('main.products.is_rented') </label>
                                <input type="checkbox" value="1" class="cm-toggle" id="" name="is_rented" {{ old('is_rented', optional($product->feature ?? null)->is_rented) ? 'checked' : '' }}>     
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>--}}
                    <div class="col-12">
                        <div class="row row-cols-1 row-cols-lg-3">
                        @php
                            if(old('features')) {
                                $selectedFeatures = old('features');
                            } elseif(isset($product) && $product->feature) {
                                $selectedFeatures = $product->feature->features ?? [];
                            } else {
                                $selectedFeatures = [];
                            }
                        @endphp
                        @foreach(getFeatures() as $feature)
                            <div class="col">
                                <label class="d-block">{{$feature->label_name}} </label>
                                <input
                                    type="radio"
                                    class="btn-check"
                                    name="features[{{ $feature->id }}]"
                                    id="yes_{{ $feature->id }}"
                                    value="1"
                                    autocomplete="off"
                                    {{ (isset($selectedFeatures[$feature->id]) && $selectedFeatures[$feature->id] == '1') ? 'checked' : '' }}
                                >
                                <label class="btn btn-sm btn-outline-success px-3" for="yes_{{ $feature->id }}">
                                    @lang('main.yes')
                                </label>
                
                                <input
                                    type="radio"
                                    class="btn-check"
                                    name="features[{{ $feature->id }}]"
                                    id="no_{{ $feature->id }}"
                                    value="0"
                                    autocomplete="off"
                                    {{ (isset($selectedFeatures[$feature->id]) && $selectedFeatures[$feature->id] == '0') ? 'checked' : '' }}
                                >
                                <label class="btn btn-sm btn-outline-danger px-3" for="no_{{ $feature->id }}">
                                    @lang('main.no')
                                </label>
                            </div>
                        @endforeach

                    </div>
                    </div>
                    <div class="col-md-12">                      
                        <div class="form-group">
                            <label>@lang('main.products.additional_info')</label>
                            <textarea type="text" name="additional_info" class="form-control @error('additional_info') is-invalid @enderror" id="additional_info">{{ old('additional_info', $product->feature?->additional_info) }}</textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>                             
            </div>
        </div>
    </div>
</div>

<div class="order-action mt-4 d-flex gap-3 justify-content-center">                
    <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm"><i class="fa-regular fa-floppy-disk"></i> @lang('main.save')</button>
    <button type="reset" class="btn btn-danger px-5 rounded-pill shadow-sm"><i class="fa-solid fa-rotate-left"></i> @lang('main.reset')</button>
</div>
@push('custom-js')
<script type="text/javascript">
   $(document).ready(function () {
    let selectedCityId = "{{ $selectedCity ?? '' }}";
    let selectedDistrictId = "{{ $selectedDistrict ?? '' }}";
    let selectedGovernorateId = "{{ $selectedGovernorate ?? '' }}";

    // إذا كان في محافظة مختارة مسبقاً (edit)
    if (selectedGovernorateId) {
        $('#city_select').html('<option value="">@lang("main.loading")...</option>');
        $.get('{{url('/')}}/locations/cities/' + selectedGovernorateId, function (data) {
            let cityOptions = '<option value="">@lang("main.choose")</option>';
            data.forEach(city => {
                let selected = (city.id == selectedCityId) ? 'selected' : '';
                cityOptions += `<option value="${city.id}" ${selected}>${city.name_ar}</option>`;
            });
            $('#city_select').html(cityOptions);

            // إذا كان في مدينة مختارة مسبقاً (edit)
            if (selectedCityId) {
                $('#district_select').html('<option value="">@lang("main.loading")...</option>');
                $.get('{{url('/')}}/locations/districts/' + selectedCityId, function (data) {
                    let distOptions = '<option value="">@lang("main.choose")</option>';
                    data.forEach(dist => {
                        let selected = (dist.id == selectedDistrictId) ? 'selected' : '';
                        distOptions += `<option value="${dist.id}" ${selected}>${dist.name_ar}</option>`;
                    });
                    $('#district_select').html(distOptions);
                });
            }
        });
    }

    // عند تغيير المحافظة
    $('#governorate_select').on('change', function () {
        let gov_id = $(this).val();
        $('#city_select').html('<option value="">@lang("main.loading")...</option>');
        $('#district_select').html('<option value="">@lang("main.choose")</option>');

        if (gov_id) {
            $.get('{{url('/')}}/locations/cities/' + gov_id, function (data) {
                let cityOptions = '<option value="">@lang("main.choose")</option>';
                data.forEach(city => {
                    cityOptions += `<option value="${city.id}">${city.name_ar}</option>`;
                });
                $('#city_select').html(cityOptions);
            });
        }
    });

    // عند تغيير المدينة
    $('#city_select').on('change', function () {
        let city_id = $(this).val();
        $('#district_select').html('<option value="">@lang("main.loading")...</option>');

        if (city_id) {
            $.get('{{url('/')}}/locations/districts/' + city_id, function (data) {
                let distOptions = '<option value="">@lang("main.choose")</option>';
                data.forEach(dist => {
                    distOptions += `<option value="${dist.id}">${dist.name_ar}</option>`;
                });
                $('#district_select').html(distOptions);
            });
        }
    });
});

    $(document).ready(function () {
        function toggleFields() {
            if ($('#product_type').val() === 'auction') {
                $('.auction-fields').show();
                $('.investment-fields').hide();
                $('.shared-fields').hide();
            }else if($('#product_type').val() === 'investment') {
                $('.investment-fields').show();
                $('.auction-fields').hide();
                $('.shared-fields').hide();
            } else if($('#product_type').val() === 'shared') {
                $('.auction-fields').hide();
                $('.investment-fields').hide();
                $('.shared-fields').show();
            } else {
                $('.auction-fields').hide();
                $('.investment-fields').hide();
                $('.shared-fields').hide();
            }
        }
        toggleFields();
        $('#product_type').on('change', function () {
            toggleFields();
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const userOption = document.getElementById('userOption');
        const existingFields = document.getElementById('existingUserFields');
        const addUserBtn = document.getElementById('addUserButton');

        function toggleFields() {
            if (userOption.value === 'new') {
                existingFields.style.display = 'none';
                addUserBtn.style.display = 'block';
            } else {
                existingFields.style.display = 'block';
                addUserBtn.style.display = 'none';
            }
        }

        userOption.addEventListener('change', toggleFields);
        toggleFields(); 
    });
    
$(document).ready(function() {
    $('#ajaxAddUserForm').on('submit', function(e) {
        e.preventDefault();

        let formData = $(this).serialize();
        let $form = $(this);

        $.ajax({
            url: '{{ route("users.ajax.store") }}',
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#addUserModal').modal('hide');
                $('#ajaxAddUserForm')[0].reset();
                $('#addUserErrors').addClass('d-none').empty();
                alert("تم إضافة المستخدم بنجاح");
                $('#main-id').val(response.id);

                $('#main-name').val(response.name);
                $('#main-mobile').val(response.mobile);
                $('.user_data').hide();
                $('#addUserButton').hide();
                $('#user-added-message').html(`
                    <div class="alert alert-success mt-2">
                        تم إدخال بيانات: <strong>${response.name}</strong> ورقم الجوال: <strong>${response.mobile}</strong>
                    </div>
                `);
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                let errorHtml = '<ul>';
                $.each(errors, function(key, value) {
                    errorHtml += '<li>' + value[0] + '</li>';
                });
                errorHtml += '</ul>';
                $('#addUserErrors').html(errorHtml).removeClass('d-none');
            }
        });
    });


});
     document.addEventListener('DOMContentLoaded', function () {
        const userTypeSelect = document.querySelector('[name="represented_by"]');
        const agencyWrapper = document.getElementById('agency_number_wrapper');
        const sakWrapper = document.getElementById('sak_number_wrapper');
        const valWrapper = document.getElementById('val_number_wrapper');
        const allWrappers = [agencyWrapper, sakWrapper, valWrapper];
        function hideAllWrappers() {
            allWrappers.forEach(wrapper => {
                if (wrapper) wrapper.style.display = 'none';
            });
        }
        function toggleAgencyField() {
            hideAllWrappers();
            switch (userTypeSelect.value) {
                case 'agent':
                    agencyWrapper && (agencyWrapper.style.display = 'block');
                    break;
                case 'owner':
                    sakWrapper && (sakWrapper.style.display = 'block');
                    break;
                case 'co-owner':
                case 'other':
                    valWrapper && (valWrapper.style.display = 'block');
                    break;
            }
        }
        toggleAgencyField();
        userTypeSelect.addEventListener('change', toggleAgencyField);
        const niceSelect = document.querySelector('.nice-select');
        if (niceSelect) {
            niceSelect.addEventListener('click', function () {
                setTimeout(toggleAgencyField, 100);
            });
        }
    });

</script>
@endpush