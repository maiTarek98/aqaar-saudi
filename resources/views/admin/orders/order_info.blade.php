<div class="row g-3 my-4">
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header d-flex gap-2">
                <h4 class="card-title">العميل</h4>
                <select name="client_options" id="client_options" class="select2 form-select w-auto">
                    <option value="">خيارات العميل</option>
                    <option value="1">طلبات العميل</option>
                    <option value="2">حظر العميل</option>
                    <option value="3">نسخ رابط التقييم</option>
                </select>
            </div>
            <div class="card-body">
                <div class="d-flex gap-3">
                    <div class="user-img">
                        @if($order->user?->getFirstMediaUrl('photo_profile','thumb'))
                        <img loading="lazy" class="avatar" src="{{$order->user->getFirstMediaUrl('photo_profile','thumb')}}" alt="{{$order->user?->name}}" id="photo">
                        @else
                        <img loading="lazy" class="avatar" src="{{url('site/images/profile_user_avatar_icon.webp')}}" alt="{{$order->user?->name}}" id="photo">
                        @endif
                    </div>
                    <div class="user-date-wrapper d-flex flex-column gap-2">
                        <h5 class="user-name">{{$order->user?->name}}</h5>
                        @if ($order->user_address?->mobile)
                        <a href="tel:{{$order->user_address?->mobile}}" class="user-phone">+01{{$order->user_address?->mobile }}</a>
                        @endif
                        <div class="user-contacts d-flex  gap-3">
                        <div class="contant copy-text p-0 border-0">
                            <input type="hidden" class="text" value="david@stylus.co.za">
                            <button class="bg-transparent border-0 p-0"><i class="fa fa-clone text-dark"></i></button>
                        </div>
                        {{--<a href="https://api.whatsapp.com/send?phone={{$order->user_address?->mobile }}" class="contant">
                            <i class="bi bi-whatsapp"></i>
                        </a>--}}
                        <a href="{{url('/admin/chat/?user_id='.$order->user_id)}}" class="contant">
                            <i class="bi bi-chat-left-text"></i>
                        </a>
                        @if($order->user?->email)
                        <a href="mailto:{{$order->user?->email}}" class="contant">
                            <i class="bi bi-envelope"></i>
                        </a>
                        @endif
                        @if($order->user?->mobile)
                        <a href="tel:{{$order->user?->mobile}}" class="contant">
                            <i class="bi bi-telephone"></i>
                        </a>
                        @endif
                        </div>
                        <div class="user-completed-order">
                        <i class="bi bi-cart"></i>
                        <span>{{$order->user?->completed_order}} طلب مكتمل</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header">
                <h4 class="card-title">الشحن</h4>
            </div>
            <div class="card-body">
                
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header">
                <h4 class="card-title">@lang('main.orders.payment')</h4>
            </div>
            <div class="card-body">
                @if($order->payment_type != null)
        <div class="d-flex gap-2 align-items-center justify-content-between border-bottom m-0 pb-3 mb-3">
            <span>@lang('main.orders.payment_type') </span>
            <span>{{__('main.orders.'.$order->payment_type)}}</span>
        </div>
                                <button type="button" id="statusButton" class="status-tag pending border-0" data-bs-toggle="modal" data-bs-target="#orderShippingModal">
                                <i class="highlight" style="--iteration-count: infinite;"></i>
                                    <p class="status-tag__txt">تعديل</p>
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                                <div class="modal fade" id="orderShippingModal" tabindex="-1" aria-labelledby="orderShippingModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="orderShippingModalLabel">#{{$order->order_no}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="form-group mb-2">
                                            <label>@lang('main.orders.choose status') </label>
                                            <select name="status" id="status" class=" form-select">
                                                <option value="">@lang('main.choose')</option>
                                                <option value="paid">{{__('main.orders.paid')}}</option>
                                                <option value="notpaid">{{__('main.orders.notpaid')}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('main.orders.notes') </label>
                                            <textarea name="notes" placeholder="@lang('main.orders.write notes')" class="form-control"></textarea>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('main.close')</button>
                                        <button type="button" id="saveChangesButton" class="btn btn-primary">@lang('main.save changes')</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                @else
                    <span>@lang('main.orders.no paid')</span>
                @endif
            </div>
        </div>
    </div>
</div>