<div class="header-hero-wrapper @if(\Request::route()->getName() == 'home') home @endif">
      <header>
        <nav class="navbar main-nav navbar-expand-lg top-0">
          <div class="container-fluid">
            <a class="navbar-brand m-0" href="{{route('home')}}">
              <img loading="lazy" src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->logo)}}" alt="{{app(App\Models\GeneralSettings::class)->site_name()}}" />
            </a>
            <div
              class="collapse navbar-collapse justify-content-between align-items-center"
              id="navbarSupportedContent"
            >
              <!-- روابط القائمة -->
              <ul class="navbar-nav gap-lg-5 mb-0">
                <li class="nav-item">
                  <a
                    class="nav-link {{ (Request::is('/') ? 'active' : '') }}"
                    href="{{route('home')}}"
                    aria-label="الذهاب إلى الصفحة الرئيسية"
                    >@lang('site.home')</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link {{ (Request::is('about-us') ? 'active' : '') }}"
                    href="{{route('aboutus')}}"
                    aria-label="الذهاب إلى صفحة من نحن"
                    >@lang('site.aboutus')</a
                  >
                </li>
                <li class="nav-item">
                  <a
                  class="nav-link {{ (Request::is('app-features') ? 'active' : '') }}"
                  href="{{route('appFeatures')}}"
                  aria-label="الذهاب إلى صفحة مميزات التطيبق"
                  >@lang('site.features')</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link {{ (Request::is('blogs') ? 'active' : '') }}"
                    href="{{route('blogs')}}"
                    aria-label="الذهاب إلى صفحة المدونة"
                    >@lang('site.blogs')</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link {{ (Request::is('contact-us') ? 'active' : '') }}"
                    href="{{route('contactus')}}"
                    aria-label="الذهاب إلى صفحة تواصل معنا"
                    >@lang('site.contactus')</a
                  >
                </li>
              </ul>
              <ul class="d-flex flex-lg-row flex-column align-items-lg-center gap-lg-4 gap-3 mt-3 my-lg-0">
                <li>
                  @if(App::getLocale() == 'ar')
                    <a href="{{url('/change-language/en')}}" id="lang" aria-label="تغيير اللغة إلى الإنجليزية">
                        <span id="lang-text">English</span>
                      </a>
                  @endif
                  @if(App::getLocale() == 'en')
                    <a href="{{url('/change-language/ar')}}" id="lang" aria-label="تغيير اللغة إلى الإنجليزية">
                        <span id="lang-text">العربية</span>
                      </a>
                  @endif
                </li>
                <li>
                  <a href="{{route('vendorRegisteration')}}" class="main-btn" aria-label="قم بالتسجيل معنا كتاجر">
                    <span>@lang('site.vendorRegisteration')</span>
                  </a>
                </li>
              </ul>
            </div>
            <button
              class="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
            </button>
          </div>
        </nav>
      </header>
      @if(\Request::route()->getName() == 'home')
      <!-- hero section -->
      <section class="heroSec">
        <div class="container-fluid text-white">
          <div class="row justify-content-lg-start justify-content-end">
            <div class="col-lg-6">
              <div class="hero-content">
                @if(app(App\Models\LandingSettings::class)->banner_title())
                <h1 class="fw-bold">{{app(App\Models\LandingSettings::class)->banner_title()}}</h1>
                @endif

                @if(app(App\Models\LandingSettings::class)->banner_text())
                <p class="fs-5 my-4 lh-lg">
                  {{app(App\Models\LandingSettings::class)->banner_text()}}
                </p>
                @endif
                <div class="apps-btns d-flex align-items-center gap-1">
                  @include('site.includes.social-f-section')
                </div>
              </div>
            </div>
            @if(app(App\Models\LandingSettings::class)->banner_image)
            <div class="col-lg-6 col-md-8">
              <img
                loading="lazy"
                src="{{url('storage/'.app(App\Models\LandingSettings::class)->banner_image)}}"
                alt="{{app(App\Models\LandingSettings::class)->banner_title()}}"
                class="hero-image w-100"
              />
            </div>
            @endif
          </div>
        </div>
      </section>
      @else
      <!-- breadcrumb -->
        @if(\Request::route()->getName() == 'site.blogs.show')
          @include('site.includes.breadcrumb-section',['title' =>$blog->name])
        @else
          @include('site.includes.breadcrumb-section',['title' =>__('site.'.\Request::route()->getName())])
        @endif
      @endif
    </div>