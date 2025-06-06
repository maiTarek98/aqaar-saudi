<header>
      <!-- الشريط العلوي -->
      <nav class="navbar top-nav">
        <div class="container-fluid">
          <div
            class="helper-links w-100 d-flex align-items-center justify-content-between py-2"
          >
            <ul class="helper-pages m-0 d-flex gap-2 align-items-center">
              <li class="">
                <a href="{{route('addRequest')}}" aria-label="إضافة طلب">
                  <span>إضافة طلب</span>
                </a>
              </li>
              <li class="">
                  @guest('web')
                    @php $route = route('login'); @endphp
                  @endguest
                  
                  @auth('web')
                    @php $route = route('addProperty',['user' => auth('web')->user()->id]); @endphp
                  @endauth
                <a href="{{$route}}" aria-label="إضافة عرض">
                  <span>إضافة عرض</span>
                </a>
              </li>
              <li>
                 @if(App::getLocale() == 'ar')
                <a href="{{url('/change-language/en')}}" id="lang" aria-label="تغيير اللغة إلى الإنجليزية">
                  <i class="bi bi-globe"></i>
                  <span id="lang-text">EN</span>
                </a>
                @endif
                @if(App::getLocale() == 'en')
                <a href="{{url('/change-language/ar')}}" id="lang" aria-label="تغيير اللغة إلى الإنجليزية">
                  <i class="bi bi-globe"></i>
                  <span id="lang-text">العربية</span>
                </a>
                @endif 
              </li>
            </ul>
            <ul class="helper-pages m-0 d-flex align-items-center">
              @guest('web')
              <li>
                <a
                  class="secondary"
                  href="{{route('register')}}"
                  aria-label="إنشاء حساب جديد"
                >
                  <i class="bi bi-box-arrow-in-left"></i>
                  <span>إنشاء حساب</span>
                </a>
              </li>
              <li>
                <a
                  class="secondary"
                  href="{{route('login')}}"
                  aria-label="تسجيل الدخول"
                >
                  <i class="bi bi-person"></i>
                  <span>تسجيل دخول</span>
                </a>
              </li>
              @endguest
              @auth('web')
              <!-- if auth -->
              <li>
                <a
                  class="secondary @if($unreadCount > 0) notifi @endif"
                  href="{{route('notifications')}}"
                  aria-label="الاشعارات"
                >
                  <i class="bi bi-bell position-relative"></i>
                  <span>الاشعارات</span>
                </a>
              </li>
              <li>
                <a
                  class="secondary"
                  href="{{route('profile')}}"
                  aria-label="الملف الشخصي"
                >
                  <i class="bi bi-person"></i>
                  <span>الملف الشخصي</span>
                </a>
              </li>
              @endauth
            </ul>
          </div>
        </div>
      </nav>
      <!-- القائمة الرئيسية -->
      <nav class="navbar main-nav navbar-expand-lg top-0">
        <div class="container-fluid">
          <a class="navbar-brand m-0" href="{{route('home')}}">
            <img loading="lazy" src="{{ url('/storage/' . app(App\Models\GeneralSettings::class)->logo) }}"
                alt="{{ app(App\Models\GeneralSettings::class)->site_name() }}" />
          </a>
          <div
            class="collapse navbar-collapse justify-content-between align-items-center"
            id="navbarSupportedContent"
          >
            <!-- روابط القائمة -->
            <ul class="navbar-nav gap-xl-3 mb-0">
              <li class="nav-item">
                <a
                  class="nav-link active"
                  href="{{route('home')}}"
                  aria-label="الذهاب إلى الصفحة الرئيسية"
                  >الرئيسية</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  href="{{route('aboutus')}}"
                  aria-label="الذهاب إلى صفحة من نحن"
                  >من نحن</a
                >
              </li>
              @if(app(App\Models\GeneralSettings::class)->aqar_screen_control == '1')
              <li class="nav-item">
                <a
                  class="nav-link"
                  href="{{route('propertys')}}"
                  aria-label="الذهاب إلى صفحة العقارات"
                  >العقارات</a
                >
              </li>
              @endif
              <li class="nav-item">
                <a
                  class="nav-link"
                  href="{{route('blogs')}}"
                  aria-label="الذهاب إلى صفحة المدونة"
                  >المدونة</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  href="{{route('contactus')}}"
                  aria-label="الذهاب إلى صفحة تواصل معنا"
                  >تواصل معنا</a
                >
              </li>
            </ul>
            <!-- مربع البحث -->
            <div class="search-box">
              <form action="{{route('propertys')}}" method="GET">
                <input
                  type="search"
                  name="listing_number"
                  class="form-control" value="{{request('listing_number')}}"
                  placeholder="بحث بكود العقار"
                  aria-label="بحث بكود العقار"
                  required
                />
                <button type="submit">
                  <i class="bi bi-search"></i>
                </button>
              </form>
            </div>
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