@extends('site.index')
@section('title', trans('site.profile') )
@section('content')
      @include('site.includes.breadcrumb-section',['title' => trans('site.profile')])
<!--  -->
    <div class="container-fluid mb-5 pb-md-4">
        <!-- profile -->
        <section class="profile mb-5">
            <div class="container-lg">
                <div class="row">
                    @include('site.includes.profile-menu')
                    <main class="col col-md-8 col-lg-9">
                        <!-- action : open profile nav @ sm media -->
                        <button id="profile_nav" class="d-md-none">
                            <h6>@lang('site.profile')</h6>
                            <i class="bi bi-sliders fs-5"></i>
                        </button>
                        <!-- end -->
                        <div class="profile-data">
                            <form id="updateForm" action="{{route('edit-profile')}}" enctype="multipart/form-data" method="post">
                            @csrf
                                <div class="row gy-4 mb-4">
                                    <!-- الاسم -->
                                    <div class="col-12">
                                        <label for="name">@lang('site.name')</label>
                                        <input class="form-control" id="name" name="name" value="{{old('name', $user->name)}}"  type="text">
                                        <small class="text-danger" id="name_error"></small>

                                    </div>
                                    <!-- البريد الالكتروني -->
                                    <div class="col-12">
                                        <label for="email">@lang('site.email')</label>
                                        <input class="form-control" id="email" name="email" value="{{old('email', $user->email)}}" type="email">
                                        <small class="text-danger" id="email_error"></small>
                                    </div>
                                    <!-- المدينة -->
                                    <div class="col-12">
                                        <label for="city">@lang('site.city')</label>
                                        <select id="city" class="form-control" name="city_id" placeholder="@lang('site.city here')">
                                            @foreach(\App\Models\City::where('city_status','enable')->get() as $city)
                                            <option value="{{$city->id}}" @if($user->city_id == $city->id) selected @endif>{{$city->city_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- رقم الجوال -->
                                    <div class="col-12">
                                        <label for="mobile">@lang('site.mobile')</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="phone_num">+966</span>
                                            <input class="form-control" name="mobile" value="{{old('mobile', $user->mobile)}}" type="tel">
                                        </div>
                                        <small class="text-danger" id="mobile_name_error"></small>
                                    </div>
                                </div>
                                <button type="submit" role="button" class="main-btn d-block w-auto ms-auto px-5 mt-3">
                                    <div class="text px-4">@lang('site.save')</div>
                                </button>
                            </form>
                        </div>
                    </main>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('custom-js')

@endpush