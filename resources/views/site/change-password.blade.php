@extends('site.index')
@section('title', trans('site.change-password') )
@section('content')
@include('site.includes.breadcrumb-section',['title' => trans('site.change-password')])
    <!-- profile -->
    <div class="container-fluid mb-5 pb-md-4">
        <!-- profile -->
        <section class="profile mb-5">
            <div class="container-lg">
                <div class="row">
                 @include('site.includes.profile-menu')
                 <main class="col col-md-8 col-lg-9">
                        <!-- action : open profile nav @ sm media -->
                        <button id="profile_nav" class="d-md-none">
                            <h6>@lang('site.change-password')</h6>
                            <i class="bi bi-sliders fs-5"></i>
                        </button>
                        <!-- end -->
                        <div class="profile-data">
                            <form method="post" id="updatePassword" action="{{route('update-password-profile')}}">@csrf
                                <div class="row gy-4 mb-4">
                                    <!-- كلمة المرور الحالية -->
                                    <div class="col-12">
                                        <label for="">@lang('site.current password')</label>
                                        <div class="input-group mb-2">
                                            <input type="password" name="current_password" class="form-control">
                                            <button type="button" class="input-group-text edit"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapseExample" 
                                            aria-expanded="false" 
                                            aria-controls="collapseExample">
                                                @lang('site.edit')
                                            </button>
                                        </div>
                                        <span class="text-danger" id="current_password_error"></span>
                                        <a href="{{route('site.forget')}}" class="forgot">@lang('site.forget password')</a>
                                    </div>
                                    <div class="co-12 collapse" id="collapseExample">
                                        <!-- كلمة المرور الجديدة -->
                                        <div class="col-12 mb-4">
                                            <label for="">  @lang('site.new password')</label>
                                            <div class="input-group">
                                                <input type="password" name="password" class="form-control" fdprocessedid="glquu">
                                                <button type="button" class="input-group-text" >
                                                    <i class="pass bi bi-eye-slash"></i>
                                                </button>
                                            </div>
                                            <span class="text-danger" id="password_error"></span>
                                        </div>
                                        <!-- تأكيد كلمة المرور الجديدة -->
                                        <div class="col-12">
                                            <label for="">@lang('site.password confirmation')</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" name="password_confirmation" fdprocessedid="glquu">
                                                <button type="button" class="input-group-text" >
                                                    <i class="pass bi bi-eye-slash"></i>
                                                </button>
                                            </div>
                                            <span class="text-danger" id="password_confirmation_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" role="button" class="main-btn d-block w-auto ms-auto px-5 mt-3">
                                    <div class="text px-4">@lang('site.save')</div>
                                </button>
                            </form>
                        </div>
                    </main>
@endsection