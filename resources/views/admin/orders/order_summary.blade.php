<!-- Order products -->
<div class="all-products">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">المنتجات</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>المنتج</th>
                            <th>الكمية</th>
                            <th>الوزن</th>
                            <th>السعر</th>
                            <th>الاجمالي</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->carts as $cart)
                        <tr>
                            <td>
                                <div class="d-flex d-flex align-items-center gap-2">
                                    @if($cart->product?->getFirstMediaUrl('products_image','thumb'))
                                        <img loading="lazy" class="avatar" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $cart->product?->id }}"
                                        id="image" src="{{$cart->product?->getFirstMediaUrl('products_image','thumb')}}" style="width:70px;"
                                        alt="@lang('main.NoImageUploaded')">
                                        @include('admin.components.modal_photo', [
                                        'image' => $cart->product?->getFirstMediaUrl('products_image','thumb'),
                                        'id' => $cart->product?->id,
                                        ])
                                    @endif
                                    {{$cart->product?->name}}
                                </div>
                            </td>
                            <td>{{$cart->qty}}</td>
                            <td>-</td>
                            <td>{{$cart->price}} <span>@lang('main.egp')</span></td>
                            <td>{{$cart->total_price}} <span>@lang('main.egp')</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Order summary -->
<div class="card">
    <div class="card-header"> 
        <h4 class="card-title">
            @lang('main.orders.order summary')
        </h4>
    </div>
    <div class="card-body">
        <div class="d-flex gap-2 align-items-center justify-content-between border-bottom m-0 pb-3">
            <span>@lang('main.orders.payment_type') </span>
            <span>{{__('main.orders.'.$order->payment_type)}}</span>
        </div>
        <div class="d-flex gap-2 align-items-center justify-content-between border-bottom m-0 py-3">
            <span>@lang('main.orders.total_cart') </span>
            <span id="productsPrice">{{$order->total}} @lang('main.egp')</span>
        </div>
        <div class="d-flex gap-2 align-items-center justify-content-between m-0 
        @if($order->delegate_from_out != 'out_store') 
            border-bottom py-3 
        @else 
            py-2 
        @endif">

            <span>@lang('main.orders.delivery_price')</span>
            <div class="shipping" id="shipping"> {{$order->delivery_price}} @lang('main.egp')</div>
        </div>
        <div class="d-flex gap-2 align-items-center justify-content-between border-bottom m-0 py-3">
            <span>@lang('main.orders.applied coupon') </span>
            @if($order->coupon_id != null)
            <span id="productsPrice">{{$order->total}} @lang('main.egp')</span>
            @endif
            <div class="d-flex gap-2 align-items-center justify-content-between border-bottom m-0 py-3">
                <span>@lang('main.orders.discount_percentage')</span>
                <input type="number" id="discountInput" class="form-control w-25" min="0" max="100" value="0" 
                       oninput="calculateDiscount()" />
            </div>
            
        </div>
        
        <div class="d-flex gap-2 align-items-center justify-content-between m-0 pt-3">
            <span> @lang('main.orders.grand_price')</span>
            <span id="finalPrice"> {{$order->grand_total}} @lang('main.egp')</span>
        </div>
    </div>
</div>
<script type="text/javascript">
      function calculateDiscount() {
        let discountPercentage = parseFloat(document.getElementById("discountInput").value) || 0;
        let originalTotal = parseFloat({{$order->grand_total}}); 
        let discountAmount = (discountPercentage / 100) * originalTotal;
        let finalTotal = originalTotal - discountAmount;

        document.getElementById("finalPrice").innerText = finalTotal.toFixed(2) + " @lang('main.egp')";
    }
</script>