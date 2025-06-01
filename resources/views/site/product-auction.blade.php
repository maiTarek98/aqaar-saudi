@extends('site.index')
@push('custom-css')

@endpush
@section('title',$property->title )
@section('content')
@include('site.includes.breadcrumb-section',['title' => $property->title])

@php
    if(now()->gt($property->end_date)){
        $property->update(['status' => 'closed']);
    }
@endphp
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

                <div class="card border-0 estate-type auction">
                  <div class="card-header py-3 bg-transparent">
                    <h4 class="card-title">
                      سعر بداية المزايدة :
                      <span>{{$property->price}} <span>ريال</span></span>
                    </h4>
                  </div>
                  <div class="card-body py-0">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="td d-flex align-items-center gap-1">
                                <i class="bi bi-calendar"></i>
                                <span>تاريخ بداية المزاد</span>
                                <span>{{$property->start_date}}</span>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="td d-flex align-items-center gap-1">
                                <i class="bi bi-calendar"></i>
                                <span>تاريخ نهاية المزاد</span>
                                <span>{{$property->end_date}}</span>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="card mt-4 border-0 estate-history">
                  <div class="card-header py-3 bg-transparent">
                    <h4 class="card-title">سجل المزايدات :</h4>
                  </div>
                  <div class="card-body py-0">
                    @if($property->bids->count() > 0)
                    <table class="table m-0">
                      <thead>
                        <th>اسم المستخدم</th>
                        <th>قيمة المزايدة</th>
                        <th>التاريخ</th>
                      </thead>
                      <tbody>
                        @foreach($property->bids as $value)
                        <tr>
                          <td>{{$value->user?->name}}</td>
                          <td>{{$value->amount}} <span>ريال</span></td>
                          <td>{{$value->created_at->format('Y-m-d')}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    @else
                      @lang('site.no date to show')
                    @endif
                  </div>
                </div>
                @if(auth('web')->user()->id != $property->added_by && auth('web')->user()->delegatedForProduct($property->id)->doesntExist())
                <div class="card mt-3 card-note mt-4 border-0 bg-light rounded-0">
                  <div class="card-body py-4 gap-3">
                    <div>
                    @if($property->type == 'auction' )
                        @if($property->status == 'inactive')
                            <div class="alert alert-warning">غير متاح المزاد الآن</div>
                            @if($property->investment_collected > 0)
                            <p class="card-title fw-bold fs-5 mb-3">مبلغ أعلى مزايدة : {{$property->investment_collected}} ريال</p>
                            @endif
                        @elseif($property->status == 'cancelled')
                            <div class="alert alert-warning">تم إلغاء هذا المزاد</div>
                        @elseif(now()->lt($property->start_date))
                            <div class="alert alert-warning">المزاد لم يبدأ بعد.</div>
                        @elseif(now()->gt($property->end_date))
                            <div class="alert alert-danger">انتهى المزاد.</div>
                        @else
                            @if($property->investment_collected > 0)
                            <p class="card-title fw-bold fs-5 mb-3">مبلغ أعلى مزايدة : {{$property->investment_collected}} ريال</p>
                            @endif
                                                @if($property->status == 'pending')

                            <form method="POST" action="{{ route('property.bid', $property->id) }}">
                                @csrf
                                <div class="d-flex flex-wrap align-items-center gap-3">
                                            <p class="">قيمة المزايدة</p>
                                            <div>
                                              <div class="input-group border">
                                                <input type="number" name="amount" class="form-control" required @if($property->investment_collected > 0) min="{{ $property->investment_collected }}" @else min="{{ $property->price + 1}}" @endif  id="InputPassword" placeholder="{{$property->investment_collected}}">
                                                <span type="button" class="input-group-text">
                                                  ريال
                                                </span>
                                              </div>

                                            </div>
                                            <button type="submit" class="main-outline-btn text-center">
                                              مزايدة
                                            </button>
                                          </div>
                            </form>
                                @else
                            <div class="alert-warning">انتهي العرض</div>
                            @endif
                        @endif
                    @endif      
                    </div>
                  </div>
                </div> 
                @else
                <div class="card mt-3 card-note mt-4 border-0 bg-light rounded-0">
                    <div class="card-body py-4 gap-3">
                        @if($property->investment_collected > 0)
                            <p class="card-title fw-bold fs-5">مبلغ أعلى مزايدة : {{$property->investment_collected}} ريال</p>
                        @else
                            <p class="card-title fw-bold fs-5">لا يوجد مزايدة حتي الآن</p>
                        @endif
                        
                        @if($property->status == 'closed')
                            <!--<button class="blue-btn" disabled>-->
                            <!--    انتهت المزايدة-->
                            <!--</button>-->
                            <div>
                                <span>
                                    لقد اانتهت المزايدة 
                                </span>
                                @if($property->winner)
                                    <span>
                                        والفائز: {{ $property->winner->name }} (ID: {{ $property->winner->card_code }})
                                    </span>
                                @else
                                    <span>
                                        لا يوجد فائز لهذا المزاد.
                                    </span>
                                @endif
                           {{-- @elseif($property->status == 'inactive')
                                <form method="post" action="{{ route('property.resumeAuction', $property->id) }}">
                                    @csrf
                                    <button class="blue-btn">
                                        تفعيل المزايدة مرة أخرى
                                    </button>
                                </form>
                                @elseif($property->status == 'cancelled')
                                <button class="blue-btn">
                                  المزايدة ملغية
                                </button>
                                @else
                                <div class="card mt-4 border-0 estate-history">
                                      <div class="card-header py-3 bg-transparent">
                                        <h4 class="card-title">خيارات التحكم في المزايدة  :</h4>
                                      </div>
                                      
                                      <div class="card-body py-0">
                                            <div class="d-flex gap-2">
                                                <form method="post" action="{{ route('property.closeAuction', $property->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="status" value="closed">
                                                    <button class="blue-btn w-auto px-md-4 px-1" type="submit">
                                                        إيقاف المزايدة
                                                    </button>
                                                </form>
                                                
                                                <form method="post" action="{{ route('property.closeAuction', $property->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="status" value="inactive">
                                                    <button class="blue-btn w-auto px-md-4 px-1" type="submit">
                                                        إيقاف مؤقت
                                                    </button>
                                                </form>
                                                
                                                <form method="post" action="{{ route('property.closeAuction', $property->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="status" value="cancelled">
                                                    <button class="blue-btn w-auto px-md-4 px-1" type="submit">
                                                        إلغاء المزايدة
                                                    </button>
                                                </form>
                                            </div>                                 
                                        </div>
                                    </div>--}}
                            </div>
                        @endif
                    </div>
                </div>
                @endif
                    
                    @if(!(auth('web')->user()->id != $property->added_by && auth('web')->user()->delegatedForProduct($property->id)->doesntExist()))
                    @if(!$property->winner)
                    <div class="card mt-4 border-0 estate-history">
                    @if(now()->gt($property->end_date))
                        <div class="alert alert-danger">انتهى المزاد.</div>
                    @else
                    <div class="card-header py-3 bg-transparent">
                        <h4 class="card-title">خيارات التحكم في المزايدة  :</h4>
                      </div>
                      <div class="card-body py-0">
                          @if($property->status == 'inactive')
                            <form method="post" action="{{ route('property.resumeAuction', $property->id) }}">
                                @csrf
                                <button class="blue-btn">
                                    تفعيل المزايدة مرة أخرى
                                </button>
                            </form>
                            @elseif($property->status == 'cancelled')
                            <button class="blue-btn">
                              المزايدة ملغية
                            </button>
                            @else
                            
                            <div class="d-flex gap-1 gap-md-2">
                                <form method="post" action="{{ route('property.closeAuction', $property->id) }}">
                                    @csrf
                                    <input type="hidden" name="status" value="closed">
                                    <button class="blue-btn w-auto px-md-4 px-2" type="submit">
                                        إيقاف المزايدة
                                    </button>
                                </form>
                                
                                <form method="post" action="{{ route('property.closeAuction', $property->id) }}">
                                    @csrf
                                    <input type="hidden" name="status" value="inactive">
                                    <button class="blue-btn w-auto px-md-4 px-2" type="submit">
                                        إيقاف مؤقت
                                    </button>
                                </form>
                                
                                <form method="post" action="{{ route('property.closeAuction', $property->id) }}">
                                    @csrf
                                    <input type="hidden" name="status" value="cancelled">
                                    <button class="blue-btn w-auto px-md-4 px-2" type="submit">
                                        إلغاء المزايدة
                                    </button>
                                </form>
                            </div>  
                            @endif
                        </div>
                    @endif
                    </div>
                     @endif
                    @endif
                            
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
                    <p class="card-title fw-bold fs-4">
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
                @include('site.includes.user-card-section',['property' => $property])
            </div>
            <div class="col-md-4">
                <div class="our-estates">
                    <div class="card shadow border-0">
                  <!-- estate info -->
                  <div class="card-body gap-3 py-4 m-0 bg-white">
                    <div
                      class="d-flex justify-content-between align-items-center"
                    >
                      <p class="estate-price secondary fw-bold fs-4">
                        {{$property->price}} <span>ريال سعودي</span>
                      </p>
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
                        @php
                            $endDate = $property?->end_date;
                        @endphp

                    @if($property->status == 'pending' && auth('web')->user()->user_type == 'other' && auth('web')->user()->id != $property->added_by && (! $property->property_delegations->where('status', 'approved')->pluck('agent_id')->contains(auth('web')->id())))
                    @if ($endDate && \Carbon\Carbon::parse($endDate)->isFuture())
                    <button
                      class="main-outline-btn text-center w-100"
                      data-bs-toggle="modal"
                      data-bs-target="#estateModal"
                    >
                      إرسال خطاب
                    </button>
                    @endif
                    @endif
                    @if(auth('web')->user()->user_type == 'other' && auth('web')->user()->id != $property->added_by && $property->feature?->represented_by == 'owner' && (! $property->property_delegations->where('status', 'approved')->pluck('agent_id')->contains(auth('web')->id())))
                        
                    @if ($endDate && \Carbon\Carbon::parse($endDate)->isFuture())
                    <button
                      class="main-outline-btn text-center w-100"
                      data-bs-toggle="modal"
                      data-bs-target="#agentModal"
                    >
                      طلب تفويض وكالة
                    </button>
                    @endif
                    @elseif($property->property_delegations->where('status', 'approved')->pluck('agent_id')->contains(auth('web')->id()))
                    <button type="button" disabled class="main-outline-btn text-center w-100">
                        أنت الآن وكيل لهذا العقار
                    </button>
                    @elseif($property->feature?->represented_by == 'owner')
                        @if(now()->gt($property->end_date))
                            @foreach($property->property_delegations->where('status','pending') as $agent)
                                    <button type="button" class="main-outline-btn text-center w-100">
                                        الموافقة علي توكيل الوكيل: {{$agent->agent?->name}}
                                    </button>
                            @endforeach
                        @else
                        @foreach($property->property_delegations->where('status','pending') as $agent)
                            <form method="post" action="{{ route('user.respondDelegation', $agent->id) }}"
                                  onsubmit="return confirm('هل أنت متأكد من الموافقة على توكيل الوكيل: {{$agent->agent?->name}}؟')">
                                @csrf
                                <input name="action" value="approved" type="hidden">
                                <button type="submit" class="main-outline-btn text-center w-100">
                                    الموافقة علي توكيل الوكيل: {{$agent->agent?->name}}
                                </button>
                            </form>
                        @endforeach

                        @endif
                        @foreach($property->property_delegations->where('status','approved') as $agent)
                            <button type="button" disabled
                              class="main-outline-btn text-center w-100">
                              اسم الوكيل للعقار: {{$agent->agent?->name}}
                            </button>
    
                        @endforeach
                               
                    @endif
                  </div>
                </div>
                    @if(auth('web')->user()->id == $property->added_by)
                    <div class="card shadow border-0">
                      <!-- estate info -->
                        <div class="card-body gap-3 py-4 m-0 bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                              <p class="estate-price secondary fw-bold fs-4">
                                التوثيقات
                              </p>
                            </div>
                            <div class="tree">
                                <ul>
                                    @foreach ($structuredTree as $node)
                                        @include('site.includes.delegation-node', ['node' => $node])
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
      </section>

      <!-- Modal -->
      <div class="modal fade" id="agentModal" tabindex="-1" aria-labelledby="agentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="agentModalLabel">
                      طلب تفويض وكالة علي العقار: {{$property->title}}
              </h1>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <form method="post" action="{{route('user.requestDelegation', $property->id)}}">
                @csrf
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                  >
                    اغلاق
                  </button>
                  <button type="submit" class="btn main-btn">
                    ارسال
                  </button>
                </div>
            </form>
            
          </div>
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="estateModal" tabindex="-1" aria-labelledby="estateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="estateModalLabel">
                خطاب عن العقار : {{$property->title}}
              </h1>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <form method="post" action="{{route('letters.store',$property->id)}}">
                @csrf
                <input type="hidden" name="receiver_id" value="{{$property->added_by}}" class="form-control" placeholder="" required="">
                <div class="modal-body">
                  <div class="form-group mb-4">
                    <label for="">الاسم</label>
                    <input type="text" value="{{auth('web')->user()->name}}" class="form-control" placeholder="" required="">
                  </div>
                  <div class="form-group mb-4">
                    <label for="">نوع الاستفسار</label>
                    <input type="text" name="type" value="" class="form-control" placeholder="" required="">
                  </div>
                  <div class="form-group mb-4">
                    <label for="">اكتب استفسارك</label>
                    <textarea name="message" class="form-control" rows="4" placeholder="" required=""></textarea>
                  </div>
                  <div class="form-group mb-4">
                      <label for="">إرفاق مستندات</label>
                      <input type="file" name="attachments[]" class="form-control" multiple accept=".pdf,.doc,.docx,.jpg,.png">
                   </div>
                </div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                  >
                    اغلاق
                  </button>
                  <button type="submit" class="btn main-btn">
                    ارسال
                  </button>
                </div>
            </form>
          </div>
        </div>
      </div>

@endsection
@push('custom-js')
 <script>
    function copyToClipboard(id) {
        document.getElementById(id).select();
        document.execCommand('copy');
        $('.copy_txt').fadeIn(500);
        $(".copy_txt").fadeOut(700);
    }
    var submitButton = $(".add-to-cart");
    var loadingIndicator = $(".loading-indicator p");
    submitButton.prop("disabled", false);
    loadingIndicator.hide();

      $(document).on("click", ".add-to-cart", function () {
          var pid = $(this).attr('data-id');
          var pprice = $(this).attr('data-price');
          var route = $(this).attr('data-route');
            $.ajax({
              type: "POST",
              url: route,
              async: true,
              data: { _token: '{{csrf_token()}}', id: pid, price: pprice },
              beforeSend: function() {
                    submitButton.prop("disabled", true);
                    $(".loading-indicator p").show(); // Show loading indicator
                },
              success: function (data) {
                // console.log(data)
                if (data.errors) {
                } else if (data.data == false) {
                  toastr.error('site.already in cart')
                } else {
                  if(data == 2){
                    toastr.error('@lang('site.already reserved')')
                  }else{
                    toastr.success('@lang('site.add to cart')')
                    submitButton.prop("disabled", true); // Re-enable the submit button
                  }
                }
              },
                complete: function(xhr, status) {
                    console.log("Request completed.");
                    $(".loading-indicator p").hide(); // Hide the loading indicator
                    submitButton.prop("disabled", false); // Re-enable the submit button
                }
            });
        });
</script>
@endpush