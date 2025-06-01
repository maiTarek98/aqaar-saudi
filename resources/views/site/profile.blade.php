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
            <img loading="lazy" 
            src="{{url('site')}}/images/menu.png"
            alt="menu icon"
          />
          </button>
        </div>

        <div class="row d-flex justify-content-between align-items-start">
        @include('site.includes.profile-menu')
        <!-- profile data col -->
          <div class="profile-data col col-md-7 col-lg-8">
            <div class="profile-wrapper">
              <form id="updateForm" action="{{route('edit-profile')}}" enctype="multipart/form-data" method="post">
                            @csrf
                <div class="d-flex align-items-center gap-3 mb-5 border-bottom pb-4">
                  <!-- profile-picture -->
                  <div class="profile-pic position-relative bg-light">
                    @if ($user->getFirstMediaUrl('photo_profile','thumb'))
                        <img loading="lazy" class="w-100" src="{{ $user->getFirstMediaUrl('photo_profile','thumb') }}" alt="{{$user->name}}" id="photo">
                    @else
                        <img loading="lazy" class="w-100" src="{{url('site/images/avatar.png')}}" alt="{{$user->name}}" id="photo">
                    @endif
                    <div class="profile-pic-icon">
                        <i class="bi bi-camera-fill"></i>
                    </div>
                    <input type="file" id="file" name="photo_profile" accept="image/*" />
                  </div>
                  <div>
                    <p class="fw-bold fs-5 mb-3">{{$user->name}}</p>
                    <p class="text-muted">{{$user->email}}</p>
                    <p class="text-muted">حساب مستخدم</p>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group mb-4">
                      <label for="InputUserName" class="mb-2">الاسم <span class="text-danger">*</span> </label>
                      <input class="form-control" id="name" name="name" value="{{old('name', $user->name)}}"  type="text">
                      <small class="text-danger" id="name_error"></small>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-4">
                      <label for="mobile">@lang('site.mobile')<span class="text-danger">*</span> </label>
                      <div class="input-group border mb-3">
                        <span class="input-group-text" id="phone_num">+966</span>
                        <input class="form-control" name="mobile" value="{{old('mobile', $user->mobile)}}" type="tel">
                      </div>
                      <small class="text-danger" id="mobile_name_error"></small>
                    </div>
                  </div>
                  {{--<div class="col-md-6">
                    <div class="form-group mb-4">
                      <label for=""  class="mb-2">نوع المستخدم</label>
                      <input class="form-control" readonly name="user_type" value="" type="tel">
                    </div>
                  </div>--}}
                  <div class="col-md-6">
                    <div class="form-group mb-4">
                      <label for="val_license"  class="mb-2">@lang('main.users.val_license')</label>
                      <input type="text" id="val_license" class="form-control" name="val_license" value="{{old('val_license', $user->val_license)}}" placeholder="@lang('main.users.val_license')" >
                      <small class="text-danger" id="val_license_name_error"></small>
                    </div>
                  </div>
                  @if($user->agency_number)
                  <div class="col-md-6">
                    <div class="form-group mb-4">
                      <label for=""  class="mb-2">رقم الوكالة</label>
                      <input type="text" class="form-control" name="agency_number" value="{{old('agency_number', $user->agency_number)}}" placeholder="الاسم" >
                      <small class="text-danger" id="agency_number_name_error"></small>
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