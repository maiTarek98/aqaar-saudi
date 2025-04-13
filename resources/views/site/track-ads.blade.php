@extends('site.index')
@section('title', trans('site.profile') )
@section('content')
      @include('site.includes.breadcrumb-section',['title' => trans('site.profile')])
<!-- track -->
    <main>

        <section>
            <div class="container-fluid mb-3 pb-md-4">
                <div class="track_steps">
                    @if($ad->status == 'pending')
                    <div class="step checked">
                        <div class="check_status"></div>
                        <p class="check_status_txt">
                            @lang('main.pending')
                        </p>
                    </div>
                    @else
                            <div class="step @if($ad->acceptance_date != null) checked @endif">
                                <div class="check_status"></div>
                                <p class="check_status_txt">
                                    تم قبول طلبك
                                </p>
                                <p class="check_status_date text-center">
                                    {{$ad->acceptance_date}}
                                </p>
                            </div>
                            <div class="step @if($ad->inspection_done_date != null ) checked @endif">
                                <div class="check_status"></div>
                                <p class="check_status_txt">
                                    تم الفحص
                                </p>
                                <p class="check_status_date text-center">
                                    @if($ad->inspection_done_date != null ) {{$ad->inspection_done_date}} @endif
                                </p>
                            </div>
                            <div class="step @if($ad->sold_date != null) checked @endif">
                                <div class="check_status"></div>
                                <p class="check_status_txt">
                                    تم البيع
                                </p>
                                 <p class="check_status_date text-center">
                                    {{$ad->sold_date}}
                                </p>
                            </div>
                    @endif
                </div>
            </div>
        </section>

        <section>
            <div class="track_title">
                <div class="container-fluid">
                    @lang('site.ad')   {{$ad->request_no}}
                </div>
            </div>
            <div class="container-fluid mb-5 pb-md-4">
                <div class="ad_details">
                    <div class="row row-cols-md-2 row-cols-1">
                        <div class="col">
                            <p>@lang('site.car brand') : {{$ad->car_brand?->brand_name}} </p>
                        </div>
                        <div class="col">
                            <p> @lang('site.car model')   : {{$ad->car_model?->model_name}} </p>
                        </div>
                        <div class="col">
                            <p> @lang('site.car category') : {{$ad->car_category?->model_name}} </p>
                        </div>
                        <div class="col">
                            <p> @lang('site.car model year') : {{$ad->car_model_year}}</p>
                        </div>
                        <div class="col">
                            <p>@lang('site.car_walker') : {{__('main.car_walker-'.$ad->car_walker)}}</p>
                        </div>
                        <div class="col">
                            <p>@lang('site.car_condition') : {{__('main.car_condition-'.$ad->car_condition)}}</p>
                        </div>
                        <div class="col">
                            <p>@lang('site.car color') : {{$ad->car_color}}</p>
                        </div>
                    </div>
                </div>

                <div class="ad_images">
                    <h6 class="fw-bold my-4">@lang('site.images')</h6>
                    <div class="gallery">
                        <div class="gallery-container">
                        @foreach($ad->getMedia('car_images') as $key=> $val)
                        <?php $imageUrl=url('/storage/sell_car_images/'.$val->id.'/'.$val->file_name);?>
                        <div class="img photo">
                            <a data-fancybox="gallary" href="{{$imageUrl}}">
                                <img loading="lazy" src="{{ $imageUrl}}" alt="{{$val->id}}" />
                            </a>
                        </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- <section>
    </section> -->

    <div class="container-fluid mb-5 pb-md-4">
        
    </div>
@endsection