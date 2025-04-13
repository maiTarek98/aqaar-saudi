                <div class="card produ-section{{$car->id}}">
                  <a href="{{route('cars.single',['q' =>slug($car->title_en).'-no-'.$car->request_no ])}}" class="link"></a>
                  <div class="card-img-top position-relative">
                  @if ($firstImage= $car->getFirstMediaUrl('images','thumb'))
                    <img loading="lazy" src="{{ $firstImage }}" alt="{{$car->title}}">
                  @else
                    <img src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->logo)}}" loading="lazy" alt="{{$car->title}}" style="
                        object-fit: contain;
                        padding: 1rem;
                        background: #f9f9f9;
                    ">
                  @endif
                    @if( $car->sell_car?->publish_by != 'car_owner' )
                        <div class="status-verified">
                            <i class="bi bi-shield-check"></i>
                            @lang('site.inspection and trusted')
                        </div>
                    @endif
                  </div>
                  <div class="card-body">
                    @if(\Request::route()->getName()== 'favorites')
                    <div class="mb-3 d-flex align-items-center justify-content-between">
                      <h5 class="card-title">{{$car->title}}</h5>
                      <a href="{{ route('user-wishlist-add',$car->id) }}" class="heart @if($car->is_fav()) fav @endif add-to-wish" data-id="{{$car->id}}">
                        <i class="fa-heart fa-solid"></i>
                      </a>
                    </div>
                    @else
                    <h5 class="card-title">{{$car->title}}</h5>
                    @endif
                    <p class="price">
                      @if($car->real_price != $car->car_price)
                      <span class="old-price">{{$car->car_price}} @lang('site.sar')</span>
                      @endif
                      <span>{{$car->real_price}}</span>
                      <span>@lang('site.sar')</span>
                    </p>
                  </div>
                </div>
