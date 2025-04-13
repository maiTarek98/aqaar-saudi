 <div class="card">
  <!-- blog link -->
  <a href="{{route('site.blogs.show',['q' =>($blog->blog_seo?->page_url)? $blog->blog_seo?->page_url:slug($blog->name_en) ])}}" aria-label="الانتقال الى مقال {{$blog->name}}" class="link"></a>
  <!-- blog img -->
  <div class="blog-img">
    @if($blog->getFirstMediaUrl('blogs_image','thumb'))
    <img src="{{$blog->getFirstMediaUrl('blogs_image','thumb')}}" loading="lazy" class="card-img-top" alt="{{$blog->name}}" />
    @else
    <img src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->logo)}}" loading="lazy" class="card-img-top" alt="{{$blog->name}}" />
    @endif
  </div>
  <!-- blog info -->
  <div class="card-body px-0">
    <span class="secondry fw-bold">{{$blog->created_at->format('d-m-Y')}}</span>
    <div class="d-flex justify-content-between align-items-center">
      <p class="blog-name cut-text card-title fw-semibold fs-4">
        {{$blog->name}}
      </p>
    </div>
    <p class="blog-description cut-text card-text text-muted">
     {{$blog->description}} </p>
     <a href="{{route('site.blogs.show',['q' =>($blog->blog_seo?->page_url)? $blog->blog_seo?->page_url:slug($blog->name_en) ])}}" aria-label="الانتقال الى مقال {{$blog->name}}" class="more main fs-5">@lang('site.more')</a>
   </div>
 </div>