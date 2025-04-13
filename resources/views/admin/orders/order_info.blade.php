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
                        <div class="contant copy-text">
                            <input type="hidden" class="text" value="david@stylus.co.za">
                            <button class="bg-transparent border-0 p-0"><i class="fa fa-clone"></i></button>
                        </div>
                        {{--<a href="https://api.whatsapp.com/send?phone={{$order->user_address?->mobile }}" class="contant">
                            <i class="bi bi-whatsapp"></i>
                        </a>--}}
                        <a href="{{url('/admin/chat/?user_id='.$order->user_id)}}" class="contant">
                            <i class="bi bi-chat-left-text"></i>
                        </a>
                        <a href="mailto:{{$order->user_address?->email}}" class="contant">
                            <i class="bi bi-envelope"></i>
                        </a>
                        <a href="tel:{{$order->user_address?->mobile}}" class="contant">
                            <i class="bi bi-telephone"></i>
                        </a>
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
                @if(!$order->payment_type)
                @else
                    <span>@lang('main.orders.no paid')</span>
                @endif
            </div>
        </div>
    </div>
</div>