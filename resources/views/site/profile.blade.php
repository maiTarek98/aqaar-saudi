@extends('site.index')
@section('title', trans('site.profile') )
@section('content')
      @include('site.includes.breadcrumb-section',['title' => trans('site.profile')])
    <section class="profile py-5">
      <div class="container-fluid">
        <!-- profile nav-sm -->
        <div class="profile-nav-sm rounded-3">
          <p class="m-0">الملف الشخصي</p>
          <button class="btn toggle-profile-nav p-0 border-0 bg-transparent" data-toggle=".profile-nav">
            <img
            src="images/menu.png"
            alt="menu icon"
          />
          </button>
        </div>

        <div class="row d-flex justify-content-between align-items-start">
        @include('site.includes.profile-menu')
        <!-- profile data col -->
          <div class="profile-data col col-md-7 col-lg-9">
            <div class="profile-wrapper">
              <form id="updateForm" action="{{route('edit-profile')}}" enctype="multipart/form-data" method="post">
                            @csrf
                <div class="d-flex align-items-center gap-3 mb-5 border-bottom pb-4">
                  <!-- profile-picture -->
                  <div class="profile-pic position-relative bg-light">
                    @if($user->photo_profile)
                        <img loading="lazy" class="w-100" src="{{$user->photo_profile}}" alt="{{$user->name}}" id="photo">
                    @else
                        <img loading="lazy" class="w-100" src="{{url('site/images/profile_user_avatar_icon.webp')}}" alt="{{$user->name}}" id="photo">
                    @endif
                    <div class="profile-pic-icon">
                        <i class="bi bi-camera-fill"></i>
                    </div>
                    <input type="file" id="file" name="photo_profile" accept="image/*" />
                  </div>
                  <div>
                    <p class="fw-bold fs-5 mb-3">{{$user->name}}</p>
                    <p class="text-muted">{{$user->email}}</p>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group mb-4">
                      <label for="InputUserName" class="mb-2">الاسم </label>
                      <input class="form-control" id="name" name="name" value="{{old('name', $user->name)}}"  type="text">
                      <small class="text-danger" id="name_error"></small>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="mobile">@lang('site.mobile')</label>
                        <div class="input-group">
                            <span class="input-group-text" id="phone_num">+966</span>
                            <input class="form-control" name="mobile" value="{{old('mobile', $user->mobile)}}" type="tel">
                        </div>
                        <small class="text-danger" id="mobile_name_error"></small>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-4">
                      <label for=""  class="mb-2">نوع المستخدم</label>
                      <input class="form-control" readonly name="user_type" value="{{$user->user_type}}" type="tel">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-4">
                      <label for=""  class="mb-2">رقم الهوية</label>
                      <input type="text" class="form-control" name="id_number" value="{{old('id_number', $user->id_number)}}" placeholder="الاسم" >
                      <small class="text-danger" id="id_number_name_error"></small>
                    </div>
                  </div>
                  @if($user->agent_number)
                  <div class="col-md-6">
                    <div class="form-group mb-4">
                      <label for=""  class="mb-2">رقم الهوية</label>
                      <input type="text" class="form-control" name="agent_number" value="{{old('agent_number', $user->agent_number)}}" placeholder="الاسم" >
                      <small class="text-danger" id="agent_number_name_error"></small>
                    </div>
                  </div>
                  @endif
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
@push('custom-js')

@endpush