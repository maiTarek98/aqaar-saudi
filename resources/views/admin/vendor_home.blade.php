@extends('admin.index')
@section('content')
  <div class="content-wrapper">
    <div class="container-fluid">
      @if(auth('admin')->user()->account_type == 'vendors')
      <section class="content"><!-- Main content -->
        <div class="card statistic mb-3">
          <div class="card-header">
            <h3 class="card-title">@lang('main.statistics')</h3>
            
          </div>
          <div class="card-body">
            <!-- Small boxes (Stat box) -->
            <div class="row row-cols-lg-5 g-3">
              <div class="col">
                <a class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between" 
                href="{{url('admin/products')}}">
                  <span class="info-box-icon">
                    <i class="bi bi-briefcase"></i>
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-number">{{$products}}</span><span class="info-box-text">@lang('main.vendorProductsCount')</span>
                  </div><!-- /.info-box-content -->
                </a><!-- /.info-box -->
              </div>
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

              <div class="col">
                <a class="info-box shadow-none bg-transparent d-flex align-items-center gap-2 justify-content-between" href="">
                  <span class="info-box-icon">
                    <i class="bi bi-hourglass-split"></i>
                  </span><!-- /.info-box-icon -->
                  <div class="info-box-content">
                    <span class="info-box-number">
                    {{$latestReviews->count()}}
                    </span>
                    <span class="info-box-text">
                    @lang('main.latestReviews')
                    </span>
                  </div><!-- /.info-box-content -->
                </a><!-- /.info-box -->
              </div>

             

            </div>
          </div>
        </div>
        <div>
        </div>
      </section><!-- /.content -->

      @endif
    </div>
  </div>
@endsection