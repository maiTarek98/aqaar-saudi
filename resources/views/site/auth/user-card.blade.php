@extends('site.index')
@section('title', trans('site.user-card') )
@section('content')
      @include('site.includes.breadcrumb-section',['title' => trans('site.user-card')])
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
          <div class="profile-data col col-md-7 col-lg-8">
            <div class="profile-wrapper">
                
                <div class="accordion" id="accordionPanelsStayOpenExample">
                  <div class="accordion-item card user-card any">
                    <h2 class="accordion-header card-header py-1">
                      <button class="accordion-button d-flex justify-content-between card-title fs-5 m-0 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                        <span>
                          بطاقة هوية رقمية
                        </span>
                        <span>
                        </span>
                      </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
                      <div class="accordion-body">
                        <div class="row align-items-center py-3 gy-3">
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>{{app(App\Models\GeneralSettings::class)->card_text_a}}</div>
                                    <div>{{app(App\Models\GeneralSettings::class)->card_text_b}}</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <h6 class="user-name text-center">
                                    الاسم/ {{auth('web')->user()->name}} 
                                </h6>
                            </div>
                            
                            <div class="col-6 col-md-4">
                                <b class="d-block">
                                    رخصة فال رقم
                                    <br>
                                    {{auth('web')->user()->val_license}}
                                </b>
                            </div>
                            
                            <div class="qr col-md-4">
                                <div class="copy-text flex-column">
                                  <input type="text" class="text" value="{{route('user.properties',auth('web')->user()->id)}}" style="opacity: 0;margin-bottom: -18px;">
                                  <button>
                                    <div class="user-img">
                                        {!! $qrCode !!}
                                    </div>
                                  </button>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <b class="d-block">ID: {{auth('web')->user()->card_code}}</b>
                                <b class="d-block">
                                    عدد العروض
                                    {{auth('web')->user()->properties?->count()}}
                                </b>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>{{app(App\Models\GeneralSettings::class)->card_text_c}}</div>
                                    <div>{{app(App\Models\GeneralSettings::class)->card_text_d}}</div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @if(auth('web')->user()->propertys_access_link->count() > 0)
                    @foreach(auth('web')->user()->propertys_access_link as $key => $property_access)
                        @php $val = $property_access->property; @endphp
                        @php
                            $user = auth('web')->user();
                            $hasDelegation = $user->property_delegations()
                                                ->where('product_id', $val->id)
                                                ->where('status','approved')
                                                ->exists();
                        @endphp
                      <div class="accordion-item card user-card @if($property_access->current_level == 1) {{$val->feature?->represented_by}} @elseif($hasDelegation) agent @else other @endif">
                        <h2 class="accordion-header card-header py-1">
                          <button class="accordion-button d-flex justify-content-between card-title fs-5 m-0 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{$key}}" aria-expanded="false" aria-controls="panelsStayOpen-collapse{{$key}}">
                            <span>
                              بطاقة هوية رقمية - {{$val->listing_number}}
                            </span>
                            <span>
                            @if($property_access->current_level == 1)
                                ({{ __('main.products.' . ($val->feature?->represented_by ?? '')) }})
                            @elseif($hasDelegation)
                                ({{ __('main.products.agent')}})
                            @else
                                (ساعي)
                            @endif
                            </span>
                          </button>
                        </h2>
                        <div id="panelsStayOpen-collapse{{$key}}" class="accordion-collapse collapse">
                          <div class="accordion-body">
                            <div class="row align-items-center py-3 gy-3">
                                <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>{{app(App\Models\GeneralSettings::class)->card_text_a}}</div>
                                    <div>{{app(App\Models\GeneralSettings::class)->card_text_b}}</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <a href="{{route('property.show',$val->listing_number)}}" class="text-decoration-underline d-flex gap-1 justify-content-center">
                                    <i class="bi bi-link-45deg fs-5"></i>
                                    <b>رقم العرض {{$val->listing_number}}</b>
                                </a>
                                <b style="float:inline-end;">{{$property_access->current_level}}</b>
                            </div>
                            <div class="col-6 col-md-4">
                                <b class="d-block">
                                    الاسم/ {{explode(' ', trim(auth('web')->user()->name))[0] }}
                                </b>
                                <b class="d-block">
                                    @if($val->feature?->represented_by == 'owner')
                                    {{__('main.users.sak_number')}}
                                    <br/>
                                    {{$val->feature?->sak_number}}
                                    @elseif($val->feature?->represented_by == 'agent')
                                    {{__('main.users.agency_number')}}
                                    <br/>
                                    {{$val->feature?->agency_number}}
                                    @else
                                    {{__('main.users.val_number')}}
                                    <br/>
                                    {{$val->feature?->val_number}}
                                    @endif
                                </b>
                            </div>
                            
                            <div class="qr col-md-4">
                                <div class="user-img">
                                    @if($val->access_links->where('source_user_id', auth('web')->user()->id)->isNotEmpty())
                                        @php $link = $val->access_links->where('source_user_id', auth('web')->user()->id)->first(); 
                                                $url = url('verify-property/'.$link->token.'?source=external&ref='.$link->current_level);
                                                $qrCode_v = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate($url);
                                        @endphp
                                        <div class="copy-text flex-column">
                                          <input type="text" class="text" value="{{$url}}" style="opacity: 0;margin-bottom: -18px;">
                                          <button>
                                            <div class="user-img">
                                                {!! $qrCode_v !!}
                                            </div>
                                          </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="d-flex align-items-center gap-2">
                                    <b> الصفة </b>
                                    <span> {{__('main.products.'.$val->feature?->represented_by)}}</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <b> نوع العرض </b>
                                    <span>{{__('main.products.'.$val->type)}}</span>
                                </div>
                                @if($val->start_date)
                                <div class="d-flex align-items-center gap-2">
                                    <b> من تاريخ </b>
                                    <span>{{$val->start_date}}</span>
                                </div>
                                @endif
                                @if($val->end_date)
                                <div class="d-flex align-items-center gap-2">
                                    <b> الى تاريخ </b>
                                    <span>{{$val->end_date}}</span>
                                </div>
                                @endif
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>{{app(App\Models\GeneralSettings::class)->card_text_c}}</div>
                                    <div>{{app(App\Models\GeneralSettings::class)->card_text_d}}</div>
                                </div>
                            </div>
                            {{--<div class="copy-text">
                                <input type="text" class="text" value="{{$url}}">
                                <button><i class="fa fa-clone"></i></button>
                              </div>--}}
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  @endif
                </div>
                
                {{--<div class="card user-card any">
                    <div class="card-header px-5">
                        <h4 class="card-title fs-5 m-0">بطاقة هوية رقمية (بطاقة نوع :  {{__('main.products.'.auth('web')->user()->user_type)}})</h4>
                    </div>
                    <div class="card-body px-5">
                        <div class="row align-items-center py-3 gy-3">
                            <div class="col-12">
                                <h6 class="user-name text-center">
                                    الاسم/ {{auth('web')->user()->name}} 
                                </h6>
                            </div>
                            
                            <div class="col-4">
                                <b class="d-block">
                                    رخصة فال رقم
                                    <br>
                                    {{auth('web')->user()->val_license}}
                                </b>
                            </div>
                            
                            <div class="col-4">
                                <div class="copy-text flex-column">
                                  <input type="text" class="text" value="david@stylus.co.za" style="opacity: 0;margin-bottom: -18px;">
                                  <button>
                                    <div class="user-img">
                                        {!! $qrCode !!}
                                    </div>
                                  </button>
                                </div>
                            </div>
                            <div class="col-4">
                                <b class="d-block">ID: {{auth('web')->user()->card_code}}</b>
                                <b class="d-block">
                                    عدد العروض
                                    {{auth('web')->user()->properties?->count()}}
                                </b>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-4 py-4">
                            <div class="user-img">
                                <img src="{{asset('site/images/qr_code.png') }}" alt="qr code">
                            @if(auth('web')->user()->photo_profile)
                                <img loading="lazy" src="{{auth('web')->user()->photo_profile}}" alt="{{$user->name}}">
                            @endif
                            </div>
                            <div>
                                <h5 class="user-name">{{auth('web')->user()->name}}</h5>
                                <h6 class="user-type my-3">{{auth('web')->user()->user_type}}</h6>
                                <p class="user-id">ID NO. {{auth('web')->user()->card_code}}</p>

                            </div>
                        </div>
                    </div>
                </div>--}}
            </div>
          </div>
        </div>
      </div>
    </section>            
                
@endsection
@push('custom-js')
@endpush