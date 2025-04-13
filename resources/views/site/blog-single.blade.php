@extends('site.index')
@section('title',$blog->name)
@section('content')
<section class="blogs py-5">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8 col-lg-9">
            <div class="card">
              <!-- blog img -->
              <div class="blog-img">
                @if($blog->getFirstMediaUrl('blogs_image','thumb'))
                <img class="card-img-top" src="{{$blog->getFirstMediaUrl('blogs_image','thumb')}}" loading="lazy" alt="{{$blog->name}}" />
                @else
                <img class="card-img-top" src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->favicon)}}" loading="lazy" alt="{{$blog->name}}" />
                @endif
              </div>
              <!-- blog info -->
              <div class="card-body px-0">
                <span class="secondry fw-bold">{{$blog->created_at->format('d-m-Y')}}</span>
                <div class="d-flex justify-content-between align-items-center">
                  <h1 class="blog-name card-title fw-semibold fs-4 my-2">
                    {{$blog->name}}
                  </h1>
                </div>
                <div
                  class="blog-description card-text d-flex flex-column gap-3 text-muted"
                >
                   {!! $blog->content !!}
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-lg-3">
            <p class="fw-bold fs-4 mb-3">@lang('site.common blogs')</p>
            @if($related_blogs->count() > 0)
                @foreach($related_blogs as $related_blog)
                    @include('site.includes.blog-section',['blog' => $related_blog])
                @endforeach
            @endif
          </div>
        </div>
      </div>
    </section>
@endsection