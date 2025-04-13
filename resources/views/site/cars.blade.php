@extends('site.index')
@section('title', trans('site.cars') )
@section('content')
@include('site.includes.breadcrumb-section',['title' =>trans('site.cars')  ])
<div class="car_filter mb-5 pb-md-4">
      <div class="row gy-4">
        <div class="col-md-4 col-lg-3 filter">
          <div class="filter-header d-md-none">
            <h5>@lang('site.filters')</h5>
            <button class="btn-close"></button>
          </div>
          <div class="selected-filters">
            <div class="selected-filters-title">
                <p> @lang('site.result of filter')</p>

                @if(!empty($_GET) && count($_GET) > 0 && ! request('page')) 
                <a href="{{ request()->url() }}" id="clear-all-filters" class="main-btn">@lang('site.reset filter') </a>
                @endif
            </div>
            <ul id="selected-filters-list">
              @if(request('brand'))
                @php $q_brand = \App\Models\CarBrand::where('id',request('brand'))->first(); @endphp
                <li data-filter="brand3">{{$q_brand->brand_name}}<a class="remove-filter-btn" href="{{request()->fullUrlWithQuery(['brand' => null])}}"><i class="fas fa-times"></i></a></li>    
              @endif

              @if(request('car_type'))
                <li data-filter="car_type3">{{__('site.'.request('car_type'))}}<a class="remove-filter-btn" href="{{request()->fullUrlWithQuery(['car_type' => null])}}"><i class="fas fa-times"></i></a></li>    
              @endif
              @if(request('detail'))
    @php 
        $details = explode(',', request('detail'));
        $q_detail = \App\Models\CarSpecification::whereIn('id', $details)->select('title_ar','id')->get(); 
    @endphp
    <ul>
        @foreach($q_detail as $q)
            <li data-filter="detail3">
                {{$q->title}}
                <a class="remove-filter-btn" href="{{ request()->fullUrlWithQuery(['detail' => implode(',', array_diff($details, [$q->id]))]) }}">
                    <i class="fas fa-times"></i>
                </a>
            </li>
        @endforeach    
    </ul>
