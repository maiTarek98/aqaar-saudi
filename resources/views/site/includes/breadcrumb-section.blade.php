@php $segments = Request::segments(); @endphp
<!-- ==== end breadcrumb ==== -->
<section class="heroSec position-relative breadcrumb-wrapper">
    <div class="overlay"></div>
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-center breadcrumb">
          <a href="{{route('home')}}" class="fs-6 text-white">  @lang('site.home')</a>
          <i class="fa-solid fa-angles-left mx-2 text-white"></i>
          @if (count($segments) > 1)
          <a href="{{route($segments[0])}}" class="fs-6 text-white">@lang('site.'.$segments[0])</a>
          <i class="fa-solid fa-angles-left mx-2"></i>
          <h2 class="fw-semibold text-white fs-5 mb-0">{{$title}}</h2>
          @else
          <h2 class="fw-semibold text-white fs-5 mb-0">{{$title}}</h2>
          @endif
        </div>
    </div>
</section>