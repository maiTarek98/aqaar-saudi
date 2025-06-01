
<div class="profile-nav col-12 col-md-5 col-lg-4" id="profile-nav">
            <div class="profile-wrapper">
              <!--<button class="close-profile-nav" data-close=".profile-nav">-->
              <!--  <i class="bi bi-x-lg"></i>-->
              <!--</button>-->
  
              <!-- profile title -->
              <div class="personal-title text-md-center fs-4">@lang('site.profile')</div>
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
                <a href="{{route('userCard',auth('web')->user()->id)}}" class="nav-link  @if(\Request::route()->getName() == 'userCard') active @endif">
                  بطاقتي
                </a>

                <!-- إضافة عقار -->
                <a href="{{route('addProperty',auth('web')->user()->id)}}" class="nav-link  @if(\Request::route()->getName() == 'addProperty') active @endif">
                  إضافة عقار
                </a>
                <!-- إدارة عقاراتي -->
                <a href="{{ route('allProperties', [auth('web')->user()->id, 'q' => 'properties']) }}"
                   class="nav-link @if(request()->routeIs('allProperties') && request('q') === 'properties') active @endif">
                    إدارة عقاراتي
                </a>
                
                <a href="{{ route('allProperties', [auth('web')->user()->id, 'q' => 'requests']) }}"
                   class="nav-link @if(request()->routeIs('allProperties') && request('q') === 'requests') active @endif">
                    طلباتي
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