    
                  <div class="col">
                    <div class="card d-lg-flex flex-lg-row align-items-center">
                      <div class="estate-category"> 
                        {{__('main.products.'.$property->type)}}
                      </div>
                      <!-- estate img -->
                      <div class="estate-img col-lg-5">
                        @if ($firstImage= $property->getFirstMediaUrl('products_image','thumb'))
                          <img loading="lazy" src="{{ $firstImage }}" alt="{{$property->title}}" class="card-img-top">
                        @else
                          <img src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->logo)}}" loading="lazy" alt="{{$property->title}}" class="card-img-top" style="object-fit: contain">
                        @endif
                      </div>
                      <!-- estate info -->
                      <div class="card-body w-100">
                        <div class="d-flex justify-content-between align-items-center">
                          <p class="estate-price secondary fw-bold">
                            @if($property->type == 'auction')
                               @if($property->investment_collected > 0)
                                @if($property->status == 'closed')
                                    المزايدة انتهت بسعر {{$property->investment_collected}}
                                @else
                                    أعلى سعر مزايدة {{$property->investment_collected}}
                                @endif
                               @else
                               {{$property->price}}
                               @endif
                               <span>ريال سعودي</span>
                            @elseif($property->type == 'investment')
                                @if( ($property->price - $property->investment_collected) == 0)
                                    تم جمع المبلغ كاملا {{$property->price}}   <span>ريال سعودي</span>
                                @else
                               متبقي {{$property->price - $property->investment_collected}}  <span>ريال سعودي</span>
                                @endif
                            @elseif($property->type == 'shared')
                                يوجد  {{$property->offers()->count()}} عروض 
                            @endif
                          </p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center my-1">
                          <p class="estate-name card-title fw-semibold">
                            {{$property->title}} - {{$property->area?->parent?->parent?->name}}
                          </p>
                          <small class="estate-type text-muted">عقار {{__('main.products.'.$property->product_for)}}</small>
                        </div>
                        @if($property->area?->parent?->parent?->name)
                        <p class="estate-location card-text main">
                          <i class="bi bi-geo-alt"></i>
                          <small>{{$property->area?->parent?->parent?->name}} , {{$property->area?->parent?->name}} ,{{$property->area?->name}}</small>
                        </p>
                        @endif
                        <div class="estate-controls d-flex justify-content-between">
                          <!-- estate link -->
                          @if($property->form_type == 'add_property')
                          <a href="{{url('verify-property/'.$property->access_links[0]['token'].'?source=external&ref='.$property->access_links[0]['current_level'])}}">
                            <i class="bi bi-eye"></i>
                            <span>عرض العقار</span>
                          </a>
                         
                          <a @if($property->status == 'closed') href="" @else href="{{route('addProperty',['user' => auth('web')->user()->id, 'property' => $property->id])}}" @endif>
                            <i class="bi bi-pencil"></i>
                            <span>تعديل العقار</span>
                          </a>
                          <a href="{{route('property.letters',['user' => auth('web')->user()->id, 'property' => $property->id])}}">
                            <i class="bi bi-pencil-square"></i>
                            <span>رؤية الخطابات</span>
                          </a>
                        </div>
                         @endif
                        @if($property->type == 'auction')
                            <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                              <div class="btn-group gap-1 gap-md-2" role="group" aria-label="First group">
                                    @if($property->status == 'closed')
                                    <button class="blue-btn">
                                      انتهت المزايدة
                                    </button>
                                    @elseif($property->status == 'inactive')
                                    <form method="post" action="{{ route('property.resumeAuction', $property->id) }}">
                                        @csrf
                                        <button class="blue-btn w-auto px-2">
                                            تفعيل المزايدة مرة أخرى
                                        </button>
                                    </form>
                                    @elseif($property->status == 'cancelled')
                                    <button class="blue-btn w-auto px-2">
                                      المزايدة ملغية
                                    </button>
                                    @else
                                    <form method="post" action="{{ route('property.closeAuction', $property->id) }}">
                                        @csrf
                                        <input type="hidden" name="status" value="closed">
                                        <button class="blue-btn w-auto px-2" type="submit">
                                            إيقاف المزايدة
                                        </button>
                                    </form>
                                    
                                    <form method="post" action="{{ route('property.closeAuction', $property->id) }}">
                                        @csrf
                                        <input type="hidden" name="status" value="inactive">
                                        <button class="blue-btn w-auto px-2" type="submit">
                                            إيقاف مؤقت
                                        </button>
                                    </form>
                                    
                                    <form method="post" action="{{ route('property.closeAuction', $property->id) }}">
                                        @csrf
                                        <input type="hidden" name="status" value="cancelled">
                                        <button class="blue-btn w-auto px-2" type="submit">
                                            إلغاء المزايدة
                                        </button>
                                    </form>
                                    
                                    @endif
                              </div>
                            </div>
                        @endif
                        
                        @if($property->type == 'shared')
                          <a class="blue-btn" href="{{route('property.private.offers',['user' => auth('web')->user()->id, 'property' => $property->id])}}">
                            <span>العروض</span>
                          </a>
                          
                        @endif
                        
                        
                        <form action="{{route('deleteProperty',['property' => $property->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                              <button class="btn btn-danger del-aqaar" type="submit">
                                  <i class="bi bi-trash3"></i>
                                <!--<span>حذف العرض</span>-->
                              </button>
                        </form>
                        
                        
                      </div>
                    </div>
                  </div>
