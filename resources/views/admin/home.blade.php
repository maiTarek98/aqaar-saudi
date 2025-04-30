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
                                    <span class="info-box-number">{{$propertiesAdminCount}}</span><span class="info-box-text">@lang('main.propertiesAdminCount')</span>
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
                                        {{$propertiesAuctionCount}}
                                    </span>
                                    <span class="info-box-text">
                                        @lang('main.propertiesAuctionCount')
                                    </span>
                                </div><!-- /.info-box-content -->
                            </a><!-- /.info-box -->
                        </div>
                        <div class="col">
                            <a class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between" href="{{url('/')}}">
                                <span class="info-box-icon">
                                    <i class="bi bi-person-badge"></i>
                                </span><!-- /.info-box-icon -->
                                <div class="info-box-content">
                                    <span class="info-box-number">
                                      {{$propertiesSharedCount}}
                                    </span>
                                    <span class="info-box-text">
                                      @lang('main.propertiesSharedCount')
                                    </span>
                                </div><!-- /.info-box-content -->
                            </a><!-- /.info-box -->
                        </div>
                        <div class="col">
                            <a class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between" href="{{url('/')}}">
                                <span class="info-box-icon">
                                    <i class="bi bi-person-badge"></i>
                                </span><!-- /.info-box-icon -->
                                <div class="info-box-content">
                                    <span class="info-box-number">
                                      {{$propertiesInvestmentCount}}
                                    </span>
                                    <span class="info-box-text">
                                      @lang('main.propertiesInvestmentCount')
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
                <div class="col-lg-8">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">@lang('main.latest_pending_products')</h3>
                        </div>
                        <div class="card-body py-1">
                            @forelse($latest_pending_products as $product)
                            <a href="{{route('products.show', $product->id)}}" class="info-box h-auto shadow-none bg-transparent d-flex align-items-center py-2 px-0 gap-2">
                                <img loading="lazy" src="{{url('dashboard/dist/img/box.png')}}" style="width:60px;" alt="">
                                <div>
                                    <p class="mb-0 fw-bold">@lang('main.products.listing_number') #{{ $product->listing_number }} - @lang('main.home.status'): {{ __('main.products.'.$product->status) }} </p>
                                    <small>- @lang('main.home.date'): {{ $product->created_at->format('Y-m-d H:i') }}</small>
                                </div>
                            </a>
                            @empty
                                <h5>@lang('main.no data')</h5>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /.content -->
        @endif
    </div><!-- /.container-fluid -->  
</div><!-- /.content-wrapper -->
@endsection
