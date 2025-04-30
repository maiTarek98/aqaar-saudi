      <div class="col">
        <div class="card produ-section{{$property->id}}">
          <!-- estate link -->
          <a
          href="estate-details.html"
          aria-label="مشاهدة تفاصيل عقار اسم العقار"
          class="link"
          ></a>

          <div class="estate-category"> 
            {{__('main.products.'.$property->type)}}
          </div>

          <!-- estate img -->
          <div class="estate-img">
            @if ($firstImage= $property->getFirstMediaUrl('products_image','thumb'))
              <img loading="lazy" src="{{ $firstImage }}" alt="{{$property->title}}" class="card-img-top">
            @else
              <img src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->logo)}}" loading="lazy" alt="{{$property->title}}" class="card-img-top">
            @endif
          </div>
          <!-- estate info -->
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <p class="estate-price secondary fw-bold">
                {{$property->price}} <span>@lang('main.sar')</span>
              </p>
            </div>
            <div class="d-flex justify-content-between align-items-center my-2">
              <p class="estate-name card-title fw-semibold">
                {{$property->title}} - {{$property->area?->parent?->parent?->name}}
              </p>
              <small class="estate-type text-muted">{{__('main.products.'.$property->product_for)}}</small>
            </div>
            <p class="estate-location card-text main">
              <i class="bi bi-geo-alt"></i>
              <small>{{$property->area?->parent?->parent?->name}} , {{$property->area?->parent?->name}} ,{{$property->area?->name}}</small>
            </p>
          </div>
        </div>
      </div>



