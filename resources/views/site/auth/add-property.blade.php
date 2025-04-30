@extends('site.index')
@section('title', trans('site.profile') )
@section('content')
      @include('site.includes.breadcrumb-section',['title' => trans('site.profile')])
    <section class="profile py-5">
      <div class="container-fluid">
        <!-- profile nav-sm -->
        <div class="profile-nav-sm rounded-3">
          <p class="m-0">الملف الشخصي</p>
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
           <div class="profile-data col col-md-7 col-lg-9">
            <form action="{{route('storeProperty',auth('web')->user()->id)}}" method="POST" enctype="multipart/form-data">
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
                <input type="text" name="represented_by" value="{{Auth::guard('web')->user()->user_type}}" class="form-control" readonly>

                <div class="profile-wrapper mb-3">
                  <div class="section-title d-flex align-items-center gap-2 mb-4">
                    <div class="section-img">
                      <img loading="lazy" src="{{url('site')}}/images/1.svg" alt="change image" />
                    </div>
                    <h5 class="fw-bold m-0"> @lang('main.show product details')</h5>
                  </div>
                  <div class="builder-options w-75">
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.product_for') <span class="text-danger">*</span></h5>
                      </div>
                      <input
                        name="product_for"
                        type="radio"
                        class="btn-check"
                        id="sale"
                        value="sale"
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
                        id="rent"
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
                        value="residential"
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
                        value="commercial"
                        autocomplete="off"
                      />
                      <label class="btn" for="commercial">
                        <img loading="lazy" src="{{url('site')}}/images/2.svg" alt="change image" />
                        <span>@lang('main.products.commercial')</span>
                      </label>
                    </div>
                    </div>
    
                    <div class="builder-option">
                      <div class="builder-option-name col-md-6">
                        <h5>@lang('main.products.product_address')<span class="text-danger">*</span></h5>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <select name="" id="governorate_select" class="form-control nice-select">
                                <option value="" hidden>المنطقة / الحي</option>
                                @foreach(getGovernorates() as $gov)
                                    <option value="{{ $gov->id }}" {{ (old('governorate_id') == $gov->id) ? 'selected' : '' }}>
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
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <select name="district_id" id="district_select" class="form-control nice-select">
                                <option value="">@lang('main.choose')</option>
                                
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
                              >{{old('map_location')}}</textarea>
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
                  <div class="builder-options w-75">
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.plan_number')  <span class="text-info">@lang('main.optional')</span></h5>
                      </div>
                      <input
                        name="plan_number" value="{{old('plan_number')}}"
                        type="text"
                        class="form-control"
                        placeholder=""
                      />
                    </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.plot_number')  <span class="text-info">@lang('main.optional')</span></h5>
                      </div>
                      <input
                        name="plot_number" value="{{old('plot_number')}}"
                        type="text"
                        class="form-control"
                        placeholder=""
                      />
                    </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.area')  <span class="text-info">@lang('main.optional')</span></h5>
                      </div>
                      <input
                        name="area" value="{{old('area')}}"
                        type="text"
                        class="form-control"
                        placeholder="متر مربع 250"
                      />
                    </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.area_after_development')  <span class="text-info">@lang('main.optional')</span></h5>
                      </div>
                      <input
                        name="area_after_development" value="{{old('area_after_development')}}"
                        type="text"
                        class="form-control"
                        placeholder="متر مربع 250"
                      />
                    </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.valuation')  <span class="text-info">@lang('main.optional')</span></h5>
                      </div>
                      <input
                        name="valuation" value="{{old('valuation')}}"
                        type="number" min="1" step="1"
                        class="form-control"
                        placeholder=""
                      />
                    </div>

                    <div class="builder-option">
                      <div class="builder-option-name">
                            <h5>@lang('main.products.valuation_date')  <span class="text-info">@lang('main.optional')</span></h5>
                      </div>
                      <input
                        name="valuation_date" value="{{old('valuation_date')}}"           type="date"
                        class="form-control"
                        placeholder=""
                      />
                    </div>
    
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.has_planning_diagram') <span class="text-info">@lang('main.optional')</span></h5>
                      </div>
    
                      <input
                        name="has_planning_diagram"
                        type="radio"
                        class="btn-check"
                        id="has_planning_diagram_yes"
                        value="1"
                        autocomplete="off"
                      />
                      <label class="btn px-4" for="has_planning_diagram_yes">
                        <span>@lang('main.yes')</span>
                      </label>
                      <input
                        name="has_planning_diagram"
                        type="radio"
                        class="btn-check"
                        id="has_planning_diagram_no"
                        value="0"
                        autocomplete="off"
                      />
                      <label class="btn px-4" for="has_planning_diagram_no">
                        <span>@lang('main.no')</span>
                      </label>
                      
                    </div>

                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.has_electronic_deed') <span class="text-info">@lang('main.optional')</span></h5>
                      </div>
    
                      <input
                        name="has_electronic_deed"
                        type="radio"
                        class="btn-check"
                        id="has_electronic_deed_yes"
                        value="1"
                        autocomplete="off"
                      />
                      <label class="btn px-4" for="has_electronic_deed_yes">
                        <span>@lang('main.yes')</span>
                      </label>
                      <input
                        name="has_electronic_deed"
                        type="radio"
                        class="btn-check"
                        id="has_electronic_deed_no"
                        value="0"
                        autocomplete="off"
                      />
                      <label class="btn px-4" for="has_electronic_deed_no">
                        <span>@lang('main.no')</span>
                      </label>
                      
                    </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.has_real_estate_market') <span class="text-info">@lang('main.optional')</span></h5>
                      </div>
    
                      <input
                        name="has_real_estate_market"
                        type="radio"
                        class="btn-check"
                        id="has_real_estate_market_yes"
                        value="1"
                        autocomplete="off"
                      />
                      <label class="btn px-4" for="has_real_estate_market_yes">
                        <span>@lang('main.yes')</span>
                      </label>
                      <input
                        name="has_real_estate_market"
                        type="radio"
                        class="btn-check"
                        id="has_real_estate_market_no"
                        value="0"
                        autocomplete="off"
                      />
                      <label class="btn px-4" for="has_real_estate_market_no">
                        <span>@lang('main.no')</span>
                      </label>
                      
                    </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.has_survey_decision') <span class="text-info">@lang('main.optional')</span></h5>
                      </div>
    
                      <input
                        name="has_survey_decision"
                        type="radio"
                        class="btn-check"
                        id="has_survey_decision_yes"
                        value="1"
                        autocomplete="off"
                      />
                      <label class="btn px-4" for="has_survey_decision_yes">
                        <span>@lang('main.yes')</span>
                      </label>
                      <input
                        name="has_survey_decision"
                        type="radio"
                        class="btn-check"
                        id="has_survey_decision_no"
                        value="0"
                        autocomplete="off"
                      />
                      <label class="btn px-4" for="has_survey_decision_no">
                        <span>@lang('main.no')</span>
                      </label>
                      
                    </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.has_mortgage') <span class="text-info">@lang('main.optional')</span></h5>
                      </div>
    
                      <input
                        name="has_mortgage"
                        type="radio"
                        class="btn-check"
                        id="has_mortgage_yes"
                        value="1"
                        autocomplete="off"
                      />
                      <label class="btn px-4" for="has_mortgage_yes">
                        <span>@lang('main.yes')</span>
                      </label>
                      <input
                        name="has_mortgage"
                        type="radio"
                        class="btn-check"
                        id="has_mortgage_no"
                        value="0"
                        autocomplete="off"
                      />
                      <label class="btn px-4" for="has_mortgage_no">
                        <span>@lang('main.no')</span>
                      </label>
                      
                    </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.has_penalties') <span class="text-info">@lang('main.optional')</span></h5>
                      </div>
    
                      <input
                        name="has_penalties"
                        type="radio"
                        class="btn-check"
                        id="has_penalties_yes"
                        value="1"
                        autocomplete="off"
                      />
                      <label class="btn px-4" for="has_penalties_yes">
                        <span>@lang('main.yes')</span>
                      </label>
                      <input
                        name="has_penalties"
                        type="radio"
                        class="btn-check"
                        id="has_penalties_no"
                        value="0"
                        autocomplete="off"
                      />
                      <label class="btn px-4" for="has_penalties_no">
                        <span>@lang('main.no')</span>
                      </label>
                      
                    </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.accepts_mortgage')  <span class="text-info">@lang('main.optional')</span></h5>
                      </div>
    
                      <input
                        name="accepts_mortgage"
                        type="radio"
                        class="btn-check"
                        id="accepts_mortgage_yes"
                        value="1"
                        autocomplete="off"
                      />
                      <label class="btn px-4" for="accepts_mortgage_yes">
                        <span>@lang('main.yes')</span>
                      </label>
                      <input
                        name="accepts_mortgage"
                        type="radio"
                        class="btn-check"
                        id="accepts_mortgage_no"
                        value="0"
                        autocomplete="off"
                      />
                      <label class="btn px-4" for="accepts_mortgage_no">
                        <span>@lang('main.no')</span>
                      </label>
                      
                    </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.usufruct_lease') <span class="text-info">@lang('main.optional')</span></h5>
                      </div>
    
                      <input
                        name="usufruct_lease"
                        type="radio"
                        class="btn-check"
                        id="usufruct_lease_yes"
                        value="1"
                        autocomplete="off"
                      />
                      <label class="btn px-4" for="usufruct_lease_yes">
                        <span>@lang('main.yes')</span>
                      </label>
                      <input
                        name="usufruct_lease"
                        type="radio"
                        class="btn-check"
                        id="usufruct_lease_no"
                        value="0"
                        autocomplete="off"
                      />
                      <label class="btn px-4" for="usufruct_lease_no">
                        <span>@lang('main.no')</span>
                      </label>
                      
                    </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.is_rented') <span class="text-info">@lang('main.optional')</span></h5>
                      </div>
    
                      <input
                        name="is_rented"
                        type="radio"
                        class="btn-check"
                        id="is_rented_yes"
                        value="1"
                        autocomplete="off"
                      />
                      <label class="btn px-4" for="is_rented_yes">
                        <span>@lang('main.yes')</span>
                      </label>
                      <input
                        name="is_rented"
                        type="radio"
                        class="btn-check"
                        id="is_rented_no"
                        value="0"
                        autocomplete="off"
                      />
                      <label class="btn px-4" for="is_rented_no">
                        <span>@lang('main.no')</span>
                      </label>
                      
                    </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.annual_rent')  <span class="text-info">@lang('main.optional')</span></h5>
                      </div>
                      <input
                        name="annual_rent" value="{{old('annual_rent')}}"
                        type="number" min="1" step="1" 
                        class="form-control"
                        placeholder=""
                      />
                    </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.remaining_lease_years')  <span class="text-info">@lang('main.optional')</span></h5>
                      </div>
                      <input
                        name="remaining_lease_years" value="{{old('remaining_lease_years')}}"
                        type="text"
                        class="form-control"
                        placeholder=""
                      />
                    </div>
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.penalty_type') <span class="text-info">@lang('main.optional')</span></h5>
                      </div>
    
                      <input
                        name="penalty_type"
                        type="radio"
                        class="btn-check"
                        id="penalty_type_cash"
                        value="cash"
                        autocomplete="off"
                      />
                      <label class="btn px-4" for="penalty_type_cash">
                        <span>@lang('main.products.cash')</span>
                      </label>
                      <input
                        name="penalty_type"
                        type="radio"
                        class="btn-check"
                        id="penalty_type_installment"
                        value="installment"
                        autocomplete="off"
                      />
                      <label class="btn px-4" for="penalty_type_installment">
                        <span>@lang('main.products.installment')</span>
                      </label>
                      
                    </div>
    
                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.license_number')  <span class="text-info">@lang('main.optional')</span></h5>
                      </div>
                      <input
                        name="license_number" value="{{old('license_number')}}"
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
                  <div class="builder-options w-75">
                     <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>
                          تحميل صور العقار الخاص بك
                          <span class="text-danger">*</span>
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
                                  name="products_image"
                                  type="file"
                                  data-max_length="20"
                                  accept="images/*"
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
                    </div>


                    <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>
                          تحميل صور العقار الخاص بك
                          <span class="text-danger">*</span>
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
                                  accept="images/*"
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
                                  value="{{old('link_video')}}"
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
                  <div class="builder-option">
                      <div class="builder-option-name">
                        <h5>@lang('main.products.title') <span class="text-danger">*</span></h5>
                      </div>
                      <input
                        name="title" value="{{old('title')}}"
                        type="text" id="title"
                        class="form-control"
                        placeholder="متر مربع 250"
                      />
                  </div>
                  <div class="builder-options w-75">
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
                      >{{old('description')}}</textarea>
                    </div>
                  </div>
                </div>
    
                <div class="profile-wrapper mb-3">
                  <div class="section-title d-flex align-items-center gap-2 mb-4">
                    <div class="section-img">
                      <img loading="lazy" src="{{url('site')}}/images/1.svg" alt="change image" />
                    </div>
                    <h5 class="fw-bold m-0">إدارة الصلاحيات</h5>
                  </div>
                  <div class="builder-options w-75">
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
                </div>
    
                <div class="profile-wrapper mb-3">
                  <div class="section-title d-flex align-items-center gap-2 mb-4">
                    <div class="section-img">
                      <img loading="lazy" src="{{url('site')}}/images/1.svg" alt="change image" />
                    </div>
                    <h5 class="fw-bold m-0">خيارات بيع إضافية لعقارك</h5>
                  </div>
    
                  <div class="builder-options w-75">
                    <div
                      class="alert alert-warning d-flex align-items-center"
                      role="alert"
                    >
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
                      <div>
                        اختيارك لهذا النظام غير إلزامي، ويمكنك إتمام عملية البيع
                        بالطريقة التقليدية. لكن إذا رغبت في إضافة ميزة المزايدة أو
                        المشاركة مع آخرين، يمكنك تفعيلها هنا
                      </div>
                    </div>
    
                    <div class="row">
                        <div class="col-12">
                            <div class="builder-option">
                              <div class="builder-option-name">
                                <h5>@lang('main.products.type') </h5>
                              </div>
                                <select name="type" id="product_type" class="form-control">
                                    <option value="" hidden>نظام البيع</option>
                                    <option value="auction" @if('auction' == old('type')) selected @endif >@lang('main.products.auction')</option>
                                    <option value="shared" @if('shared' == old('type')) selected @endif >@lang('main.products.shared')</option>
                                    <option value="investment" @if('investment' == old('type')) selected @endif >@lang('main.products.investment')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 investment-fields">
                            <div class="builder-option">
                                <div class="builder-option-name">
                                  <h5>@lang('main.products.amount_investment')</h5>
                                </div>
                                <input name="price_investment" value="{{ old('price') }}" type="text" class="form-control" placeholder="ريال سعودي 1600000" />
                            </div>
                        </div>

                        <div class="col-12 auction-fields">
                            <div class="builder-option">
                                <div class="builder-option-name">
                                  <h5>@lang('main.products.amount')</h5>
                                </div>
                                <input name="price_auction" value="{{ old('price') }}" type="text" class="form-control" placeholder="ريال سعودي 1600000" />
                            </div>
                        </div>
                        <div class="col-md-6 auction-fields">
                            <div class="builder-option">
                                <div class="builder-option-name">
                                  <h5>@lang('main.products.start_date')</h5>
                                </div>
                                <input name="start_date" value="{{ old('start_date') }}" type="date" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6 auction-fields">
                            <div class="builder-option">
                                <div class="builder-option-name">
                                  <h5>@lang('main.products.end_date')</h5>
                                </div>
                                <input name="end_date" value="{{ old('end_date') }}"  type="date" class="form-control" />
                            </div>
                        </div>
                        <div class="builder-options w-75">
                            <div class="builder-option">
                              <div class="builder-option-name">
                                <h5>
                                 @lang('main.products.additional_info')  <span class="text-info">@lang('main.optional')</span>
                                </h5>
                              </div>
                              <textarea
                                class="form-control"
                                rows="6"
                                name="additional_info"
                                id="additional_info"
                              >{{old('additional_info')}}</textarea>
                            </div>
                          </div>
                    </div>
    
                  </div>
                </div>
    
                <button type="submit" class="main-outline-btn text-center">
                  @lang('main.products.add property')  
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