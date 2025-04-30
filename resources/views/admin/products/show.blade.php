@extends('admin.index')
@push('custom-css')
<!-- <style type="text/css">
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
</style> -->
@endpush
@section('content')
   <div class="content-wrapper">
      <div class="container-fluid">
         <!-- Content Header (Page header) -->
         <div class="content-header">
            @include('admin.partials.breadcrumb')
         </div>
         <div class="content">
            <div class="main-section row g-3">
               <div class="sticky-side col-md-4">
                  <div class="card">
                     <div class="card-body">
                        <div class="customer-avatar-section position-relative overflow-hidden border-bottom pb-3">
                           <div class="d-flex align-items-center flex-column">
                              @if($product->getFirstMediaUrl('products_image','thumb'))
                              <img src="{{$product->getFirstMediaUrl('products_image','thumb')}}" class="img-fluid rounded-circle mb-3" width="120" alt="product">
                              @else
                              <img src="{{ url('/dashboard') }}/dist/img/no-photo.png" class="img-fluid rounded-circle mb-3" alt="@lang('main.users.NoOfferImage')">
                              @endif
                              <div class="customer-info text-center mb-2">
                                 <h5 class="mb-1">{{$product->title}}</h5>
                                 <div class="Stars" style="--rating:;"></div>
                                 @if($product->discount)
                                 <div class="d-flex gap-2">
                                    <small class="text-decoration-line-through">{{$product->price}} @lang('main.egp')</small>
                                    <b>{{$product->real_price}} @lang('main.egp')</b>
                                 </div>
                                 @else
                                 <span>{{$product->price}} @lang('main.egp')</span>
                                 @endif
                              </div>
                              @if($product->start_date && $product->end_date)
                              <div class="">
                                 <p class="m-0">
                                 @lang('main.products.start_date')
                                 {{$product->start_date}}
                                 </p> - <p class="m-0">
                                 @lang('main.products.end_date')
                                 {{$product->end_date}}
                                 </p>
                              </div>
                              @endif
                              
                              <button type="button" id="statusButton" class="status-tag {{ $product->status == 'show' ? 'accepted' : 'declined' }} border-0">
                                 <i class="highlight" style="--iteration-count: infinite;"></i>
                                 <p class="status-tag__txt">
                                 @lang('main.products.status')
                                 {{__('main.products.'.$product->status)}}
                                 </p>
                              </button>
                           </div>
                        </div>

                        <div class="customer-details py-3">
                           <div class="d-flex flex-column gap-2">
                              <div class="d-flex gap-2">
                                 <i class="bi bi-tag"></i>
                                 <div>
                                    <small class="fw-bold mb-1"> @lang('main.products.type')</small>
                                    <p class="m-0">{{_('main.products.'.$product->type)}}</p>
                                 </div>
                              </div>
                              <div class="d-flex gap-2">
                                 <i class="bi bi-tag"></i>
                                 <div>
                                    <small class="fw-bold mb-1"> @lang('main.products.product_for')</small>
                                    <p class="m-0">{{_('main.products.'.$product->product_for)}}</p>
                                 </div>
                              </div>
                              @if($product->owner_id)
                              <div class="d-flex gap-2">
                                 <i class="bi bi-shop"></i>
                                 <div>
                                    <small class="fw-bold mb-1">@lang('main.owner_id')</small>
                                    <a href="{{route('users.show',['account_type' => 'users', $product->owner_id])}}">{{$product->owner?->name}}</a>
                                    <p class="m-0"></p>
                                 </div>
                              </div>
                              @endif
                              <div class="d-flex gap-2">
                                 <i class="bi bi-upc-scan"></i>
                                 <div>
                                    <small class="fw-bold mb-1">@lang('main.products.listing_number')</small>
                                    <p class="m-0">{{$product->listing_number}}</p>
                                 </div>
                              </div>

                              <div class="d-flex gap-2">
                                 <i class="bi bi-eye"></i>
                                 <div>
                                    <small class="fw-bold mb-1"> @lang('main.products.views')</small>
                                    <p class="m-0">{{$product->views}}</p>
                                 </div>
                              </div>

                              <div class="d-flex gap-2">
                                 <i class="bi bi-patch-check"></i>
                                 <div>
                                    <small class="fw-bold mb-1">@lang('main.products.created_at')</small>
                                    <p class="m-0">{{$product->created_at}}</p>
                                 </div>
                              </div>
                           </div>
                        </div>  
                     </div>
                  </div>
               </div>

               <div class="main-side col-md-8">
                  <div class="card statistic shadow-none bg-transparent mb-3">
                     <div class="row row-cols-lg-3 g-3">
                        <div class="col">
                           <div class="info-box shadow-none d-flex align-items-center gap-2 justify-content-between">
                              <span class="info-box-icon">
                                 <i class="bi bi-heart"></i>
                              </span>
                              <div class="info-box-content">
                                 <span class="info-box-number">{{$product->letters()->count()}}</span>
                                 <span class="info-box-text">@lang('main.products.no_letters') </span>
                              </div>
                           </div>
                        </div>
                        <div class="col">
                           <div class="info-box shadow-none d-flex align-items-center gap-2 justify-content-between">
                              <span class="info-box-icon">
                                 <i class="bi bi-heart"></i>
                              </span>
                              <div class="info-box-content">
                                 <span class="info-box-number">{{$product->offers()->count()}}</span>
                                 <span class="info-box-text">@lang('main.products.no_offers') </span>
                              </div>
                           </div>
                        </div>
                        <div class="col">
                           <div class="info-box shadow-none d-flex align-items-center gap-2 justify-content-between">
                              <span class="info-box-icon">
                                 <i class="bi bi-heart"></i>
                              </span>
                              <div class="info-box-content">
                                 <span class="info-box-number">{{$product->verifications()->count()}}</span>
                                 <span class="info-box-text">@lang('main.products.no_verifications') </span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  @if ($product->getMedia('document')->count() > 0)
                  <div class="card mb-3">
                     <div class="card-body">
                        <div class="single-img">
                           <div class="all">
                              @if ($product->getMedia('document')->count() > 1)
                              <div class="slider">
                                 <div class="owl-carousel owl-theme one">
                                    @foreach($product->getMedia('document') as $key=> $val)
                                    <div class="item-box">
                                       <?php $imageUrl=url('/storage/products_images/'.$val->id.'/'.$val->file_name);?>
                                       <img src="{{ $imageUrl}}" alt="">
                                    </div>
                                    @endforeach
                                 </div>
                              </div>
                              <div class="slider-two">
                                 <div class="owl-carousel owl-theme two">
                                    @foreach($product->getMedia('document') as $key=> $val)
                                    <div class="item">
                                       <?php $imageUrl=url('/storage/products_images/'.$val->id.'/'.$val->file_name);?>
                                       <img src="{{ $imageUrl}}" alt="">
                                    </div>
                                    @endforeach
                                 </div>
                                 <div class="left-t nonl-t">
                                 <i class="bi bi-chevron-left"></i>
                                 </div>
                                 <div class="right-t">
                                 <i class="bi bi-chevron-right"></i>
                                 </div>
                              </div>
                              @else
                              <div class="slider">
                                 @foreach($product->getMedia('document') as $key=> $val)
                                 <div class="item-box">
                                    <?php $imageUrl=url('/storage/products_images/'.$val->id.'/'.$val->file_name);?>
                                    <img src="{{ $imageUrl}}" alt="">
                                 </div>
                                 @endforeach
                              </div>
                              @endif
                           </div>
                        </div>

                        
                     </div>
                  </div>
                  @endif

                  <div class="card mb-3">
                     <div class="card-header">
                        <h3 class="card-title">الوصف</h3>
                     </div>
                     <div class="card-body">
                        <div class="description">
                           <div class="form-group">
                              <label for="fname">@lang('main.products.valuation'): </label>
                              <p>{{$product->feature?->valuation}}</p>
                           </div>

                           <div class="form-group">
                              <label for="fname">@lang('main.products.valuation_date'): </label>
                              <p>{{$product->feature?->valuation_date}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.area_after_development'): </label>
                              <p>{{$product->feature?->area_after_development}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.area'): </label>
                              <p>{{$product->feature?->area}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.plot_number'): </label>
                              <p>{{$product->feature?->plot_number}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.plan_number'): </label>
                              <p>{{$product->feature?->plan_number}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.has_penalties'): </label>
                              <p>{{$product->feature?->has_penalties ? __('main.yes') : __('main.no')}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.has_mortgage'): </label>
                              <p>{{$product->feature?->has_mortgage ? __('main.yes') : __('main.no')}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.has_survey_decision'): </label>
                              <p>{{$product->feature?->has_survey_decision ? __('main.yes') : __('main.no')}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.has_real_estate_market'): </label>
                              <p>{{$product->feature?->has_real_estate_market ? __('main.yes') : __('main.no')}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.has_electronic_deed'): </label>
                              <p>{{$product->feature?->has_electronic_deed ? __('main.yes') : __('main.no')}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.has_planning_diagram'): </label>
                              <p>{{$product->feature?->has_planning_diagram ? __('main.yes') : __('main.no')}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.accepts_mortgage'): </label>
                              <p>{{$product->feature?->accepts_mortgage}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.usufruct_lease'): </label>
                              <p>{{$product->feature?->usufruct_lease}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.product_type'): </label>
                              <p>{{$product->feature?->product_type}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.owner_type'): </label>
                              <p>{{$product->feature?->owner_type}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.link_video'): </label>
                              <p>{{$product->link_video}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.is_private'): </label>
                              <p>{{$product->is_private ? __('main.yes') : __('main.no')}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.in_home'): </label>
                              <p>{{__('main.'.$product->in_home)}}</p>
                           </div>

                           <div class="form-group">
                              <label for="fname">@lang('main.products.is_rented'): </label>
                              <p>{{$product->feature?->is_rented ? __('main.yes') : __('main.no')}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.penalty_type'): </label>
                              <p>{{$product->feature?->penalty_type}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.represented_by'): </label>
                              <p>{{$product->feature?->represented_by}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.map_location'): </label>
                              <p>{{$product->map_location}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.product_description'): </label>
                              <p>{{$product->description}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.valuation_type'): </label>
                              <p>{{$product->feature?->valuation_type}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.remaining_lease_years'): </label>
                              <p>{{$product->feature?->remaining_lease_years}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.annual_rent'): </label>
                              <p>{{$product->feature?->annual_rent}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.license_number'): </label>
                              <p>{{$product->feature?->license_number}}</p>
                           </div>
                           <div class="form-group">
                              <label for="fname">@lang('main.products.additional_info'): </label>
                              <p>{{$product->feature?->additional_info}}</p>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="row g-3">
                    <div class="upload__img-wrap row g-3 row-cols-lg-5">
                            @if($product->getFirstMediaUrl('document','thumb'))
                                @foreach($product->getMedia('document') as $key => $media)
                                <?php $imageUrl=url('/storage/products_images/'.$media->id.'/'.$media->file_name);?>
                                <div class="col">
                                    <div class='upload__img-box'>
                                        <div 
                                        data-number='{{$key+1}}' 
                                        data-file='{{$media->file_name}}' 
                                        class='img-bg'>
                                            <div class='upload__img-close'></div>
                                            <img src="{{$imageUrl}}" >
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
