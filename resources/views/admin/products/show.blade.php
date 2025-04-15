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
                                 <h5 class="mb-1">{{$product->name}}</h5>
                                 <div class="Stars" style="--rating:{{ number_format($product->averageRating(), 0) }};"></div>
                                 @if($product->discount)
                                 <div class="d-flex gap-2">
                                    <small class="text-decoration-line-through">{{$product->price}} @lang('main.egp')</small>
                                    <b>{{$product->real_price}} @lang('main.egp')</b>
                                 </div>
                                 @else
                                 <span>{{$product->price}} @lang('main.egp')</span>
                                 @endif
                              </div>
                              @if($product->discount)
                              <div class="badge">
                                 <p class="m-0">
                                 @lang('main.discount')
                                 {{number_format($product->discount, 0)}} {{__('main.products.'.$product->discount_type)}}
                                 </p>
                              </div>
                              @endif
                              
                              <button type="button" id="statusButton" class="status-tag {{ $product->status == 'show' ? 'accepted' : 'declined' }} border-0">
                                 <i class="highlight" style="--iteration-count: infinite;"></i>
                                 <p class="status-tag__txt">
                                 @lang('main.products.status')
                                 {{__('main.'.$product->status)}}
                                 </p>
                              </button>
                           </div>
                        </div>

                        <div class="customer-details py-3">
                           <div class="d-flex flex-column gap-2">
                              <div class="d-flex gap-2">
                                 <i class="bi bi-tag"></i>
                                 <div>
                                    <small class="fw-bold mb-1"> @lang('main.products.category_name')</small>
                                    <p class="m-0">{{$product->category?->title}}</p>
                                 </div>
                              </div>
                              <div class="d-flex gap-2">
                                 <i class="bi bi-tag"></i>
                                 <div>
                                    <small class="fw-bold mb-1"> @lang('main.products.brand_name')</small>
                                    <p class="m-0">{{$product->brand?->title}}</p>
                                 </div>
                              </div>

                              <div class="d-flex gap-2">
                                 <i class="bi bi-shop"></i>
                                 <div>
                                    <small class="fw-bold mb-1">@lang('main.store_name')</small>
                                    <p class="m-0"><a href="{{route('stores.show',$product->store_id)}}">{{$product->store?->name}}</a></p>
                                 </div>
                              </div>
                              
                              <div class="d-flex gap-2">
                                 <i class="bi bi-upc-scan"></i>
                                 <div>
                                    <small class="fw-bold mb-1">@lang('main.products.product_sku')</small>
                                    <p class="m-0">{{$product->sku}}</p>
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
                                 <span class="info-box-number">{{$product->wishlist->count()}}</span>
                                 <span class="info-box-text">@lang('main.products.no_wishlists') </span>
                              </div>
                           </div>
                        </div>
                        <div class="col">
                           <div class="info-box shadow-none d-flex align-items-center gap-2 justify-content-between">
                              <span class="info-box-icon">
                                 <i class="bi bi-star-half"></i>
                              </span>
                              <div class="info-box-content">
                                 <span class="info-box-number">{{$product->product_reviews->count()}}</span>
                                 <span class="info-box-text">@lang('main.products.no_reviews') </span>
                              </div>
                           </div>
                        </div>
                        <div class="col">
                           <div class="info-box shadow-none d-flex align-items-center gap-2 justify-content-between">
                              <span class="info-box-icon">
                                 <i class="bi bi-cart-check"></i>
                              </span>
                              <div class="info-box-content">
                                 <span class="info-box-number">{{$product->soldCount()}}</span>
                                 <span class="info-box-text">@lang('main.products.no_sold_qty')</span>
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
                              <label for="fname">@lang('main.products.product_overview'): </label>
                              <p>{{$product->overview}}</p>
                           </div>
      
                           <div class="form-group">
                              <label for="fname">@lang('main.products.product_description'): </label>
                              <p>{{$product->description}}</p>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="row g-3">
                     @if($product->wishlist->count() > 0)
                     <div class="{{ $product->customerOrders->count() > 0 ? 'col-md-6' : 'col-md-12' }}">
                        <div class="card h-100">
                           <div class="card-header">
                              <h3 class="card-title">@lang('main.products.no_wishlists')</h3>
                              <b>{{$product->wishlist->count()}}</b>
                           </div>
                           <div class="card-body">
                              <div class="owl-carousel latestReviews">
                                    @foreach($product->wishlist as $favorite)
                                    <a class="info-box h-auto shadow-none bg-transparent d-flex py-1 gap-1">
                                       @if($favorite->user?->getFirstMediaUrl('photo_profile','thumb'))
                                       <img loading="lazy" class="cursor-img" src="{{$favorite->user?->getFirstMediaUrl('photo_profile','thumb')}}" style="width:80px;" alt="">
                                       @endif
                                       <p class="mb-0 fw-bold">
                                          @lang('main.products.added_to_wishlist')
                                          {{ $favorite->user?->name }}
                                       </p>
                                    </a>
                                    @endforeach
                                 </div>
                              </div>
                           </div>
                     </div>
                     @endif
                     @if($product->customerOrders->count() > 0)
                     <div class="{{ $product->wishlist->count() > 0 ? 'col-md-6' : 'col-md-12' }}">
                        <div class="card h-100">
                           <div class="card-header">
                              <h3 class="card-title">@lang('main.products.customers_who_bought')</h3>
                           </div>
                           <div class="card-body">
                              <div class="owl-carousel latestReviews">
                                 @forelse($product->customerOrders as $order)
                                 <a class="info-box h-auto shadow-none bg-transparent d-flex py-1 gap-1">
                                    @if($order->user?->getFirstMediaUrl('photo_profile','thumb'))
                                    <img loading="lazy" class="cursor-img" src="{{$order->user?->getFirstMediaUrl('photo_profile','thumb')}}" style="width:80px;" alt="">
                                    @endif
                                    <p class="mb-0 fw-bold">
                                       {{ $order->user?->name }}
                                       @lang('main.products.bought_this_product_on') 
                                       <span>{{ $order->last_updated }}</span>
                                       - @lang('main.products.times_purchased'): <strong>{{ $order->purchase_count }}</strong>
                                    </p>
                                 </a>
                                 @endforeach
                              </div>
                           </div>
                        </div>
                     </div>
                     @endif

                     <div class="col-12">
                        <div class="card">
                           <div class="card-header">
                              <h3 class="card-title">@lang('main.products.no_reviews') ⭐{{ number_format($product->averageRating(), 0) }}</h3>
                              <b>{{$product->product_reviews->count()}}</b>
                           </div>
                           <div class="card-body">        
                              @if($product->product_reviews->count() > 0)
                              <div class="latestReviews">
                                 @forelse($product->product_reviews as $review)
                                 <a class="info-box h-auto shadow-none bg-transparent d-flex py-1 gap-1">
                                    @if($review->user?->getFirstMediaUrl('photo_profile','thumb'))
                                    <img loading="lazy" class="cursor-img" src="{{$review->user?->getFirstMediaUrl('photo_profile','thumb')}}" style="width:80px;" alt="">
                                    @else
                                    <img loading="lazy" class="cursor-img" src="{{url('dashboard/dist/img/avatar.png')}}" style="width:80px;" alt="">
                                    @endif
                                    <div>
                                       <p class="mb-0 fw-bold">
                                          {{ $review->user?->name }}
                                       </p>
                                       <div class="Stars" style="--rating:{{ $review->star }}"></div>
                                       <p class="m-0">{{ $review->review ? " $review->review" : '' }}</p>
                                    </div>
                                 </a>
                                 @endforeach
                              </div>
                              @else
                              <p>@lang('main.products.no_reviews_yet')</p>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
