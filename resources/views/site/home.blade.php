@extends('site.index')
@section('title', app(App\Models\GeneralSettings::class)->site_name())
@section('content')
    <!-- hero section -->
    <section class="heroSec position-relative">
      <div class="overlay"></div>
      <div class="hero-content text-center text-white">
        <div class="container-fluid h-100">
          <h1 class="mb-2 fs-2 fw-semibold">{{app(App\Models\LandingSettings::class)->banner_title()}} </h1>
          <p class="fs-4">
{{app(App\Models\LandingSettings::class)->banner_text()}}          </p>

          <div class="search-box">
      <form action="{{route('product.filter')}}" method="post">
        @csrf
              <select name="product_for[]">
                <option value="sale" @if(request('product_for') == 'sale') selected @endif>للبيع</option>
                <option value="rent" @if(request('product_for') == 'rent') selected @endif>للإيجار</option>
              </select>
              <input
                type="search"
                name="search"
                id="search"
                value=""
                placeholder=" ابحث عن العقار الذي تريده "
                class="ui-autocomplete-input"
                autocomplete="off"
              />
              <button type="submit" class="btn main-btn">
                <i class="bi bi-search me-1 d-none d-md-inline"></i>
                <span>بحث</span>
              </button>
            </form>
          </div>
        </div>
      </div>
      <nav aria-label="scroll to next section">
        <ul class="scroll-to-next p-0">
          <li>
            <a href="#about_sec">
              <i class="bi bi-arrow-down"></i>
              <span>التمرير للأسفل</span>
            </a>
          </li>
        </ul>
      </nav>
    </section>

    @include('site.includes.about-section')
    <!-- estates section -->
@if(app(App\Models\GeneralSettings::class)->aqar_screen_control == '1')
    @if($propertys->count() > 0)
    <section class="our-estates py-5">
      <div class="container-fluid">
        <div class="section-title text-center pb-4">
          <h2 class="secDesc fw-bold secondary fs-4">اكتشف عقارك المثالي</h2>
        </div>
        <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 gy-4">
        @foreach($propertys as $property)
            @include('site.includes.property-section',['property' => $property])
        @endforeach
        </div>
        <a
          href="{{route('propertys')}}"
          aria-label="المزيد"
          class="main-outline-btn m-auto mt-4"
        >
          المزيد
        </a>
      </div>
    </section>
    @endif
    @endif
    <!-- discover section -->
    <section class="discover-wrapper py-5">
      <div class="container-fluid">
        <div class="discover position-relative">
          <div class="discover-bg"></div>
          <div class="d-flex flex-lg-row flex-column-reverse align-items-center">
            <div class="discover-content">
              <div class="about">
                <div class="section-title">
                  <h2 class="secDesc fw-bold secondary fs-4">
                    أحدث العروض والإعلانات
                  </h2>
                </div>
                <div class="about-txt d-flex flex-column gap-3 my-4">
                  <p>
                    اكتشف أحدث العروض والإعلانات المميزة من شركتنا. نحن نقدم لك فرصة للحصول على أفضل العروض والتخفيضات على منتجاتنا وخدماتنا، بالإضافة إلى إعلانات حصرية لتحسين تجربتك معنا
                  </p>
                </div>
                @if(app(App\Models\GeneralSettings::class)->aqar_screen_control == '1')
                <a
                  href="{{route('propertys')}}"
                  aria-label="اكتشف أحدث العروض والإعلانات المميزة من شركتنا"
                  class="main-outline-btn"
                >
                العقارات
                </a>
                @endif
              </div>
            </div>
            <div class="discover-img col-lg-6">
              <img src="{{url('site')}}/images/new-ads.png" class="w-100" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>
    @if($blogs->count()>0)
    <!-- blogs section -->
    <section class="blogs py-5">
      <div class="container-fluid">
        <div class="section-title text-center pb-4">
          <h2 class="secDesc fw-bold secondary fs-4">
            اكتشف آخر الأخبار والمقالات
          </h2>
        </div>
        <div class="row g-3 row-cols-lg-3 row-cols-md-2 row-cols-1">
          @foreach($blogs as $blog)
              @include('site.includes.blog-section',['blog' => $blog])
          @endforeach
        </div>
        <a
          href="{{route('blogs')}}"
          aria-label="مشاهدة كل المقالات"
          class="main-outline-btn m-auto mt-4"
        >
          المزيد
        </a>
      </div>
    </section>
    @endif
@endsection