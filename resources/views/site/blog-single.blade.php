@extends('site.index')
@section('title',$blog->name)
@section('content')
@include('site.includes.breadcrumb-section',['title' =>$blog->name  ])
<section class="blogs py-5">
      <div class="container-fluid">
        <div class="row gy-3">
          <div class="col-md-8 col-lg-9">
            <div class="card blog-details bg-transparent">
              <!-- blog img -->
              @php
                    $article_url = url()->current();
                @endphp

              <div class="blog-img">
                @if($blog->getFirstMediaUrl('blogs_image','thumb'))
                <img class="card-img-top" src="{{$blog->getFirstMediaUrl('blogs_image','thumb')}}" loading="lazy" alt="{{$blog->name}}" />
                @else
                <img class="card-img-top" src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->favicon)}}" loading="lazy" alt="{{$blog->name}}" />
                @endif
              </div>
              <div class="card-header d-flex flex-wrap align-items-center justify-content-between pt-4 py-3 bg-transparent">
                <h4 class="card-title main fw-bold">{{$blog->name}}</h4>
                <div class="share-blog d-flex gap-2 align-items-center justify-content-between">
                  <p>
                    مشاركة
                  </p>
                  <div class="share">
                    <ul class="social d-flex gap-2 m-0">
                      <li>
                        <a href="https://www.snapchat.com/scan?attachmentUrl={{ urlencode($article_url) }}" target="_blank" aria-label="مشاركة العقار عبر سناب شات">
                          <i class="fa-brands fa-snapchat"></i>
                        </a>
                      </li>
                      <li>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($article_url) }}" target="_blank" aria-label="مشاركة العقار عبر فيسبوك">
                          <i class="fa-brands fa-facebook-f"></i>
                        </a>
                      </li>
                      <li>
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->name) }}&url={{ urlencode($article_url) }}"" target="_blank" aria-label="مشاركة العقار عبر تويتر">
                          <i class="fa-brands fa-x-twitter"></i>
                        </a>
                      </li>

                    </ul>
                  </div>
                </div>
              </div>
              <!-- blog info -->
              <div class="card-body px-0">
                {{--<span class="secondry fw-bold">{{$blog->created_at->format('d-m-Y')}}</span>
                <div class="d-flex justify-content-between align-items-center">
                  <h1 class="blog-name card-title fw-semibold fs-4 my-2">
                    {{$blog->name}}
                  </h1>
                </div>--}}
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
            <div class="row g-3 row-cols-1">
                @foreach($related_blogs as $related_blog)
                <div class="col">
                    @include('site.includes.blog-section',['blog' => $related_blog])
                </div>
                @endforeach
            </div>
            @endif
          </div>
        </div>
      </div>
    </section>
@endsection