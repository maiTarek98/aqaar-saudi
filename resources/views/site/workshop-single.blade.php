@extends('site.index')
@section('title',$workshop->name )
@section('content')
@include('site.includes.breadcrumb-section',['title' => $workshop->name])
<!-- ورش الصيانة -->
    <div class="container-fluid mb-5 pb-md-4">
      <div class="workshop-single">
        <div class="row">
          <div class="col-12 col-md-7">
            <div class="single-img">
              <div class="all">
                <div class="slider">
                  <div class="owl-carousel owl-theme one">
                    @if ($firstImage= $workshop->photo_cover)
                    <a
                      data-fancybox="gallary"
                      href="{{ url($firstImage) }}"
                      class="item-box"
                    >
                      <img loading="lazy" src="{{ url($firstImage) }}" alt="{{$workshop->name}}" />
                    </a>
                    @else
                      <img loading="lazy" src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->logo)}}" loading="lazy" class="workshop_img" alt="{{$workshop->name}}">
                    @endif

<!-- 
                    
                    <a
                      data-fancybox="gallery"
                      href="{{url('site')}}/images/02.jpg"
                      class="item-box"
                    >
                      <img loading="lazy" src="{{url('site')}}/images/02.jpg" alt="" />
                    </a>
                    <a
                      data-fancybox="gallery"
                      href="{{url('site')}}/images/03.jpg"
                      class="item-box"
                    >
                      <img loading="lazy" src="{{url('site')}}/images/03.jpg" alt="" />
                    </a>
                    <a
                      data-fancybox="gallery"
                      href="{{url('site')}}/images/06.jpg"
                      class="item-box"
                    >
                      <img loading="lazy" src="{{url('site')}}/images/06.jpg" alt="" />
                    </a>
                    <a
                      data-fancybox="gallery"
                      href="{{url('site')}}/images/Rectangle 8.png"
                      class="item-box"
                    >
                      <img loading="lazy" src="{{url('site')}}/images/Rectangle 8.png" alt="" />
                    </a>
                    <a
                      data-fancybox="gallery"
                      href="{{url('site')}}/images/04.webp"
                      class="item-box"
                    >
                      <img loading="lazy" src="{{url('site')}}/images/04.webp" alt="" />
                    </a> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-5">
            <div class="workshop-details">
              <div class="workshop_feature">
                <div class="d-flex align-items-center gap-2">
                  <img loading="lazy" src="{{url('site')}}/images/CAR WORKSHOPE.svg" class="workshop_img">
                  <h5>{{$workshop->name}}</h5>
                </div>
                <div class="Stars" style="--rating: {{$workshop->rate_overall}}"></div>
              </div>
              <div class="workshop_feature">
                <div class="d-flex align-items-center gap-2">
                  <img loading="lazy" src="{{url('site')}}/images/Icon awesome-city.svg" alt="" class="img">
                  <h5>{{$workshop->city?->city}} {{-- 50.00km --}}</h5>
                </div>
                <label class="switch">
                  <input type="checkbox" disabled @if($workshop->is_available == '1') checked @endif />
                  <div class="slider round">
                    <span class="on">@lang('site.is_yes_available')</span>
                    <span class="off">@lang('site.is_not_available')</span>
                  </div>
                </label>
              </div>
              <div class="workshop_feature">
                <div>
                  <h5 class="mb-3">@lang('site.for reserv download app')</h5>
                  <div class="apps-btns">
                    <a href="{{app(App\Models\GeneralSettings::class)->ios_link}}" target="_blank" class="main-btn">
                      <img loading="lazy" src="{{url('site')}}/images/apple.svg" alt="apple image" />
                      <div>
                        <span>@lang('site.download now')</span>
                        <h5>Apple store</h5>
                      </div>
                    </a>
                    <a href="{{app(App\Models\GeneralSettings::class)->android_link}}" target="_blank">
                      <img loading="lazy" src="{{url('site')}}/images/GooglePlay.png" alt="GooglePlay" />
                      <div>
                        <span>@lang('site.download now')</span>
                        <h5>Google play</h5>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            {{--<div id="map">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3418.134910986955!2d31.3914636!3d31.050343599999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14f79d99ef7ea253%3A0xe92319f27469b714!2z2LPZhdin2LHYqiDZgdmK2KzZhiDZhNiq2LXZhdmK2YUg2YjYqNix2YXYrNipINin2YTZhdmI2KfZgti5!5e0!3m2!1sar!2seg!4v1729603808611!5m2!1sar!2seg"
                width="600"
                height="450"
                style="border: 0"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
            </div>--}}
          </div>
        </div>
      </div>
      @if($workshop->categorys->count() > 0)
      <div class="services mt-5 pb-md-4">
        <div class="row gy-4">
          <div class="col-md-4 col-lg-4">
            <ul class="nav flex-column servs-nav">
              @foreach($workshop->categorys as $key => $value)
              <li class="nav-item">
                <button
                  class="nav-link @if($key == 0) active @endif"
                  id="v-pills-serv{{$key}}-tab"
                  data-bs-toggle="pill"
                  data-bs-target="#v-pills-serv{{$key}}"
                  type="button"
                  role="tab"
                  aria-controls="v-pills-serv{{$key}}"
                  aria-selected="true"
                >
                  <div class="serv-item">
                    <div class="icon">
                      @if($value->service_image)
                      <img loading="lazy" src="{{url($value->service_image)}}" alt="{{$value->title}}" />
                      @else
                      <img loading="lazy" src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->logo)}}" loading="lazy" alt="{{$value->title}}" />
                      @endif
                    </div>
                    <span>{{$value->title}}</span>
                  </div>
                </button>
              </li>
              @endforeach
            </ul>
          </div>
          <div class="col-md-8 col-lg-8">
            <div class="tab-content" id="v-pills-tabContent">
              @foreach($workshop->categorys as $key => $value)
              <div
                class="tab-pane fade @if($key == 0) show active @endif"
                id="v-pills-serv{{$key}}"
                role="tabpanel"
                aria-labelledby="v-pills-serv{{$key}}-tab"
                tabindex="0"
              >
                <div class="serv-details">
                  <h4 class="serv-title">@lang('site.service details')</h4>
                  <div class="serv-desc">
                    <p>
                      {!! $value->description !!}
                    </p>
                  </div>
                  <h4 class="serv-title">@lang('site.expected price')</h4>
                  <div class="serv-desc">
                    <p class="serv-price">
                      <span>{{$value->price}}</span>
                      <span>@lang('site.sar')</span>
                    </p>
                  </div>
                  <h4 class="serv-title">
                  @lang('site.download from here')
                  </h4>
                  <div class="serv-desc">
                    <div class="apps-btns">
                      <a href="{{app(App\Models\GeneralSettings::class)->ios_link}}" target="_blank" class="main-btn">
                        <img loading="lazy" src="{{url('site')}}/images/apple.svg" alt="apple link" />
                        <div>
                          <span>@lang('site.download now')</span>
                          <h5>Apple store</h5>
                        </div>
                      </a>
                      <a href="{{app(App\Models\GeneralSettings::class)->android_link}}" target="_blank">
                        <img loading="lazy" src="{{url('site')}}/images/GooglePlay.png" alt="GooglePlay link" />
                        <div>
                          <span>@lang('site.download now')</span>
                          <h5>Google play</h5>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
@endsection