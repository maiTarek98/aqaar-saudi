@extends('site.index')
@section('title', trans('site.sellCar') )
@section('content')
@include('site.includes.breadcrumb-section',['title' =>trans('site.sellCar')  ])
@php 
if(request('car')){
  $sell_ur_car = \App\Models\Car::where('id',request('car'))->first();
}else{
  $sell_ur_car = null;
}
@endphp

@if(request('form_id') == 'owner_mobile_verify')
<main>
  <div class="container-fluid pb-5">
    <div class="sell_car mb-md-4">
      <div class="text-center">
        <p class="fs-5 fw-semibold">@if(session()->has('sell_email_otp_code') && session()->get('sell_email_otp_code') != null ) @lang('site.verify ur email') @else
        @lang('site.verify ur mobile') @endif</p>
        <img loading="lazy" src="{{url('site')}}/images/v_otp.svg" class="v_otp" alt="v_otp image" />
        <form action="{{route('sellMobileVerify')}}" method="post">
          @csrf
          <div class="text-center">
            <label class="fw-semibold">@lang('site.write otp which is sent')</label>
            <p class="fw-bold my-2">@if(session()->has('sell_email_otp_code') && session()->get('sell_email_otp_code') != null ) {{isUserSellCar()?->email}} @else 
            {{isUserSellCar()?->mobile}} @endif</p>
            <a role="button" class="forgot terms" onclick="history.back()" >
              @if(session()->has('sell_email_otp_code') && session()->get('sell_email_otp_code') != null ) @lang('site.change email') @else @lang('site.change mobile') @endif
            </a>
            <div id="verification-input">
              <input type="text" name="mobile_code[]" required/>
              <input type="text" name="mobile_code[]" required/>
              <input type="text" name="mobile_code[]" required/>
              <input type="text" name="mobile_code[]" required/>
            </div>
            
              <p class="login_replace mb-4"> @lang('site.dont send') 
                  <button id="sendOtpBtn">@lang('site.send again')</button></p>
    <div id="message"></div>
    
            {{--<p class="login_replace mb-4">@lang('site.not send otp')  <button class="text-decoration-underline"> @lang('site.send otp again')</button> </p>--}}
            <button type="submit" class="d-block main-btn m-auto px-5">@lang('site.check code')</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
@elseif(request('form_id') == 'sell_car_done')
<main>
  <div class="container-fluid pb-5">
    <div class="sell_car mb-md-4">
      <div class="text-center sell_done">
        <img loading="lazy" src="{{url('site')}}/images/done.svg" class="v_otp done" alt="v_otp image" />
        <div class="text-center">
          <p class="fw-bold my-4">
            @lang('site.reservation is done')
          </p>
          <a href="{{route('home')}}" class="d-block main-btn m-auto px-5">@lang('site.goto home')</a>
        </div>
      </div>
    </div>
  </div>
