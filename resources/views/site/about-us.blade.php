@extends('site.index')
@section('title', trans('site.aboutus') )
@section('content')
@include('site.includes.breadcrumb-section',['title' =>trans('site.aboutus')  ])
    @include('site.includes.about-section')
    <!--  section -->
    @if(app(App\Models\LandingSettings::class)->beneficiaries_title())
    <section class="py-5">
      <div class="container-fluid">
        <div class="section-title text-center pb-4">
          <h2 class="secDesc fw-bold secondary fs-4">
            الجهات المستفيدة 
          </h2>
          <p class="col-md-6 m-auto my-3">
            {{app(App\Models\LandingSettings::class)->beneficiaries_title()}}
              </p>
        </div>
        <div class="beneficiaries">
        {!! app(App\Models\LandingSettings::class)->beneficiaries_text() !!}
        </div>
      </div>
    </section>
    @endif
@endsection