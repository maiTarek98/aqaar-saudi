@extends('site.index')
@php
$property = \App\Models\Product::where('id',request('property'))->first(); 
@endphp
@section('title', (isset($property)) ? trans('site.update-property') : trans('site.add-property') )
@section('content')
    @include('site.includes.breadcrumb-section',['title' => (isset($property)) ? trans('site.update-property') : trans('site.add-property')])
    <section class="profile py-5">
      <div class="container-fluid">
        <!-- profile nav-sm -->
        <div class="profile-nav-sm rounded-3">
          <p class="m-0">@lang('site.profile')</p>
          <button class="btn toggle-profile-nav p-0 border-0 bg-transparent" data-toggle=".profile-nav">
            <img
            src="{{url('site')}}/images/menu.png"
            alt="menu icon"
          />
          </button>
        </div>
        <div class="row d-flex justify-content-between align-items-start">
        @include('site.includes.profile-menu')
        <!-- profile data col -->
           <div class="profile-data col col-md-7 col-lg-8">
               <div class="alert alert-warning d-flex align-items-center" role="alert">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" fill="var(--secondary)">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                  </svg>
                  <div>
                        جميع الحقول التي تحتوي على ( <span class="text-danger fs-5">*</span> ) هي إلزامية، أما الحقول التي لا تحمل العلامة فهي اختيارية يمكنك تعبئتها إن وُجدت.
                  </div>
                </div>
            <form action="{{ isset($property) ? route('updateProperty', ['user' => auth('web')->user()->id, 'property' => $property->id]) : route('storeProperty', ['user' => auth('web')->user()->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                <input type="number" name="added_by" value="{{ Auth::guard('web')->user()->id }}" class="form-control" hidden>
                <input type="text" name="status" value="pending" class="form-control" hidden>
                <!--<input type="text" name="represented_by" value="{{Auth::guard('web')->user()->user_type}}" class="form-control" readonly>-->

                <div class="profile-wrapper mb-3">
                    <div class="section-title d-flex align-items-center gap-2 mb-4">
                    <div class="section-img">
                      <img loading="lazy" src="{{url('site')}}/images/1.svg" alt="change image" />
                    </div>
                    <h5 class="fw-bold m-0"> تفاصيل نوع العرض</h5>
                  </div>
                  <div class="builder-options col-lg-9">
                    <div class="builder-option">
                        <div class="form-group mb-4">
                            <label for="represented_by">نوع العرض <span class="text-danger">*</span></label>
                            <select name="represented_by" id="represented_by" class="form-control" placeholder="@lang('site.user_type')" value="{{ old('user_type') }}">
                                <option value="owner" @if(isset($property) && $property->feature?->represented_by == 'owner') selected @endif>@lang('main.products.owner')</option>
                                <option value="agent" @if(isset($property) && $property->feature?->represented_by == 'agent') selected @endif>@lang('main.products.agent')</option>
                                <option value="co-owner" @if(isset($property) && $property->feature?->represented_by == 'co-owner') selected @endif>@lang('main.products.co-owner')</option>
                                <option value="other" @if(isset($property) && $property->feature?->represented_by == 'other') selected @endif>@lang('main.products.other')</option>
                            </select>
                            <span class="text-danger error-msg user_type"></span>
                        </div>
                        
                        
                        <div class="form-group mb-4" id="sak_number_wrapper" style="display:none">
                            <label for="">@lang('main.users.sak_number')</label>
                            <input type="text" maxlength="10" name="sak_number" value="{{old('sak_number',(isset($property))? ($property->feature->sak_number ?? '') : '')}}"class="form-control @error('sak_number') is-invalid @enderror" id="sak_number" placeholder="@lang('main.users.sak_number')">
                            <span class="text-danger error-msg sak_number"></span>
                        </div>
        
                        <div class="form-group mb-4" id="agency_number_wrapper" style="display:none">
                            <label for="">@lang('main.users.agency_number')</label>
                            <input type="text" maxlength="10" name="agency_number" value="{{old('agency_number',(isset($property))? ($property->feature->agency_number ?? '') : '')}}" class="form-control @error('agency_number') is-invalid @enderror" id="agency_number" placeholder="@lang('main.users.agency_number')">
                            <span class="text-danger error-msg agency_number"></span>
                        </div>
                        <div class="form-group mb-4" id="val_number_wrapper" style="display:none">
                            <label for="">@lang('main.users.val_number')</label>
                            <input type="text"  name="val_number" value="{{auth('web')->user()->val_number,(isset($property))? ($property->feature->val_number ?? '') : ''}}"class="form-control @error('val_number') is-invalid @enderror" id="val_number" placeholder="@lang('main.users.val_number')">
                            <span class="text-danger error-msg val_number"></span>
                        </div>
                    </div>
                 </div>
                  <div class="section-title d-flex align-items-center gap-2 mb-4">
                    <div class="section-img">
                      <img loading="lazy" src="{{url('site')}}/images/1.svg" alt="change image" />
                    </div>
                    <h5 class="fw-bold m-0"> @lang('main.show product details')</h5>
                  </div>
                  <div class="builder-options col-lg-9">
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.product_for') <span class="text-danger">*</span></h5>
                      </div>
                      <input
                        name="product_for"
                        type="radio"
                        class="btn-check"
                        id="sale"
                        value="sale" @if(isset($property) && $property->product_for == 'sale') checked @endif
                        autocomplete="off"
                      />
                      <label class="btn" for="sale">
                        <img loading="lazy" src="{{url('site')}}/images/2.svg" alt="change image" />
                        <span>@lang('main.products.sale')</span>
                      </label>
    
                      <input
                        name="product_for"
                        type="radio"
                        class="btn-check"
                        id="rent" @if(isset($property) && $property->product_for == 'rent') checked @endif
                        value="rent"
                        autocomplete="off"
                      />
                      <label class="btn" for="rent">
                        <img loading="lazy" src="{{url('site')}}/images/2.svg" alt="change image" />
                        <span>@lang('main.products.rent')</span>
                      </label>
                    </div>
    
                    <div class="builder-option">
                      <div class="builder-option-name mb-0">
                        <h5>@lang('main.products.product_type') <span class="text-danger">*</span></h5>
                      </div>
                      <div class="builder-option">
                      <input
                        name="product_type"
                        type="radio"
                        class="btn-check"
                        id="residential"
                        value="residential" @if(isset($property) && $property->feature?->product_type == 'residential') checked @endif
                        autocomplete="off"
                      />
                      <label class="btn" for="residential">
                        <img loading="lazy" src="{{url('site')}}/images/2.svg" alt="change image" />
                        <span>@lang('main.products.residential')</span>
                      </label>
    
                      <input
                        name="product_type"
                        type="radio"
                        class="btn-check"
                        id="commercial"
                        value="commercial" @if(isset($property) && $property->feature?->product_type == 'commercial') checked @endif
                        autocomplete="off"
                      />
                      <label class="btn" for="commercial">
                        <img loading="lazy" src="{{url('site')}}/images/2.svg" alt="change image" />
                        <span>@lang('main.products.commercial')</span>
                      </label>
                      
                      <input
                        name="product_type"
                        type="radio"
                        class="btn-check"
                        id="two"
                        value="two" @if(isset($property) && $property->feature?->product_type == 'two') checked @endif
                        autocomplete="off"
                      />
                      <label class="btn" for="two">
                        <img loading="lazy" src="{{url('site')}}/images/2.svg" alt="change image" />
                        <span>@lang('main.products.two')</span>
                      </label>
                    </div>
                    </div>
    
                    <div class="builder-option">
                      <div class="builder-option-name col-md-6">
                        <h5>@lang('main.products.product_address')</h5>
                      </div>
                      @php
                            $district = isset($property) ? \App\Models\Location::find($property->area_id) : null;
                            $city = $district?->parent;
                            $governorate = $city?->parent;
                        @endphp

                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <select name="" id="governorate_select" class="form-control nice-select">
                                <option value="" hidden>المنطقة / الحي</option>
                                @foreach(getGovernorates() as $gov)
                                    <option value="{{ $gov->id }}" {{ old('governorate_id', $governorate?->id) == $gov->id ? 'selected' : '' }}>
                                        {{ $gov->name }}
                                    </option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <select name="" id="city_select" class="form-control nice-select">
                              <option value="" hidden>المدينة</option>
                                @if($governorate)
                                    @foreach(getCitiesByGovernorateId($governorate->id) as $cityItem)
                                        <option value="{{ $cityItem->id }}" {{ old('city_id', $city?->id) == $cityItem->id ? 'selected' : '' }}>
                                            {{ $cityItem->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <select name="district_id" id="district_select" class="form-control nice-select">
                                <option value="">@lang('main.choose')</option>
                                @if($city)
                                    @foreach(getDistrictsByCityId($city->id) as $districtItem)
                                        <option value="{{ $districtItem->id }}" {{ old('area_id', $district?->id) == $districtItem->id ? 'selected' : '' }}>
                                            {{ $districtItem->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                          </div>
                        </div>
                        <div class="col-12">
                            <div class="builder-option">
                              <div class="builder-option-name">
                                <h5>
                                  @lang('main.products.map_location') <span class="text-danger">*</span>
                                </h5>
                              </div>
                              <textarea
                                class="form-control"
                                rows="2"
                                name="map_location"
                                id="map_location"
                              >{{old('map_location',(isset($property))?? $property->map_location)}}</textarea>
                            </div>
                          <!-- add map to select location -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
    
                <div class="profile-wrapper mb-3">
                  <div class="section-title d-flex align-items-center gap-2 mb-4">
                    <div class="section-img">
                      <img loading="lazy" src="{{url('site')}}/images/1.svg" alt="change image" />
                    </div>
                    <h5 class="fw-bold m-0">@lang('main.products.product_features') </h5>
                  </div>
                  <div class="builder-options col-lg-9">
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.plan_number')  </h5>
                      </div>
                      <input
                        name="plan_number" value="{{old('plan_number',(isset($property))? ($property->feature->plan_number ?? '') : '' )}}"
                        type="text"
                        class="form-control"
                        placeholder=""
                      />
                    </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.plot_number')  </h5>
                      </div>
                      <input
                        name="plot_number" value="{{old('plot_number',(isset($property))? ($property->feature->plot_number ?? '') : '')}}"
                        type="text"
                        class="form-control"
                        placeholder=""
                      />
                    </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.area')  </h5>
                      </div>
                      <input
                        name="area" value="{{old('area',(isset($property))? ($property->feature->area ?? '') : '')}}"
                        type="text"
                        class="form-control"
                        placeholder="متر مربع 250"
                      />
                    </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.area_after_development')  </h5>
                      </div>
                      <input
                        name="area_after_development" value="{{old('area_after_development',(isset($property))? ($property->feature->area_after_development ?? '') : '')}}"
                        type="text"
                        class="form-control"
                        placeholder="متر مربع 250"
                      />
                    </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.valuation')  </h5>
                      </div>
                      <input
                        name="valuation" value="{{old('valuation',(isset($property))? ($property->feature->valuation ?? '') : '')}}"
                        type="number" min="1" step="1"
                        class="form-control"
                        placeholder=""
                      />
                    </div>

                    <div class="builder-option">
                      <div class="builder-option-name">
                            <h5>@lang('main.products.valuation_date')  </h5>
                      </div>
                      <input
                        name="valuation_date" value="{{old('valuation_date',(isset($property))? ($property->feature->valuation_date ?? '') : '')}}"           type="date"
                        class="form-control"
                        placeholder=""
                      />
                    </div>
                    
                        @php
                            if(old('features')) {
                                $selectedFeatures = old('features');
                            } elseif(isset($property) && $property->feature) {
                                $selectedFeatures = $property->feature->features ?? [];
                            } else {
                                $selectedFeatures = [];
                            }
                        @endphp

                    <div class="row row-cols-2 row-cols-lg-3">
                        @foreach(getFeatures() as $feature)
                            <div class="col">
                                <div class="builder-option">
                                    <div class="builder-option-name">
                                        <h5>{{ $feature->label_name }}</h5>
                                    </div>
                    
                                    <input type="radio"
                                           class="btn-check"
                                           name="features[{{ $feature->id }}]"
                                           id="yes_{{ $feature->id }}"
                                           value="1"
                                           {{ (isset($selectedFeatures[$feature->id]) && $selectedFeatures[$feature->id] == '1') ? 'checked' : '' }}>
                                    <label class="btn btn-outline-success px-4" for="yes_{{ $feature->id }}">
                                        @lang('main.yes')
                                    </label>
                    
                                    <input type="radio"
                                           class="btn-check"
                                           name="features[{{ $feature->id }}]"
                                           id="no_{{ $feature->id }}"
                                           value="0"
                                           {{ (isset($selectedFeatures[$feature->id]) && $selectedFeatures[$feature->id] == '0') ? 'checked' : '' }}>
                                    <label class="btn btn-outline-danger px-4" for="no_{{ $feature->id }}">
                                        @lang('main.no')
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.annual_rent')  </h5>
                      </div>
                      <input
                        name="annual_rent" value="{{old('annual_rent',(isset($property))? ($property->feature->annual_rent ?? '') : '')}}"
                        type="number" min="1" step="1" 
                        class="form-control"
                        placeholder=""
                      />
                    </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.remaining_lease_years')  </h5>
                      </div>
                      <input
                        name="remaining_lease_years" value="{{old('remaining_lease_years',(isset($property))? ($property->feature->remaining_lease_years ?? '') : '')}}"
                        type="text"
                        class="form-control"
                        placeholder="برجاء ادخال المدة المتبقية حسب سنة أو شهر"
                      />
                    </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.penalty_type') </h5>
                      </div>
                      <input
                        name="penalty_type[]"
                        type="checkbox"
                        class="btn-check"
                        id="penalty_type_cash"
                        value="cash"  @if(isset($property) && ($property->feature?->penalty_type == 'cash' || $property->feature?->penalty_type == 'cash_installment')) checked @endif
                        autocomplete="off"
                      />
                      <label class="btn px-4" for="penalty_type_cash">
                        <span>@lang('main.products.cash')</span>
                      </label>
                      <input
                        name="penalty_type[]"
                        type="checkbox"
                        class="btn-check"
                        id="penalty_type_installment"
                        value="installment" @if(isset($property) && ($property->feature?->penalty_type == 'installment' || $property->feature?->penalty_type == 'cash_installment')) checked @endif
                        autocomplete="off"
                      />
                      <label class="btn px-4" for="penalty_type_installment">
                        <span>@lang('main.products.installment')</span>
                      </label>
                      
                    </div>
    
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.license_number')  </h5>
                      </div>
                      <input
                        name="license_number" value="{{old('license_number',(isset($property))? ($property->feature->license_number ?? '') : '')}}"
                        type="text"
                        class="form-control"
                        placeholder=""
                      />
                    </div>
    
                    
                  </div>
                </div>
    
                <div class="profile-wrapper mb-3">
                  <div class="section-title d-flex align-items-center gap-2 mb-4">
                    <div class="section-img">
                      <img loading="lazy" src="{{url('site')}}/images/1.svg" alt="change image" />
                    </div>
                    <h5 class="fw-bold m-0">@lang('main.products.product_up_img') </h5>
                  </div>
                  <div class="builder-options col-lg-9">
                     <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>
                          تحميل صورة العقار الرئيسية الخاص بك
                        </h5>
                      </div>
                      <div class="upload-wrapper mb-3">
                        <div class="upload__box">
                          <div class="upload__btn-box row align-items-center">
                            <div
                              class="builder-option-name d-flex gap-3 align-items-center mb-3"
                            >
                              <i class="fa-regular fa-image"></i>
    
                              <label class="upload__btn m-0">
                                <span>تحميل صورة</span>
                                <input
                                  name="products_image"
                                  type="file"
                                  data-max_length="20"
accept="image/png, image/jpeg, image/webp"
                                  class="upload__inputfile" 
                                />
                              </label>
                            </div>
                            <p class="p-0">
                              الحجم الأقصى 5 ميغا بايت ، Jpg. Png فقط
                            </p>
                          </div>
                          <div class="upload__img-wrap"></div>
                        </div>
                        
                        @if((isset($property)) && $property->getFirstMediaUrl('products_image','thumb'))
                            <img src="{{$property->getFirstMediaUrl('products_image','thumb')}}" class="img-fluid rounded-circle mb-3" width="120" alt="product">
                        @endif
                      </div>
                    </div>


                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>
                          تحميل صور العقار الداخلية
                        </h5>
                      </div>
                      <div class="upload-wrapper mb-3">
                        <div class="upload__box">
                          <div class="upload__btn-box row align-items-center">
                            <div
                              class="builder-option-name d-flex gap-3 align-items-center mb-3"
                            >
                              <i class="fa-regular fa-image"></i>
    
                              <label class="upload__btn m-0">
                                <span>تحميل صور</span>
                                <input
                                  name="document[]"
                                  type="file"
                                  multiple=""
                                  data-max_length="20"
accept="image/png, image/jpeg, image/webp"
                                  max="6"
                                  class="upload__inputfile"
                                />
                              </label>
                            </div>
                            <p class="p-0">
                              الحجم الأقصى 5 ميغا بايت ، Jpg. Png فقط
                            </p>
                          </div>
                          <div class="upload__img-wrap"></div>
                        </div>
                      </div>
                      
                      @if ((isset($property)) && $property->getMedia('document')->count() > 0)
                  <div class="card mb-3">
                     <div class="card-body">
                        <div class="single-img">
                           <div class="all">
                              @if ($property->getMedia('document')->count() > 1)
                              <div class="slider">
                                 <div class="owl-carousel owl-theme one">
                                    @foreach($property->getMedia('document') as $key=> $val)
                                    <div class="item-box">
                                       <?php $imageUrl=url('/storage/products_images/'.$val->id.'/'.$val->file_name);?>
                                       <img src="{{ $imageUrl}}" alt="">
                                    </div>
                                    @endforeach
                                 </div>
                              </div>
                              <div class="slider-two">
                                 <div class="owl-carousel owl-theme two">
                                    @foreach($property->getMedia('document') as $key=> $val)
                                    <div class="item">
                                       <?php $imageUrl=url('/storage/products_images/'.$val->id.'/'.$val->file_name);?>
                                       <img src="{{ $imageUrl}}" alt="">
                                    </div>
                                    @endforeach
                                 </div>
                                 <div class="left-t nonl-t">
                                 <i class="bi bi-chevron-left"></i>
                                 </div>
                                 <div class="right-t">
                                 <i class="bi bi-chevron-right"></i>
                                 </div>
                              </div>
                              @else
                              <div class="slider">
                                 @foreach($property->getMedia('document') as $key=> $val)
                                 <div class="item-box">
                                    <?php $imageUrl=url('/storage/products_images/'.$val->id.'/'.$val->file_name);?>
                                    <img src="{{ $imageUrl}}" alt="">
                                 </div>
                                 @endforeach
                              </div>
                              @endif
                           </div>
                        </div>

                        
                     </div>
                  </div>
                  @endif
                    </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>أضف مقاطع فيديو للعقار الخاص بك</h5>
                      </div>
                      <div class="upload-wrapper">
                        <div class="upload__box">
                          <div class="upload__btn-box row align-items-center">
                            <div
                              class="builder-option-name d-flex gap-3 align-items-center mb-3"
                            >
                              <i class="fa-solid fa-video"></i>
    
                              <button type="button" class="upload__btn" id="addVideo">
                                <span>تحميل فيديو</span>
                              </button>
                            </div>
                            <div class="video-link" id="videos-link">
                              <h5>رابط الفيديو</h5>
                              <div class="d-flex">
                                <div class="btn">
                                  <i class="fa-brands fa-youtube"></i>
                                </div>
                                <input
                                  type="text"
                                  name="link_video"
                                  class="form-control m-0"
                                  placeholder="ضع رايط الفيديو هنا"
                                  value="{{old('link_video',(isset($property))? ($property->link_video ?? '') : '')}}"
                                />
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
    
                <div class="profile-wrapper mb-3">
                  <div class="section-title d-flex align-items-center gap-2 mb-4">
                    <div class="section-img">
                      <img loading="lazy" src="{{url('site')}}/images/1.svg" alt="change image" />
                    </div>
                    <h5 class="fw-bold m-0">تفاصيل إضافية</h5>
                  </div>
                  <div class="builder-options col-lg-9">
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.title') <span class="text-danger">*</span></h5>
                      </div>
                      <input
                        name="title" value="{{old('title',(isset($property))? ($property->title ?? '') : '')}}"
                        type="text" id="title"
                        class="form-control"
                        placeholder="أضف عنوان مناسب للعرض"
                      />
                  </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>
                         @lang('main.products.description') <span class="text-danger">*</span>
                        </h5>
                      </div>
                      <textarea
                        class="form-control"
                        rows="6"
                        name="description"
                        id="description"
                      >{{old('description',(isset($property))? ($property->description ?? '') : '')}}</textarea>
                    </div>
                  </div>
                </div>
    
                {{--<div class="profile-wrapper mb-3">
                  <div class="section-title d-flex align-items-center gap-2 mb-4">
                    <div class="section-img">
                      <img loading="lazy" src="{{url('site')}}/images/1.svg" alt="change image" />
                    </div>
                    <h5 class="fw-bold m-0">إدارة الصلاحيات</h5>
                  </div>
                  <div class="builder-options col-lg-9">
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>الموكلين <span class="text-danger">*</span></h5>
                      </div>
                      <input
                        name=""
                        type="text"
                        class="form-control"
                        placeholder=""
                      />
                    </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>نوع الصلاحية <span class="text-danger">*</span></h5>
                      </div>
                      <input
                        name=""
                        type="text"
                        class="form-control"
                        placeholder=""
                      />
                    </div>
                  </div>
                </div>--}}
    
                <div class="profile-wrapper mb-3">
                  <div class="section-title d-flex align-items-center gap-2 mb-4">
                    <div class="section-img">
                      <img loading="lazy" src="{{url('site')}}/images/1.svg" alt="change image" />
                    </div>
                    <h5 class="fw-bold m-0">خيارات بيع إضافية لعقارك</h5>
                  </div>
    
                  <div class="builder-options col-lg-9">
                   
    
                    <div class="row">
                        <div class="col-12">
                            <div class="builder-option">
                              <div class="w-100 d-flex justify-content-between">
                                <h5 class="fw-bold main mb-3">@lang('main.products.type') </h5>
                                <a href="{{route('pages',['id'=>2])}}" target="_blank">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        class="bi flex-shrink-0 me-2"
                                        viewBox="0 0 16 16"
                                        role="img"
                                        aria-label="Warning:"
                                        fill="var(--secondary)"
                                      >
                                        <path
                                          d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"
                                        />
                                      </svg>
                                        شرح اليات نظام
                                      
                                    </a>  
                              </div>
                                <select name="type" id="product_type" class="form-control">
                                    <option value="" hidden>نظام البيع</option>
                                    <option value="auction" @if(isset($property) && $property->type == 'auction') selected @endif >@lang('main.products.auction')</option>
                                    <option value="shared" @if(isset($property) && $property->type == 'shared') selected @endif >@lang('main.products.shared')</option>
                                    <option value="investment" @if(isset($property) && $property->type == 'investment') selected @endif >@lang('main.products.investment')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 shared-fields">
                            <div class="builder-option">
                                <div class="builder-option-name">
                                  <h5>@lang('main.products.amount_shared')</h5>
                                </div>
                                <input name="price_shared" value="{{old('price',(isset($property))? ($property->price ?? '') : '')}}" type="text" class="form-control" placeholder="ريال سعودي 1600000" />
                            </div>
                            <div class="builder-option">
                                <div class="builder-option-name">
                                  <h5>@lang('main.products.enter mobiles numbers')</h5>
                                </div>
                                <input name="phone_numbers" value="" class="input-tags form-control" type="text" data-role="tagsinput"/>
                            </div>
                        </div>

                        <div class="col-12 investment-fields">
                            <div class="builder-option">
                                <div class="builder-option-name">
                                  <h5>@lang('main.products.amount_investment')</h5>
                                </div>
                                <input name="price_investment" value="{{old('price',(isset($property))? ($property->price ?? '') : '')}}" type="text" class="form-control" placeholder="ريال سعودي 1600000" />
                            </div>
                            <div class="builder-option">
                                <div class="builder-option-name">
                                  <h5>@lang('main.products.investment_min')</h5>
                                </div>
                                <input name="investment_min" min="1" max="100" value="{{old('investment_min',(isset($property))? ($property->investment_min ?? '') : '')}}" type="number" class="form-control" placeholder="% " />
                            </div>
                        </div>

                        <div class="col-12 auction-fields">
                            <div class="builder-option">
                                <div class="builder-option-name">
                                  <h5>@lang('main.products.amount')</h5>
                                </div>
                                <input name="price_auction" value="{{old('price',(isset($property))? ($property->price ?? '') : '')}}" type="text" class="form-control" placeholder="ريال سعودي 1600000" />
                            </div>
                        </div>
                        <div class="col-md-6 auction-fields">
                            <div class="builder-option">
                                <div class="builder-option-name">
                                  <h5>@lang('main.products.start_date')</h5>
                                </div>
                                <input name="start_date" value="{{old('start_date',(isset($property))? ($property->start_date ?? '') : '')}}" type="date" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6 auction-fields">
                            <div class="builder-option">
                                <div class="builder-option-name">
                                  <h5>@lang('main.products.end_date')</h5>
                                </div>
                                <input name="end_date" value="{{old('end_date',(isset($property))? ($property->end_date ?? '') : '')}}"  type="date" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="builder-option">
                              <div class="builder-option-name">
                                <h5>
                                 @lang('main.products.additional_info') 
                                </h5>
                              </div>
                              <textarea
                                class="form-control"
                                rows="6"
                                name="additional_info"
                                id="additional_info"
                              >{{old('additional_info',(isset($property))? ($property->feature->additional_info ?? '') : '')}}</textarea>
                            </div>

    
                  </div>
                </div>
    
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" fill="var(--secondary)">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                  </svg>
                    <div>
                        <input type="checkbox" name="agree" required>                         جميع البيانات المُدخلة في نموذج إضافة العقار تقع تحت مسؤوليتك الكاملة، وتقر بصحتها ومطابقتها للواقع وفق أنظمة موقع عقار السعودية
                    </div>
                </div>
                
                <button type="submit" class="main-outline-btn text-center">
                @if(isset($property))
                    @lang('main.products.update property')  
                @else
                    @lang('main.products.add property')  
                @endif

                </button>

            </form>

          </div>
        </div>
      </div>
    </section>            
                
@endsection
@push('custom-js')
<script>

     $(document).ready(function () {
        $('#governorate_select').on('change', function () {
        let gov_id = $(this).val();
        $('#city_select').html('<option value="">@lang("main.loading")...</option>').niceSelect('update');
        $('#district_select').html('<option value="">@lang("main.choose")</option>').niceSelect('update');

        if (gov_id) {
            $.get('{{url('/')}}/locations/cities/' + gov_id, function (data) {
                let cityOptions = '<option value="">@lang("main.choose")</option>';
                data.forEach(city => {
                    cityOptions += `<option value="${city.id}">${city.name_ar}</option>`;
                });
                $('#city_select').html(cityOptions).niceSelect('update');
            });
        }
    });

    $('#city_select').on('change', function () {
        let city_id = $(this).val();
        $('#district_select').html('<option value="">@lang("main.loading")...</option>').niceSelect('update');

        if (city_id) {
            $.get('{{url('/')}}/locations/districts/' + city_id, function (data) {
                let distOptions = '<option value="">@lang("main.choose")</option>';
                data.forEach(dist => {
                    distOptions += `<option value="${dist.id}">${dist.name_ar}</option>`;
                });
                $('#district_select').html(distOptions).niceSelect('update');
            });
        }
    });


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
                $('.shared-fields').show();
                $('.auction-fields').hide();
                $('.investment-fields').hide();
            } else{
                $('.shared-fields').hide();
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