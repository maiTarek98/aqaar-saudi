@extends('site.index')
@push('custom-css')
<style>
  .copy_txt{
        color: red;
        border: 1px solid red;
        padding: 10px;
        display: none;
    }
  </style>
@endpush
@section('title',$car->title )
@section('content')
@include('site.includes.breadcrumb-section',['title' => $car->title])
<!-- تفاصيل السيارة -->
    <section class="container-fluid mb-5 pb-md-4">
      <div class="car-single">
        <div class="car-wrapper">
          <main class="stick-next-to col-12 col-md-8">
            <!-- **responsive: show only sm screen** -->
            <div class="car-details d-md-none">
              <div class="car_feature pt-0">
                <h5>{{$car->title}}</h5>
                <div class="c_badge">{{__('site.'. $car->car_type)}}</div>
              </div>
            </div>
            <!-- **End responsive: show only sm screen** -->
            @if (count($car->getMedia('images')) > 0)
            <!-- slider images -->
            <div class="single-img position-relative">
              <div class="owl-carousel owl-theme one">
                @foreach($car->getMedia('images') as $key=> $val)
                <?php $imageUrl=url('/storage/car_images/'.$val->id.'/'.$val->file_name);?>
                <a
                  data-fancybox="gallary"
                  href="{{ $imageUrl}}"
                  class="item-box">
                  <img loading="lazy" src="{{ $imageUrl}}" alt="{{$val->id}}" />
                </a>
                @endforeach
              </div>
              <div class="slider-counter">
                <span class="current">01</span>
                <span class="mx-1">من</span>
                <span class="len"> 04 </span>
              </div>
            </div>
            @endif
            @if( $car->sell_car?->publish_by != 'car_owner')
                <div class="status-verified @if (count($car->getMedia('images')) == 0) rounded-3 py-3 m-0  @endif">
                    <i class="bi bi-shield-check"></i>
                    @lang('site.inspection and trusted')
                </div>
            @endif
            <!-- **responsive: show only sm screen** -->
            <div class="car-details d-md-none">
              <div class="car_feature py-2">
                <h5 class="price">
                    <span>@lang('site.price') </span>
                    <span class="current-price">{{$car->real_price}} @lang('site.sar')</span>
                      
                    @if($car->real_price != $car->car_price)
                    <span class="old-price">{{$car->car_price}} @lang('site.sar')</span>
                    @endif
                </h5>
                <span class="hint">@lang('site.price with tax')</span>
              </div>
              <div class="car_feature py-3">
                <button class="heart">
                  <i class="fa-regular fa-heart"></i>
                  <span>@lang('site.add to wishlist')</span>
                </button>
                <!-- action : open share ad modal -->
                <button class="share" data-bs-toggle="modal" data-bs-target="#shareAd_modal">
                  <i class="fa-solid fa-share"></i>
                  <span>@lang('site.share car')</span>
                </button>
              </div>
              <div class="car_feature py-2">
                <div class="">
                  <h5 class="fs-6 mb-1">
                    <span>@lang('site.request_no') :</span>
                    <b>{{$car->request_no}}</b>
                  </h5>
                  <p class="hint">@lang('site.call with car request_no')</p>
                </div>
              </div>
            </div>
            <!-- **End responsive: show only sm screen** -->

            <!-- car information -->
            <div class="car-info mt-4">
              <!-- bg-body-tertiary -->
              <nav id="car_info_nav" class="px-3 mb-3">
                <ul class="nav nav-pills">
                  <li class="nav-item">
                    <a class="nav-link active" href="#scrollspyHeading1">
                        @lang('site.car info')
                        </a>
                  </li>
                  @if($car->car_type == 'used' && $car->car_report->isNotEmpty())
                  <li class="nav-item">
                    <a class="nav-link" href="#scrollspyHeading2">@lang('site.inspection report')</a>
                  </li>
                  @endif
                </ul>
              </nav>
              <div id="scrollspyHeading1">
                <div class="accordion" id="accordionExample">
                  @foreach(\App\Models\CarSpecification::whereNull('parent_id')->get() as $key => $value)
  {{-- Check if there are any valid details for this specification --}}
  @php
    $hasDetails = false;
  @endphp

  {{-- Loop through car details and check for matching specification IDs --}}
  @foreach($car->car_details as $detail)
    @if($value->childs->isNotEmpty() && in_array($detail->car_specification_id, $value->childs->pluck('id')->toArray()))
      @php
        $specTitle = optional($detail->car_specification)->title;
        $specType = optional($detail->car_specification)->type;
        $detailTitle = $detail->title;
        $selectTitle = \App\Models\CarSpecification::find($detail->title)?->title;
      @endphp

      {{-- Check if there is content to display --}}
      @if($specType == 'yes_no' && $detailTitle == 'yes' || $specType == 'select' && $selectTitle || $specType != 'yes_no' && $detailTitle)
        @php
          $hasDetails = true;
        @endphp
      @endif
    @endif
  @endforeach

  {{-- Only render this accordion item if there are details to show --}}
  @if($hasDetails)
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button @if($key == 0) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
          {{$value->title}}
        </button>
      </h2>
      <div id="collapse{{$key}}" class="accordion-collapse collapse @if($key == 0) show @endif" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <ul>
            @if($key == 0)
              <li>الموديل : {{$car->car_model_year}}</li>
            @endif
                    @foreach($car->car_details as $detail)
                      @if($value->childs->isNotEmpty() && in_array($detail->car_specification_id, $value->childs->pluck('id')->toArray()))
                        @php
                          $specTitle = optional($detail->car_specification)->title;
                          $specType = optional($detail->car_specification)->type;
                          $detailTitle = $detail->title;
                          $selectTitle = \App\Models\CarSpecification::find($detail->title)?->title;
                        @endphp
        
                        @if($specType == 'yes_no' && $detailTitle == 'yes')
                          <li>{{ $specTitle }}</li>
                        @elseif($specType == 'select' && $selectTitle)
                          <li>{{ $specTitle }} : {{ $selectTitle }}</li>
                        @elseif($specType != 'yes_no' && $detailTitle)
                          <li>{{ $specTitle }} : {{ $detailTitle }}</li>
                        @endif
                      @endif
                    @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
              @endif
            @endforeach

                </div> 
              </div>
              @if($car->car_type == 'used' && $car->car_report->isNotEmpty())
              <div id="scrollspyHeading2" class="check_report_wrapp">
                <div class="check_report">
                  <h5 class="car_info_title">
                @lang('site.full inspection report')
                  </h5>
                  <p class="text-center">
                @lang('site.report msg')
                  </p>
                  <ul>
                    <a href="{{route('product.report',['car_no'=>$car->request_no])}}" class="link" style="z-index: 9;"></a>
                    @foreach($car->car_report->unique('inspection_report.parent.title') as $val)
                      <li>
                        {{$val->inspection_report?->parent?->title}}
                        @if(in_array($val->inspection_report?->id, $car->car_report?->pluck('inspection_report_id')->toArray()) && $car->car_report->where('inspection_report_id',$val->inspection_report?->id)->contains('value', 'yes')) 
                        <img loading="lazy" src="{{url('site')}}/images/check_mark.svg" alt="check_mark">
                        @elseif(in_array($val->inspection_report?->id, $car->car_report?->pluck('inspection_report_id')->toArray()) && $car->car_report->where('inspection_report_id',$val->inspection_report?->id)->contains('value', 'no'))
                        <img loading="lazy" src="{{url('site')}}/images/exclamation.svg" alt="exclamation">
                        @endif
                      </li>
                    @endforeach
                  </ul>
                  <div class="w-100 text-center my-4">
                    <a href="{{route('product.report',['car_no'=>$car->request_no])}}" target="_blank" class="main-btn">
                   @lang('site.show all report')
                    </a>
                  </div>
                  <div class="check_report_info">
                    @if(! $car->car_report->isEmpty())
                    <p>
                    @lang('site.inspection date') : {{$car_report_date_hijri}} | {{$car->car_report[0]->created_at->format('Y/m/d')}}
                    </p>
                    @endif
                    <!-- action : open Disclaimer modal -->
                    <button class="hint fs-6" data-bs-toggle="modal" data-bs-target="#Disclaimer_modal">
                    @lang('site.disclaimer msg')
                    </button>
                  </div>
                </div>
              </div>
              @endif
            </div>
          </main>
          <!-- sticky aside -->
          <aside class="sticky-wrapper col-12 col-md-4">
            <div class="car-details sticky d-none d-md-block">
              <div class="car_feature pt-0">
                <h5>{{$car->title}}</h5>
                <div class="c_badge">{{__('site.'. $car->car_type)}}</div>
              </div>
              <div class="car_feature">
                <div class="w-100">
                  <h5 class="price">
                    <span>@lang('site.price') </span>
                    <span class="current-price">{{$car->real_price}} @lang('site.sar')</span>
                    @if($car->real_price != $car->car_price)
                    <span class="old-price"> {{$car->car_price}} @lang('site.sar')</span>
                    @endif
                  </h5>
                  <span class="hint">@lang('site.price with tax')</span>
                  <div class="car_actions">
                    <!-- action : open confirm book modal -->
                    @guest('web')
                    <a class="main-btn w-100 my-md-3" href="{{route('login')}}">
                      @lang('site.signin first')
                    </a>
                    @endguest
                    @auth('web')
                    @if($car->is_reserved())  
                      <button class="main-btn w-100 my-md-3" disabled>
                      @lang('site.already reserved')
                    </button>

                    @else
                    <button class="main-btn w-100 my-md-3" data-bs-toggle="modal" data-bs-target="#book_modal">
                      @lang('site.reserv now')
                    </button>
                    @endif
                    @endauth
                    <!-- action : show div.car-contact -->
                    
                    @if($car->sell_car != null && $car->sell_car->publish_by == 'car_owner' && $car->sell_car->mobile != null)
                    <button class="toggle_contact btn_show_contact main-outline-btn w-100" id="btn_show_contact" data-target="car_contact">
                      @lang('site.contact for reserv')
                    </button>
                    <div class="car_contact d-none">
                          <div class="bg-white">
                            <div class="d-flex align-items-center gap-2">
                              <button class="toggle_contact bg-transparent" data-target="btn_show_contact">
                                <i class="fa-solid fa-close fs-5"></i>
                              </button>
                              <h5 class="text-center">@lang('site.contactus from') : </h5>
                            </div>
                            @if($car->sell_car->mobile)
                            <a href="tel:{{$car->sell_car->mobile}}" class="main-outline-btn w-100 my-3 px-4">
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                  <i class="fa-solid fa-phone-flip fs-5"></i>
                                  <span>@lang('site.calling')</span>
                                </div>
                                <span>{{$car->sell_car->mobile}}</span>
                              </div>
                            </a>
                            @endif
                           
                          </div>
                        </div>
                    @else
                    <button class="toggle_contact btn_show_contact main-outline-btn w-100" id="btn_show_contact" data-target="car_contact">
                      @lang('site.contact for reserv')
                    </button>
                        @if(app(App\Models\GeneralSettings::class)->phone || app(App\Models\GeneralSettings::class)->another_phone) 
                        <div class="car_contact d-none">
                          <div class="bg-white">
                            <div class="d-flex align-items-center gap-2">
                              <button class="toggle_contact bg-transparent" data-target="btn_show_contact">
                                <i class="fa-solid fa-close fs-5"></i>
                              </button>
                              <h5 class="text-center">@lang('site.contactus from') : </h5>
                            </div>
                            @if(app(App\Models\GeneralSettings::class)->phone)
                            <a href="tel:{{app(App\Models\GeneralSettings::class)->phone}}" class="main-outline-btn w-100 my-3 px-4">
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                  <i class="fa-solid fa-phone-flip fs-5"></i>
                                  <span>@lang('site.calling')</span>
                                </div>
                                <span>{{app(App\Models\GeneralSettings::class)->phone}}</span>
                              </div>
                            </a>
                            @endif
                            @if(app(App\Models\GeneralSettings::class)->another_phone)
                            <a href="https://api.whatsapp.com/send?phone={{app(App\Models\GeneralSettings::class)->another_phone}}&text=ابي استفسر عن شراء {{$car->title}} - {{__('main.'.$car->car_type)}} - لون  {{$car->color}} -للبيع  - {{$car->request_no}} | {{url()->current()}}" 
                            target="_blank" 
                            class="main-btn w-100 px-4">
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                  <i class="fa-brands fa-whatsapp fs-5"></i>
                                  <span>@lang('site.whatsapp')</span>
                                </div>
                                <span>{{app(App\Models\GeneralSettings::class)->another_phone}}</span>
                              </div>
                            </a>
                            @endif
                          </div>
                        </div>
                        @endif
                    @endif
                  </div>
                </div>
              </div>
              <div class="car_feature">
                <button class="heart">
                  
                </button>

                @guest('web')
                  <a href="{{route('login')}}" class="heart"><i class="fa-regular fa-heart"></i>
                  <span>@lang('site.add to wishlist')</span></a>
                @endguest 
                
                @auth('web')
                <a href="{{ route('user-wishlist-add',$car->id) }}" class="heart @if($car->is_fav()) fav @endif add-to-wish" data-id="{{$car->id}}">
                  <i class="fa-regular fa-heart"></i>
                  <span>@lang('site.add to wishlist')</span>
                </a>
                @endauth

                <!-- action : open share ad modal -->
                <button class="share" data-bs-toggle="modal" data-bs-target="#shareAd_modal">
                  <i class="fa-solid fa-share"></i>
                  <span>@lang('site.share car')</span>
                </button>
              </div>
              <div class="car_feature border-0">
                <div class="">
                  <h5 class="fs-6 mb-2">
                    <span>@lang('site.request_no') :</span>
                    <b>{{$car->request_no}}</b>
                  </h5>
                  <p>@lang('site.call with car request_no')</p>
                </div>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </section>
    @php $cars=\App\Models\Car::where('id','!=', $car->id)->where('car_model_id', $car->car_model_id)->where('status','show')->get(); @endphp
    @if($cars->count() > 0 )
    <!-- سيارات مشابهة -->
    <section class="cars car_offers py-md-5 my-5 bg-transparent">
      <div class="container-fluid" style="padding-inline-end: 0 !important">
        <h2 class="title text-start mb-4">@lang('site.recommends car')</h2>
        <div class="owl-carousel">
          @forelse($cars as $elsecar)
            @include('site.includes.car-section',['car' => $elsecar])
          @empty
            <h3>@lang('site.NoData')</h3>
          @endforelse
        </div>
      </div>
    </section>
    @endif


    <!-- confirm book modal -->
    <div class="modal fade" id="book_modal" tabindex="-1" aria-labelledby="book_modalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="book_modalLabel">@lang('site.confirm reservation') </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h4 class="fs-5 mb-3">
              @lang('site.reserv') {{$car->title}} | @lang('site.request_no') : {{$car->request_no}}
            </h4>
            @if ($firstImage= $car->getFirstMediaUrl('images','thumb'))
              <img loading="lazy" src="{{ $firstImage }}" alt="{{$car->title}}">
            @endif
          </div>
          <div class="modal-footer">
                                          <div class="loading-indicator">
                                <p>Loading...</p>  <!-- Optional: you can use a spinner here -->

            <button type="button" class="main-btn add-to-cart" data-route="{{url('/addcart/'. $car->id)}}" data-price="{{$car->real_price}}" data-id="{{$car->id}}" >@lang('site.confirm')</button>
            <button type="button" class="main-outline-btn px-4" data-bs-dismiss="modal">@lang('site.close')</button>
          </div>

          </div>
        </div>
      </div>
    </div>


     <!-- share ad modal -->
    <div class="modal fade" id="shareAd_modal" tabindex="-1" aria-labelledby="shareAd_modalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="shareAd_modalLabel">@lang('site.share this car')</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            {{--<h4>
              {{$car->title}}
            </h4>--}}
            <div class="social-share">
              <a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" target="_blank">
                <img loading="lazy" src="{{url('site')}}/images/facebookShare.svg" width="48" height="48" alt="facebookShare">
                <span>@lang('site.facebook')</span>
              </a>
              <a href="https://twitter.com/intent/tweet?url={{url()->current()}}" target="_blank">
                <img loading="lazy" src="{{url('site')}}/images/xShare.png" width="48" height="48" alt="xShare">
                <span>@lang('site.twitter')</span>
              </a>
              <a href="https://api.whatsapp.com/send?text={{url()->current()}}" target="_blank">
                <img loading="lazy" src="{{url('site')}}/images/whatsappShare.png" width="48" height="48" alt="whatsappShare">
                <span>  @lang('site.whatsapp')</span>
              </a>
            </div>
            <div class="copy-text copy-link">
              <input type="text" id="copy" class="copy-link-input text" value="{{url()->current()}}" readonly>
              <button type="button" onclick="copyToClipboard('copy')"><i class="fa fa-clone"></i></button>
              <div class="copy_txt">
                <span> link copied to clipboard</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
