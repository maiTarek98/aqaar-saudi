<!-- Navbar -->
<div class="container-fluid">
    
    <nav class="main-header navbar navbar-expand navbar-white navbar-light justify-content-between">
        <!-- Left navbar links -->
        <ul class="navbar-nav align-items-center gap-3">
            <!--<button id="allowNotificationsButton">Allow Notifications</button>-->
    
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <!--<li class="nav-item d-none d-sm-inline-block">-->
            <!--    <a href="{{ url('/admin/adminLogout') }}" class="nav-link">-->
            <!--        <i class="bi bi-door-open-fill"></i>-->
            <!--    @lang('main.logout')</a>-->
            <!--</li>-->
        
            
            <li>
                <a href="{{url('/')}}" class="card-i" targer="_blank">
                    <i class="bi bi-display"></i>
                    @lang('main.goto site')
                </a>
            </li>
          <!--   <li class="nav-item d-none d-sm-inline-block">
                @php $currentTime = \Carbon\Carbon::now()->format('g:i a'); 
                     $todayDate = \Carbon\Carbon::now()->format('Y-m-d');@endphp
                <span>{{$todayDate}} / {{$currentTime}}</span>
            </li> -->
            <!-- <li class="nav-item d-none d-sm-inline-block">
                <select onchange="changeLanguage(this.value)" class="form-control">
                    <option {{ session()->has('lang_code') ? (session()->get('lang_code') == 'ar' ? 'selected' : '') : '' }}
                        value="ar">Arabic</option>
                    <option {{ session()->has('lang_code') ? (session()->get('lang_code') == 'en' ? 'selected' : '') : '' }}
                        value="en">English</option>
                </select>
            </li> -->
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav align-items-center">
              <li class="nav-item d-none d-sm-inline-block px-2">
                @php $currentTime = \Carbon\Carbon::now()->format('g:i a'); 
                     $todayDate = \Carbon\Carbon::now()->format('Y-m-d');@endphp
                <span class="px-2"> <i class="bi bi-calendar4-event"></i> <span id="current-date">{{$todayDate}}</span> </span>
                <span class="px-2"> <i class="bi bi-clock"></i> <span id="current-time">{{$currentTime}}</span></span>
            </li>
            <li class="nav-item d-none d-sm-flex align-items-center px-2">
                <!--<select onchange="changeLanguage(this.value)" class="form-control">-->
                <!--    <option {{ session()->has('lang_code') ? (session()->get('lang_code') == 'ar' ? 'selected' : '') : '' }}-->
                <!--        value="ar">Arabic</option>-->
                <!--    <option {{ session()->has('lang_code') ? (session()->get('lang_code') == 'en' ? 'selected' : '') : '' }}-->
                <!--        value="en">English</option>-->
                <!--</select>-->
                <i class="bi bi-translate"></i>
                @if(App::getLocale() == 'ar')
                <a href="{{url('/change-language/en')}}" class="nav-link" id="lang">
                        EN
                </a>
                  @endif
                  @if(App::getLocale() == 'en')
                      <a href="{{url('/change-language/ar')}}" class="nav-link" id="lang">
                          العربية
                      </a>
                  @endif
            </li>
            <!-- Messages Dropdown Menu -->
            <!--  <li class="nav-item dropdown">
            <a class="nav-link" data-bs-toggle="dropdown" href="#">
              <i class="far fa-comments"></i>
              <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <a href="#" class="dropdown-item">
                <div class="media">
                  <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 me-3 img-circle">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      Brad Diesel
                      <span class="float-start text-sm text-danger"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">Call me whenever you can...</p>
                    <p class="text-sm text-muted"><i class="far fa-clock me-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <div class="media">
                  <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle me-3">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      John Pierce
                      <span class="float-start text-sm text-muted"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">I got your message bro</p>
                    <p class="text-sm text-muted"><i class="far fa-clock me-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <div class="media">
                  <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle me-3">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      Nora Silvester
                      <span class="float-start text-sm text-warning"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">The subject goes here</p>
                    <p class="text-sm text-muted"><i class="far fa-clock me-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
          </li> -->
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item   @if(Auth::guard('admin')->user()->unreadNotifications->count() > 0) dropdown @endif">
                <a class="nav-link"    @if(Auth::guard('admin')->user()->unreadNotifications->count() > 0)  data-bs-toggle="dropdown" @endif 
                @if(Auth::guard('admin')->user()->unreadNotifications->count() > 0)
                href="#" @else href="{{ url('/admin/notifications') }}"
                @endif>
                    <i class="far fa-bell fa-lg"></i>
                    <span
                        class="badge badge-warning navbar-badge">{{ Auth::guard('admin')->user()->unreadNotifications->count() }}</span>
                </a>
                <div class="dropdown-menu p-0 dropdown-menu-right">
                    <div class="card m-0">
                        <div class="card-header">
                            <span>
                                {{-- Auth::guard('admin')->user()->unreadNotifications->count() --}}
                                @lang('main.Notifications')
                            </span>
                        </div>
                        <div class="card-body">
                            @foreach (Auth::guard('admin')->user()->unreadNotifications()->orderBy('created_at', 'desc')->take(20)->get() as $note)
                                <a href="{{url('/admin/notifications')}}#{{$note->id}}" class="news">
                                  <div class="circle"></div>
                                  <div class="text-con">
                                    <div class="time">
                                        @php
                                            $now = \Carbon\Carbon::now();
                                            $created = $note->created_at;
                                            $x = $created->diffForHumans($now);
                                            echo $x;
                                        @endphp
                                    </div>
                                    <div class="description">
                                      {{ $note->data['title'] }}
                                    </div>
                                  </div>
                                </a>
                                {{--<a href="{{url('/admin/notifications')}}#{{$note->id}}"
                                        class="dropdown-item">
                                    <i class="fas fa-envelope me-2"></i>{{ $note->data['title'] }}
                                    <span class="float-start text-muted text-sm"> @php
                                            $now = \Carbon\Carbon::now();
                                            $created = $note->created_at;
                                            $x = $created->diffForHumans($now);
                                            echo $x;
                                    @endphp</span>
                                </a>--}}
                            @endforeach
                        </div>
                        <div class="card-footer bg-white border-0 z-1">
                            <a href="{{ url('/admin/notifications') }}" class="btn btn-primary w-100" >@lang('main.See All Notifications')</a>
                        </div>
                    </div>
                </div>
            </li>
    
        </ul>
    </nav>
</div>
<!-- /.navbar -->