@endif


            </ul>
          </div>
        <form action="{{route('product.filter')}}" method="post">
            @csrf
            
            <div class="accordion accordion-flush" id="accordionFlushExample">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button 
                  class="accordion-button" 
                  type="button" data-bs-toggle="collapse" 
                  data-bs-target="#flush-collapseOne" 
                  aria-expanded="true" 
                  aria-controls="flush-collapseOne">
                    @lang('site.car brand')
                  </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      <ul>
                        @foreach($brands as $brand)
                        <li>
                          @php $count=\App\Models\Car::where('status','show')->where('car_brand_id', $brand->id)->count(); @endphp
                              @if(!empty( $_GET['brand']))
                                @php
                                  $filter_brands=explode(',',$_GET['brand']);
                                @endphp
                              @endif
                          <div class="form-check">
                            <img src="{{$brand->getFirstMediaUrl('image','thumb')}}" alt="{{$brand->brand_name}}">
                            <input @if(!empty($filter_brands) && in_array($brand->id, $filter_brands)) checked @endif 
                              class="form-check-input"
                              type="checkbox" onChange="this.form.submit()" value="{{$brand->id}}"
                              name="brand[]"
                              id="category{{$brand->id}}"
                            />
                            <label class="form-check-label" for="category{{$brand->id}}">
                                {{ucfirst($brand->brand_name)}} ({{$count}})
                            </label>
                          </div>
                        </li>
                        @endforeach
                      </ul>
                    </div>            
                </div>
              </div>
              
              @foreach(\App\Models\CarSpecification::where('parent_id', 1)->whereNotNull('parent_id')->whereIn('id', [15,8, 9, 14, 10, 11,19])->get() as $key => $value)
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" 
                  type="button" data-bs-toggle="collapse" 
                  data-bs-target="#flush-collapse{{$key}}" 
                  aria-expanded="false" 
                  aria-controls="flush-collapse{{$key}}">
                    {{$value->title}}
                  </button>
                </h2>
                <div id="flush-collapse{{$key}}" 
                class="accordion-collapse collapse" 
                data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                                <ul>
                                   
                                    @foreach($value->childs as $detail)
                                        @php
                                            $count = \App\Models\CarDetail::whereHas('car', function($q) {
                                                $q->where('status', 'show');
                                            })
                                            ->where(function($query) use ($detail) {
                                                $query->where('car_specification_id', $detail->id)
                                                      ->orWhere('title_ar', $detail->id);  
                                            })
                                            ->count();
                                        @endphp
                                    @if($count > 0)
                                    <li>                      
                                        <div class="form-check">
                                            @if(!empty( $_GET['detail']))
                                              @php
                                                $filter_details=explode(',',$_GET['detail']);
                                              @endphp
                                            @endif
                                            @if($detail->parent_id == 8 || $detail->parent_id == 9)
                                            <span class="car_color" style="--car-color: {{searchColorByName($detail->title_ar)}}"></span>
                                            @endif
                                            <input @if(!empty($filter_details) && in_array($detail->id, $filter_details)) checked @endif 
                                              class="form-check-input"
                                              type="checkbox" onChange="this.form.submit()"
                                              name="detail[]" value="{{$detail->id}}" 
                                              id="category1{{$key}}_{{$detail->id}}"
                                            />  
                                            <label class="form-check-label" for="category1{{$key}}_{{$detail->id}}">
                                                {{$detail->title_ar}} ({{$count}})
                                            </label>
                                        </div>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                </div>
              </div>
              @endforeach
              
              @foreach(\App\Models\CarSpecification::where('id','!=',1)->has('childs')->whereNull('parent_id')->get() as $key => $value)
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" 
                  data-bs-toggle="collapse" 
                  data-bs-target="#flush-collapse-f{{$key}}" 
                  aria-expanded="false" 
                  aria-controls="flush-collapse-f{{$key}}">
                    {{$value->title}}
                  </button>
                </h2>
                <div id="flush-collapse-f{{$key}}" 
                class="accordion-collapse collapse" 
                data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      <ul>
                        @foreach($value->childs as $val)
                          @php $count=\App\Models\CarDetail::whereHas('car',function($q){ $q->where('status','show'); })->where('car_specification_id', $val->id)->count(); @endphp
                        @if($count)
                        <li>
                          <div class="form-check">
                               @if(!empty( $_GET['detail']))
                                @php
                                  $filter_details=explode(',',$_GET['detail']);
                                @endphp
                              @endif
                            <input @if(!empty($filter_details) && in_array($val->id, $filter_details)) checked @endif 
                              class="form-check-input"
                              type="checkbox" onChange="this.form.submit()"
                              name="detail[]" value="{{$val->id}}"
                              id="car_detail{{$val->id}}"
                            />
                            <label class="form-check-label" for="car_detail{{$val->id}}">
                                {{$val->title}} ({{$count}})
                            </label>
                          </div>
                        </li>
                        @endif
                        @endforeach
                      </ul>
                    </div>
                </div>
              </div>
              @endforeach
              
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button 
                  class="accordion-button collapsed" 
                  type="button" data-bs-toggle="collapse" 
                  data-bs-target="#flush-collapseThree" 
                  aria-expanded="false" 
                  aria-controls="flush-collapseThree">
                    @lang('site.price')
                  </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                            <div class="middle">
                            <div class="multi-range-slider">
                              <input type="hidden" id="from_price" name="from_price" value="">
                              <input type="hidden" id="to_price" name="to_price" value="">

                              <input type="range" id="input-left" min="0" max="500000" value="{{request('from_price',0)}}">
                              <input type="range" id="input-right" min="0" max="500000" value="{{request('to_price',500000)}}">
                    
                              <div class="slider">
                                <div class="track"></div>
                                <div class="range"></div>
                                <div class="thumb left">
                                  <div class="dot"></div>
                                </div>
                                <div class="thumb right">
                                  <div class="dot"></div>
                                </div>
                              </div>
                            </div>
                            <div class="prices">
                                <!-- <span>السعر</span> -->
                                <span class="price-to">100 @lang('site.sar')</span>
                                <span> - </span>
                                <span class="price-from">0 @lang('site.sar')</span>
                            </div>
                            </div>
                        </div>           
                </div>
              </div>
            </div>
            
            
            <button type="submit" class="main-btn">@lang('site.filter now')</button>
          </form>
        </div>
        <div class="col-md-8 col-lg-9">
          <div class="cars">
            <div class="row g-3">
              @forelse($cars as $car)
               <div class="col-6 col-md-3 col-lg-4">
                @include('site.includes.car-section',['car' => $car])
              </div>
              @empty
                <h3>@lang('site.NoData')</h3>
              @endforelse
            </div>
            <!--  all cars pagination -->
            {{$cars->appends($_GET)->links('vendor.pagination.custom')}}
          </div>
        </div>
      </div>
    </div>

    <button id="filter"><i class="bi bi-sliders fs-5"></i></button>
@endsection
@push('custom-js')
<script>
    // price from .. to ..
    var inputLeft = document.getElementById("input-left");
    var inputRight = document.getElementById("input-right");
    var thumbLeft = document.querySelector(".slider > .thumb.left");
    var thumbRight = document.querySelector(".slider > .thumb.right");
    var range = document.querySelector(".slider > .range");
    var priceFrom = document.querySelector(".price-from");
    var priceTo = document.querySelector(".price-to");
    
    var priceFromInput = document.querySelector("[name='from_price']");
    var priceToInput = document.querySelector("[name='to_price']");
    
    if (inputLeft !== null) {
      function setLeftValue() {
        var _this = inputLeft,
          min = parseInt(_this.min),
          max = parseInt(_this.max);

        _this.value = Math.min(parseInt(_this.value), parseInt(inputRight.value) - 1);

        var percent = ((_this.value - min) / (max - min)) * 100;

        thumbLeft.style.left = percent + "%";
        range.style.left = percent + "%";

        // Calculate price based on range value
        var price = parseInt(inputLeft.value) ; // Adjust this formula based on your requirements
        priceFrom.textContent = price + "  ر.س";
        priceFromInput.value = price ;
      }
      setLeftValue();

      function setRightValue() {
        var _this = inputRight,
          min = parseInt(_this.min),
          max = parseInt(_this.max);

        _this.value = Math.max(parseInt(_this.value), parseInt(inputLeft.value) + 1);

        var percent = ((_this.value - min) / (max - min)) * 100;

        thumbRight.style.right = (100 - percent) + "%";
        range.style.right = (100 - percent) + "%";

        // Calculate price based on range value
        var price = parseInt(inputRight.value) ; // Adjust this formula based on your requirements
        priceTo.textContent = price + "  ر.س";
        // priceToInput.value = price ;
      }
      setRightValue();

      inputLeft.addEventListener("input", setLeftValue);
      inputRight.addEventListener("input", setRightValue);

      // Add event listeners for thumb hover and active states
      // These listeners are not directly related to updating the price
      inputLeft.addEventListener("mouseover", function () {
        thumbLeft.classList.add("hover");
      });
      inputLeft.addEventListener("mouseout", function () {
        thumbLeft.classList.remove("hover");
      });
      inputLeft.addEventListener("mousedown", function () {
        thumbLeft.classList.add("active");
      });
      inputLeft.addEventListener("mouseup", function () {
        thumbLeft.classList.remove("active");
      });

      inputRight.addEventListener("mouseover", function () {
        thumbRight.classList.add("hover");
      });
      inputRight.addEventListener("mouseout", function () {
        thumbRight.classList.remove("hover");
      });
      inputRight.addEventListener("mousedown", function () {
        thumbRight.classList.add("active");
      });
      inputRight.addEventListener("mouseup", function () {
        thumbRight.classList.remove("active");
      });
    }
</script>
@endpush