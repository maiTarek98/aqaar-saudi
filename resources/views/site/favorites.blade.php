@extends('site.index')
@section('title', trans('site.my-favorites') )
@section('content')
@include('site.includes.breadcrumb-section',['title' => trans('site.my-favorites')])
    <!-- profile -->
        <div class="container-fluid mb-5 pb-md-4">
    <section class="profile mb-5">
        <div class="container-lg">

            <div class="row">
                @include('site.includes.profile-menu')
                <main class="col col-md-8 col-lg-9">
                    <button id="profile_nav" class="d-md-none">
                        <h5>@lang('site.my-favorites')</h5>
                        <i class="bi bi-sliders fs-5"></i>
                    </button>
                    <div class="profile-data py-4 px-md-4">
                            <div class="cars">
                        <?php $favs=\App\Models\Car::whereHas('wishlists',function($q){
                            $q->where('user_id',auth('web')->user()->id);
                          })->get();?>
                          @if($favs->count()>0)
                                <div class="row g-3">
                                  @forelse($favs as $car)
                                  <div class="col-12 col-md-3 col-lg-4 produ-{{$car->id}}">
                                    @include('site.includes.car-section')
                                  </div>
                                  @empty
                                  <div class="text-center">
                                    <h4>@lang('site.no fav')</h4>
                                    <img loading="lazy" alt="empty fav" src="https://backend.smartvision4p.com/elhenawy-co/public/dashboard/dist/img/Empty-rafiki.png" class="w-75 m-auto">
                                  </div>
                                  @endforelse
                                </div>
                         @else
                                <div class="text-center">
                                    <h4>@lang('site.no fav')</h4>
                                    <img loading="lazy" alt="empty fav" src="https://backend.smartvision4p.com/elhenawy-co/public/dashboard/dist/img/Empty-rafiki.png" class="w-75 m-auto">
                                </div>

                         @endif
                        </div>
                      </div>
                </main>
            </div>
        </div>
    </section>
</div>
@endsection