</main>
@else
<main>
  <div class="container-fluid pb-5">
    <div class="sell_car mb-md-4">
      <!-- خطوات النموذج -->
      <div class="steps-container">
        <div class="step active">
          <span class="step_num">1</span>
          <span class="step_name">@lang('site.ur car info')</span>
        </div>
        <div class="step @if(request('form_id') == 'car_estimated_price') active @endif">
          <span class="step_num">2</span>
          <span class="step_name">@lang('site.ur expected price')</span>
        </div>
        <div class="step @if(request('form_id') == 'sell_car_appointment') active @endif">
          <span class="step_num">3</span>
          <span class="step_name">@lang('site.ur inspection date')</span>
        </div>
      </div>

      <div class="progress" style="height: 3px;">
        <div class="progress-bar" role="progressbar" style="width: 0;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      @if(request('form_id') == 'car_details')
      <div class="step-part" id="part-1">
        <h4 class="my-3">@lang('site.choose car info')</h4>
        <form method="post" action="{{route('sellTempForm',['form_id'=>'owner_details'])}}">
          @csrf
          <div class="row gy-3">
            <div class="col-12">
              <select name="car_brand_id" class="form-control form-select" id="brand_id" required>
                <option hidden="" value="">@lang('site.choose car brand')</option>
                @foreach (\App\Models\CarBrand::where('brand_status','enable')->get() as $brand)
                <option value="{{$brand->id}}" @if ($brand->id == old('car_brand') or $brand->id == isUserSellCar()?->car_brand_id or ($sell_ur_car  != null && $sell_ur_car->car_brand_id == $brand->id)) selected @endif>
                  {{ $brand->brand_name }}
                </option>
                @endforeach
              </select>
            </div>
            <div class="col-12">
              <select name="car_model_id" class="form-control form-select"
              required id="car_model_id">
              @if(isUserSellCar()?->car_model_id)
                <option value="{{isUserSellCar()?->car_model_id}}" selected>{{isUserSellCar()?->car_model?->model_name}}</option>
              @elseif($sell_ur_car != null)
                <option value="{{$sell_ur_car?->car_model_id}}" selected>{{$sell_ur_car?->car_model?->model_name}}</option>
              @else
              <option hidden="" value="">@lang('site.choose model')</option>
              @endif
            </select>
          </div>
          <div class="col-12">
            <select name="car_category_id" class="form-control form-select"
            required id="car_category_id">
            @if(isUserSellCar()?->car_model_id)
                <option value="{{isUserSellCar()?->car_category_id}}" selected>{{isUserSellCar()?->car_category?->model_name}}</option>
            @elseif($sell_ur_car != null)
                <option value="{{$sell_ur_car?->car_category_id}}" selected>{{$sell_ur_car?->car_category?->model_name}}</option>
              @else
            <option hidden="" value="">@lang('main.SelectCarCategoryName')</option>
              @endif
          </select>
        </div>
        <div class="col-12">
          <select name="car_model_year" class="form-control form-select" required>
            <option hidden="" value="">@lang('site.choose model year')</option>
            @for($i = date('Y', strtotime('+1 year')); $i >= 2010; $i--)
            <option value="{{ $i }}"  @if(isUserSellCar()?->car_model_year == $i or ($sell_ur_car != null && $sell_ur_car->car_model_year == $i)) selected @endif>{{ $i }}</option>
            @endfor
          </select>
        </div>
        <div class="col-12">
          <select
          name="car_walker"
          class="form-control form-select"
          required
          >
          <option hidden="" value="">@lang('site.car_walker')</option>
          <option value="0-10000">@lang('main.car_walker-0-10000')</option>
          <option value="10000-50000">@lang('main.car_walker-10000-50000')</option>
          <option value="50000-70000">@lang('main.car_walker-50000-70000')</option>
          <option value="70000-100000">@lang('main.car_walker-70000-100000')</option>
          <option value="100000-130000">@lang('main.car_walker-100000-130000')</option>
          <option value="130000-190000">@lang('main.car_walker-130000-190000')</option>
          <option value="190000">@lang('main.car_walker-190000')</option>
        </select>
      </div>
      <div class="col-12">
        <select
        name="car_condition"
        class="form-control form-select"
        required
        >
        <option hidden="" value="">@lang('site.car_condition')</option>
        <option value="1" @if(isUserSellCar()?->car_condition == 1) selected @endif>@lang('main.car_condition-1')</option>
        <option value="2" @if(isUserSellCar()?->car_condition == 2) selected @endif>@lang('main.car_condition-2')</option>
        <option value="3" @if(isUserSellCar()?->car_condition == 3) selected @endif>@lang('main.car_condition-3')</option>
      </select>
    </div>
    <div class="col-12">
      <select name="car_color" class="form-control form-select" required>
        <option hidden="" value="">@lang('site.car color')</option>
        @foreach(colors() as $value)
        <option value="{{$value}}" @if(isUserSellCar()?->car_color == $value) selected @endif>{{$value}}</option>
        @endforeach
      </select>
    </div>
    <div class="col-12">
      <label class="d-block">@lang('site.are car installment')</label>
      <input type="radio"  @if(isUserSellCar()?->car_type == 'owned') checked @endif class="btn-check" name="car_type" id="option5" autocomplete="off" required value="owned">
      <label class="btn" for="option5">@lang('site.owned')</label>

      <input type="radio"  @if(isUserSellCar()?->car_type == 'installment') checked @endif class="btn-check" name="car_type" id="option6" autocomplete="off" required value="installment">
      <label class="btn" for="option6">@lang('site.installment')</label>

    </div>
    
    <div class="col-12">
        <label class="d-block">هل تريد البيع بواسطتك ام بواسطة محرك ؟</label>
        <input type="radio" class="btn-check" name="publish_by" id="soldByMoharek" autocomplete="off" required value="mohrk" checked>
        <label class="btn" for="soldByMoharek"> محرك</label>
    
        <input type="radio" class="btn-check" name="publish_by" id="soldByUser" autocomplete="off" required value="car_owner">
        <label class="btn" for="soldByUser">عن طريقي</label>
    </div>
    
    <div class="col-12">
        <div class="form-check" data-target="mohrk">
            <input class="form-check-input" type="radio" name="agree_policy" value="moharekPolicy" id="soldByMoharekPolicy" required>
            <label class="form-check-label" for="soldByMoharekPolicy">
                أتعهد أنا المعلن بدفع عمولة الموقع وقدرها 5% من قيمة البيع، اذا تم البيع عن طريق الموقع . كما ألتزم بدفع العمولة خلال 10 أيام من استلام كامل مبلغ المبايعة  
            </label>
        </div>
        <div class="form-check" data-target="car_owner" style="display: none;">
            <input class="form-check-input" type="radio" name="agree_policy" value="userPolicy" id="soldByUserPolicy" required>
            <label class="form-check-label" for="soldByUserPolicy">
                أتعهد أنا المعلن بدفع عمولة الموقع وقدرها 1% من قيمة البيع، اذا تم البيع بسبب الموقع . كما ألتزم بدفع العمولة خلال 10 أيام من استلام كامل مبلغ المبايعة
            </label>
        </div>
    </div>

    <div class="col-auto ms-auto">
      <button type="submit" id="nextButton" class="main-btn d-block disabled-link">
        @lang('site.next')
      </button>
    </div>
  </div>
