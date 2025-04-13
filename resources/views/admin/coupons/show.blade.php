@extends('admin.index')
@push('custom-css')
<style type="text/css">
   .card-body{
      display: inline-flex;
    text-align: justify;
   }
   .cursor-img{
      margin: 42px;
   }
   .nav-link.active{
      color: #fff !important;
   }
</style>
@endpush
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
<div class="content-header">
                {{-- search part --}}
                @include('admin.partials.breadcrumb')
            </div>            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                  <div class="tab-content">
                     <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                        <div class="card">
                           <div class="card-header d-flex justify-content-between">
                              <div class="iq-header-title">
                                 <h4 class="card-title">@lang('main.coupon_informations')</h4>
                              </div>
                           </div>
                           <div class="card-body">
                                 
                                 <div class=" row align-items-center">
                                    <div class="form-group col-sm-6">
                                       <label for="fname">@lang('main.coupons.added_by'): </label>
                                       <p>{{$coupon->admin?->name}}</p>
                                    </div>

                                    <div class="form-group col-sm-6">
                                       <label for="fname">@lang('main.coupons.status'): </label>
                                       <p>{{__('main.coupons.'.$coupon->status)}}</p>
@if(auth('admin')->user()->account_type != 'vendors' && auth('admin')->user()->account_type != 'subadmins')
@if($coupon->status == 'approve' || $coupon->status == 'decline')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#approveDecline">
  approve/decline
</button>

<!-- Modal -->
<div class="modal fade" id="approveDecline" tabindex="-1" aria-labelledby="approveDeclineLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="approveDeclineLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('coupons.changeAdminStatus',$coupon->id)}}">
           @csrf
           <select name="status" class="form-select">
              <option value="approve">{{__('main.coupons.approve')}}</option>
              <option value="decline">{{__('main.coupons.decline')}}</option>
           </select>
           <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
      
    </div>
  </div>
</div>  
@endif

@elseif(auth('admin')->user()->account_type == 'vendors' || auth('admin')->user()->account_type == 'subadmins')

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showHide">
  show/hide
</button>

<!-- Modal -->
<div class="modal fade" id="showHide" tabindex="-1" aria-labelledby="showHideLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="showHideLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('coupons.changeAdminStatus',$coupon->id)}}">
           @csrf
           <select name="status" class="form-select">
              <option value="show">{{__('main.coupons.show')}}</option>
              <option value="hide">{{__('main.coupons.hide')}}</option>
           </select>
           <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
      
    </div>
  </div>
</div>  

@endif
                                  </div>

                                    <div class="form-group col-sm-6">
                                       <label for="fname">@lang('main.coupons.text'): </label>
                                       <p>{{$coupon->text}}</p>
                                    </div>

                                    <div class="form-group col-sm-6">
                                       <label for="fname">@lang('main.coupons.coupon_code'): </label>
                                       <p>{{$coupon->coupon_code}}</p>
                                    </div>

                                    <div class="form-group col-sm-6">
                                       <label for="fname">@lang('main.coupons.offer_type'): </label>
                                       <p>{{__('main.coupons.'.$coupon->offer_type)}}</p>
                                    </div>

                                    <div class="form-group col-sm-6">
                                       <label for="fname">@lang('main.coupons.start_date'): </label>
                                       <p>{{$coupon->start_date}}</p>
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="fname">@lang('main.coupons.end_date'): </label>
                                       <p>{{$coupon->end_date}}</p>
                                    </div>

                                    <div class="form-group col-sm-6">
                                       <label for="fname">@lang('main.coupons.created_at'): </label>
                                       <p>{{$coupon->created_at}}</p>
                                    </div>
                                    
                                    @if($coupon->coupon_discount)
                                    <div class="form-group col-sm-6">
                                       <label for="fname">@lang('main.coupons.discount_value'): </label>
                                       <p>{{$coupon->coupon_discount?->discount_value}}  {{__('main.coupons.'.$coupon->coupon_discount?->discount_type)}}</p>
                                    </div>


                                    @if($coupon->coupon_discount?->category_id)
                                    <div class="form-group col-sm-6">
                                       <label for="fname">@lang('main.coupons.category_id'): </label>
                                       <p>{{$coupon->coupon_discount?->category?->title}}</p>
                                    </div>
                                    @endif

                                    @if($coupon->coupon_discount?->brand_id)
                                    <div class="form-group col-sm-6">
                                       <label for="fname">@lang('main.coupons.brand_id'): </label>
                                       <p>{{$coupon->coupon_discount?->brand?->title}}</p>
                                    </div>
                                    @endif

                                    @if($coupon->products)
                                    <div class="form-group col-sm-6">
                                       <label for="fname">@lang('main.coupons.products'): </label>
                                       @foreach($coupon->products as $val)
                                       <p>{{$val->name}} , </p>
                                       @endforeach
                                    </div>
                                    @endif

                                    @endif
                                </div>
                           </div>
                        </div>
                     </div>
                   
                  </div>
               </div>
         </section>
   </div>
@endsection
