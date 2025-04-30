@extends('admin.index')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        @if(auth('admin')->user()->account_type == 'admins')
        <!-- Content Header (Page header) -->
        <section class="content"><!-- Main content -->
            <div class="card statistic mb-3">
                <div class="card-header">
                    <h3 class="card-title">@lang('main.statistics')</h3>
                </div>
                <div class="card-body">
                    <!-- Small boxes (Stat box) -->
                    <div class="row row-cols-lg-5 g-3">
                        <div class="col">
                            <a class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between" href="{{url('admin/categorys')}}">
                                <span class="info-box-icon">
                                <i class="bi bi-ui-checks-grid"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-number">{{$categorysCount}}</span><span class="info-box-text">@lang('main.categorysCount')</span>
                                </div><!-- /.info-box-content -->
                            </a><!-- /.info-box -->
                        </div>
                        <div class="col">
                            <a class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between"
                            href="{{url('/admin/blogs?status=show')}}">
                                <span class="info-box-icon">
                                    <i class="bi bi-newspaper"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-number">{{$blogsShowCount}}</span>
                                    <span class="info-box-text">@lang('main.blogsShowCount')</span>
                                </div><!-- /.info-box-content -->
                            </a><!-- /.info-box -->
                        </div>
                        <div class="col">
                            <a class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between" href="{{url('/admin/brands')}}">
                                <span class="info-box-icon">
                                    <i class="bi bi-tags"></i>
                                </span><!-- /.info-box-icon -->
                                <div class="info-box-content">
                                    <span class="info-box-number">
                                        {{$brandsCount}}
                                    </span>
                                    <span class="info-box-text">
                                        @lang('main.brandsCount')
                                    </span>
                                </div><!-- /.info-box-content -->
                            </a><!-- /.info-box -->
                        </div>
                        <div class="col">
                            <a class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between" href="{{url('/admin/pending_vendors?status=accepted')}}">
                                <span class="info-box-icon">
                                    <i class="bi bi-person-badge"></i>
                                </span><!-- /.info-box-icon -->
                                <div class="info-box-content">
                                    <span class="info-box-number">
                                      {{$acceptedVendorsCount}}
                                    </span>
                                    <span class="info-box-text">
                                      @lang('main.acceptedVendorsCount')
                                    </span>
                                </div><!-- /.info-box-content -->
                            </a><!-- /.info-box -->
                        </div>
                        <div class="col">
                            <a class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between" href="{{url('/admin/contacts?is_viewed=no')}}">
                                <span class="info-box-icon">
                                    <i class="bi bi-chat-text"></i>
                                </span><!-- /.info-box-icon -->
                                <div class="info-box-content">
                                    <span class="info-box-number">
                                        {{$contactsCount}}
                                    </span>
                                    <span class="info-box-text">
                                        @lang('main.contactsCount')
                                    </span>
                                </div><!-- /.info-box-content -->
                            </a><!-- /.info-box -->
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row row-cols-lg-3 g-3 mb-3">
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">@lang('main.home.most_categorys')</h3>
                        </div>
                        <div class="card-body py-1">
                            @forelse($categories as $category)
                                @if($category->products_in_cart > 0)
                                <a class="info-box h-auto shadow-none bg-transparent d-flex align-items-center py-2 px-0 gap-2">
                                    @if($category->getFirstMediaUrl('categorys_image','thumb'))
                                    <img loading="lazy" src="{{$category->getFirstMediaUrl('categorys_image','thumb')}}" style="width:70px;" alt="">
                                    @endif
                                    <div>
                                        <p class="mb-0 fw-bold">{{ $category->title }}</p>
                                        <small>{{ $category->products_in_cart }} @lang('main.home.products_in_cart')</small>
                                    </div>
                                </a>
                                @endif
                            @empty
                                <h5>@lang('main.no data')</h5>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">@lang('main.home.most_stores') <small>@lang('main.home.weekly')</small></h3>
                        </div>
                        <div class="card-body py-1">
                            @forelse($topStores as $store)
                            <a class="info-box h-auto shadow-none bg-transparent d-flex align-items-center py-2 px-0 gap-2">
                                @if($store->getFirstMediaUrl('stores_image','thumb'))
                                <img loading="lazy" src="{{$store->getFirstMediaUrl('stores_image','thumb')}}" style="width:70px;" alt="">
                                @endif
                                <div>
                                    <p class="mb-0 fw-bold">{{ $store->name }}</p>
                                    <small>{{ $store->total_sales }} @lang('main.home.completed_orders_of_week')</small>
                                </div>
                            </a>
                            @empty
                                <h5>@lang('main.no data')</h5>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">@lang('main.home.most_blogs') <small>@lang('main.home.monthly')</small></h3>
                        </div>
                        <div class="card-body py-1">
                            @forelse($topBlogs as $blog)
                            <a class="info-box h-auto shadow-none bg-transparent d-flex align-items-center py-2 px-0 gap-2"
                            href="{{ route('blogs.show', $blog->id) }}">
                                @if($blog->getFirstMediaUrl('blogs_image','thumb'))
                                <img loading="lazy" src="{{$blog->getFirstMediaUrl('blogs_image','thumb')}}" style="width:70px;" alt="">
                                @endif
                                <div>
                                    <p class="mb-0 fw-bold">{{ $blog->name }}</p>
                                    <small>{{ $blog->views }} @lang('main.home.views')</small>
                                </div>
                            </a>
                            @empty
                                <h5>@lang('main.no data')</h5>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row g-3 mb-3">
                <div class="col-lg-8">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">@lang('main.home.latest_orders')</h3>
                        </div>
                        <div class="card-body py-1">
                            @forelse($latestOrders->sortByDesc('created_at')->take(3) as $order)
                            <a href="#" class="info-box h-auto shadow-none bg-transparent d-flex align-items-center py-2 px-0 gap-2">
                                <img loading="lazy" src="{{url('dashboard/dist/img/box.png')}}" style="width:60px;" alt="">
                                <div>
                                    <p class="mb-0 fw-bold">@lang('main.home.order_no') #{{ $order->id }} - @lang('main.home.status'): {{ __('main.orders.'.$order->status) }} </p>
                                    <small>- @lang('main.home.date'): {{ $order->created_at->format('Y-m-d H:i') }}</small>
                                </div>
                            </a>
                            @empty
                                <h5>@lang('main.no data')</h5>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">@lang('main.chart4') </h3>
                        </div>
                        <div class="card-body" wire:ignore>
                            {!! $chart4->container() !!}
                            {{ $chart4->script() }}
                        </div>
                    </div> 
                </div>
            </div>
            
            <div class="row g-3">
                <div class="col-lg-8">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">@lang('main.home.latest_pending_vendors')</h3>
                                </div>
                                <div class="card-body py-1">
                                    @forelse($latestPendingVendors->sortByDesc('created_at')->take(3) as $vendor)
                                    <a href="{{route('pending_vendors.show',$vendor->id)}}" class="info-box h-auto shadow-none bg-transparent d-flex align-items-center py-2 px-0 gap-2">
                                        <img loading="lazy" src="{{url('dashboard/dist/img/avatar.png')}}" style="width:70px;" alt="">
                                        <div>
                                            <p class="mb-0 fw-bold">
                                            {{ $vendor->name }}
                                            - @lang('main.users.email'): {{ $vendor->email }}  
                                            </p>
                                            <small>- @lang('main.home.date'): {{ $vendor->created_at->format('Y-m-d H:i') }}</small>
                                        </div>
                                    </a>
                                    @empty
                                        <h5>@lang('main.no data')</h5>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">@lang('main.chart3')</h3>
                                </div>
                                <div class="card-body" wire:ignore>
                                    {!! $chart3->container() !!}
                                    {{ $chart3->script() }}
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">@lang('main.chart')</h3>
                                </div>
                                <div class="card-body" wire:ignore>
                                    {!! $chart->container() !!}
                                    {{ $chart->script() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row g-3">
                        {{--<div class="col-12">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h3 class="card-title">@lang('main.chart2') </h3>
                                </div>
                                <div class="card-body" wire:ignore>
                                    {!! $chart2->container() !!}
                                    {{ $chart2->script() }}
                                </div>
                            </div> 
                        </div>--}}
                        <div class="col-12">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h3 class="card-title">@lang('main.home.latest_reviews')</h3>
                                </div>
                                <div class="card-body p-0">
                                    <div class="owl-carousel latestReviews">
                                        @forelse($latestReviews as $review)
                                        <a href="{{route('users.show',['account_type'=> 'users', $review->user_id])}}" class="info-box h-auto shadow-none bg-transparent d-flex py-1 gap-1">
                                            @if($review->product?->getFirstMediaUrl('products_image','thumb'))
                                            <img loading="lazy" src="{{$review->product?->getFirstMediaUrl('products_image','thumb')}}" style="width:70px;" alt="">
                                            @endif
                                            <div>
                                                <p class="mb-0 fw-bold">
                                                    {{ $review->customer_name }}
                                                </p>
                                                <small>
                                                    {{ $review->product_name }} @lang('main.home.inside_store') {{ $review->store_name }} 
                                                </small>
                                                <div class="Stars" style="--rating:{{ $review->star }}"></div>
                                                <p class="m-0">{{ $review->review ? " $review->review" : '' }}</p>
                                            </div>
                                        </a>
                                        @empty
                                            <h5>@lang('main.no data')</h5>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h3 class="card-title">@lang('main.home.most_customers')</h3>
                                </div>
                                <div class="card-body py-1">
                                    @forelse($topCustomers as $customer)
                                    <a href="{{route('users.show',['account_type'=> 'users', $customer->id])}}" class="info-box h-auto shadow-none bg-transparent d-flex align-items-center py-2 px-0 gap-2">
                                        @if($customer->getFirstMediaUrl('photo_profile','thumb'))
                                        <img loading="lazy" src="{{$customer->getFirstMediaUrl('photo_profile','thumb')}}" style="width:70px;" alt="">
                                        @endif
                                        <div>
                                            <p class="mb-0 fw-bold">{{ $customer->name }}</p>
                                            <small>{{ $customer->total_orders }} @lang('main.home.orders_of_week')</small>
                                        </div>
                                    </a>
                                    @empty
                                        <h5>@lang('main.no data')</h5>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h3 class="card-title">@lang('main.home.latest_coupons')</h3>
                                </div>
                                <div class="card-body py-0 px-3">
                                    <div class="owl-carousel latestReviews">
                                        @forelse($topCoupons as $coupon)
                                        <a href="" class="info-box h-auto shadow-none bg-transparent">
                                            <p class="mb-0 fw-bold">
                                                @lang('main.home.coupon') {{ $coupon->code }} - @lang('main.home.store_owner')  {{ $coupon->owner_name }}
                                            </p>
                                            <small>@lang('main.home.no_of_uses'): {{ $coupon->usage_count }}</small>
                                        </a>
                                        @empty
                                            <h5>@lang('main.no data')</h5>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    
                    {{--<div class="col-lg-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h3 class="card-title">@lang('main.chart4') </h3>
                            </div>
                            <div class="card-body" wire:ignore>
                                {!! $chart2->container() !!}
                                {{ $chart2->script() }}
                            </div>
                        </div> 
                    </div>--}}
                    
                </div>
            </div>
        </section><!-- /.content -->
        @endif
    </div><!-- /.container-fluid -->  
</div><!-- /.content-wrapper -->
@endsection