</form>
</div>
@endif

@if(request('form_id') == 'owner_details')
<div class="step-part" id="part-1">
  <h4 class="my-3">@lang('site.owner info')</h4>
  <form method="post" action="{{route('sellTempForm',['form_id'=>'owner_mobile_verify'])}}">
    @csrf
    <div class="row gy-3">
      <div class="col-12">
        <input
        type="text" name="name" @auth('web') value="{{auth('web')->user()->name}}" @endauth @guest('web') value="{{isUserSellCar()?->name}}" @endguest
        class="form-control"
        placeholder="@lang('site.full name')"
        required
        />
      </div>
    
      <div class="col-12">
        <input
        type="email" name="email" @guest('web') value="{{isUserSellCar()?->email}}" @endguest
        class="form-control" @auth('web') value="{{auth('web')->user()->email}}" @endauth
        placeholder="@lang('site.email')"
        required
        />
      </div>
      
      <div class="col-12">
        <input
        type="text" name="mobile" @guest('web') value="{{isUserSellCar()?->mobile}}" @endguest
        class="form-control" @auth('web') value="{{auth('web')->user()->mobile}}" @endauth
        placeholder="@lang('site.mobile')"
        required
        />
      </div>
      <div class="col-12">
        <select
        name="city_id"
        class="form-control form-select"
        required
        >
        <option hidden="" value="">@lang('site.inspection city')</option>
        @foreach(\App\Models\City::where('city_status','enable')->get() as $city)
        <option value="{{$city->id}}" @if(isUserSellCar()?->city_id == $city->id) selected @endif>{{$city->city_name}}</option>
        @endforeach
      </select>
    </div>

    <div class="col-12">
      <div class="form-check">
        <input name="agree_terms" 
        class="form-check-input"
        type="checkbox"
        value=""
        id="approveSellTerms"
        required
        />
        <label class="form-check-label" for="approveSellTerms">
          <a
          role="button"
          class="forgot terms"
          data-bs-toggle="modal"
          data-bs-target="#sellTerm_modal"
          >
         @lang('site.agree terms')
        </a>
      </label>
    </div>
  </div>

  <div class="col-auto ms-auto">
    <button type="submit" id="nextButton"
    class="main-btn d-block disabled-link">
    @lang('site.next')
  </button>
</div>
</div>
</form>
</div>
@endif

@if(request('form_id') == 'car_location')
<div class="step-part" id="part-1">
  <h4 class="my-3">@lang('site.car location')</h4>
  <form method="post" action="{{route('sellTempForm',['form_id'=>'car_images'])}}">
    @csrf
    <div class="row gy-3">
      <div class="col-12">
        @php $country= \App\Models\Country::first();  @endphp
        <select
        name="owner_city_id"
        class="form-control form-select"
        required
        >
        <option hidden="" value="">@lang('site.country')</option>
        <option value="{{$country->id}}" selected>{{$country->country_name}}</option>
      </select>
    </div>

    <div class="col-12">
      <select
      name="owner_area_id"
      class="form-control form-select"
      required
      >
              <option hidden="" value="">@lang('site.city')</option>
