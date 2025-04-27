@extends('site.index')
@section('title', trans('site.user-card') )
@section('content')
      @include('site.includes.breadcrumb-section',['title' => trans('site.user-card')])
    <section class="profile py-5">
      <div class="container-fluid">
        <!-- profile nav-sm -->
        <div class="profile-nav-sm rounded-3">
          <p class="m-0">الملف الشخصي</p>
          <button class="btn toggle-profile-nav p-0 border-0 bg-transparent" data-toggle=".profile-nav">
            <img
            src="images/menu.png"
            alt="menu icon"
          />
          </button>
        </div>

        <div class="row d-flex justify-content-between align-items-start">
        @include('site.includes.profile-menu')
        <!-- profile data col -->
          <div class="profile-data col col-md-7 col-lg-8">
            <div class="profile-wrapper p-0 bg-transparent">
              <div class="estate-filter d-flex flex-md-row flex-column align-items-center justify-content-between">
                <select name="" id="" class="form-control">
                  <option value="">عقاراتي</option>
                  <option value="">عقارات متزايدة</option>
                  <option value="">عقارات متشاركة بالمزايدة</option>
                  <option value="">عقار مشاركة</option>
                </select>
                <div class="builder-option d-flex gap-2">
                  <input name="purpose" type="radio" class="btn-check" id="accepted" value="accepted" autocomplete="off" checked>
                  <label class="btn" for="accepted">
                    <span>نشطة</span>
                  </label>

                  <input name="purpose" type="radio" class="btn-check" id="pending" value="pending" autocomplete="off">
                  <label class="btn" for="pending">
                    <span>بانتظار الموافقة</span>
                  </label>
                </div>
              </div>

              <div class="our-estates">
                <div class="row gy-3 row-cols-1">
                  @foreach($properties as $property)
                  <div class="col">
                    <div class="card d-lg-flex flex-lg-row align-items-center">
                      <!-- estate img -->
                      <div class="estate-img col-lg-6">
                        @if ($firstImage= $property->getFirstMediaUrl('products_image','thumb'))
                          <img loading="lazy" src="{{ $firstImage }}" alt="{{$property->title}}" class="card-img-top">
                        @else
                          <img src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->logo)}}" loading="lazy" alt="{{$property->title}}" class="card-img-top">
                        @endif
                      </div>
                      <!-- estate info -->
                      <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                          @if($property->type == 'auction')
                          <p class="estate-price secondary fw-bold">
                            أعلى سعر مزايدة
                            {{$property->investment_collected}} <span>ريال سعودي</span>
                          </p>
                          @elseif($property->type == 'investment')
                          <p class="estate-price secondary fw-bold">
                            @if($property->investment_collected > 0)
                            متبقي 
                            {{$property->price - $property->investment_collected}}  <span>ريال سعودي</span>
                            @else 
                            {{$property->price}} <span>ريال سعودي</span>
                            @endif
                          </p>
                          @else
                          <p class="estate-price secondary fw-bold">
                            {{$property->price}} <span>ريال سعودي</span>
                          </p>
                          @endif
                        </div>
                        <div class="d-flex justify-content-between align-items-center my-2">
                          <p class="estate-name card-title fw-semibold">
                            {{$property->title}} – {{$property->area?->parent?->parent?->name}} 
                          </p>
                          <small class="estate-type text-muted">{{__('main.products.'.$property->product_for)}}</small>
                        </div>
                        <p class="estate-location card-text main">
                          <i class="bi bi-geo-alt"></i>
                          <small>{{$property->area?->parent?->parent?->name}}, {{$property->area?->parent?->name}}, {{$property->area?->name}}</small>
                        </p>
                        <div class="estate-controls d-flex justify-content-between">
                          <!-- estate link -->
                          <a href="user-estate-details.html">
                            <i class="bi bi-eye"></i>
                            <span>عرض العقار</span>
                          </a>
                          <a href="">
                            <i class="bi bi-pencil"></i>
                            <span>تعديل العقار</span>
                          </a>
                          <a href="letters.html">
                            <i class="bi bi-pencil-square"></i>
                            <span>رؤية الخطابات</span>
                          </a>
                          @if($property->type == 'auction' && $property->investment_collected > 0 && $property->status != 'closed')
                          <form method="post" action="{{route('property.closeAuction', $property->id)}}">
                            @csrf
                            <button type="submit" class="blue-btn">
                              إيقاف المزايدة
                            </button>
                          </form>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>            
                
@endsection
@push('custom-js')

@endpush