@push('custom-js')
 <script>
    function copyToClipboard(id) {
        document.getElementById(id).select();
        document.execCommand('copy');
        $('.copy_txt').fadeIn(500);
        $(".copy_txt").fadeOut(700);
    }
    var submitButton = $(".add-to-cart");
    var loadingIndicator = $(".loading-indicator p");
    submitButton.prop("disabled", false);
    loadingIndicator.hide();

      $(document).on("click", ".add-to-cart", function () {
          var pid = $(this).attr('data-id');
          var pprice = $(this).attr('data-price');
          var route = $(this).attr('data-route');
            $.ajax({
              type: "POST",
              url: route,
              async: true,
              data: { _token: '{{csrf_token()}}', id: pid, price: pprice },
              beforeSend: function() {
                    submitButton.prop("disabled", true);
                    $(".loading-indicator p").show(); // Show loading indicator
                },
              success: function (data) {
                // console.log(data)
                if (data.errors) {
                } else if (data.data == false) {
                  toastr.error('site.already in cart')
                } else {
                  if(data == 2){
                    toastr.error('@lang('site.already reserved')')
                  }else{
                    toastr.success('@lang('site.add to cart')')
                    submitButton.prop("disabled", true); // Re-enable the submit button
                  }
                }
              },
                complete: function(xhr, status) {
                    console.log("Request completed.");
                    $(".loading-indicator p").hide(); // Hide the loading indicator
                    submitButton.prop("disabled", false); // Re-enable the submit button
                }
            });
        });
</script>
@endpush