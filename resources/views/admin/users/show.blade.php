@extends('admin.index')
@push('custom-css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="container-fluid">
        <div class="content-header">
            {{-- search part --}}
            @include('admin.partials.breadcrumb')
        </div>          

        <!-- Main content -->
        <section class="content">
            <div class="main-section row g-3">
                <div class="sticky-side col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="customer-avatar-section border-bottom pb-3">
                                <div class="d-flex align-items-center flex-column">
                                    @if ($user->getFirstMediaUrl('photo_profile','thumb'))
                                    <img src="{{ $user->getFirstMediaUrl('photo_profile','thumb') }}" class="img-fluid rounded-circle mb-3" data-toggle="modal" data-target="#exampleModal{{ $user->id }}" width="120" height="120" alt="User avatar">
                                    @include('admin.components.modal_photo', [
                                    'image' => $user->getFirstMediaUrl('photo_profile','thumb'),
                                    'id' => $user->id,
                                    ])
                                    @else
                                    <img src="{{ url('/dashboard') }}/dist/img/avatar.png" class="img-fluid rounded-circle mb-3" data-toggle="modal" width="120" height="120" alt="User avatar">
                                    @endif
                                    <div class="customer-info text-center mb-3">
                                        @if($user->name)
                                        <h5 class="mb-1">{{ $user->name }}</h5>
                                        @endif
                                        @if($user->account_type == 'users')
                                        <span>Customer ID {{ $user->id }}</span>
                                        @elseif($user->account_type == 'admins')
                                        <span>Admin ID {{ $user->id }}</span>
                                        @elseif($user->account_type == 'vendors')
                                        <span>Vendor ID {{ $user->id }}</span>
                                        @else
                                        <span>Moderator ID {{ $user->id }}</span>
                                        @endif
                                    </div>
                                    @if($user->status && $user->id != 1)
                                    <button type="button" id="statusButton" class="status-tag {{$user->status}} border-0" data-bs-toggle="modal" data-bs-target="#userStatusModal">
                                        <i class="highlight" style="--iteration-count: infinite;"></i>
                                        <p class="status-tag__txt">@lang('main.users.status') {{ __('main.users.'.$user->status) }}</p>
                                        <i class="bi bi-chevron-left status-tag__txt"></i>
                                    </button>
                                    @endif
                                </div>
                            </div>
                            <div class="customer-details py-3">
                                <div class="d-flex flex-column gap-2">
                                    @if($user->email)
                                    <div class="d-flex gap-2">
                                        <i class="bi bi-envelope"></i>
                                        <div>
                                            <small class="fw-bold mb-1"> @lang('main.users.email')</small>
                                            <p class="m-0"><a href="mailto:{{$user->email}}">{{ $user->email }}</a></p>
                                        </div>
                                    </div>
                                    @endif
            
                                    @if($user->mobile)
                                    <div class="d-flex gap-2">
                                        <i class="bi bi-telephone"></i>
                                        <div>
                                            <small class="fw-bold mb-1"> @lang('main.users.mobile')</small>
                                            <p class="m-0"><a href="tel:+20{{$user->mobile}}">+20{{ $user->mobile }}</a></p>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="d-flex gap-2">
                                        <i class="bi bi-calendar-check"></i>
                                        <div>
                                            <small class="fw-bold mb-1"> @lang('main.users.created_at')</small>
                                            <p class="m-0">{{ $user->created_at }}</p>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <i class="bi bi-clock"></i>
                                        <div>
                                            <small class="fw-bold mb-1"> @lang('main.users.last_login')</small>
                                            <p class="m-0">{{ $user->last_login }}</p>
                                        </div>
                                    </div>

                                    @if(request('account_type') != 'admins')
                                    <div class="d-flex gap-2">
                                        <i class="bi bi-patch-check"></i>
                                        <div>
                                            <small class="fw-bold mb-1"> @lang('main.users.mobile_verified_at')</small>
                                            <p class="m-0">{{ $user->mobile_verified_at }}</p>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="d-flex gap-2">
                                        <i class="bi bi-person-bounding-box"></i>
                                        <div>
                                            <small class="fw-bold mb-1"> @lang('main.users.account_type')</small>
                                            <p class="m-0">{{ __('main.'.\Str::singular($user->account_type)) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
                <div class="main-side col-md-8">
                    @if($user->account_type == 'users')
                    <ul class="nav nav-pills mb-3 user-pills" id="pills-tab" role="tablist">
                        <li class="nav-item active">
                            <a class="nav-link active" id="pills-userorders-tab" data-bs-toggle="pill" data-bs-target="#pills-userorders" type="button" role="tab" aria-controls="pills-userorders" aria-selected="true"> <i class="bi bi-cart3"></i> @lang('main.users.show all user cards')</a>
                        </li>
                        {{--<li class="nav-item ">
                            <a class="nav-link " id="pills-userwishlist-tab" data-bs-toggle="pill" data-bs-target="#pills-userwishlist" type="button" role="tab" aria-controls="pills-userwishlist" aria-selected="true"><i class="bi bi-heart"></i> @lang('main.users.show all user wishlist')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-useraddresses-tab" data-bs-toggle="pill" data-bs-target="#pills-useraddresses" type="button" role="tab" aria-controls="pills-useraddresses" aria-selected="true"><i class="bi bi-geo"></i> @lang('main.users.show all user addresses')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-userwallet-tab" data-bs-toggle="pill" data-bs-target="#pills-userwallet" type="button" role="tab" aria-controls="pills-userwallet" aria-selected="true"> <i class="bi bi-wallet2"></i> @lang('main.users.show all user wallet')</a>
                        </li>--}}
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-userorders" role="tabpanel" aria-labelledby="pills-userorders-tab">
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
                                <h6 class="user-name text-center">
                                    الاسم/ {{$user->name}} 
                                </h6>
                            </div>
                            
                            <div class="col-4">
                                <b class="d-block">
                                    رخصة فال رقم
                                    <br>
                                    {{$user->val_license}}
                                </b>
                            </div>
                            
                            <div class="col-4">
                                <div class="copy-text flex-column">
                                  <input type="text" class="text" value="{{route('user.properties',$user->id)}}" style="opacity: 0;margin-bottom: -18px;">
                                  <button>
                                    <div class="user-img">
                                        {!! $qrCode !!}
                                    </div>
                                  </button>
                                </div>
                            </div>
                            <div class="col-4">
                                <b class="d-block">ID: {{$user->card_code}}</b>
                                <b class="d-block">
                                    عدد العروض
                                    {{$user->properties?->count()}}
                                </b>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @if($user->propertys_access_link->count() > 0)
                    @foreach($user->propertys_access_link as $key => $property_access)
                        @php $val = $property_access->property; @endphp
                        @php
                            $user = $user;
                            $hasDelegation = $user->property_delegations()
                                                ->where('product_id', $val->id)
                                                ->exists();
                        @endphp
                      <div class="accordion-item card user-card @if($property_access->current_level == 2) {{$val->feature?->represented_by}} @elseif($hasDelegation) agent @else other @endif">
                        <h2 class="accordion-header card-header py-1">
                          <button class="accordion-button d-flex justify-content-between card-title fs-5 m-0 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{$key}}" aria-expanded="false" aria-controls="panelsStayOpen-collapse{{$key}}">
                            <span>
                              بطاقة هوية رقمية - {{$val->listing_number}}
                            </span>
                            <span>
                            @if($property_access->current_level == 2)
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
                                <a href="{{route('property.show',$val->listing_number)}}" class="text-decoration-underline d-flex gap-1 justify-content-center">
                                    <i class="bi bi-link-45deg fs-5"></i>
                                    <b>رقم العرض {{$val->listing_number}}</b>
                                </a>
                                <b style="float:inline-end;">{{$property_access->current_level}}</b>
                            </div>
                            <div class="col-4">
                                <b class="d-block">
                                    الاسم/ {{explode(' ', trim($user->name))[0] }}
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
                            
                            <div class="col-4">
                                <div class="user-img">
                                    @if($val->access_links->where('source_user_id', $user->id)->isNotEmpty())
                                        @php $link = $val->access_links->where('source_user_id', $user->id)->first(); 
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
                            <div class="col-4">
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
                        </div>

                        <div class="tab-pane fade " id="pills-userwishlist" role="tabpanel" aria-labelledby="pills-userwishlist-tab">
                            
                        </div>

                        <div class="tab-pane fade" id="pills-useraddresses" role="tabpanel" aria-labelledby="pills-useraddresses-tab">
                            
                        </div>

                        <div class="tab-pane fade" id="pills-userwallet" role="tabpanel" aria-labelledby="pills-userwallet-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">@lang('main.users.wallet')</h3>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    @endif
                    
                </div>
            </div>
        </section>
    </div>
</div>

<div class="modal fade" id="userStatusModal" tabindex="-1" aria-labelledby="userStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('users.changeStatus', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="userStatusModalLabel">@lang('main.update_status')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <select class="form-control form-select" name="status">
                        <option value="accepted" {{ $user->status == 'accepted' ? 'selected' : '' }}>@lang('main.users.accepted')</option>
                        <option value="pending" {{ $user->status == 'pending' ? 'selected' : '' }}>@lang('main.users.pending')</option>
                        <option value="blocked" {{ $user->status == 'blocked' ? 'selected' : '' }}>@lang('main.users.blocked')</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    <button type="submit" id="saveChangesButton" class="btn btn-primary">@lang('main.update_status')</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="withdrawModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="withdrawModalLabel">سحب الرصيد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert">
                    ℹ️ يتم فتح تحويل الرصيد المسحوب من المتجر كل شهر من تاريخ التسجيل.
                </div>
                
                <div class="text-center">
                    <h4 class="fw-bold">الرصيد الحالي</h4>
                    <h3 class="fw-bold text-success">0 ر.س</h3>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>
@endsection
