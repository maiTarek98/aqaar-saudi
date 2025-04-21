@extends('site.index')
@section('title', trans('site.blogs') )
@section('content')
@include('site.includes.breadcrumb-section',['title' =>trans('site.blogs')  ])
<!-- blogs section -->
    <section class="blogs py-5">
      <div class="container-fluid">
        <div class="row g-3 row-cols-lg-3 row-cols-md-2 row-cols-1">
            @forelse($blogs as $blog)
              @include('site.includes.blog-section',['blog' => $blog])
            @empty
              <h3>@lang('main.NoData')</h3>
            @endforelse
          </div>
          {{$blogs->appends($_GET)->links('vendor.pagination.custom')}}
        </div>
      </div>
    </section>

@endsection 