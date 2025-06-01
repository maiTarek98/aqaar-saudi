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
                            <div class="our-estates">
                                <div class="card border-0 estate-type">
                                    <div class="card-header py-3 bg-transparent">
                                        <h4 class="card-title">
                                           السعر الإجمالي للعقار :
                                          <span>{{$property->price}} <span>ريال</span></span>
                                        </h4>
                                    </div>
                                    <div class="card-body pb-4">
                                        <b>تم جمع {{$property->investment_collected}}</b>
                                        @php
                                            $progress = $property->price > 0 ? ($property->investment_collected / $property->price) * 100 : 0;
                                        @endphp
                                    
                                        <div class="progress w-75" role="progressbar" aria-valuenow="{{ $property->investment_collected }}" aria-valuemin="0" aria-valuemax="{{ $property->price }}" style="height: 12px">
                                          <div class="progress-bar bg-success" style="width: {{ $progress }}%"></div>
                                        </div>
                                    </div>
                                </div>
                                @if($property->investment_collected == $property->price)
                                    <div class="alert alert-success rounded-4 mt-3">
                                      تم جمع المبلغ بنجاح وانتهت المشاركة
                                    </div>
                                @else
                                
                                    @if(auth('web')->user()->id != $property->added_by && auth('web')->user()->delegatedForProduct($property->id)->doesntExist())
                            
                                        @php
                                        $minInvestmentAmount = null;
                                        if ($property->investment_min) {
                                            $minInvestmentAmount = $property->price * ($property->investment_min / 100);
                                        }
                                        @endphp
                                    <div class="card border-0 bg-transparent rounded-0">
                                      <div class="card-body py-3 gap-3">
                                        <div>
                                                                @if($property->status == 'pending')

                                          <form method="post" action="{{route('property.invest',$property->id)}}">
                                            @csrf
                                            <div class="d-flex flex-wrap align-items-center gap-3">
                                              <b class="mb-md-4">قيمة المشاركة</b>
                                              <div>
                                                <div class="input-group border">
                                                  <input type="number" @if(isset($minInvestmentAmount) && $property->investment_collected < 1 ) min="{{$minInvestmentAmount}}" @else min="1" @endif step="0.1" max="{{$property->price- $property->investment_collected}}" class="form-control" id="InputPassword" placeholder="{{$property->price- $property->investment_collected}}" name="amount" required>
                                                  <span type="button" class="input-group-text">
                                                    ريال
                                                  </span>
                                                </div>
                                               <small class="text-muted">
                                                    أدنى سعر للمزايدة {{ $minInvestmentAmount }} ريال
                                                 </small>
                                              </div>
                                              <button type="submit" class="main-outline-btn mb-4 text-center">
                                                شارك
                                              </button>
                                            </div>
                                          </form>
                                          @else
                                            <div class="alert-warning">انتهي العرض</div>
                                            @endif
                                        </div>
                                      </div>
                                    </div> 
                                    @endif
                                @endif
                                <div class="card mt-4 border-0 estate-history">
                                  <div class="card-header py-3 bg-transparent">
                                    <h4 class="card-title">سجل المشاركات :</h4>
                                  </div>
                                  <div class="card-body py-0">
                                    @if($property->investments->count() > 0)
                                    <table class="table m-0">
                                      <thead>
                                        <th>اسم المستخدم</th>
                                        <th>قيمة المشاركة</th>
                                        <th>التاريخ</th>
                                      </thead>
                                      <tbody>
                                        @foreach($property->investments as $value)
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
                                @include('site.includes.user-card-section',['property' => $property])
                            </div> 
                        </div>
                    </div>
                <!--</div>-->
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
                        
                        @if($property->status == 'pending' && auth('web')->user()->user_type == 'other' && auth('web')->user()->id != $property->added_by && (! $property->property_delegations->where('status', 'approved')->pluck('agent_id')->contains(auth('web')->id())))
                        <button
                          class="main-outline-btn text-center w-100"
                          data-bs-toggle="modal"
                          data-bs-target="#estateModal"
                        >
                          إرسال خطاب
                        </button>
                        @endif
                        @if(auth('web')->user()->user_type == 'other' && auth('web')->user()->id != $property->added_by && $property->feature?->represented_by == 'owner' && (! $property->property_delegations->where('status', 'approved')->pluck('agent_id')->contains(auth('web')->id())))

                        @if ($property->status == 'pending')
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