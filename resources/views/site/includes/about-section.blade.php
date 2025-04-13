<div class="row align-items-center gy-3 gx-md-5">
      <div class="col-md-9 col-lg-6">
        @if(app(App\Models\LandingSettings::class)->about_image)
        <img loading="lazy" src="{{url('storage/'.app(App\Models\LandingSettings::class)->about_image)}}" class="w-100" alt="{{app(App\Models\LandingSettings::class)->about_title()}}">
        @endif
      </div>
      <div class="col-lg-6">
        <div class="section-title">
          @if(app(App\Models\LandingSettings::class)->about_title())
          <h2 class="secTitle fw-bold secondry fs-2">{{app(App\Models\LandingSettings::class)->about_title()}}</h2>
          @endif
        </div>
        @if(app(App\Models\LandingSettings::class)->about_text())
        <p class="about-txt my-4 fw-medium @if(\Request::route()->getName() == 'home') cut-text @endif">
          {{app(App\Models\LandingSettings::class)->about_text()}}
        </p>
        @endif
        <div class="apps-btns d-flex align-items-center gap-1">
          @include('site.includes.social-section')
        </div>
      </div>
    </div>