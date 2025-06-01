@extends('site.index')
@push('custom-css')

@endpush
@section('title',$property->title )
@section('content')
@include('site.includes.breadcrumb-section',['title' => $property->title])
      <section class="estates my-5">
        <div class="container-fluid">
          <div class="row gy-3">
            <div class="col-md-8">
              <div class="single-img">
                <div class="all">
                  <div class="slider">
                    <div class="owl-carousel owl-theme one">
                      @foreach($property->getMedia('document') as $key=> $val)
                      <?php $imageUrl=url('/storage/products_images/'.$val->id.'/'.$val->file_name);?>
                      <div class="item-box">
                        <img src="{{ $imageUrl}}" alt="{{$val->id}}"  />
                      </div>
                      @endforeach
                    </div>
                  </div>
                  <div class="slider-two">
                    <div class="owl-carousel owl-theme two">
                      @foreach($property->getMedia('document') as $key=> $val)
                      <?php $imageUrl=url('/storage/products_images/'.$val->id.'/'.$val->file_name);?>
                      <div class="item @if($key == 0) active @endif">
                        <img src="{{ $imageUrl}}" alt="{{$val->id}}"  />
                      </div>
                      @endforeach
                    </div>
                    <div class="left-t nonl-t">
                      <i class="bi bi-chevron-left"></i>
                    </div>
                    <div class="right-t">
                      <i class="bi bi-chevron-right"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="our-estates">
               
                <div class="card mt-4 border-0 bg-light">
                  <!-- estate description -->
                  <div class="card-body py-4 gap-3">
                    <p class="card-title fw-bold fs-4">الوصف</p>

                    <p class="text-muted">
                        {!! $property->description !!}
                    </p>
                  </div>
                </div>

                <div class="card mt-4 border-0 bg-light">
                  <!-- estate description -->
                  <div class="card-body py-4 gap-3">
                    <p class="card-title fw-bold px-3 fs-4">
                      معلومات عن العقار
                    </p>
                    <table class="table bg-transparent m-0">
                      <tbody>
                        <tr>
                          <th>نوع العقار</th>
                          <td>{{__('main.products.'.$property->feature?->product_type)}}</td>
                          <th>المساحة</th>
                          <td>{{$property->feature?->area}} متر</td>
                        </tr>
                        <tr>
                          <th>نوع العرض</th>
                          <td>{{__('main.products.'.$property->product_for)}}</td>
                          <th>الرقم المرجعي</th>
                          <td>{{$property->listing_number}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
            </div>
            <div class="col-md-4">
              <div class="our-estates">
                <div class="card shadow border-0">
                  <!-- estate info -->
                  <div class="card-body gap-3 py-4 m-0 bg-white">
                    <div
                      class="d-flex justify-content-between align-items-center"
                    >
                      {{--<p class="estate-price secondary fw-bold fs-4">
                        {{$property->price}} <span>ريال سعودي</span>
                      </p>--}}
                    </div>
                    <div
                      class="d-flex justify-content-between align-items-center"
                    >
                      <p class="estate-name card-title fw-semibold mb-2">
                        {{$property->title}} – {{$property->area?->parent?->parent?->name}} 
                      </p>
                    </div>
                    <div class="card-text">
                      <div class="estate-feature">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>{{$property->area?->parent?->parent?->name}}, {{$property->area?->parent?->name}}, {{$property->area?->name}}</span>
                      </div>
                      <div class="estate-feature">
                        <i class="fa-solid fa-building"></i>
                        <span>{{__('main.products.'.$property->product_for)}}</span>
                      </div>
                      <div class="d-flex align-items-center gap-md-5">
                        <div class="estate-feature">
                          <i class="fa-solid fa-bed"></i>
                          <span>{{__('main.products.'.$property->feature?->product_type)}}</span>
                        </div>
                        <div class="estate-feature">
                          <i class="fa-solid fa-ruler-combined"></i>
                          <span>{{$property->feature?->area}} متر مربع</span>
                        </div>
                      </div>
                    </div>
                   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>        </div>

      </section>
@endsection
