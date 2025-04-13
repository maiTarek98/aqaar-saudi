@extends('site.index')
@section('title', trans('site.workshops') )
@section('content')
@include('site.includes.breadcrumb-section',['title' =>trans('site.workshops')  ])
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
              @if(request('city'))
                @php $q_city = \App\Models\City::where('id',request('city'))->first(); @endphp
                <li data-filter="city3">{{$q_city->city_name}}<a class="remove-filter-btn" href="{{request()->fullUrlWithQuery(['city' => null])}}"><i class="fas fa-times"></i></a></li>    
              @endif
              @if(request('is_available'))
                  @php 
                      $is_available = explode(',', request('is_available'));
                      $availabilityMap = [
                          '1' => 'yes',
                          '0' => 'no',
                      ];
                  @endphp
                  <ul>
                      @foreach ($is_available as $value => $label)
                          <li data-filter="is_available{{ $value }}">
                              {{ $label }}
                              <a class="remove-filter-btn" 
                                 href="{{ request()->fullUrlWithQuery(['is_available' => implode(',', array_diff($is_available, [$label]))]) }}">
                                  <i class="fas fa-times"></i>
                              </a>
                          </li>
                      @endforeach
                  </ul>   
              @endif

            </ul>
          </div>
        <form action="{{route('workshop.filter')}}" method="post">
            @csrf
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <!--  الماركة   -->
                <div class="accordion-item">
                  <h2 class="accordion-header">
                   <button 
                      class="accordion-button" 
                      type="button" data-bs-toggle="collapse" 
                      data-bs-target="#flush-collapseOne" 
                      aria-expanded="true" 
                      aria-controls="flush-collapseOne">
                     @lang('site.is_available')
                    </button>
                  </h2>
                  <div
                    id="flush-collapseOne"
                    class="accordion-collapse collapse show"
                    data-bs-parent="#accordionFlushExample"
                  >
                    <div class="accordion-body">
                      <ul>
                        <li>
                          @php $count=\App\Models\User::where('account_type','workshop')->where('account_status','active')->where('is_available','1')->count(); @endphp
                              @if(!empty( $_GET['is_available']))
                                @php
                                  $filter_is_availables=explode(',',$_GET['is_available']);
                                @endphp
                              @endif
                          <div class="form-check">
                            <input @if(!empty($filter_is_availables) && in_array('yes', $filter_is_availables)) checked @endif 
                              class="form-check-input"
                              type="checkbox" onChange="this.form.submit()" value="yes"
                              name="is_available[]"
                              id="category1"
                            />
                            <label class="form-check-label" for="category1">
                                @lang('site.is_yes_available') ({{$count}})
                            </label>
                          </div>
                        </li>

                        <li>
                          @php $count=\App\Models\User::where('account_type','workshop')->where('account_status','active')->where('is_available','0')->count(); @endphp
                              @if(!empty( $_GET['is_available']))
                                @php
                                  $filter_is_availables=explode(',',$_GET['is_available']);
                                @endphp
                              @endif
                          <div class="form-check">
                            <input @if(!empty($filter_is_availables) && in_array('no', $filter_is_availables)) checked @endif 
                              class="form-check-input"
                              type="checkbox" onChange="this.form.submit()" value="no"
                              name="is_available[]"
                              id="category0"
                            />
                            <label class="form-check-label" for="category0">
                                @lang('site.is_not_available') ({{$count}})
                            </label>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <!--  المدينة   -->
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button
                      class="accordion-button collapsed"
                      type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#flush-collapseTwo"
                      aria-expanded="false"
                      aria-controls="flush-collapseTwo"
                    >
                    @lang('site.city')
                    </button>
                  </h2>
                  <div
                    id="flush-collapseTwo"
                    class="accordion-collapse collapse"
                    data-bs-parent="#accordionFlushExample""
                  >
                    <div class="accordion-body">
                      <ul>
                        @foreach($citys as $city)
                        <li>
                          @php $count=\App\Models\User::where('account_type','workshop')->where('account_status','active')->where('city_id', $city->id)->count(); @endphp
                              @if(!empty( $_GET['city']))
                                @php
                                  $filter_citys=explode(',',$_GET['city']);
                                @endphp
                              @endif
                          <div class="form-check">
                            <input @if(!empty($filter_citys) && in_array($city->id, $filter_citys)) checked @endif 
                              class="form-check-input"
                              type="checkbox" onChange="this.form.submit()" value="{{$city->id}}"
                              name="city[]"
                              id="category{{$city->id}}"
                            />
                            <label class="form-check-label" for="category{{$city->id}}">
                                {{ucfirst($city->city_name)}} ({{$count}})
                            </label>
                          </div>
                        </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
            </div>
            <!-- <button type="submit" class="main-btn">تصفية</button> -->
          </form>
        </div>
        <div class="col-md-8 col-lg-9">
          <div class="cars">
            <div class="row g-3">
              @forelse($workshops as $workshop)
                @include('site.includes.workshop-section',['workshop' => $workshop])
              @empty
                <h3>@lang('site.NoData')</h3>
              @endforelse
            </div>
            <!--  all workshops pagination -->
            {{$workshops->appends($_GET)->links('vendor.pagination.custom')}}
          </div>
        </div>
      </div>
    </div>

    <button id="filter"><i class="bi bi-sliders fs-5"></i></button>
@endsection