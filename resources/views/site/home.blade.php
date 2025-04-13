@extends('site.index')
@section('title', app(App\Models\GeneralSettings::class)->site_name())
@section('content')
<!-- about us -->
    <section class="about-us py-5">
      <div class="container-fluid">
        @include('site.includes.about-section')
      </div>
    </section>
    @if($brands->count()>0)
    <!-- brands -->
    <section class="brands py-5">
      <div class="container-fluid">
        <div class="section-title">
          <h2 class="secTitle fw-bold secondry text-center fs-2 mb-5">@lang('site.brands')</h2>
        </div>
      </div>
      <div class="owl-carousel">
        @foreach($brands as $brand)
        <div class="brand">
          @if($brand->getFirstMediaUrl('brands_image','thumb'))
          <img loading="lazy" src="{{$brand->getFirstMediaUrl('brands_image','thumb')}}" alt="{{$brand->title}}">
          @else
          <img src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->logo)}}" loading="lazy" alt="{{$brand->title}}" />
          @endif
        </div>
        @endforeach
      </div>
    </section>
    @endif
    <!-- features -->
    <section class="about-us py-5">
      <div class="container-fluid">
        @include('site.includes.feature-section')
      </div>
    </section>

    <!-- screens -->
    <section class="screens py-5">
      <div class="container-fluid">
        <div class="section-title">
          <h2 class="secTitle fw-bold text-white fs-2 mt-3">@lang('site.app screens')</h2>
        </div>
      </div>
      <div class="owl-carousel">
        
        <div class="screen">
          <img loading="lazy" src="{{url('site')}}/images/product.png" alt="product screen">
        </div>
        <div class="screen">
          <img loading="lazy" src="{{url('site')}}/images/Filter.png" alt="filter screen">
        </div>
        <div class="screen">
          <img loading="lazy" src="{{url('site')}}/images/Cart.png" alt="cart screen">
        </div>
        <div class="screen">
          <img loading="lazy" src="{{url('site')}}/images/orders.png" alt="orders screen">
        </div>
        <div class="screen">
          <img loading="lazy" src="{{url('site')}}/images/main.png" alt="main screen">
        </div>
        
        <!--<div class="screen">-->
        <!--  <img loading="lazy" src="{{url('site')}}/images/main.png" alt="main screen">-->
        <!--</div>-->
        <!--<div class="screen">-->
        <!--  <img loading="lazy" src="{{url('site')}}/images/Cart.png" alt="cart screen">-->
        <!--</div>-->
        <!--<div class="screen">-->
        <!--  <img loading="lazy" src="{{url('site')}}/images/orders.png" alt="orders screen">-->
        <!--</div>-->
        <!--<div class="screen">-->
        <!--  <img loading="lazy" src="{{url('site')}}/images/Filter.png" alt="filter screen">-->
        <!--</div>-->
        <!--<div class="screen">-->
        <!--  <img loading="lazy" src="{{url('site')}}/images/product.png" alt="product screen">-->
        <!--</div>-->
      </div>
    </section>
    @if($blogs->count()>0)
    <!-- blogs -->
    <section class="blogs py-5">
      <div class="container-fluid">
        <div class="section-title mb-4">
          <h2 class="secTitle fw-bold secondry text-center fs-2">@lang('site.blogs')</h2>
        </div>
        <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1">
          @forelse($blogs as $blog)
            <div class="col">
                @include('site.includes.blog-section',['blog' => $blog])
            </div>
            @empty
              <h3>@lang('main.NoData')</h3>
          @endforelse
        </div>
      </div>
    </section>
    @endif
    
    @include('site.includes.vendor-form')

@endsection