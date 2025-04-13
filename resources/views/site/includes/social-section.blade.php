@if(app(App\Models\SocialSettings::class)->ios_link)
          <a href="{{app(App\Models\SocialSettings::class)->ios_link}}" class="main-btn" aria-label="حمل تطبيق لامورا من خلال ابل ستور">
            <img loading="lazy" src="{{url('site')}}/images/apple.svg" alt="apple icon">
            <div>
              <span>@lang('site.download now')</span>
              <h5>Apple store</h5>
            </div>
          </a>
          @endif
          @if(app(App\Models\SocialSettings::class)->android_link)
          <a href="{{app(App\Models\SocialSettings::class)->android_link}}" class="main main-outline-btn" aria-label="حمل تطبيق لامورا من خلال جوجل بلاي">
            <i class="fa-brands fa-google-play fs-3 me-2"></i>
            <div>
              <span class="main">@lang('site.download now')</span>
              <h5 class="main">Google play</h5>
            </div>
          </a>
          @endif