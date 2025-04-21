@extends('site.index')
@section('title', trans('site.properties') )
@section('content')
@include('site.includes.breadcrumb-section',['title' =>trans('site.properties')  ])

<!-- section -->
<section class="estates my-5 pb-5">
  <div class="container-fluid">
    <div class="row gx-lg-5">
      <div class="col-5 col-lg-4 filter px-3">
        <div class="filter-header d-flex justify-content-between d-md-none">
          <p class="m-0 fw-bold fs-5">التصفيه</p>
          <button
          data-close=".filter"
          class="close-filter">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>

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
              @if(request('product_for'))
                <li data-filter="product_for3">{{__('site.'.request('product_for'))}}<a class="remove-filter-btn" href="{{request()->fullUrlWithQuery(['product_for' => null])}}"><i class="fas fa-times"></i></a></li>    
              @endif

              @if(request('type'))
                <li data-filter="type3">{{__('site.'.request('type'))}}<a class="remove-filter-btn" href="{{request()->fullUrlWithQuery(['type' => null])}}"><i class="fas fa-times"></i></a></li>    
              @endif

              @if(request('area_id'))
                <li data-filter="area_id3">{{getArea(request('area_id'))->name}}<a class="remove-filter-btn" href="{{request()->fullUrlWithQuery(['area_id' => null])}}"><i class="fas fa-times"></i></a></li>    
              @endif

              @if(request('from_price'))
                <li data-filter="from_price3">{{__('site.start') . request('from_price')}}<a class="remove-filter-btn" href="{{request()->fullUrlWithQuery(['from_price' => null])}}"><i class="fas fa-times"></i></a></li>    
              @endif
              @if(request('to_price'))
                <li data-filter="to_price3">{{__('site.start') . request('to_price')}}<a class="remove-filter-btn" href="{{request()->fullUrlWithQuery(['to_price' => null])}}"><i class="fas fa-times"></i></a></li>    
              @endif
            </ul>
          </div>
      <form action="{{route('product.filter')}}" method="post">
        @csrf
        <div class="input-group my-3">
          <input type="text" name="search" value="{{old('search',request('search'))}}" class="form-control" placeholder="...ابحث" />
          <button class="input-group-text bg-white">
            <i class="bi bi-search"></i>
          </button>
        </div>
      <div class="accordion accordion-flush" id="accordionFlushExample">
        <!-- حال العقار -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingThree">
            <button
            class="accordion-button px-1 collapsed"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#flush-collapseThree"
            aria-expanded="false"
            aria-controls="flush-collapseThree"
            >
            حال العقار
          </button>
        </h2>
        <div
        id="flush-collapseThree"
        class="accordion-collapse collapse"
        aria-labelledby="flush-headingThree"
        data-bs-parent="#accordionFlushExample"
        >
        <div class="accordion-body px-1">
          <ul>
            <li>
              @php $count=\App\Models\Product::where('status','shared_onsite')->where('product_for', 'sale')->count(); @endphp
              @if(!empty( $_GET['product_for']))
              @php
              $filter_product_fors=explode(',',$_GET['product_for']);
              @endphp
              @endif
              <div class="form-check">
                <input @if(!empty($filter_product_fors) && in_array('sale', $filter_product_fors)) checked @endif 
                class="form-check-input"
                type="checkbox"  value="sale"
                name="product_for[]"
                id="categorysale"
                />
                <label class="form-check-label" for="categorysale">
                  Sale ({{$count}})
                </label>
              </div>
            </li>

            <li>
              @php $count=\App\Models\Product::where('status','shared_onsite')->where('product_for', 'rent')->count(); @endphp
              @if(!empty( $_GET['product_for']))
              @php
              $filter_product_fors=explode(',',$_GET['product_for']);
              @endphp
              @endif
              <div class="form-check">
                <input @if(!empty($filter_product_fors) && in_array('rent', $filter_product_fors)) checked @endif 
                class="form-check-input"
                type="checkbox"  value="rent"
                name="product_for[]"
                id="categoryrent"
                />
                <label class="form-check-label" for="categoryrent">
                  rent ({{$count}})
                </label>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- فئة العقار -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="flush-headingFour">
        <button
        class="accordion-button px-1 collapsed"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#flush-collapseFour"
        aria-expanded="false"
        aria-controls="flush-collapseFour"
        >
        فئة العقار
      </button>
    </h2>
    <div
    id="flush-collapseFour"
    class="accordion-collapse collapse"
    aria-labelledby="flush-headingFour"
    data-bs-parent="#accordionFlushExample"
    >
    <div class="accordion-body px-1">
      <ul>
        <li>
          @php $count=\App\Models\Product::where('status','shared_onsite')->where('type', 'auction')->count(); @endphp
          @if(!empty( $_GET['type']))
          @php
          $filter_types=explode(',',$_GET['type']);
          @endphp
          @endif
          <div class="form-check">
            <input @if(!empty($filter_types) && in_array('auction', $filter_types)) checked @endif 
            class="form-check-input"
            type="checkbox"  value="auction"
            name="type[]"
            id="categoryauction"
            />
            <label class="form-check-label" for="categoryauction">
              auction ({{$count}})
            </label>
          </div>
        </li>

        <li>
          @php $count=\App\Models\Product::where('status','shared_onsite')->where('type', 'shared')->count(); @endphp
          @if(!empty( $_GET['type']))
          @php
          $filter_types=explode(',',$_GET['type']);
          @endphp
          @endif
          <div class="form-check">
            <input @if(!empty($filter_types) && in_array('shared', $filter_types)) checked @endif 
            class="form-check-input"
            type="checkbox"  value="shared"
            name="type[]"
            id="categoryshared"
            />
            <label class="form-check-label" for="categoryshared">
              shared ({{$count}})
            </label>
          </div>
        </li>
        <li>
          @php $count=\App\Models\Product::where('status','shared_onsite')->where('type', 'investment')->count(); @endphp
          @if(!empty( $_GET['type']))
          @php
          $filter_types=explode(',',$_GET['type']);
          @endphp
          @endif
          <div class="form-check">
            <input @if(!empty($filter_types) && in_array('investment', $filter_types)) checked @endif 
            class="form-check-input"
            type="checkbox"  value="investment"
            name="type[]"
            id="categoryinvestment"
            />
            <label class="form-check-label" for="categoryinvestment">
              investment ({{$count}})
            </label>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