@foreach(\App\Models\City::where('city_status','enable')->get() as $city)
        <option value="{{$city->id}}" @if(isUserSellCar()?->owner_area_id == $city->id) selected @endif>{{$city->city_name}}</option>
        @endforeach
      </select>

  </div>

  <div class="col-auto ms-auto">
    <button type="submit" id="nextButton" class="main-btn d-block disabled-link">
      @lang('site.next')
    </button>
  </div>
</div>
</form>
</div>
@endif

@if(request('form_id') == 'car_images')
<div class="step-part" id="part-1">
  <h4 class="my-3">@lang('site.car images')</h4>
  <form enctype="multipart/form-data" method="post" action="{{route('sellTempForm',['form_id'=>'car_estimated_price'])}}">
    @csrf
    <div class="row gy-3">
      <div class="col-12">
        <div class="upload__box">
          <div class="upload__btn-box">
            <label class="upload__btn">
              <img loading="lazy" src="{{url('site')}}/images/upload_imgs.svg" alt="">
              <input type="file" name="car_images[]" multiple="" data-max_length="20" class="upload__inputfile" accept="image/*" required>
            </label>
          </div>
          <div class="upload__img-wrap">

          </div>
        </div>
      </div>

      <div class="col-12">
        <textarea class="form-control" placeholder="@lang('site.add notes')" name="notes" id="" rows="6"></textarea>
      </div>

      <div class="col-auto ms-auto">
        <button type="submit" id="nextButton" class="main-btn d-block disabled-link">
          @lang('site.next')
        </button>
      </div>
    </div>
  </form>
</div>
@endif


@if(request('form_id') == 'car_estimated_price')
<div class="step-part" id="part-1">
  <form method="post" action="{{route('sellTempForm',['form_id'=>'sell_car_appointment'])}}">
    @csrf
    <div class="row gy-3">
      <div class="col-12">
        <input
        type="number" step="0.1" min="1" name="expected_car_price" value="{{isUserSellCar()?->expected_car_price}}"
        class="form-control mt-5 mb-3"
        placeholder="@lang('site.enter ur expected price')"
        required
        />
      </div>

      <div class="col-auto ms-auto">
        <button type="submit" 
        id="nextButton"
        class="main-btn d-block disabled-link"
        >
        @lang('site.next')
      </button>
    </div>
  </div>
</form>
</div>
@endif

@if(request('form_id') == 'sell_car_appointment')
<div class="step-part" id="part-1">
  <h4 class="my-3">@lang('site.choose inspection date')</h4>
  <form method="post" action="{{route('sellTempForm',['form_id'=>'sell_car_done'])}}">
    @csrf
    <div class="row gy-3">
      <div class="col-12">
        <input name="inspection_date" 
        type="date" value="{{isUserSellCar()?->inspection_date}}"  min="<?php echo date('Y-m-d'); ?>"
        class="form-control"
        placeholder="@lang('site.enter ur inspection_date')"
        required
        />
      </div>

      <div class="col-auto ms-auto">
        <button type="submit" 
        id="nextButton"
        class="main-btn d-block disabled-link"
        >
        @lang('site.next')
      </button>
    </div>
  </div>
</form>
</div>
@endif
</div>
</div>
</main>
@endif
@endsection
@include('admin.ads.ajax_to_get_car_models_by_car_brand_id')
@include('admin.ads.ajax_to_get_car_categorys_by_car_model_id')
@push('custom-js')
<script type="text/javascript">
     $('#sendOtpBtn').on('click', function() {
            $(this).prop('disabled', true);
            $.ajax({
                url: "{{ route('sellCar.otp') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#message').text(response.message);
                    if (response.success) {
                        setTimeout(function() {
                            $('#sendOtpBtn').prop('disabled', false);
                            $('#message').text('You can request a new OTP now.');
                        }, 30000); // 30 seconds
                    } else {
                        setTimeout(function() {
                            $('#sendOtpBtn').prop('disabled', false);
                        }, 30000); // 30 seconds
                    }
                },
                error: function(xhr) {
                    $('#message').text('An error occurred. Please try again.');
                    $('#sendOtpBtn').prop('disabled', false);
                }
            });
        });
</script>
@endpush