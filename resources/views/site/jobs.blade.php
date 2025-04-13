@extends('site.index')
@section('title', trans('site.jobs') )
@section('content')
@include('site.includes.breadcrumb-section',['title' =>trans('site.jobs')  ])
<section class="mb-5 pb-md-4">
      <div class="container-fluid">
        <div class="jobs">
            <!-- <a href="job_details.html" class="link"></a> -->
          @forelse($jobs as $job)
          <div class="job_item">
            <div class="row justify-content-between align-items-center">
              <div class="col-lg-9 col-md-8">
                <p class="jobTitle mb-2 mb-md-3">{{$job->job_title}}</p>
                <div class="d-flex flex-column flex-md-row gap-1 gap-md-3 gap-lg-5 align-items-md-center">
                  <div class="job_info">
                    <i class="bi bi-geo-alt-fill"></i>
                    <p>{{$job->location}}</p>
                  </div>
                  <div class="job_info">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="16"
                      height="16"
                      fill="currentColor"
                      class="bi bi-buildings-fill"
                      viewBox="0 0 16 16"
                    >
                      <path
                        d="M15 .5a.5.5 0 0 0-.724-.447l-8 4A.5.5 0 0 0 6 4.5v3.14L.342 9.526A.5.5 0 0 0 0 10v5.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14h1v1.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5zM2 11h1v1H2zm2 0h1v1H4zm-1 2v1H2v-1zm1 0h1v1H4zm9-10v1h-1V3zM8 5h1v1H8zm1 2v1H8V7zM8 9h1v1H8zm2 0h1v1h-1zm-1 2v1H8v-1zm1 0h1v1h-1zm3-2v1h-1V9zm-1 2h1v1h-1zm-2-4h1v1h-1zm3 0v1h-1V7zm-2-2v1h-1V5zm1 0h1v1h-1z"
                      />
                    </svg>
                    <p>{{__('main.'.$job->job_type)}}</p>
                  </div>
                  <div class="job_info">
                    <i class="bi bi-briefcase-fill"></i>
                    <p>{{$job->job_experience}}</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-auto text-center">
                <a href="{{route('jobs.single',['q'=>$job->id])}}" class="main-btn mt-2 mt-md-0" >@lang('site.hire')</a>
              </div>
            </div>
          </div>
          @empty
              <h3>@lang('main.NoData')</h3>
          @endforelse
        </div>
        {{$jobs->appends($_GET)->links('vendor.pagination.custom')}}
      </div>
    </section>
@endsection