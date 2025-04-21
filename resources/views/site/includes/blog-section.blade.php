<div class="col">
            <div class="card">
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
              <div class="card-body">
                <span class="blog-date">{{ $blog->created_at->locale('ar')->translatedFormat('j F Y') }}</span>
                <p class="blog-name cut-text card-title fw-semibold fs-6 my-2">
                  {{$blog->name}}
                </p>
                <p class="blog-description cut-text card-text text-muted">
                  {{$blog->description}}
                </p>
              </div>
            </div>
          </div>