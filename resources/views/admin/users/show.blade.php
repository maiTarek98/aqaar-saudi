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
