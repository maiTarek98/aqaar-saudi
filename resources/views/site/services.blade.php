@extends('site.index')
@section('title', trans('site.services') )
@section('content')
@include('site.includes.breadcrumb-section',['title' =>trans('site.services')  ])
<!------------- services section -------------->
    <div class="services mb-5 pb-md-4">
      <div class="container-fluid">
        <div class="row gy-4">
          <div class="col-md-4 col-lg-4">
            <ul class="nav flex-column servs-nav">
              @foreach($services as $service)
              <li class="nav-item">
                <a class="nav-link @if(request('service') == $service->id) active @endif" aria-current="page" href="{{route('services',['service' => $service->id])}}">
                  <div class="serv-item">
                    <div class="icon">
                      <img loading="lazy" src="{{url($service->category_icon)}}" alt="{{$service->category_name}}" />
                    </div>
                    <span>{{$service->category_name}}</span>
                  </div>
                </a>
              </li>
              @endforeach
            </ul>
          </div>
          <div class="col-md-8 col-lg-8">
            <div class="serv-details">
              <h4 class="serv-title">@lang('site.service details')</h4>
              <div class="serv-desc">
                <p>
                  {{$current_service->category_description}}
                </p>
              </div>
              <h4 class="serv-title">@lang('site.expected price')</h4>
              <div class="serv-desc">
                <p class="serv-price">
                  <span>{{$current_service->price}}</span>
                  <span>@lang('site.sar')</span>
                </p>
              </div>
              <h4 class="serv-title">
                @lang('site.download from here')
              </h4>
              <div class="serv-desc">
                <div class="apps-btns">
                  <a href="{{app(App\Models\GeneralSettings::class)->ios_link}}" target="_blank" class="main-btn">
                    <img loading="lazy" src="{{url('site')}}/images/apple.svg" alt="apple image" />
                    <div>
                      <span>@lang('site.download now')</span>
                      <h5>Apple store</h5>
                    </div>
                  </a>
                  <a href="{{app(App\Models\GeneralSettings::class)->android_link}}" target="_blank">
                    <img loading="lazy" src="{{url('site')}}/images/GooglePlay.png" alt="GooglePlay image" />
                    <div>
                      <span>@lang('site.download now')</span>
                      <h5>Google play</h5>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection