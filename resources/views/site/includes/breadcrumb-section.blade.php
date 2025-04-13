@php $segments = Request::segments(); @endphp
<!-- ==== end breadcrumb ==== -->

<section class="">
  <div class="container-fluid">
    <div class="d-flex align-items-center breadcrumb">
      <a href="{{route('home')}}" class="fw-semibold fs-5"> @lang('site.home')</a>
      <i class="fa-solid fa-angles-left mx-2 text-white"></i>
      @if (count($segments) > 1)
      <h2 class="fw-semibold text-white fs-5 mb-0"><a href="{{route($segments[0])}}">@lang('site.'.$segments[0])</a></h2>
      <i class="fa-solid fa-angles-left mx-2 text-white"></i>
      <h2 class="fw-semibold text-white fs-5 mb-0">{{$title}}</h2>
      @else
      <h2 class="fw-semibold text-white fs-5 mb-0">{{$title}}</h2>
      @endif
    </div>
  </div>
</section>