
<div class="profile-nav col col-md-5 col-lg-3" id="profile-nav">
            <div class="profile-wrapper">
              <button class="close-profile-nav" data-close=".profile-nav">
                <i class="bi bi-x-lg"></i>
              </button>
  
              <!-- profile title -->
              <div class="personal-title text-md-center fs-4">الملف الشخصي</div>
              <!-- profile nav -->
              <div class="nav flex-column nav-pills">
                <!-- المعلومات الشخصية -->
                <a aria-current="page" href="{{route('profile')}}" class="nav-link @if(\Request::route()->getName() == 'profile') active @endif">
                    @lang('site.profile') 
                </a>
                <!-- تعيين كلمة المرور -->
                <a href="{{route('change-password')}}" class="nav-link @if(\Request::route()->getName() == 'change-password') active @endif">
                    @lang('site.change-password')
                </a>
  
                <!-- بطاقتي -->
                <a href="{{route('userCard',auth('web')->user()->id)}}" class="nav-link">
                  بطاقتي
                </a>

                <!-- إضافة عقار -->
                <a href="{{route('addProperty',auth('web')->user()->id)}}" class="nav-link">
                  إضافة عقار
                </a>

                <!-- إدارة عقاراتي -->
                <a href="p_estateControl.html" class="nav-link">
                  إدارة عقاراتي
                </a>

              </div>
              <!--profile log out button -->
                <form method="post" action="{{route('ulogout')}}">
                @csrf
                    <button class="log-out btn d-block w-100 mt-1 fs-5">  
                    <i class="bi bi-box-arrow-right"></i>    
                    @lang('site.logout')
                    </button>
                </form>
            </div>

          </div>