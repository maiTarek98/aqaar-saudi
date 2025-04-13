@extends('site.index')
@section('title', trans('site.profile') )
@section('content')
      @include('site.includes.breadcrumb-section',['title' => trans('site.profile')])
<!--  -->
    <div class="container-fluid mb-5 pb-md-4">
        <!-- profile -->
        <section class="profile mb-5">
            <div class="container-lg">
                <div class="row">
                    @include('site.includes.profile-menu')
                    <main class="col col-md-8 col-lg-9">
              <!-- action : open profile nav @ sm media -->
              <button id="profile_nav" class="d-md-none">
                <h6>@lang('site.my ads')</h6>
                <i class="bi bi-sliders fs-5"></i>
              </button>
              <!-- end -->
              <div class="profile-data">
                <div class="my_cars">
                    @forelse($user->reservations as $val)
                    <div class="own_car">
                      {{--<a href="{{route('cars.single',['q' =>slug($val->car?->title_en).'-no-'.$val->car?->request_no ])}}" class="link"></a>--}}
                        <div class="d-flex align-items-center gap-3">
                            @if ($firstImage= $val->car?->getFirstMediaUrl('images','thumb'))
                                <img loading="lazy" src="{{ $firstImage }}" alt="{{$val->car?->title}}">
                            @endif
                            <h6 class="fw-bold">{{$val->car?->title}}</h6>
                        </div>
                        <div class="take_action gap-3">
                          <button class="open_car_modal" data-bs-toggle="modal" data-bs-target="#car_details{{$val->id}}">
                             @lang('site.car details')
                          </button>
                          <a href="{{route('sellCar',['form_id' =>'car_details','car' => $val->car?->id])}}" class="main-btn"> @lang('site.sell car') </a>
                        </div>
                    </div>
    @php $CarSpecification = \App\Models\CarSpecification::where('id',1)->first(); @endphp
                     <!-- car details modal -->
    <div
      class="modal fade"
      id="car_details{{$val->id}}"
      tabindex="-1"
      aria-labelledby="car_details{{$val->id}}Label"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="car_details{{$val->id}}Label">@lang('site.car info')</h1>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <ul>
              @foreach($val->car?->car_details as $detail)
              @if(in_array($detail->car_specification_id,$CarSpecification->childs->pluck('id')->toArray()))
              <li>@if($detail->car_specification?->type == 'yes_no')
                              @if($detail->title == 'yes')
                                {{$detail->car_specification?->title}}
                              @endif
                            @elseif($detail->car_specification?->type == 'select')
                              {{$detail->car_specification?->title}} : {{\App\Models\CarSpecification::where('id',$detail->title)->first()?->title}}
                            @else
                              {{$detail->car_specification?->title}} : {{$detail->title}}
                            @endif</li>
              @endif
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>

                    @empty
                  <h4>@lang('site.noBuyCars')</h4>
                    @endforelse
                </div>
              </div>
            </main>
                </div>
            </div>
        </section>
    </div>
   
@endsection
@push('custom-js')

@endpush