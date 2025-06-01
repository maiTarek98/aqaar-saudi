     <!-- about us -->
    <section id="about_sec" class="about-us py-5">
      <div class="container-fluid">
        <div class="row align-items-center gy-3 gx-md-5 mb-4">
          <div class="col-lg-6">
            <div class="section-title">
              @if(app(App\Models\LandingSettings::class)->about_title_one())
              <h2 class="secTitle fw-bold secondary fs-4">{{app(App\Models\LandingSettings::class)->about_title_one()}}</h2>
              @endif
            </div>
            <div class="about-txt d-flex flex-column gap-3 my-4">
              @if(app(App\Models\LandingSettings::class)->about_text_one())
              <p>{{app(App\Models\LandingSettings::class)->about_text_one()}}</p>
              @endif
            </div>
          </div>
          <div class="col-lg-6">
            @if(app(App\Models\LandingSettings::class)->about_image_one)
            <img loading="lazy" src="{{url('storage/'.app(App\Models\LandingSettings::class)->about_image_one)}}" class="w-100" alt="{{app(App\Models\LandingSettings::class)->about_title_one()}}">
            @endif
          </div>
        </div>
        <div class="row align-items-center gy-3 gx-md-5">
          <div class="col-lg-6">
            @if(app(App\Models\LandingSettings::class)->about_image_two)
            <img loading="lazy" src="{{url('storage/'.app(App\Models\LandingSettings::class)->about_image_two)}}" class="w-100" alt="{{app(App\Models\LandingSettings::class)->about_title_two()}}">
            @endif
          </div>
          <div class="col-lg-6">
            <div class="section-title">
              @if(app(App\Models\LandingSettings::class)->about_title_two())
              <h2 class="secTitle fw-bold secondary fs-4">{{app(App\Models\LandingSettings::class)->about_title_two()}}</h2>
              @endif
            </div>
            <div class="about-txt d-flex flex-column gap-3 my-4">
              @if(app(App\Models\LandingSettings::class)->about_text_two())
              <p>{{app(App\Models\LandingSettings::class)->about_text_two()}}</p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- features section -->
    <div class="features py-5">
      <div class="container-fluid">
        <div class="row gy-3">
          <div class="col-lg-4">
            <div class="feature">
              <div class="feature-icon">
@if(app(App\Models\LandingSettings::class)->feature_image_one)
            <img loading="lazy" src="{{url('storage/'.app(App\Models\LandingSettings::class)->feature_image_one)}}" 
            alt="{{app(App\Models\LandingSettings::class)->feature_title_one()}}">
            @endif              </div>
              <div class="feature-content">
                <h3 class="fs-6 fw-bold main my-3">{{app(App\Models\LandingSettings::class)->feature_title_one()}}</h3>
                <p>
                {!! app(App\Models\LandingSettings::class)->feature_text_one() !!}                  </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="feature">
              <div class="feature-icon">
@if(app(App\Models\LandingSettings::class)->feature_image_two)
            <img loading="lazy" src="{{url('storage/'.app(App\Models\LandingSettings::class)->feature_image_two)}}" 
            alt="{{app(App\Models\LandingSettings::class)->feature_title_two()}}">
            @endif               </div>
              <div class="feature-content">
                <h3 class="fs-6 fw-bold main my-3">{{app(App\Models\LandingSettings::class)->feature_title_two()}}</h3>
                <p>
                {!! app(App\Models\LandingSettings::class)->feature_text_two() !!}                  </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="feature">
              <div class="feature-icon">
@if(app(App\Models\LandingSettings::class)->feature_image_three)
            <img loading="lazy" src="{{url('storage/'.app(App\Models\LandingSettings::class)->feature_image_three)}}" 
            alt="{{app(App\Models\LandingSettings::class)->feature_title_three()}}">
            @endif               </div>
              <div class="feature-content">
                <h3 class="fs-6 fw-bold main my-3">{{app(App\Models\LandingSettings::class)->feature_title_three()}}</h3>
                <p>
                {!! app(App\Models\LandingSettings::class)->feature_text_three() !!}                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
