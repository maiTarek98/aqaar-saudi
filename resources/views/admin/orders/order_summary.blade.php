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
                            <th>@lang('main.products.product_name')</th>
                            <th>@lang('main.products.qty')</th>
                            <!--<th>الوزن</th>-->
                            <th>@lang('main.products.product_price')</th>
                            <th>@lang('main.products.total')</th>
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
                                    <a href="{{route('products.show',$cart->product_id)}}">{{$cart->product?->name}}</a>
                                </div>
                            </td>
                            <td>{{$cart->qty}}</td>
                            <!--<td>-</td>-->
                            <td>{{$cart->price}} <span>@lang('main.egp')</span></td>
                            <td>{{$cart->total_price}} <span>@lang('main.egp')</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if($order->wallet_transaction?->type == 'deposit' || $order->reason != null)
    <div class="card bg-success bg-opacity-10 my-3">
        <div class="card-header">
            <h3 class="card-title">المنتجات المسلمة</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>@lang('main.products.product_name')</th>
                            <th>@lang('main.products.qty')</th>
                            <!--<th>الوزن</th>-->
                            <th>@lang('main.products.product_price')</th>
                            <th>@lang('main.products.total')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->completed() as $cart)
                        <tr>
                            @php $product = \App\Models\Product::where('id',$cart['product_id'])->first(); @endphp
                            <td>
                                <div class="d-flex d-flex align-items-center gap-2">
                                    @if($product->getFirstMediaUrl('products_image','thumb'))
                                        <img loading="lazy" class="avatar" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $product->id }}"
                                        id="image" src="{{$product->getFirstMediaUrl('products_image','thumb')}}" style="width:70px;"
                                        alt="@lang('main.NoImageUploaded')">
                                        @include('admin.components.modal_photo', [
                                        'image' => $product->getFirstMediaUrl('products_image','thumb'),
                                        'id' => $product->id,
                                        ])
                                    @endif
                                    <a href="{{route('products.show',$product->id)}}">{{$product->name}}</a>
                                </div>
                            </td>
                            <td>{{$cart['received_qty']}}</td>
                            <!--<td>-</td>-->
                            <td>{{$product->real_price}} <span>@lang('main.egp')</span></td>
                            <td>{{$product->real_price * $cart['received_qty']}} <span>@lang('main.egp')</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="card bg-danger bg-opacity-10">
        <div class="card-header">
            <h3 class="card-title">المنتجات المرتجعة</h3>
            <small>@lang('main.orders.return_date'): {{$order->order_returns->first()->created_at}}</small>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>@lang('main.products.product_name')</th>
                            <th>@lang('main.products.qty')</th>
                            <!--<th>الوزن</th>-->
                            <th>@lang('main.products.product_price')</th>
                            <th>@lang('main.products.total')</th>
                            <th>@lang('main.orders.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->order_returns as $cart)
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
                                    <a href="{{route('products.show',$cart->product_id)}}">{{$cart->product?->name}}</a>
                                </div>
                            </td>
                            <td>{{$cart->qty}}</td>
                            <!--<td>-</td>-->
                            <td>{{$cart->product?->real_price}} <span>@lang('main.egp')</span></td>
                            <td>{{$cart->product?->real_price * $cart->qty}} <span>@lang('main.egp')</span></td>
                            
                            <td>
                                            
                                <form action="{{ route('store.returns.process', $cart->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" name="status" value="approve" class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Approve">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                    
                                    <button type="submit" name="status" value="reject" class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Reject">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                    
                                    <button type="submit" name="status" value="exchange" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Exchange">
                                        <i class="bi bi-arrow-left-right"></i>
                                    </button>

                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <p class="m-0 fw-bold">@lang('main.orders.return_reason'): {{$order->reason}}</p>  
        </div>
    </div>
    @endif
</div>
<!-- Order summary -->
<div class="card mt-3">
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
            <div class="shipping" id="shipping"> {{$order->delivery_price}} @lang('main.egp')
            </div>
        </div>
        @if($order->status == 'pending')
        <div class="border-bottom m-0 py-3">
            <div class="d-flex gap-2 align-items-center justify-content-between">
                <span>@lang('main.orders.applied coupon') </span>
                @if($order->coupon_id != null)
                <span id="productsPrice">{{$order->total}} @lang('main.egp')</span>
                @endif
            </div>
            <div class="card basic mt-2">
                <div class="card-body">
                    <form method="post" action="{{route('orders.applyDiscount', $order->id)}}">
                        @csrf
                        <input name="discount_value" type="hidden" value="" id="price_after_discount">
                        <div class="row g-2 align-items-center">
                            <div class="col-12">
                                <label class="mb-0">@lang('main.orders.discount_percentage')</label>
                            </div>
                            <div class="col">
                                <input type="number" name="discount" id="discountInput" class="form-control" min="0" max="100" value="{{$order->order_discount??0}}" 
                                       oninput="calculateDiscount()" />
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-outline-primary">@lang('main.orders.apply discount')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
        <div class="d-flex gap-2 align-items-center justify-content-between m-0 pt-3">
            <span> @lang('main.orders.grand_price')</span>
                @if($order->coupon_id != null)
                <span>@lang('main.orders.applied coupon code'): {{$order->coupon?->coupon_code}}</span>
                <span>@lang('main.orders.applied coupon'): {{$order->coupon?->coupon_discount?->discount_value}} {{__('main.orders.'.$order->coupon?->coupon_discount?->discount_type)}}</span>
                @endif
            <span id="finalPrice"> @if($order->discount_total && $order->applied_coupon > 0) {{$order->applied_coupon}}  @lang('main.egp') <span class="text-muted text-decoration-line-through">{{$order->grand_total}}  @lang('main.egp')</span>
                @elseif($order->discount_total) {{$order->discount_total}}  @lang('main.egp') <span class="text-muted text-decoration-line-through">{{$order->grand_total}}  @lang('main.egp')</span>
            @else {{$order->grand_total}} @lang('main.egp') @endif </span>
        </div>
    </div>
</div>
<script type="text/javascript">
      function calculateDiscount() {
        let discountPercentage = parseFloat(document.getElementById("discountInput").value) || 0;
        let originalTotal = parseFloat({{$order->grand_total}}); 
        let discountAmount = (discountPercentage / 100) * originalTotal;
        let finalTotal = originalTotal - discountAmount;

        document.getElementById("price_after_discount").value = finalTotal.toFixed(2);
        document.getElementById("finalPrice").innerText = finalTotal.toFixed(2) + " @lang('main.egp')";
    }
</script>