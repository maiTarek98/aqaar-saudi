@include('site.layouts.header')

@if(\Request::route()->getName() != 'site.signin' && \Request::route()->getName() != 'login' && \Request::route()->getName() != 'register' && \Request::route()->getName() != 'site.otp' && \Request::route()->getName() != 'site.continue_registeration' && \Request::route()->getName() != 'site.forget' && \Request::route()->getName() != 'site.forget.otp' && \Request::route()->getName() != 'site.changePassword') 
	@include('site.layouts.navbar')
@endif
@yield('content')

@include('site.layouts.footer')