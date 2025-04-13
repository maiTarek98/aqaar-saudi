@extends('site.index')
@section('title', trans('site.login') )
@section('content')
 <main class="login_register py-5 p-md-5">
        <div class="container-fluid">
            <a class="navbar-brand m-0" href="{{route('home')}}">
                <img loading="lazy" src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->favicon)}}" alt="{{app(App\Models\GeneralSettings::class)->site_name}}" />
            </a>
            <div class="row gy-4 justify-content-between align-items-end">
                <div class="col-md-4">
                    <a href="{{route('login')}}" class="d-block main-btn">@lang('site.login')</a>
                    <a href="{{route('register')}}" class="d-block main-outline-btn">@lang('site.register')</a>
                </div>
                <div class="col-md-7">
                    <img loading="lazy" src="{{url('site')}}/images/svg_car.svg" alt="svg_car for login page">
                </div>
            </div>
        </div>
    </main>
@endsection