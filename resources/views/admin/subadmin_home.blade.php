@extends('admin.index')
@section('content')
  <div class="content-wrapper">
    <div class="container-fluid">
      @if(auth('admin')->user()->account_type == 'subadmins')
      <section class="content"><!-- Main content -->
        <div class="card statistic mb-3">
          <div class="card-header">
            <h3 class="card-title">@lang('main.statistics')</h3>
            
          </div>
          <div class="card-body">
            <!-- Small boxes (Stat box) -->
            <div class="row row-cols-lg-4 g-3">
              <div class="col">
                <a class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between" 
                href="{{url('admin/orders')}}">
                  <span class="info-box-icon">
                    <i class="bi bi-briefcase"></i>
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-number">{{$orders->count()}}</span><span class="info-box-text">@lang('main.vendorOrdersCount')</span>
                  </div><!-- /.info-box-content -->
                </a><!-- /.info-box -->
              </div>
              <div class="col">
                <a class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between"
                href="{{url('/admin/orders')}}">
                  <span class="info-box-icon">
                    <i class="bi bi-newspaper"></i>
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-number">{{$totalSpent}}</span>
                    <span class="info-box-text">@lang('main.totalOrdersSpent')</span>
                  </div><!-- /.info-box-content -->
                </a><!-- /.info-box -->
              </div>
            </div>
          </div>
        </div>
        
        
            <div class="row g-3 mb-3">
                <div class="sticky-side col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="customer-avatar-section position-relative overflow-hidden border-bottom pb-3">
                                <div class="d-flex align-items-center flex-column">
                                    @php $store = auth('admin')->user()->parent?->store; @endphp
                                    @if($store->getFirstMediaUrl('stores_image','thumb'))
                                    <img class="img-fluid rounded-circle mb-3" width="120" src="{{$store->getFirstMediaUrl('stores_image','thumb')}}" alt="">
                                    @else
                                    <img src="http://localhost/ecommerce/public/storage/products/431/products_image-1740042204.jpg" class="img-fluid rounded-circle mb-3" alt="@lang('main.NoImageUploaded')">
                                    @endif
                                </div>
                            </div>

                            <div class="customer-details py-3">
                                <div class="d-flex flex-column gap-2">
                                    <div class="d-flex gap-2">
                                        <i class="bi bi-patch-check"></i>
                                        <div>
                                            <small class="fw-bold mb-1"> @lang('main.subadmins.store_name') </small>
                                            <p class="m-0">{{$store->name}}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <i class="bi bi-calendar-event"></i>
                                        <div>
                                            <small class="fw-bold mb-1"> @lang('main.subadmins.store_owner') </small>
                                            <p class="m-0">{{$store->user?->name}}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <i class="bi bi-calendar-x"></i>
                                        <div>
                                            <small class="fw-bold mb-1"> @lang('main.subadmins.orders_return_period') </small>
                                            <p class="m-0">{{$store->orders_return_period}} @lang('main.day')</p>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="bi bi-bell-fill"></i> تنبيهات متابعة الطلبات
                            </h3>
                        </div>
                        <div class="card-body">
                            @if ($reminders->count())
                            <ul class="list-inside mt-2">
                                @foreach($reminders as $order)
                                    <li class="mb-2">
                                        <a href="{{ route('orders.show', $order->id) }}" class="">
                                            الطلب رقم <strong>#{{ $order->id }}</strong> في حالة 
                                            <strong>{{ ucfirst($order->status) }}</strong> منذ 
                                            <strong>{{ $latest_status_days }} @lang('main.days')</strong>.
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            @else
                            <div class="bg-gray-100 text-gray-700 p-4 rounded-md">
                                لا توجد تذكيرات حالياً.
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="main-side col-md-8">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title"><i class="bi bi-fire"></i>@lang('main.home.new_orders')</h3>
                        </div>
                        <div class="card-body py-1">
                            @forelse($orders->where('status','pending')->take(30) as $order)
                            <a href="{{route('orders.show',$order->id)}}" class="info-box h-auto shadow-none bg-transparent d-flex align-items-center py-2 px-0 gap-2">
                                <img loading="lazy" src="{{url('dashboard/dist/img/box.png')}}" style="width:60px;" alt="">
                                <div>
                                    <p class="mb-0 fw-bold">@lang('main.home.order_no') #{{ $order->order_no }} - @lang('main.home.status'): {{ __('main.orders.'.$order->status) }} </p>
                                    <small>- @lang('main.home.date'): {{ $order->created_at->format('Y-m-d H:i') }}</small>
                                </div>
                            </a>
                            @empty
                                <h5>@lang('main.no data')</h5>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
      </section><!-- /.content -->
      @endif
    </div>
  </div>
@endsection