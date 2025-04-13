<aside class="col-md-4 col-lg-3">
                        <div class="profile-nav">
                            <div class="profile-header d-md-none">
                                <h5>@lang('site.profile')</h5>
                                <button class="btn-close"></button>
                            </div>
                            <!-- profile-picture -->
                            <form action="{{route('edit-photo')}}" method="post" enctype="multipart/form-data">
                              @csrf
                                <div class="profile-pic position-relative">
                                  @if($user->photo_profile)
                                    <img loading="lazy" class="w-100" src="{{$user->photo_profile}}" alt="{{$user->name}}" id="photo">
                                    @else
                                    <img loading="lazy" class="w-100" src="{{url('site/images/profile_user_avatar_icon.webp')}}" alt="{{$user->name}}" id="photo">
                                    @endif
                                    <div class="profile-pic-icon">
                                        <i class="bi bi-camera-fill"></i>
                                    </div>
                                    <input type="file" id="file" name="photo_profile" accept="image/*" />
                                    <button type="submit" class="save_img">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                </div>
                            </form>
                            <!-- user info -->
                            <div class="user_info">
                                <b>{{$user->name}}</b>
                                <p class="mt-2">{{$user->email}}</p>
                            </div>
                            <!-- profile navigation -->
                            <ul class="nav w-100 flex-column">
                                <li class="nav-item">
                                    <a aria-current="page" href="{{route('profile')}}" class="nav-link @if(\Request::route()->getName() == 'profile') active @endif">
                                      <i class="bi bi-person"></i>
                                      <span> @lang('site.profile') </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                  <a href="{{route('change-password')}}" class="nav-link @if(\Request::route()->getName() == 'change-password') active @endif">
                                    <i class="bi bi-lock"></i>
                                    <span>
                                        @lang('site.change-password')
                                    </span>
                                  </a>
                        
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('favorites')}}" class="nav-link @if(\Request::route()->getName() == 'favorites') active @endif">
                                      <i class="bi bi-heart"></i>
                                      <span>@lang('site.my-favorites') </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if(\Request::route()->getName() == 'my-cars') active @endif" href="{{route('usercars')}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-car-front" viewBox="0 0 16 16">
                                            <path
                                                d="M4 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0m10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM4.862 4.276 3.906 6.19a.51.51 0 0 0 .497.731c.91-.073 2.35-.17 3.597-.17s2.688.097 3.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 10.691 4H5.309a.5.5 0 0 0-.447.276" />
                                            <path
                                                d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM4.82 3a1.5 1.5 0 0 0-1.379.91l-.792 1.847a1.8 1.8 0 0 1-.853.904.8.8 0 0 0-.43.564L1.03 8.904a1.5 1.5 0 0 0-.03.294v.413c0 .796.62 1.448 1.408 1.484 1.555.07 3.786.155 5.592.155s4.037-.084 5.592-.155A1.48 1.48 0 0 0 15 9.611v-.413q0-.148-.03-.294l-.335-1.68a.8.8 0 0 0-.43-.563 1.8 1.8 0 0 1-.853-.904l-.792-1.848A1.5 1.5 0 0 0 11.18 3z" />
                                        </svg>
                                        <span> @lang('site.my cars') </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if(\Request::route()->getName() == 'my-ads') active @endif" href="{{route('ads')}}">
                                        <i class="bi bi-megaphone"></i>
                                        <span> @lang('site.my ads') </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <form method="post" action="{{route('ulogout')}}">
                                      @csrf
                                      <button class="logout nav-link">      
                                          <img loading="lazy" src="{{url('site')}}/images/power-button.svg" alt="logout icon" style="width: 16px" />
                                          <span>
                                              @lang('site.logout')
                                          </span> 
                                      </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </aside>