@php
    $segments = Request::segments();
    $routeName = $segments[0] ?? null;
    $title = $title ?? '';
@endphp

<!-- ==== start breadcrumb ==== -->
<section class="heroSec position-relative breadcrumb-wrapper">
    <div class="overlay"></div>
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-center breadcrumb">
            <a href="{{ route('home') }}" class="fs-6 text-white">@lang('site.home')</a>
            @if (count($segments) > 1)
                <i class="fa-solid fa-angles-left mx-2 text-white"></i>

                @php
                    $canLinkToRoute = Route::has($routeName) && count(Route::getRoutes()->getByName($routeName)?->parameterNames() ?? []) === 0;
                @endphp

                @if ($canLinkToRoute)
                    <a href="{{ route($routeName) }}" class="fs-6 text-white">@lang('site.' . $routeName)</a>
                @else
                    <span class="fs-6 text-white">@lang('site.' . $routeName)</span>
                @endif

                <i class="fa-solid fa-angles-left mx-2 text-white"></i>
                <h2 class="fw-semibold text-white fs-5 mb-0">{{ $title }}</h2>
            @else
                <i class="fa-solid fa-angles-left mx-2 text-white"></i>
                <h2 class="fw-semibold text-white fs-5 mb-0">{{ $title }}</h2>
            @endif
        </div>
    </div>
</section>
<!-- ==== end breadcrumb ==== -->
