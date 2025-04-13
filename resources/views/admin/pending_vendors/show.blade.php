@extends('admin.index')
@section('content')
<style>
    .info-box{
        min-height: unset;
    }
</style>
<div class="content-wrapper">
    <div class="container-fluid add-form-list">
        <div class="content-header">
            @include('admin.partials.breadcrumb')
        </div>
        <div class="content">
            @include('admin.layouts.alerts')

            {{--<div class="iq-edit-list usr-edit">
                <div class="iq-edit-profile owl-carousel nav nav-tabs border-0" id="nav-tab" role="tablist">
                    <a class="info-box active"  data-bs-toggle="tab" data-bs-target="#personal-information" type="button" role="tab" aria-controls="personal-information" aria-selected="true">
                    @lang('main.pending_vendors.informations')
                    </a>
                    
                </div>
            </div>--}}
            <div class="iq-edit-list-data">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="personal-information" role="tabpanel" aria-labelledby="pills-personal-information" tabindex="0">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="customer-avatar-section border-bottom pb-3">
                                            <div class="d-flex align-items-center flex-column">
                                                <img src="{{ url('/dashboard') }}/dist/img/avatar.png" class="img-fluid rounded-circle mb-3" data-toggle="modal" width="120" height="120" alt="User avatar">
                                                <div class="customer-info text-center mb-3">
                                                    <h5 class="mb-1">{{$pending_vendor->full_name}}</h5>
                                                </div>
                                                <button type="button" id="statusButton" class="status-tag {{$pending_vendor->status}} border-0" data-bs-toggle="modal" data-bs-target="#userStatusModal">
                                                    <i class="highlight" style="--iteration-count: infinite;"></i>
                                                    <p class="status-tag__txt">@lang('main.pending_vendors.status') {{__('main.pending_vendors.'.$pending_vendor->status)}}</p>
                                                    <i class="bi bi-chevron-left status-tag__txt"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="customer-details py-3">
                                            <div class="d-flex flex-column gap-2">
                                                <div class="d-flex gap-2">
                                                    <i class="bi bi-envelope"></i>
                                                    <div>
                                                        <small class="fw-bold mb-1"> @lang('main.pending_vendors.email')</small>
                                                        <p class="m-0"><a href="mailto:{{$pending_vendor->email}}">{{ $pending_vendor->email }}</a></p>
                                                    </div>
                                                </div>

                                                <div class="d-flex gap-2">
                                                    <i class="bi bi-telephone"></i>
                                                    <div>
                                                        <small class="fw-bold mb-1"> @lang('main.pending_vendors.mobile')</small>
                                                        <p class="m-0"><a href="tel:+20{{$pending_vendor->mobile}}">+20{{ $pending_vendor->mobile }}</a></p>
                                                    </div>
                                                </div>
                                                
                                                <div class="d-flex gap-2">
                                                    <i class="bi bi-tags"></i>
                                                    <div>
                                                        <small class="fw-bold mb-1"> @lang('main.pending_vendors.brand_name')</small>
                                                        <p class="m-0">{{$pending_vendor->brand_name}}</p>
                                                    </div>
                                                </div>
                                                
                                                <div class="d-flex gap-2">
                                                    <i class="bi bi-geo-alt"></i>
                                                    <div>
                                                        <small class="fw-bold mb-1"> @lang('main.pending_vendors.shipping_address')</small>
                                                        <p class="m-0">{{$pending_vendor->shipping_address}}</p>
                                                    </div>
                                                </div>
                                                
                                                <div class="d-flex gap-2">
                                                    <i class="bi bi-file-earmark-check"></i>
                                                    <div>
                                                        <small class="fw-bold mb-1"> @lang('main.pending_vendors.commercial_registration_no')</small>
                                                        <p class="m-0">{{$pending_vendor->commercial_registration_no}}</p>
                                                    </div>
                                                </div>


                                                <div class="d-flex gap-2">
                                                    <i class="bi bi-calendar-event"></i>
                                                    <div>
                                                        <small class="fw-bold mb-1"> @lang('main.pending_vendors.created_at')</small>
                                                        <p class="m-0">{{ $pending_vendor->created_at }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <p class="fw-bold mb-1"> @lang('main.pending_vendors.commercial_registration_image') </p>
                                        @if($pending_vendor->getFirstMediaUrl('commercial_registration_image','thumb'))
                                        <img class="w-100 rounded-3 mt-3" src="{{$pending_vendor->getFirstMediaUrl('commercial_registration_image','thumb')}}">
                                        @else
                                        <span>@lang('main.no uploaded file')</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            @if($pending_vendor->vendor?->store)
                                <a class="btn btn-primary w-auto" href="{{ route('stores.show', $pending_vendor->vendor->store->id) }}">
                                    @lang('main.stores.go to store')
                                </a>
                            @elseif($pending_vendor->status == 'accepted' && $pending_vendor->vendor)
                                <a href="" class="btn btn-primary w-auto" data-bs-toggle="modal" data-bs-target="#storeCreatedModal">
                                    @lang('main.pending_vendors.add store')
                                </a>
                            @endif
                        </div>
                        
                    </div>
                    
                    @if (Cache::get('vendor_created') && ! optional($pending_vendor->vendor)->store)
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            new bootstrap.Modal(document.getElementById('storeCreatedModal')).show();
                        });
                    </script>
                    @endif
                            
                    <!-- Modal HTML -->
                    <div class="modal fade" id="storeCreatedModal" tabindex="-1" aria-labelledby="storeCreatedModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="storeCreatedModalLabel">@lang('main.pending_vendors.account created')</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="m-0">@lang('main.pending_vendors.account created successfull,would you like to do next')</p>
                                    <div class="d-flex justify-content-around">
                                        <a href="{{ route('stores.create',['user_id' => $pending_vendor->vendor?->id]) }}" class="btn btn-secondary">@lang('main.pending_vendors.add store')</a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(! $pending_vendor->vendor()->exists())
                    <div class="text-center mt-4">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary w-auto" data-bs-toggle="modal" data-bs-target="#acceptVendor">@lang('main.pending_vendors.Accept and create an account')</button>
                    </div>
                    
                    

                    <!-- Modal -->
                    <div class="modal fade" id="acceptVendor" tabindex="-1" aria-labelledby="acceptVendorLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="acceptVendorLabel">@lang('main.pending_vendors.create account')</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clearCacheBeforeRedirect(event, '{{ route('pending_vendors.show',$pending_vendor->id) }}')"></button>
                                </div>
                                <form method="post" action="{{ route('users.store') }}">
                                    <div class="modal-body">
                                        @csrf
                                        <input type="hidden" name="account_type" value="vendors">
                                        <input type="hidden" name="pending_vendor_id" value="{{$pending_vendor->id}}">
                                        <input type="hidden" name="added_by" value="{{auth('admin')->user()->id}}">
                                        <div class="form-group mb-3">
                                            <label for="name"> @lang('main.vendors.name')<span class="text-danger">*</span></label>
                                            <input type="text" name="name" value="{{ old('name', $pending_vendor->full_name) }}"
                                                class="form-control  @error('name') is-invalid @enderror" id="name" placeholder="@lang('main.users.name')">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="mobile"> @lang('main.vendors.mobile')<span class="text-danger">*</span></label>
                                            <input type="text" name ="mobile" value="{{ old('mobile', $pending_vendor->mobile) }}"
                                                class="form-control  @error('mobile') is-invalid @enderror" id="mobile" placeholder="@lang('main.users.mobile')">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="email"> @lang('main.vendors.email')<span class="text-danger">*</span></label>
                                            <input type="email" name="email" value="{{ old('email', $pending_vendor->email) }}" class="form-control @error('email') is-invalid @enderror"
                                                id="email" placeholder="@lang('main.users.email')">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="password"> @lang('main.password')<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="password" name="password" value=""
                                                    class="form-control @error('password') is-invalid @enderror" id="password"
                                                    placeholder="@lang('main.users.password')">
                                                <button type="button" class="pass input-group-text" toggle="#password">
                                                    <i class="bi bi-lock"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="roles_name[0]" value="vendor"/>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"   onclick="clearCacheBeforeRedirect(event, '{{ route('pending_vendors.show',$pending_vendor->id) }}')">@lang('main.close')</button>
                                        <button type="submit" class="btn btn-primary">@lang('main.save changes')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-js')
<script>
  $(document).ready(function () {

    function clearCacheBeforeRedirect(event, url) {
        event.preventDefault(); // منع الانتقال الفوري
        fetch("{{ route('cache.clear.vendor_created') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
        }).then(() => {
            window.location.href = url; // توجيه المستخدم بعد حذف الكاش
        }).catch(error => console.error("Error clearing cache:", error));
    }
</script>
@endpush