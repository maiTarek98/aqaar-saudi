@extends('site.index')
@section('title', trans('site.blogs') )
@section('content')
<section class="blogs py-5">
        <div class="container-fluid">
          <div class="section-title mb-4">
            <h2 class="secTitle fw-bold secondry text-center fs-2">@lang('site.blogs')</h2>
          </div>
          <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1">
            @forelse($blogs as $blog)
            <div class="col">
                @include('site.includes.blog-section',['blog' => $blog])
            </div>
            @empty
              <h3>@lang('main.NoData')</h3>
            @endforelse
          </div>
          {{$blogs->appends($_GET)->links('vendor.pagination.custom')}}
        </div>
      </section>
@endsection 