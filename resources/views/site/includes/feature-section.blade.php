<div class="row align-items-center gy-3 gx-md-5">
    <div class="col-lg-6">
      <div class="section-title">
        @if(app(App\Models\LandingSettings::class)->feature_title())
        <h2 class="secTitle fw-bold secondry fs-2">{{app(App\Models\LandingSettings::class)->feature_title()}}</h2>
        @endif
      </div>
      @if(app(App\Models\LandingSettings::class)->feature_text())
        {!! app(App\Models\LandingSettings::class)->feature_text() !!}
      @endif
    </div>
    <div class="col-md-9 col-lg-6">
      @if(app(App\Models\LandingSettings::class)->feature_image)
      <img loading="lazy" src="{{url('storage/'.app(App\Models\LandingSettings::class)->feature_image)}}" class="w-100" alt="{{app(App\Models\LandingSettings::class)->feature_title()}}">
      @endif
    </div>
</div>