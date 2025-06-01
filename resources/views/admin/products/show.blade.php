@extends('admin.index')
@push('custom-css')
<style>

        .tree{
            margin-inline-start: -18px;
        }
        .tree ul {
            position: relative;
        }
        
        .tree ul::before {
            content: '';
            position: absolute;
            top: 0;
            inset-inline-start: 40px;
            border-left: 1px solid #ccc;
            height: 100%;
        }
        .tree ul:has(>.node-box.winner)::before,
        .tree ul:first-child > li:first-child::after{
            content: unset;
        }
        
        .tree li {
            /*display: table-cell;*/
            /*text-align: center;*/
            /* padding: 20px 5px 0 5px; */
            margin-top: 10px;
            margin-inline-start: 18px;
            position: relative;
        }
        
        .tree li::after {
            content: '';
            position: absolute;
            top: 18px;
            inset-inline-start: -10px;
            border-top: 1px solid #ccc;
            height: 1px;
            width: 100%;
        }
        
        .tree li::before {
            left: 0;
            border-right: 1px solid #ccc;
        }
        
        /*.tree li::after {*/
        /*    right: 0;*/
        /*    border-left: 1px solid #ccc;*/
        /*}*/
        
        
        .tree li:only-child {
            padding-top: 0;
        }
        .tree > ul > li:first-child{
            margin-top: 0;
        }
        
        .tree li:first-child::before{
            border: 0 none;
        }
        
        .tree li:last-child::before {
            border-right: 1px solid #ccc;
            border-radius: 0 5px 0 0;
        }
        
        .node-box {
            padding: 6px 11px;
            background: #f9f9f9;
            border-radius: 8px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
            position: relative;
            z-index: 2;
        }
        .node-box.winner{
            margin-block: 10px;
            margin-inline-start: -15px;
            position: relative;
            background: var(--secondary);
            color: var(--white);
        }
        .node-box.winner .node-level {
            background: var(--white);
            color: var(--secondary);
        }
        .node-level {
            background: var(--secondary);
            color: var(--white);
            width: 24px;
            height: 24px;
            display: flex;
            line-height: normal;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        
        .tree li .node-box + ul {
            margin-inline-start: 14px; 
        }

    </style>
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
                                  <img src="{{ url('/dashboard') }}/dist/img/no-photo.png" class="img-fluid rounded-circle mb-3" width="120" alt="@lang('main.users.NoOfferImage')">
                                  @endif
                                  <div class="customer-info text-center mb-2">
                                     <h5 class="mb-1">{{$product->title}}</h5>
                                     <!--<div class="Stars" style="--rating:;"></div>-->
                                     @if($product->price != null)
                                     @if($product->discount)
                                     <div class="d-flex gap-2">
                                        <small class="text-decoration-line-through">{{$product->price}} @lang('main.egp')</small>
                                        <b>{{$product->real_price}} @lang('main.egp')</b>
                                     </div>
                                     @else
                                     <span>{{$product->price}} @lang('main.egp')</span>
                                     
                                     @if($product->type == 'investment')
                                        <span> @lang('main.products.investment_min'): {{$product->investment_min}} %</span>
                                     @endif
                                     @endif
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
                                  
                                  {{--<button type="button" id="statusButton" class="status-tag {{ $product->status == 'show' ? 'accepted' : 'declined' }} border-0">
                                     <i class="highlight" style="--iteration-count: infinite;"></i>
                                     <p class="status-tag__txt">
                                     @lang('main.products.status')
                                     {{__('main.products.'.$product->status)}}
                                     </p>
                                  </button>--}}
                               </div>
                            </div>
    
                            <div class="customer-details py-3">
                               <div class="d-flex flex-column gap-2">
                                  @if($product->admin)
                                  <div class="d-flex gap-2">
                                     <i class="bi bi-tag"></i>
                                     <div>
                                        <small class="fw-bold mb-1"> @lang('main.products.owner')</small>
                                        <p class="m-0">{{$product->admin?->name}}</p>
                                     </div>
                                  </div>
                                  @endif
                                  <div class="d-flex gap-2">
                                     <i class="bi bi-tag"></i>
                                     <div>
                                        <small class="fw-bold mb-1"> @lang('main.products.type')</small>
                                        <p class="m-0">{{__('main.products.'.$product->type)}}</p>
                                     </div>
                                  </div>
                                  <div class="d-flex gap-2">
                                     <i class="bi bi-tag"></i>
                                     <div>
                                        <small class="fw-bold mb-1"> @lang('main.products.product_for')</small>
                                        <p class="m-0">{{__('main.products.'.$product->product_for)}}</p>
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
    
                                  {{--<div class="d-flex gap-2">
                                     <i class="bi bi-eye"></i>
                                     <div>
                                        <small class="fw-bold mb-1"> @lang('main.products.views')</small>
                                        <p class="m-0">{{$product->views}}</p>
                                     </div>
                                  </div>--}}
    
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
                      @if(request('form_type') == 'add_property')
                      <div class="card statistic shadow-none bg-transparent mb-3">
                         <div class="row row-cols-lg-3 g-3">
                            <div class="col">
                               <a href="{{route('productLetters',$product->id)}}">
                                   <div class="info-box shadow-none d-flex align-items-center gap-2 justify-content-between">
                                  <span class="info-box-icon">
                                     <i class="bi bi-heart"></i>
                                  </span>
                                  <div class="info-box-content">
                                     <span class="info-box-number">{{$product->letters()->count()}}</span>
                                     <span class="info-box-text">@lang('main.products.no_letters') </span>
                                  </div>
                               </div></a>
                            </div>
                            @if($product->type == 'auction')
                            <div class="col">
                               <div class="info-box shadow-none d-flex align-items-center gap-2 justify-content-between">
                                  <span class="info-box-icon">
                                     <i class="bi bi-heart"></i>
                                  </span>
                                  <div class="info-box-content">
                                     <span class="info-box-number">{{$product->bids()->count()}}</span>
                                     <span class="info-box-text">@lang('main.products.no_bids') </span>
                                  </div>
                               </div>
                            </div>
                            @endif
                            @if($product->type == 'shared')
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
                            @endif
                            @if($product->type == 'investment')
                            <div class="col">
                               <div class="info-box shadow-none d-flex align-items-center gap-2 justify-content-between">
                                  <span class="info-box-icon">
                                     <i class="bi bi-heart"></i>
                                  </span>
                                  <div class="info-box-content">
                                     <span class="info-box-number">{{$product->investments()->count()}}</span>
                                     <span class="info-box-text">@lang('main.products.no_investments') </span>
                                  </div>
                               </div>
                            </div>
                            @endif
                            <div class="col">
                               <div class="info-box shadow-none d-flex align-items-center gap-2 justify-content-between">
                                  <span class="info-box-icon">
                                     <i class="bi bi-heart"></i>
                                  </span>
                                  <div class="info-box-content">
                                     <span class="info-box-number">{{$product->access_links()->count()}}</span>
                                     <span class="info-box-text">@lang('main.products.no_verifications') </span>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                      @endif
                    @php $request_data = $product->request_data; @endphp
                      @if($request_data)
                      <div class="card mb-3">
                         <div class="card-header">
                            <h3 class="card-title">بيانات صاحب الطلب</h3>
                         </div>
                         <div class="card-body">
                            <div class="description">
                               <div class="form-group">
                                  <label for="fname">@lang('main.users.name'): </label>
                                  <p>{{$request_data['name']}}</p>
                               </div>
                               <div class="form-group">
                                  <label for="fname">@lang('main.users.mobile'): </label>
                                  <p>{{$request_data['mobile']}}</p>
                               </div>
                            </div>
                        </div>
                      </div>
                      @endif
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
                            <div class="row row-cols-md-3 row-cols-1 description">
                               <div class="col form-group">
                                  <label for="fname">@lang('main.products.valuation'): </label>
                                  <p>{{$product->feature?->valuation}}</p>
                               </div>
    
                               <div class="col form-group">
                                  <label for="fname">@lang('main.products.valuation_date'): </label>
                                  <p>{{$product->feature?->valuation_date}}</p>
                               </div>
                               <div class="col form-group">
                                  <label for="fname">@lang('main.products.area_after_development'): </label>
                                  <p>{{$product->feature?->area_after_development}}</p>
                               </div>
                               <div class="col form-group">
                                  <label for="fname">@lang('main.products.area'): </label>
                                  <p>{{$product->feature?->area}}</p>
                               </div>
                               <div class="col form-group">
                                  <label for="fname">@lang('main.products.plot_number'): </label>
                                  <p>{{$product->feature?->plot_number}}</p>
                               </div>
                               <div class="col form-group">
                                  <label for="fname">@lang('main.products.plan_number'): </label>
                                  <p>{{$product->feature?->plan_number}}</p>
                               </div>
                               
                               <div class="col form-group">
                                  <label for="fname">@lang('main.products.accepts_mortgage'): </label>
                                  <p>{{$product->feature?->accepts_mortgage}}</p>
                               </div>
                               <div class="col form-group">
                                  <label for="fname">@lang('main.products.usufruct_lease'): </label>
                                  <p>{{$product->feature?->usufruct_lease}}</p>
                               </div>
                               <div class="col form-group">
                                  <label for="fname">@lang('main.products.product_type'): </label>
                                  <p>{{__('main.products.'.$product->feature?->product_type)}}</p>
                               </div>
                               <div class="col form-group">
                                  <label for="fname">@lang('main.products.owner_type'): </label>
                                  <p>{{$product->feature?->owner_type}}</p>
                               </div>
                               <div class="col form-group">
                                  <label for="fname">@lang('main.products.link_video'): </label>
                                  <p><a href="{{$product->link_video}}" target="_blank">مشاهدة الفيديو المرفق</a></p>
                               </div>
                               <div class="col form-group">
                                  <label for="fname">@lang('main.products.penalty_type'): </label>
                                  <p>{{__('main.products.'.$product->feature?->penalty_type)}}</p>
                               </div>
                               <div class="col form-group">
                                  <label for="fname">@lang('main.products.represented_by'): </label>
                                  <p>{{__('main.products.'.$product->feature?->represented_by)}}</p>
                               </div>
                               @if($product->feature?->sak_number)
                               <div class="col form-group">
                                  <label for="fname">@lang('main.users.sak_number'): </label>
                                  <p>{{$product->feature?->sak_number}}</p>
                               </div>
                               @endif
                               @if($product->feature?->agency_number)
                               <div class="col form-group">
                                  <label for="fname">@lang('main.users.agency_number'): </label>
                                  <p>{{$product->feature?->agency_number}}</p>
                               </div>
                               @endif
                               @if($product->feature?->val_number)
                               <div class="col form-group">
                                  <label for="fname">@lang('main.users.val_number'): </label>
                                  <p>{{$product->feature?->val_number}}</p>
                               </div>
                               @endif
                               <div class="col form-group">
                                  <label for="fname">@lang('main.products.map_location'): </label>
                                  <p>{{$product->map_location}}</p>
                               </div>
                               <div class="col form-group">
                                  <label for="fname">@lang('main.products.product_description'): </label>
                                  <p>{{$product->description}}</p>
                               </div>
                               <div class="col form-group">
                                  <label for="fname">@lang('main.products.valuation_type'): </label>
                                  <p>{{$product->feature?->valuation_type}}</p>
                               </div>
                               <div class="col form-group">
                                  <label for="fname">@lang('main.products.remaining_lease_years'): </label>
                                  <p>{{$product->feature?->remaining_lease_years}}</p>
                               </div>
                               <div class="col form-group">
                                  <label for="fname">@lang('main.products.annual_rent'): </label>
                                  <p>{{$product->feature?->annual_rent}}</p>
                               </div>
                               <div class="col form-group">
                                  <label for="fname">@lang('main.products.license_number'): </label>
                                  <p>{{$product->feature?->license_number}}</p>
                               </div>
                               <div class="col form-group">
                                  <label for="fname">@lang('main.products.additional_info'): </label>
                                  <p>{{$product->feature?->additional_info}}</p>
                               </div>
                               
                               
                            </div>
                               @php $data = $product->feature->features; @endphp
                               
                               <div class="form-group">
                                  <label for="fname">@lang('main.products.product_features'): </label>
                                  <div class="row row-cols-md-3 row-cols-1">
                                    @foreach($data as $key => $value)
                                        @php $d_feature = \App\Models\DynamicFeature::where('id',$key)->value('label_name'); @endphp
                                        <div class="col">
                                            <p> {{ $d_feature }} : {{ $value == 1 ? 'نعم' : 'لا' }}</p>
                                        </div>
                                    @endforeach
                                  </div>
                                </div>
                         </div>
                      </div>
                    @if(
                        request('form_type') !== 'add_request'
                        && request('form_type') !== 'site_property'
                    )
                    <div class="mb-3">
                        @php
                                $qrCount = $product->access_links()->where('method', 'qr')->count();
                                $linkCount = $product->access_links()->where('method', 'link')->count();
                                $total = $qrCount + $linkCount;
                                
                                @endphp
                        <div class="row row-cols-lg-3 g-3">
                                    <div class="col">
                                        <div class="info-box shadow-none d-flex align-items-center gap-2 justify-content-between">
                                          <div class="info-box-content">
                                             <span class="info-box-number"> {{ $qrCount }}</span>
                                             <span class="info-box-text">توثيق Qr </span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col">
                                        <div class="info-box shadow-none d-flex align-items-center gap-2 justify-content-between">
                                          <div class="info-box-content">
                                             <span class="info-box-number"> {{  $linkCount  }}</span>
                                             <span class="info-box-text">توثيق بالرابط </span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col">
                                        <div class="info-box shadow-none d-flex align-items-center gap-2 justify-content-between">
                                          <div class="info-box-content">
                                             <span class="info-box-number"> {{ $total }}</span>
                                             <span class="info-box-text"> إجمالي التوثيقات </span>
                                          </div>
                                       </div>
                                    </div>
                                </div>
                    </div>
                    <div class="card mb-3">
                            <div class="card-header">
                              <h3 class="card-title">
                                   التوثيق للعقار رقم {{ $product->listing_number }}
                              </h3>                          
                              <b> {{ $total }}</b>
                            </div>
                            <div class="card-body"> 
                                <div class="tree">
                                    <ul>
                                        @foreach ($structuredTree as $node)
                                            @include('site.includes.delegation-node', ['node' => $node])
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    
                        <div class="card mb-3">
                            
                            <div class="card-body">    
                                @if($product->type == 'auction')
                                    
                                    <div class="card-header mb-3" style="padding-inline: 0 !important">
                                      <h3 class="card-title"> 
                                        @if($product->investment_collected > 0)
                                            @if($product->status == 'closed')
                                                المزايدة انتهت بسعر {{$product->investment_collected}}
                                            @else
                                                أعلى سعر مزايدة {{$product->investment_collected}}
                                            @endif
                          
                                        @else
                                        {{$product->price}}
                                        @endif
                                        </b>
                                       <span>ريال سعودي</span>
                                      </h3>
                                    </div>
                                    <ul class="nav nav-tabs mb-3" id="propertyTabs" role="tablist">
                                      <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="bids-tab" data-bs-toggle="tab" data-bs-target="#bids" type="button" role="tab">المزايدات</button>
                                      </li>
                                      <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="actions-tab" data-bs-toggle="tab" data-bs-target="#actions" type="button" role="tab">إدارة المزاد</button>
                                      </li>
                                    </ul>
                                    
                                    <div class="tab-content" id="propertyTabsContent">
                                      <!-- تبويب المزايدات -->
                                      <div class="tab-pane fade show active" id="bids" role="tabpanel">
                                        <h5 class="mb-3">كل المزايدات:</h5>
                                        <table class="table table-bordered">
                                          <thead>
                                            <tr>
                                              <th>المستخدم</th>
                                              <th>قيمة المزايدة</th>
                                              <th>تاريخ المزايدة</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @forelse($product->bids as $bid)
                                              <tr>
                                                <td>{{ $bid->user->name }}</td>
                                                <td>{{ number_format($bid->amount, 2) }}</td>
                                                <td>{{ $bid->created_at->format('Y-m-d H:i') }}</td>
                                              </tr>
                                            @empty
                                              <tr>
                                                <td colspan="3">لا توجد مزايدات حتى الآن.</td>
                                              </tr>
                                            @endforelse
                                          </tbody>
                                        </table>
                                      </div>
                                    
                                      <!-- تبويب إدارة المزاد -->
                                      <div class="tab-pane fade" id="actions" role="tabpanel">
                                        <h5 class="mb-3">إجراءات المزايدة:</h5>
                                        @if($product->status == 'closed')
                                                                <button class="blue-btn">
                                                                  انتهت المزايدة
                                                                </button>
                                                                @if($product->winner)
                                                                    <div class="winner-info">
                                                                        الفائز: {{ $product->winner->name }} (ID: {{ $product->winner->card_code }})
                                                                    </div>
                                                                @else
                                                                    <div class="winner-info" style="background-color:#f8d7da; color:#721c24; border-color:#f5c6cb;">
                                                                        لا يوجد فائز لهذا المزاد.
                                                                    </div>
                                                                @endif
                                                                @elseif($product->status == 'inactive')
                                                                {{--<form method="post" action="{{ route('property.resumeAuction', $product->id) }}">
                                                                    @csrf
                                                                    <button class="blue-btn">
                                                                        تفعيل المزايدة مرة أخرى
                                                                    </button>
                                                                </form>--}}
                                                                @elseif($product->status == 'cancelled')
                                                                <button class="blue-btn">
                                                                  المزايدة ملغية
                                                                </button>
                                                                @else
                                                                {{--<form method="post" action="{{ route('property.closeAuction', $product->id) }}">
                                                                    @csrf
                                                                    <input type="hidden" name="status" value="closed">
                                                                    <button class="blue-btn" type="submit">
                                                                        إيقاف المزايدة
                                                                    </button>
                                                                </form>
                                                                
                                                                <form method="post" action="{{ route('property.closeAuction', $product->id) }}">
                                                                    @csrf
                                                                    <input type="hidden" name="status" value="inactive">
                                                                    <button class="blue-btn" type="submit">
                                                                        إيقاف مؤقت
                                                                    </button>
                                                                </form>
                                                                
                                                                <form method="post" action="{{ route('property.closeAuction', $product->id) }}">
                                                                    @csrf
                                                                    <input type="hidden" name="status" value="cancelled">
                                                                    <button class="blue-btn" type="submit">
                                                                        إلغاء المزايدة
                                                                    </button>
                                                                </form>--}}
                                                                
                                                                @endif
                                      </div>
                                    </div>
                                @endif
                    
                                @if($product->type == 'investment')
                                    <div class="card-header mb-3" style="padding-inline: 0 !important">
                                      <h3 class="card-title">
                                        @if( ($product->price - $product->investment_collected) == 0)
                                            تم جمع المبلغ كاملا {{$product->price}}   <span>ريال سعودي</span>
                                        @else
                                       متبقي {{$product->price - $product->investment_collected}}  <span>ريال سعودي</span>
                                        @endif
                                          
                                      </h3>
                                     </div>
                                    <ul class="nav nav-tabs mb-3" id="propertyTabs" role="tablist">
                                      <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="investments-tab" data-bs-toggle="tab" data-bs-target="#investments" type="button" role="tab">
                                          الاستثمارات
                                        </button>
                                      </li>
                                    </ul>
                                    <div class="tab-content" id="propertyTabsContent">
                                      <div class="tab-pane fade show active" id="investments" role="tabpanel">
                                        <h5 class="mb-3">قائمة الاستثمارات:</h5>
                                        <table class="table table-bordered table-striped">
                                          <thead>
                                            <tr>
                                              <th>المستثمر</th>
                                              <th>المبلغ</th>
                                              <th>تاريخ الاستثمار</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @forelse($product->investments as $investment)
                                              <tr>
                                                <td>{{ $investment->user->name }}</td>
                                                <td>{{ number_format($investment->amount, 2) }} ريال</td>
                                                <td>{{ $investment->created_at->format('Y-m-d H:i') }}</td>
                                              </tr>
                                            @empty
                                              <tr>
                                                <td colspan="3" class="text-center">لا توجد استثمارات حتى الآن.</td>
                                              </tr>
                                            @endforelse
                                          </tbody>
                                        </table>
                                      </div>
                                    
                                    </div>
                                @endif
                                
                                @if($product->type == 'shared')
                                    <div class="card-header mb-3" style="padding-inline: 0 !important">
                                      <h3 class="card-title"
                                            يوجد  {{$product->offers()->count()}} عروض 
                                      </h3>
                                    </div>
                                    @php
                                        $approvedOffer = $product->offers()->where('status', 'approve')->first();
                                    @endphp
                                    
                                    @if($approvedOffer)
                                        <div class="card-header mb-3" style="padding-inline: 0 !important">
                                            <h3 class="card-title">
                                                العرض الفائز {{ $approvedOffer->user?->name }} بقيمة {{ $approvedOffer->amount }} 
                                            </h3>
                                        </div> 
                                    @endif
                                    <ul class="nav nav-tabs mb-3" id="propertyTabs" role="tablist">
                                      <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="offers-tab" data-bs-toggle="tab" data-bs-target="#offers" type="button" role="tab">
                                          العروض
                                        </button>
                                      </li>
                                    </ul>
                                    <div class="tab-content" id="propertyTabsContent">
                                      <div class="tab-pane fade show active" id="offers" role="tabpanel" aria-labelledby="offers-tab">
                                        <h5 class="mb-3">قائمة العروض المقدمة:</h5>
                                    
                                        <table class="table table-bordered table-striped">
                                          <thead>
                                            <tr>
                                              <th>المستخدم</th>
                                              <th>المبلغ</th>
                                              <th>تاريخ العرض</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @forelse($product->offers as $offer)
                                              <tr>
                                                <td>{{ $offer->user->name ?? 'غير معروف' }}</td>
                                                <td>{{ number_format($offer->amount, 2) }} ريال</td>
                                                <td>{{ $offer->created_at->format('Y-m-d H:i') }}</td>
                                              </tr>
                                            @empty
                                              <tr>
                                                <td colspan="4" class="text-center">لا توجد عروض حتى الآن.</td>
                                              </tr>
                                            @endforelse
                                          </tbody>
                                        </table>
                                      </div>
                                    
                                    </div>
                                    
                                @endif
                            </div>
                        </div>
    
                        <div class="card mb-3">
                            <div class="card-header">
                              <h3 class="card-title"> تفويضات العقار </h3>
                              <!--<b>0</b>-->
                            </div>
                            <div class="card-body">   
                                <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>المفوَّض إليه</th>
                              <th>حالة التفويض</th>
                              <th>تاريخ التفويض</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse($product->property_delegations as $delegation)
                              <tr>
                                <td>{{ $delegation->agent->name ?? '-' }}</td>
                                <td>{{ $delegation->status ?? '-' }}</td>
                                <td>{{ $delegation->created_at->format('Y-m-d') }}</td>
                              </tr>
                            @empty
                              <tr>
                                <td colspan="4" class="text-center">لا توجد تفويضات حالياً.</td>
                              </tr>
                            @endforelse
                          </tbody>
                        </table>
                            </div>    
                        </div>
                    @endif
    
                   </div>
                </div>
            </div>
        </div>
   </div>
@endsection