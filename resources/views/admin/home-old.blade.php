@extends('admin.index')
@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="mb-0 fs-5 fw-bold" style="color: var(--main)">@lang('main.dashboard')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row g-3 mb-3">
          <div class="col-md-3 col-sm-6 col-12">
            <a href="{{url('admin/categorys')}}" class="info-box">
              <div class="d-flex justify-content-between">
                <span class="info-box-number">{{$categorysCount}}</span>
                <span class="info-box-icon">
                  <i class="bi bi-briefcase"></i>
                </span>
              </div>
              <div class="info-box-content">
                <span class="info-box-text">@lang('main.categorysCount')</span>
              </div>
              <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
          </div>

      
          <div class="col-md-3 col-sm-6 col-12">
            <a href="{{url('/admin/blogs?status=show')}}" class="info-box">
              <div class="d-flex justify-content-between">
                <span class="info-box-number">{{$blogsShowCount}}</span>
                <span class="info-box-icon"><i class="bi bi-newspaper"></i></span>
              </div>
              
              <div class="info-box-content">
                <span class="info-box-text">@lang('main.blogsShowCount')</span>
              </div>
              <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-12">
            <a href="{{url('/admin/blogs?status=hide')}}" class="info-box">
              <div class="d-flex justify-content-between">
                <span class="info-box-number">{{$blogsHideCount}}</span>
                <span class="info-box-icon"><i class="bi bi-hourglass-split"></i></span>
              </div>

              <div class="info-box-content">
                <span class="info-box-text">@lang('main.blogsHideCount')</span>
              </div>
              <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
          </div>
          
          <div class="col-md-3 col-sm-6 col-12">
            <a href="{{url('/admin/brands')}}" class="info-box">
              <div class="d-flex justify-content-between">
                <span class="info-box-number">{{$brandsCount}}</span>
                <span class="info-box-icon">
                  <i class="bi bi-hourglass-split"></i>
                </span>
              </div>

              <div class="info-box-content">
                <span class="info-box-text">@lang('main.brandsCount')</span>
              </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">
            <a href="{{url('/admin/brands')}}" class="info-box">
              <div class="d-flex justify-content-between">
                <span class="info-box-number">{{$brandsYesCount}}</span>
                <span class="info-box-icon">
                  <i class="bi bi-hourglass-split"></i>
                </span>
              </div>

              <div class="info-box-content">
                <span class="info-box-text">@lang('main.brandsYesCount')</span>
              </div>
                <!-- /.info-box-content -->
            </a>
          <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-12">
            <a href="{{url('/admin/pending_vendors?status=accepted')}}" class="info-box">
              <div class="d-flex justify-content-between">
                <span class="info-box-number">{{$acceptedVendorsCount}}</span>
                <span class="info-box-icon"><i class="bi bi-journal-check"></i></span>
              </div>
              <div class="info-box-content">
                <span class="info-box-text">@lang('main.acceptedVendorsCount')</span>
              </div>
              <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-12">
            <a href="{{url('/admin/pending_vendors?status=pending')}}" class="info-box">
              <div class="d-flex justify-content-between">
                <span class="info-box-number">{{$pendingVendorsCount}}</span>
                <span class="info-box-icon"><i class="bi bi-envelope"></i></span>
              </div>
              <div class="info-box-content">
                <span class="info-box-text">@lang('main.pendingVendorsCount')</span>
              </div>
              <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
          </div>


          <div class="col-md-3 col-sm-6 col-12">
            <a href="{{url('/admin/contacts?is_viewed=no')}}" class="info-box">
              <div class="d-flex justify-content-between">
                <span class="info-box-number">{{$contactsCount}}</span>
                <span class="info-box-icon"><i class="bi bi-envelope"></i></span>
              </div>
              <div class="info-box-content">
                <span class="info-box-text">@lang('main.contactsCount')</span>
              </div>
              <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
          </div>


        </div>
        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>


    <section>
      <h2>الأقسام حسب أكثر المنتجات المضافة إلي السلة حاليا</h2>

      <ul>
        @forelse($categories as $category)
            <li>
                {{ $category->title }} ({{ $category->products_in_cart }} منتجات في السلة)
            </li>
        @empty
            <h5>@lang('main.no data')</h5>
        @endforelse
      </ul>
    </section>
    <hr>
    <section>
      <h2>المتاجر الأكثر مبيعا هذا الاسبوع</h2>

      <ul>
          @forelse($topStores as $store)
              <li>
                  {{ $store->name }} - {{ $store->total_sales }} طلبات مكتملة هذا الأسبوع
              </li>
          @empty
              <h5>@lang('main.no data')</h5>
          @endforelse
      </ul>
    </section>
    <hr>
    <section>
      <h2>المقالات الأعلي مشاهدة</h2>

      <ul>
          @forelse($topBlogs as $blog)
          <li>
              <a href="{{ route('blogs.show', $blog->id) }}">
                  {{ $blog->name }} - {{ $blog->views }} مشاهدة
              </a>
          </li>
          @empty
              <h5>@lang('main.no data')</h5>
          @endforelse
      </ul>
    </section>
    <hr>
    <section>
      <h2>أفضل العملاء (Top Customers) الذين قاموا بعمليات شراء خلال هذا الشهر</h2>

      <ul>
          @forelse($topCustomers as $customer)
          <li>
              {{ $customer->name }} - {{ $customer->total_orders }} طلبات هذا الشهر
          </li>
          @empty 
              <h5>@lang('main.no data')</h5>
          @endforelse
      </ul>
    </section>
    <hr>



    <section>
      <h2>أحدث تقييمات العملاء على المنتجات</h2>

      <ul>
          @forelse($latestReviews as $review)
            <li>
              <strong>{{ $review->customer_name }}</strong> قيَّم المنتج 
              <strong>{{ $review->product_name }}</strong> 
              في متجر <strong>{{ $review->store_name }}</strong> 
              بـ {{ $review->star }} نجوم  
              {{ $review->review ? " - $review->review" : '' }}
            </li>
          @empty
              <h5>@lang('main.no data')</h5>
          @endforelse
      </ul>
    </section>
    <hr>


    <section>
      <h2>أحدث الطلبات المكتملة أو قيد التنفيذ</h2>
      <ul>
          @forelse($latestOrders as $order)
            <li>
                الطلب رقم #{{ $order->id }} - الحالة: {{ $order->status }} 
                - التاريخ: {{ $order->created_at->format('Y-m-d H:i') }}
            </li>
          @empty
              <h5>@lang('main.no data')</h5>
          @endforelse
      </ul>
    </section>
    <hr>
    <section>
      <h2>أكثر الكوبونات استخدامًا</h2>
      <ul>
          @forelse($topCoupons as $coupon)
            <li>
                الكوبون: <strong>{{ $coupon->code }}</strong> 
                - صاحب الكوبون: <strong>{{ $coupon->owner_name }}</strong> 
                - عدد مرات الاستخدام: <strong>{{ $coupon->usage_count }}</strong>
            </li>
          @empty
              <h5>@lang('main.no data')</h5>
          @endforelse
      </ul>
    </section>
    <hr>


    <section>
      <h2>أحدث طلبات التجار المتقدمين المعلقين</h2>
      <ul>
          @forelse($latestPendingVendors as $vendor)
          <li>
              التاجر: <strong>{{ $vendor->name }}</strong>  
              - البريد الإلكتروني: {{ $vendor->email }}  
              - تاريخ التقديم: {{ $vendor->created_at->format('Y-m-d H:i') }}
          </li>
          @empty
              <h5>@lang('main.no data')</h5>
          @endforelse
      </ul>
    </section>
    <hr>
    <!-- /.content -->
  </div>
@endsection
