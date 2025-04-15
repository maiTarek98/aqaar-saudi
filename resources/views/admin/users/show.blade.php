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

                                    @if(request('account_type') == 'vendors')
                                    <div class="d-flex gap-2">
                                        <i class="bi bi-shop"></i>
                                        <div>
                                            <small class="fw-bold mb-1"> @lang('main.stores.store_owner')</small>
                                            @if($user->store()->exists())
                                            <p class="m-0"><a href="{{route('stores.show',$user->store?->id)}}">{{$user->store?->name}}</a></p>
                                            @else
                                            <p><a href="{{ route('stores.create',['user_id' => $user->id]) }}">@lang('main.pending_vendors.add store')</a></p>
                                            @endif
                                        </div>
                                    </div>
                                    @endif

                                    @if($user->pending_vendor_id)
                                    <div class="d-flex gap-2">
                                        <i class="bi bi-file-earmark-medical"></i>
                                        <div>
                                            <small class="fw-bold mb-1"> @lang('main.users.pending_vendor_id')</small>
                                            <p class="m-0"><a href="{{route('pending_vendors.show',$user->pending_vendor_id)}}">{{$user->pending_vendor?->full_name}}</a></p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
                <div class="main-side col-md-8">
                    @if($user->account_type == 'users')
                    <ul class="nav nav-pills mb-3 user-pills" id="pills-tab" role="tablist">
                        <li class="nav-item active">
                            <a class="nav-link active" id="pills-userorders-tab" data-bs-toggle="pill" data-bs-target="#pills-userorders" type="button" role="tab" aria-controls="pills-userorders" aria-selected="true"> <i class="bi bi-cart3"></i> @lang('main.users.show all user orders')</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " id="pills-userwishlist-tab" data-bs-toggle="pill" data-bs-target="#pills-userwishlist" type="button" role="tab" aria-controls="pills-userwishlist" aria-selected="true"><i class="bi bi-heart"></i> @lang('main.users.show all user wishlist')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-useraddresses-tab" data-bs-toggle="pill" data-bs-target="#pills-useraddresses" type="button" role="tab" aria-controls="pills-useraddresses" aria-selected="true"><i class="bi bi-geo"></i> @lang('main.users.show all user addresses')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-userwallet-tab" data-bs-toggle="pill" data-bs-target="#pills-userwallet" type="button" role="tab" aria-controls="pills-userwallet" aria-selected="true"> <i class="bi bi-wallet2"></i> @lang('main.users.show all user wallet')</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-userorders" role="tabpanel" aria-labelledby="pills-userorders-tab">
                            <div class="card statistic mb-3">
                                <a href="{{route('orders.index',['user_id' => $user->id])}}"  class="card-header">
                                    <h3 class="card-title">@lang('main.vendors.no orders')</h3>
                                    <b>({{$user->orders->whereNotNull('status')->count()}})</b>
                                </a>
                                <div class="card-body">
                                    <!-- Small boxes (Stat box) -->
                                    <div class="row row-cols-lg-5 g-3">
                                        <div class="col">
                                            <div class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between">
                                                <span class="info-box-icon">
                                                    <i class="bi bi-hourglass-split"></i>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-number">{{$user->orders->where('status','pending')->count()}}</span><span class="info-box-text">@lang('main.vendors.no pending orders')</span>
                                                </div><!-- /.info-box-content -->
                                            </div><!-- /.info-box -->
                                        </div>
                                        <div class="col">
                                            <div class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between">
                                                <span class="info-box-icon">
                                                    <i class="bi bi-hourglass-split"></i>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-number">{{$user->orders->where('status','accepted')->count()}}</span><span class="info-box-text">@lang('main.vendors.no accepted orders')</span>
                                                </div><!-- /.info-box-content -->
                                            </div><!-- /.info-box -->
                                        </div>
                                        <div class="col">
                                            <div class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between">
                                                <span class="info-box-icon">
                                                    <i class="bi bi-truck"></i>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-number">{{$user->orders->where('status','shipped')->count()}}</span><span class="info-box-text">@lang('main.vendors.no shipped orders')</span>
                                                </div><!-- /.info-box-content -->
                                            </div><!-- /.info-box -->
                                        </div>
                                        <div class="col">
                                            <div class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between">
                                                <span class="info-box-icon">
                                                    <i class="bi bi-hourglass-bottom"></i>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-number">{{$user->orders->where('status','completed')->count()}}</span><span class="info-box-text">@lang('main.vendors.no completed orders')</span>
                                                </div><!-- /.info-box-content -->
                                            </div><!-- /.info-box -->
                                        </div>
                                        <div class="col">
                                            <div class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between">
                                                <span class="info-box-icon">
                                                    <i class="bi bi-hourglass-split"></i>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-number">{{$user->orders->where('status','returned')->count()}}</span><span class="info-box-text">@lang('main.vendors.no returned orders')</span>
                                                </div><!-- /.info-box-content -->
                                            </div><!-- /.info-box -->
                                        </div>
                                        <div class="col">
                                            <div class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between">
                                                <span class="info-box-icon">
                                                    <i class="bi bi-x-circle"></i>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-number">{{$user->orders->where('status','cancelled')->count()}}</span><span class="info-box-text">@lang('main.vendors.no cancelled orders')</span>
                                                </div><!-- /.info-box-content -->
                                            </div><!-- /.info-box -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">كل الطلبات</h3>
                                </div>
                                <div class="card-body py-1 px-0">
                                    <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                                <th>#</th>
                                                <th>@lang('main.orders.order_no')</th>
                                                <th>@lang('main.store_name')</th>
                                                <th>@lang('main.orders.payment_type')</th>
                                                <th>@lang('main.orders.created_at')</th>
                                                <th>@lang('main.orders.details')</th>
                                            </thead>
                                            <tbody>
                                                @forelse($user->orders->whereNotNull('status') as $order)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{$order->order_no}}
                                                    </td>
                                                    <td>
                                                        @if($order->store()->exists())
                                                        <a href="{{route('stores.show',$order->store_id)}}">{{ $order->store?->name }}</a>
                                                        @else
                                                        -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $order->grand_total }} @lang('main.egp') / 
                                                        {{ __('main.orders.'.$order->payment_type) }}
                                                        
                                                    </td>
                                                    <td>
                                                        {{$order->created_at->diffForHumans()}}
                                                    </td>
                                                    <td>
                                                        <a href="{{route('orders.show',$order->id)}}" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="عرض التفاصيل"><i class="fa fa-eye mr-0"></i></a>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td class="text-center text-muted" style="font-size: 25px" colspan="7">
                                                        {{ trans('main.NoOrders') }}
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade " id="pills-userwishlist" role="tabpanel" aria-labelledby="pills-userwishlist-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">@lang('main.favorites')</h3>
                                </div>
                                <div class="card-body py-1 px-0">
                                    <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                                <th>#</th>
                                                <th>@lang('main.users.store_name')</th>
                                                <th>@lang('main.products.product_price')</th>
                                                <th>@lang('main.users.created_at')</th>
                                                <th>@lang('main.users.actions')</th>    
                                            </thead>
                                            <tbody>
                                                @forelse($user->wishlists as $wishlist)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
            
                                                    <td>
                                                        <div class="d-flex d-flex align-items-center gap-2">
                                                            @if ($wishlist->product?->getFirstMediaUrl('logo','thumb'))
                                                            <img src="{{ $wishlist->getFirstMediaUrl('logo','thumb') }}" data-toggle="modal" data-target="#exampleModall{{ $wishlist->id }}" class="avatar">
                                                            @include('admin.components.modal_photo', [
                                                            'image' => 'l'.$wishlist->getFirstMediaUrl('logo','thumb'),
                                                            'id' => $wishlist->id,
                                                            ])
                                                            @else
                                                            <img src="{{ url('/dashboard') }}/dist/img/box.png" class="avatar" alt="@lang('main.users.NoOfferImage')">

                                                            @endif
                                                            {{$wishlist->product?->name}}
                                                        </div>
                                                    </td>

                                                    <td>
                                                        {{$wishlist->product?->real_price}} @lang('main.egp')
                                                    </td>
                                                    
                                                    <td>
                                                        {{$wishlist->created_at->diffForHumans()}}
                                                    </td>
                                                    <td>
                                                        {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['userwishlists.destroy', $wishlist->id],
                                                        'style' => 'display:inline',
                                                        ]) !!}
                                                        <button type="submit" class="btn btn-outline-danger btn-sm show_confirm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="@lang('main.users.delete')"><i class="fa fa-trash"></i></button>
                                                        {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                                @empty
                                                <td class="text-center text-muted" style="font-size: 25px" colspan="7">
                                                    {{ trans('main.Nouserwishlist') }}
                                                </td>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>   
                        </div>

                        <div class="tab-pane fade" id="pills-useraddresses" role="tabpanel" aria-labelledby="pills-useraddresses-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">@lang('main.users.addresses')</h3>
                                </div>
                                <div class="card-body py-1 px-0">
                                    <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                                <th>#</th>
                                                <th>@lang('main.users.address_details')</th>
                                                <th>@lang('main.users.address_type')</th>
                                                <th>@lang('main.users.created_at')</th>
                                                <th>@lang('main.users.actions')</th>    
                                            </thead>
                                            <tbody>
                                                @forelse($user->addresses as $address)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <small class="d-block mb-1 fw-bold">
                                                        {{ $address->label_name }}/ {{ $address->location?->name }} ،  {{ $address->apartment_no }}/ {{ $address->floor_no }}
                                                        </small>
                                                        {{$address->street_name}}
                                                        , {{$address->location?->parent?->name}}, {{$address->location?->parent?->parent?->name}}, مصر,
                                                    </td>
                                                    <td>
                                                        {{ $address->mark }}
                                                        @if($address->type)
                                                         / {{ __('main.users.type-'.$address->type)}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{$address->created_at->diffForHumans()}}
                                                    </td>
                                                    <td>
                                                        {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['useraddresses.destroy', $address->id],
                                                        'style' => 'display:inline',
                                                        ]) !!}
                                                        <button type="submit" class="btn btn-outline-danger btn-sm show_confirm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="@lang('main.users.delete')"><i class="fa fa-trash"></i></button>
                                                        {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                                @empty
                                                <td class="text-center text-muted" style="font-size: 25px" colspan="7">
                                                    {{ trans('main.Nouseraddresses') }}
                                                </td>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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

                    @if($user->account_type == 'vendors')
                    <div class="card statistic mb-3">
                        <a href="{{route('orders.index',['store_id' => $user->store?->id])}}"  class="card-header">
                            <h3 class="card-title">@lang('main.vendors.no orders')</h3>
                            <b>({{$user->store?->orders->whereNotNull('status')->count()}})</b>
                        </a>
                        <div class="card-body">
                            <!-- Small boxes (Stat box) -->
                            <div class="row row-cols-lg-4 g-3">
                                <div class="col">
                                    <div class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between">
                                        <span class="info-box-icon">
                                            <i class="bi bi-hourglass-split"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-number">{{$user->store?->orders->where('status','pending')->count()}}</span><span class="info-box-text">@lang('main.vendors.no pending orders')</span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </div>
                                <div class="col">
                                    <div class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between">
                                        <span class="info-box-icon">
                                            <i class="bi bi-hourglass-split"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-number">{{$user->store?->orders->where('status','accepted')->count()}}</span><span class="info-box-text">@lang('main.vendors.no accepted orders')</span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </div>
                                <div class="col">
                                    <div class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between">
                                        <span class="info-box-icon">
                                            <i class="bi bi-truck"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-number">{{$user->store?->orders->where('status','shipped')->count()}}</span><span class="info-box-text">@lang('main.vendors.no shipped orders')</span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </div>
                                <div class="col">
                                    <div class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between">
                                        <span class="info-box-icon">
                                            <i class="bi bi-hourglass-bottom"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-number">{{$user->store?->orders->where('status','completed')->count()}}</span><span class="info-box-text">@lang('main.vendors.no completed orders')</span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </div>
                                
                                <div class="col">
                                    <div class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between">
                                        <span class="info-box-icon">
                                            <i class="bi bi-arrow-repeat"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-number">{{$user->store?->orders->where('status','returned')->count()}}</span><span class="info-box-text">@lang('main.vendors.no returned orders')</span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </div>
                                <div class="col">
                                    <div class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between">
                                        <span class="info-box-icon">
                                            <i class="bi bi-x-circle"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-number">{{$user->store?->orders->where('status','cancelled')->count()}}</span><span class="info-box-text">@lang('main.vendors.no cancelled orders')</span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card statistic mb-3">
                        <div class="card-header">
                            <h3 class="card-title">@lang('main.vendors.balance_tracking')</h3>
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#withdrawModal">
                            سحب رصيد
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row row-cols-lg-3 g-3">
                                <div class="col">
                                    <div class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between">
                                        <span class="info-box-icon">
                                            <i class="bi bi-wallet2"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-number">{{$user->getTotalOrdersBalance('cash') + $user->getTotalOrdersBalance('online')}} @lang('main.egp')</span>
                                            <span class="info-box-text">@lang('main.vendors.total_balance')</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between">
                                        <span class="info-box-icon">
                                            <i class="bi bi-cash-stack"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-number">{{$user->getTotalOrdersBalance('cash')}} @lang('main.egp')</span>
                                            <span class="info-box-text">@lang('main.vendors.cash_balance')</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between">
                                        <span class="info-box-icon">
                                            <i class="bi bi-credit-card"></i>  
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-number">{{$user->getTotalOrdersBalance('online')}} @lang('main.egp')</span>
                                            <span class="info-box-text">@lang('main.vendors.online_balance')</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> سجل العمليات</h3>
                        </div>
                        <div class="card-body">
                            <div class="history">
                                @if($user->store)
                                <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                                <th>#</th>
                                                <th>@lang('main.orders.order_no')</th>
                                                <th>@lang('main.orders.grand_price')</th>
                                                <th>@lang('main.orders.payment_type')</th>
                                                <th>@lang('main.orders.payment_transaction')</th>
                                                <th>@lang('main.orders.created_at')</th>
                                                <th>@lang('main.orders.details')</th>
                                            </thead>
                                            <tbody>

                                                @forelse($user->store?->transactions as $transaction)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{$transaction->order?->order_no}}
                                                    </td>
                                                    <td>
                                                        {{ $transaction->order?->grand_total }} @lang('main.egp')
                                                    </td>
                                                    <td>
                                                        {{ __('main.orders.'.$transaction->order->payment_type) }}
                                                    </td>
                                                    <td>
                                                        {{ __('main.orders.transaction-'.$transaction->status) }}
                                                    </td>
                                                    <td>
                                                        {{$transaction->order->created_at->diffForHumans()}}
                                                    </td>
                                                    <td>
                                                        <a href="{{route('orders.show',$transaction->order->id)}}" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="عرض التفاصيل"><i class="fa fa-eye mr-0"></i></a>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td class="text-center text-muted" style="font-size: 25px" colspan="7">
                                                        <i class="fa-regular fa-trash-can" style="
                                                            font-size: 100px;
                                                            color: #d3d3d3;
                                                            display: block;"></i> 
                                                        {{ trans('main.noTranscations') }}
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                <span>@lang('main.no_transactions_history')</span>
                                @endif
                            </div>
                        </div>
                    </div>
            
            
            
            
                    
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> المسؤولين عن الطلبات داخل المتجر</h3>
                        </div>
                        <div class="card-body">
                            <div class="history">
                                @if($user->subadmins)
                                <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                                <th>#</th>
                                                <th>@lang('main.subadmins.name')</th>
                                                <th>@lang('main.subadmins.order_count')</th>
                                                <th>@lang('main.orders.details')</th>
                                            </thead>
                                            <tbody>

                                                @forelse($user->subadmins as $subadmin)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{$subadmin->name}}
                                                    </td>
                                                    <td>
                                                        {{$subadmin->orders_assigned->count()}}
                                                    </td>
                                                    <td>
                                                      <a href="{{route('users.show',['account_type'=>'subadmins',$subadmin->id])}}" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="عرض التفاصيل"><i class="fa fa-eye mr-0"></i></a>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td class="text-center text-muted" style="font-size: 25px" colspan="7">
                                                        <i class="fa-regular fa-trash-can" style="
                                                            font-size: 100px;
                                                            color: #d3d3d3;
                                                            display: block;"></i> 
                                                        {{ trans('main.noSubadmins') }}
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                <span>@lang('main.no_transactions_history')</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if($user->account_type == 'subadmins')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> سجل العمليات  ({{$user->orders_assigned->count()}})</h3>
                        </div>
                        <div class="card-body">
                            <div class="history">
                                @if($user->orders_assigned)
                                <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                                <th>#</th>
                                                <th>@lang('main.orders.order_no')</th>
                                                <th>@lang('main.orders.grand_price')</th>
                                                <th>@lang('main.orders.payment_type')</th>
                                                <th>@lang('main.orders.payment_transaction')</th>
                                                <th>@lang('main.orders.created_at')</th>
                                                <th>@lang('main.orders.details')</th>
                                            </thead>
                                            <tbody>

                                                @forelse($user->orders_assigned as $order)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{$order->order_no}}
                                                    </td>
                                                    <td>
                                                        {{ $order->grand_total }} @lang('main.egp')
                                                    </td>
                                                    <td>
                                                        {{ __('main.orders.'.$order->payment_type) }}
                                                    </td>
                                                    <td>
                                                        {{ __('main.orders.'.$order->status) }}
                                                    </td>
                                                    <td>
                                                        {{$order->created_at->diffForHumans()}}
                                                    </td>
                                                    <td>
                                                        <a href="{{route('orders.show',$order->id)}}" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="عرض التفاصيل"><i class="fa fa-eye mr-0"></i></a>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td class="text-center text-muted" style="font-size: 25px" colspan="7">
                                                        <i class="fa-regular fa-trash-can" style="
                                                            font-size: 100px;
                                                            color: #d3d3d3;
                                                            display: block;"></i> 
                                                        {{ trans('main.noTranscations') }}
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                <span>@lang('main.no_transactions_history')</span>
                                @endif
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
                @if(($user->getVendorTotalOrdersBalance('cash') + $user->getVendorTotalOrdersBalance('online')) > 0)
                <div class="alert alert-warning" role="alert">
                    ⚠️ لا يوجد رصيد حالي
                </div>
                @endif
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
