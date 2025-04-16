<input type="number" name="added_by" value="{{ Auth::guard('admin')->user()->id }}" class="form-control" hidden>
<div class="row g-3 mb-4"> 
    <input type="hidden" name="page" value="{{ request('page') }}" class="form-control">

    @if(\Route::currentRouteName() == 'products.edit')
    <input type="hidden" class="product_id" value="{{$product->id}}">
    @endif
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
                            <label for="categorys_image" class="form-label">@lang('main.products.products_image') <span class="text-danger">*</span></label>
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
                 
                    <div class="col-md-12">                      
                        <div class="form-group">
                            <label>@lang('main.products.status') <span class="text-danger">*</span></label>
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
                            <label for="is_private"> @lang('main.products.is_private')</label><span class="text-danger">*</span>
                            <select name="is_private" class="form-select">
                                <option value="yes" @if($product->is_private == 'yes') selected @endif>@lang('main.yes')</option>
                                <option value="no" @if($product->is_private == 'no') selected @endif>@lang('main.no')</option>
                            </select>
                        </div>
                    </div> 
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
                        $governorates = \App\Models\Location::where('type', 'governorate')->get();
                        $selectedCity = $product->city_id ?? null;
                        $selectedDistrict = $product->district_id ?? null;
                        $cities = $selectedCity 
                            ? \App\Models\Location::where('parent_id', $product->governorate_id)->where('type', 'city')->get()
                            : collect();
                        $districts = $selectedDistrict 
                            ? \App\Models\Location::where('parent_id', $product->city_id)->where('type', 'district')->get()
                            : collect();
                    @endphp
                        <div class="col-md-4">
                            <label>@lang('main.locations.governorate')</label>
                            <select name="governorate_id" id="governorate_select" class="form-select">
                                <option value="">@lang('main.choose')</option>
                                @foreach($governorates as $gov)
                                    <option value="{{ $gov->id }}" {{ (old('governorate_id', $product->governorate_id ?? '') == $gov->id) ? 'selected' : '' }}>
                                        {{ $gov->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>@lang('main.locations.city')</label>
                            <select name="city_id" id="city_select" class="form-select">
                                <option value="">@lang('main.choose')</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}" {{ (old('city_id', $product->city_id ?? '') == $city->id) ? 'selected' : '' }}>
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
                                    <option value="{{ $dist->id }}" {{ (old('district_id', $product->district_id ?? '') == $dist->id) ? 'selected' : '' }}>
                                        {{ $dist->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
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
        <div class="card">
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
                            @lang('main.products.product_for')<span class="text-danger">*</span>
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
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="type">
                            @lang('main.products.type')<span class="text-danger">*</span>
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
                <div class="col-md-4 auction-fields">                      
                    <div class="form-group">
                        <label>@lang('main.products.start_date')<span class="text-danger">*</span></label>
                        <input type="text" name="start_date" value="{{ old('start_date', $product->product_offer?->start_date) }}" class="form-control @error('start_date') is-invalid @enderror" id="start_date">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-4 auction-fields">                      
                    <div class="form-group">
                        <label>@lang('main.products.end_date')<span class="text-danger">*</span></label>
                        <input type="text" name="end_date" value="{{ old('end_date', $product->product_offer?->end_date) }}" class="form-control @error('end_date') is-invalid @enderror" id="end_date">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-4 auction-fields">                      
                    <div class="form-group">
                        <label>@lang('main.products.amount')<span class="text-danger">*</span></label>
                        <input type="text" name="amount" value="{{ old('amount', $product->product_offer?->amount) }}" class="form-control @error('amount') is-invalid @enderror" id="amount">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-4 investment-fields">                      
                    <div class="form-group">
                        <label>@lang('main.products.amount_investment')<span class="text-danger">*</span></label>
                        <input type="text" name="amount" value="{{ old('amount', $product->product_offer?->amount) }}" class="form-control @error('amount') is-invalid @enderror" id="amount">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">                      
                    <div class="form-group">
                        <label>@lang('main.products.title')<span class="text-danger">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $product->title) }}" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="" required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">                      
                    <div class="form-group">
                        <label>@lang('main.products.description') (@lang('main.ar'))</label>
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
                            <label>@lang('main.products.plan_number')<span class="text-danger">*</span></label>
                            <input type="text" name="plan_number" value="{{ old('plan_number', $product->plan_number) }}" class="form-control @error('plan_number') is-invalid @enderror" id="plan_number" placeholder="" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.plot_number')<span class="text-danger">*</span></label>
                            <input type="text" name="plot_number" value="{{ old('plot_number', $product->plot_number) }}" class="form-control @error('plot_number') is-invalid @enderror" id="plot_number" placeholder="" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.area')<span class="text-danger">*</span></label>
                            <input type="text" name="area" value="{{ old('area', $product->area) }}" class="form-control @error('area') is-invalid @enderror" id="area" placeholder="" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.area_after_development')<span class="text-danger">*</span></label>
                            <input type="text" name="area_after_development" value="{{ old('area_after_development', $product->area_after_development) }}" class="form-control @error('area_after_development') is-invalid @enderror" id="area_after_development" placeholder="" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.valuation')<span class="text-danger">*</span></label>
                            <input type="text" name="valuation" value="{{ old('valuation', $product->valuation) }}" class="form-control @error('valuation') is-invalid @enderror" id="valuation" placeholder="" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.valuation_date')<span class="text-danger">*</span></label>
                            <input type="date" name="valuation_date" value="{{ old('valuation_date', $product->valuation_date) }}" class="form-control @error('valuation_date') is-invalid @enderror" id="valuation_date" placeholder="" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.annual_rent')<span class="text-danger">*</span></label>
                            <input type="text" name="annual_rent" value="{{ old('annual_rent', $product->annual_rent) }}" class="form-control @error('annual_rent') is-invalid @enderror" id="annual_rent" placeholder="" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.status') <span class="text-danger">*</span></label>
                            <select name="status" class="form-select">
                                <option value="owner" {{ $product->status == 'owner' ? 'selected' : '' }}>@lang('main.products.owner')</option>
                                <option value="agent" {{ $product->status == 'agent' ? 'selected' : '' }}>@lang('main.products.agent')</option>
                                <option value="co-owner" {{ $product->status == 'co-owner' ? 'selected' : '' }}>@lang('main.products.co-owner')</option>
                                <option value="other" {{ $product->status == 'other' ? 'selected' : '' }}>@lang('main.products.other')</option>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div> 

                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.product_type') <span class="text-danger">*</span></label>
                            <select name="product_type" class="form-select">
                                <option value="residential" {{ $product->product_type == 'residential' ? 'selected' : '' }}>@lang('main.products.residential')</option>
                                <option value="commercial" {{ $product->product_type == 'commercial' ? 'selected' : '' }}>@lang('main.products.commercial')</option>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>


                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.owner_type') <span class="text-danger">*</span></label>
                            <select name="owner_type" class="form-select">
                                <option value="individual" {{ $product->owner_type == 'individual' ? 'selected' : '' }}>@lang('main.products.individual')</option>
                                <option value="company" {{ $product->owner_type == 'company' ? 'selected' : '' }}>@lang('main.products.company')</option>
                                <option value="other" {{ $product->owner_type == 'other' ? 'selected' : '' }}>@lang('main.products.other')</option>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div> 
                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.remaining_lease_years')<span class="text-danger">*</span></label>
                            <input type="text" name="remaining_lease_years" value="{{ old('remaining_lease_years', $product->remaining_lease_years) }}" class="form-control @error('remaining_lease_years') is-invalid @enderror" id="remaining_lease_years" placeholder="" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.license_number')<span class="text-danger">*</span></label>
                            <input type="text" name="license_number" value="{{ old('license_number', $product->license_number) }}" class="form-control @error('license_number') is-invalid @enderror" id="license_number" placeholder="" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <hr class="mt-0">                    
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <label>@lang('main.products.has_planning_diagram') <span class="text-danger">*</span></label>
                                <input type="checkbox" class="cm-toggle" id="" name="has_planning_diagram" @if($product->has_planning_diagram == 'on') checked="" @endif>     
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <hr class="mt-0">                    
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <label>@lang('main.products.has_survey_decision') <span class="text-danger">*</span></label>
                                <input type="checkbox" class="cm-toggle" id="" name="has_survey_decision" @if($product->has_survey_decision == 'on') checked="" @endif>     
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <hr class="mt-0">                    
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <label>@lang('main.products.has_electronic_deed') <span class="text-danger">*</span></label>
                                <input type="checkbox" class="cm-toggle" id="" name="has_electronic_deed" @if($product->has_electronic_deed == 'on') checked="" @endif>     
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <hr class="mt-0">                    
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <label>@lang('main.products.has_real_estate_market') <span class="text-danger">*</span></label>
                                <input type="checkbox" class="cm-toggle" id="" name="has_real_estate_marke" @if($product->has_real_estate_market == 'on') checked="" @endif>     
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <hr class="mt-0">                    
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <label>@lang('main.products.has_mortgage') <span class="text-danger">*</span></label>
                                <input type="checkbox" class="cm-toggle" id="" name="has_mortgage" @if($product->has_mortgage == 'on') checked="" @endif>     
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <hr class="mt-0">                    
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <label>@lang('main.products.has_penalties') <span class="text-danger">*</span></label>
                                <input type="checkbox" class="cm-toggle" id="" name="has_penalties" @if($product->has_penalties == 'on') checked="" @endif>     
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-md-12">                      
                        <div class="form-group">
                            <label>@lang('main.products.penalty_type') <span class="text-danger">*</span></label>
                            <select name="penalty_type" class="form-select">
                                <option value="cash" {{ $product->penalty_type == 'cash' ? 'selected' : '' }}>@lang('main.products.cash')</option>
                                <option value="installment" {{ $product->penalty_type == 'installment' ? 'selected' : '' }}>@lang('main.products.installment')</option>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div> 
                    <div class="col-md-4">  
                        <hr class="mt-0">                    
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <label>@lang('main.products.valuation_type') <span class="text-danger">*</span></label>
                                <input type="checkbox" class="cm-toggle" id="" name="valuation_type" @if($product->valuation_type == 'on') checked="" @endif>     
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <hr class="mt-0">                    
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <label>@lang('main.products.accepts_mortgage') <span class="text-danger">*</span></label>
                                <input type="checkbox" class="cm-toggle" id="" name="accepts_mortgage" @if($product->accepts_mortgage == 'on') checked="" @endif>     
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <hr class="mt-0">                    
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <label>@lang('main.products.usufruct_lease') <span class="text-danger">*</span></label>
                                <input type="checkbox" class="cm-toggle" id="" name="usufruct_lease" @if($product->usufruct_lease == 'on') checked="" @endif>     
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <hr class="mt-0">                    
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <label>@lang('main.products.is_rented') <span class="text-danger">*</span></label>
                                <input type="checkbox" class="cm-toggle" id="" name="is_rented" @if($product->is_rented == 'on') checked="" @endif>     
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label>@lang('main.products.payment_method')<span class="text-danger">*</span></label>
                            <input type="text" name="payment_method" value="{{ old('payment_method', $product->payment_method) }}" class="form-control @error('payment_method') is-invalid @enderror" id="payment_method" placeholder="" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-12">                      
                        <div class="form-group">
                            <label>@lang('main.products.additional_info')</label>
                            <textarea type="text" name="additional_info" class="form-control @error('additional_info') is-invalid @enderror" id="additional_info">{{ old('additional_info', $product->additional_info) }}</textarea>
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
            }else if($('#product_type').val() === 'investment') {
                $('.investment-fields').show();
                $('.auction-fields').hide();
            } else {
                $('.auction-fields').hide();
                $('.investment-fields').hide();
            }
        }
        toggleFields();
        $('#product_type').on('change', function () {
            toggleFields();
        });
    });
</script>
@endpush