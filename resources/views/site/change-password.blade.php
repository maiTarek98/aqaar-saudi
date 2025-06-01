@extends('site.index')
@section('title', trans('site.change-password') )
@section('content')
@include('site.includes.breadcrumb-section',['title' => trans('site.change-password')])
    <section class="profile py-5">
      <div class="container-fluid">
        <!-- profile nav-sm -->
        <div class="profile-nav-sm rounded-3">
          <p class="m-0">الملف الشخصي</p>
          <button class="btn toggle-profile-nav p-0 border-0 bg-transparent" data-toggle=".profile-nav">
            <img loading="lazy" 
            src="{{url('site')}}/images/menu.png"
            alt="menu icon"
          />
          </button>
        </div>

        <div class="row d-flex justify-content-between align-items-start">
                @include('site.includes.profile-menu')
                <div class="profile-data col col-md-7 col-lg-8">
                    @if (session('success'))
                      <div class="alert alert-success">
                        {{ session('success') }}
                      </div>
                    @endif
                    
                    @if (session('error'))
                      <div class="alert alert-danger">
                        {{ session('error') }}
                      </div>
                    @endif

                    <div class="profile-wrapper">
                        <form method="post" id="updatePassword" action="{{route('update-password-profile')}}">
                        @csrf
                        @if ($errors->any())
                          <div class="alert alert-danger">
                            <ul class="mb-0">
                              @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                              @endforeach
                            </ul>
                          </div>
                        @endif
                        @php $user=auth('web')->user(); @endphp
                        <div class="d-flex align-items-center gap-3 mb-5 border-bottom pb-4">
                          <!-- profile-picture -->
                          <div class="profile-pic position-relative bg-light">
                            @if($user->photo_profile)
                                <img loading="lazy" class="w-100" src="{{$user->photo_profile}}" alt="{{$user->name}}" id="photo">
                            @else
                                <img loading="lazy" class="w-100" src="{{url('site/images/avatar.png')}}" alt="{{$user->name}}" id="photo">
                            @endif
                          </div>
                          <div>
                            <p class="fw-bold fs-5 mb-3">{{$user->name}}</p>
                            <p class="text-muted">{{$user->email}}</p>
                            <p class="text-muted">حساب مستخدم</p>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group mb-4">
                              <label for="current_password"> كلمة المرور الحالية</label>
                              <div class="input-group border mb-3">
                                <input type="password" name="current_password" class="form-control" id="current_password" placeholder="" required="">
                                <button type="button" class="input-group-text fs-4 pass" title="show pass" aria-label="اظهار كلمة المرور">
                                  <i class="bi bi-lock"></i>
                                </button>
                              </div>
                              <span class="text-danger" id="current_password_error"></span>  
                              {{--<a href="{{route('site.forget')}}" class="text-decoration-underline" aria-label="هل نسيت كلمة المرور؟ الذهاب لاعادة التعيين">
                                هل نسيت كلمة المرور؟
                              </a>--}}
                            </div>
                          </div>
        
                          <div class="col-md-6">
                            <div class="form-group mb-4">
                              <label for="password">كلمة المرور الجديدة</label>
                              <div class="input-group border mb-3">
                                <input type="password" name="password" class="form-control" id="password" placeholder="" required="">
                                <button type="button" class="input-group-text fs-4 pass" title="show pass" aria-label="اظهار كلمة المرور">
                                  <i class="bi bi-lock"></i>
                                </button>
                              </div>
                            </div>
                            <span class="text-danger" id="password_error"></span>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group mb-4">
                              <label for="password_confirmation">تأكيد كلمة المرور الجديدة</label>
                              <div class="input-group border mb-3">
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="" required="">
                                <button type="button" class="input-group-text fs-4 pass" title="show pass" aria-label="اظهار كلمة المرور">
                                  <i class="bi bi-lock"></i>
                                </button>
                              </div>
                            </div>
                            <span class="text-danger" id="password_confirmation_error"></span>
                          </div>
                        </div>
                        <!-- ارسال -->
                        <button
                          type="submit"
                          class="btn main-outline-btn px-5 py-2 mb-3"
                          aria-label="تحديث المعلومات الشخصية"
                        >
                        حفظ التعديلات
                        </button>
                      </form>
                    </div>
                </div>
        </div>  
     </div> 
    </section> 
@endsection