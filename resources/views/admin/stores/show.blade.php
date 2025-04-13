@extends('admin.index')
@section('content')
  <div class="content-wrapper">
      <div class="container-fluid add-form-list">
         <div class="content-header">
            {{-- search part --}}
            @include('admin.partials.breadcrumb')
         </div>
         <div class="contant">
            <div class="main-section row g-3">
               <div class="sticky-side col-md-4">
                  <div class="card">
                     <div class="card-body" style="opacity: 1;">
                        <div class="customer-avatar-section position-relative overflow-hidden border-bottom pb-3">
                           <div class="d-flex align-items-center flex-column">
                              @if($store->getFirstMediaUrl('stores_image','thumb'))
                                 <img class="img-fluid rounded-circle mb-3" width="120"
                                 src="{{$store->getFirstMediaUrl('stores_image','thumb')}}"
                                 alt="">
                              @else
                                 <img src="http://localhost/ecommerce/public/storage/products/431/products_image-1740042204.jpg" class="img-fluid rounded-circle mb-3" alt="@lang('main.NoImageUploaded')">
                              @endif
                              <div class="customer-info text-center mb-2">
                                 <h5 class="mb-1">{{$store->name}}</h5>
                              </div>
                                                            
                              <button type="button" id="statusButton" class="status-tag {{ $store->status == 'show' ? 'accepted' : 'declined' }} border-0">
                                 <i class="highlight" style="--iteration-count: infinite;"></i>
                                 <p class="status-tag__txt">
                                    @lang('main.stores.status') {{__('main.'.$store->status)}}
                                 </p>
                              </button>
                           </div>
                        </div>

                        <div class="customer-details py-3">
                           <div class="d-flex flex-column gap-2">
                              <div class="d-flex gap-2">
                                 <i class="bi bi-shop"></i>
                                 <div>
                                    <small class="fw-bold mb-1">@lang('main.stores.store_owner')</small>
                                    <p class="m-0"><a href="{{route('users.show',[$store->user?->id,'account_type' =>'vendors' ])}}">{{$store->user?->name}}</a></p>
                                 </div>
                              </div>

                              <div class="d-flex gap-2">
                                 <i class="bi bi-patch-check"></i>
                                 <div>
                                    <small class="fw-bold mb-1">@lang('main.stores.created_at')</small>
                                    <p class="m-0">{{$store->created_at}}</p>
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
                                 <i class="bi bi-cart"></i>
                              </span>
                              <div class="info-box-content">
                                 <span class="info-box-number">{{$store->orders()->count()}}</span>
                                 <span class="info-box-text">@lang('main.stores.no_orders')</span>
                              </div>
                           </div>
                        </div>

                        <div class="col">
                           <div class="info-box shadow-none d-flex align-items-center gap-2 justify-content-between">
                              <span class="info-box-icon">
                                 <i class="bi bi-box2"></i>
                              </span>
                              <div class="info-box-content">
                                 <span class="info-box-number">{{$store->products()->count()}}</span>
                                 <span class="info-box-text">@lang('main.stores.no_wishlists')</span>
                              </div>
                           </div>
                        </div>
                        <div class="col">
                           <div class="info-box shadow-none d-flex align-items-center gap-2 justify-content-between">
                              <span class="info-box-icon">
                                 <i class="bi bi-percent"></i>
                              </span>
                              <div class="info-box-content">
                                 <span class="info-box-number">{{$store->user?->coupons()->count()}}</span>
                                 <span class="info-box-text">@lang('main.stores.no_coupons')</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="card mb-3">
                     <div class="card-header">
                        <h3 class="card-title">المنتجات</h3>
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
                                                @forelse($store->products as $product)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
            
                                                    <td>
                                                        <div class="d-flex d-flex align-items-center gap-2">
                                                            <a href="{{route('products.show',$product->id)}}">@if ($product->getFirstMediaUrl('products_image','thumb'))
                                                            <img src="{{ $product->getFirstMediaUrl('products_image','thumb') }}" data-toggle="modal" data-target="#exampleModall{{ $product->id }}" class="avatar">
                                                            @include('admin.components.modal_photo', [
                                                            'image' => 'l'.$product->getFirstMediaUrl('products_image','thumb'),
                                                            'id' => $product->id,
                                                            ])
                                                            @else
                                                            <img src="{{ url('/dashboard') }}/dist/img/box.png" class="avatar" alt="@lang('main.users.NoOfferImage')">

                                                            @endif
                                                            {{$product->name}} </a>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        {{$product->real_price}} @lang('main.egp')
                                                    </td>
                                                    
                                                    <td>
                                                        {{$product->created_at->diffForHumans()}}
                                                    </td>
                                                    <td>
                                                        {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['products.destroy', $product->id],
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
            </div>
         </div>
      </div>
   </div>
@endsection
