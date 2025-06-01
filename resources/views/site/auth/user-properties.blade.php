@extends('site.index')
@section('title', trans('site.user-card') )
@section('content')
      @include('site.includes.breadcrumb-section',['title' => trans('site.user-card')])
    <section class="profile py-5">
      <div class="container-fluid">
        <!-- profile data col -->
          <div class="profile-data">
            <div class="profile-wrapper p-0 bg-transparent">
              <div class="our-estates">
                <h2 class="fs-4 mb-3 main fs-bold">عقارات {{ $user->name }}</h2>
                <div class="row gy-3 row-cols-1">
                  @forelse($properties as $property)
                  <div class="col">
                    <div class="card user-properties rounded-4 d-lg-flex flex-lg-row align-items-center">
                      <!-- estate info -->
                        <div class="card-body m-0 py-2">
                            <a href="{{route('propertys.single',$property->listing_number)}}">
                                <div class="d-flex gap-2 align-items-center">
                                    <i class="bi bi-buildings"></i>
                                    <div>
                                        <p class="estate-name card-title fw-semibold">
                                        {{ $property->title }}
                                        </p>
                                        <small class="estate-type text-muted">{{ $property->listing_number }}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                  </div>
                  @empty
                    <div class="col text-center m-auto">
                        <div class="py-5">
                          <p class="fw-bold fs-5">@lang('site.NoData')</p>
                          <img class="w-100" src="{{ asset('images/empty-box.png') }}" >
                        </div>
                    </div>
                  @endforelse
                </div>
              </div>
            </div>
          </div>
      </div>
    </section>  
    <style>
        .user-properties i {
            background: rgba(var(--mainOp), .05);
            color: var(--main);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            font-size: 27px;
            width: 45px;
            height: 45px;
        }
    </style>
@endsection