<!-- اختر المدينة  -->
<div class="accordion-item">
  <h2 class="accordion-header" id="flush-headingOne">
    <button
    class="accordion-button px-1"
    type="button"
    data-bs-toggle="collapse"
    data-bs-target="#flush-collapseOne"
    aria-expanded="true"
    aria-controls="flush-collapseOne"
    >
    اختر المدينة
  </button>
</h2>
<div
id="flush-collapseOne"
class="accordion-collapse collapse show"
aria-labelledby="flush-headingOne"
data-bs-parent="#accordionFlushExample"
>
<div class="accordion-body px-1">
  <ul>
    @foreach($areas as $area)
    <li>
      @php  
      $count = \App\Models\Product::where('status', 'shared_onsite')
      ->whereHas('area.parent.parent', function($q) use ($area) {
        $q->where('id', $area->id)
        ->where('type', 'governorate');
      })
      ->count();
      @endphp
      @if(!empty( $_GET['area_id']))
      @php
      $filter_area_ids = explode(',',$_GET['area_id']);                               @endphp
      @endif
      <div class="form-check">
        <input @if(!empty($filter_area_ids) && in_array($area->id, $filter_area_ids)) checked @endif 
        class="form-check-input"
        type="checkbox"  value="{{$area->id}}"
        name="area_id[]"
        id="category{{$area->id}}"
        />
        <label class="form-check-label" for="category{{$area->id}}">
          {{ucfirst($area->name)}} ({{$count}})
        </label>
      </div>
    </li>
    @endforeach
  </ul>
</div>
</div>
</div>
<!-- نوع العقار  -->
<div class="accordion-item">
  <h2 class="accordion-header" id="flush-headingTwo">
    <button
    class="accordion-button px-1 collapsed"
    type="button"
    data-bs-toggle="collapse"
    data-bs-target="#flush-collapseTwo"
    aria-expanded="false"
    aria-controls="flush-collapseTwo"
    >
    نوع العقار
  </button>
</h2>
<div
id="flush-collapseTwo"
class="accordion-collapse collapse"
aria-labelledby="flush-headingTwo"
data-bs-parent="#accordionFlushExample"
>
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
<button type="submit" class="main-outline-btn w-100">تصفية</button>
      </form>

</div>
<div class="col filter-data">
  <div class="our-estates">
      <div class="row gy-3 row-cols-lg-2 row-cols-1">
        @forelse($propertys as $property)
            @include('site.includes.property-section',['property' => $property])
        @empty
          <h3>@lang('site.NoData')</h3>
        @endforelse
      </div>
      {{$propertys->appends($_GET)->links('vendor.pagination.custom')}}
  </div>
</div>
</div>
</div>
</section>

<!-- filter  btn -->
<button id="filter" data-toggle=".filter"><i class="bi bi-sliders fs-5"></i></button>

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