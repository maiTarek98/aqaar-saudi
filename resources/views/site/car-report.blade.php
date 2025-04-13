@extends('site.index')
@section('title', trans('site.car-report') )
@section('content')
<nav
      id="check_report_nav"
      class="navbar d-block bg-body-tertiary navbar-expand-lg navbar-light top-0"
    >
    <div class="container-fluid py-2 border-bottom flex-row">
      <a class="navbar-brand p-0 m-0" href="{{route('home')}}">
        <img src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->logo)}}" alt="{{app(App\Models\GeneralSettings::class)->site_name}}" class="m-0"/>
      </a>
      <button class="nav-link" id="full-inspection-button">
        <i class="fa-solid fa-chevron-right"></i>
        @lang('site.full inspection report')
      </button>
      
    </div>
      <div class="container-fluid">
        <ul class="nav nav-pills w-100 justify-content-between">
          @foreach($reports as $key => $report)
          <li class="nav-item">
            <a href="#part{{$key+1}}" class="nav-link">{{$report->title}}</a>
          </li>
          @endforeach
        </ul>
      </div>
    </nav>

    <div
      data-bs-spy="scroll"
      data-bs-target="#check_report_nav"
      data-bs-root-margin="0px 0px -40%"
      data-bs-smooth-scroll="true"
      class="scrollspy-example bg-body-tertiary p-1 p-md-3 rounded-2"
      tabindex="0"
    >
      <div class="container-fluid">
        @foreach($reports as $key => $report)
        <div id="part{{$key+1}}">
          <div class="stick-next-to">
            <div class="car-info mt-4">
              <div class="check_report_wrapp pt-0">
                <div class="check_report">
                  <h5 class="car_info_title">{{$report->title}}</h5>
                  <ul>
                    @foreach($report->childs as $k => $val)
                    <li>
                      {{$val->title}}
                      @if(in_array($val->id, $car->car_report?->pluck('inspection_report_id')->toArray()) && $car->car_report->where('inspection_report_id',$val->id)->contains('value', 'yes')) 
                      <img src="{{url('site')}}/images/check_mark.svg" alt="" />
                      @elseif(in_array($val->id, $car->car_report?->pluck('inspection_report_id')->toArray()) && $car->car_report->where('inspection_report_id',$val->id)->contains('value', 'no'))
                      <button class="exclamation" data-bs-toggle="modal" data-bs-target="#exclamation{{$k}}-{{$val->id}}">
                        <span>@lang('site.show image')</span>
                        <img src="{{url('site')}}/images/exclamation.svg" alt="exclamation">
                      </button>


                        <!-- exclamation modal -->
                        <div
      class="modal fade"
      id="exclamation{{$k}}-{{$val->id}}"
      tabindex="-1"
      aria-labelledby="exclamation{{$k}}-{{$val->id}}Label"
      aria-hidden="true"
    >
    @php $car_report = $car->car_report->where('inspection_report_id', $val->id)->first(); @endphp
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="book_modalLabel"> {{$val->id}}
             {{$car_report->inspection_report?->title}}
            </h1>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
              fdprocessedid="xl5kwo"
            ></button>
          </div>
          <div class="modal-body">
            <h4 class="fs-5 mb-3">{{$car_report->description}}</h4>
            @if($car_report->getFirstMediaUrl('image', 'thumb'))
              <img id="preview_{{$car_report->id}}" src="{{ $car_report->getFirstMediaUrl('image', 'thumb') }}" alt="">
            @endif
          </div>
        </div>
      </div>
    </div>
                      @endif
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        
        <div class="check_report_info">
            @if(! $car->car_report->isEmpty())
                    <p>
                    @lang('site.inspection date') : {{$car_report_date_hijri}} | {{$car->car_report[0]->created_at->format('Y/m/d')}}
                    </p>
                    @endif
                    <!-- action : open Disclaimer modal -->
                    <button class="hint fs-6" data-bs-toggle="modal" data-bs-target="#Disclaimer_modal">
                    @lang('site.disclaimer msg')
                    </button>
         
        </div>
      </div>
    </div>
@endsection
@push('custom-js')
<script>
    document.getElementById('full-inspection-button').addEventListener('click', function() {
    window.location.href = "{{ route('cars.single', ['q' => slug($car->title_en) . '-no-' . $car->request_no]) }}";
});

</script>
@endpush