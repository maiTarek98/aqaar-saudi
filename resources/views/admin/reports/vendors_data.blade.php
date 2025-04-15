@if($sales['sales']->count() > 0)
    @include('admin.partials.search_part', ['route' => route('reports.index') ,'type' => 'vendors', 'report_period' => $period])
    <div class="card">
        <div class="card-header">
            <p class="m-0">
                <span>
                    إجمالي المبيعات علي المنتحات المباعة بالفعل
                    {{__('main.'.$period)}}
                </span>
                <span>( {{$sales['sales']->count()}} )</span>
            </p>
        </div>
        <div class="card-body">
            <table class="table mb-0 tbl-server-info text-center">
                    <thead>
                        <tr>
                            <th>vendor_name</th>
                            <th>store_name</th>
                            <th>product name</th>
                            <th>qty</th>
                            <th>price of product</th>
                            <th>grand_total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales['sales'] as $val)
                        @foreach($val->store->products as $prod)
                        <tr>
                            <td>{{$val->name}}</td>
                            <td>{{$val->store?->name}}</td>
                            <td>{{$prod->name}}</td>
                             <td>
                                @php
                                    $totalQty = 0;
                                    $totalPrice = 0;
                                    foreach ($val->store->orders as $order) {
                                        foreach ($order->carts as $cart) {
                                            if ($cart->product_id == $prod->id) {
                                                $totalQty += $cart->qty;
                                                $totalPrice += ($cart->qty*$cart->price); 
                                            }
                                        }
                                    }
                                @endphp
                                {{$totalQty}}
                            </td>
                            <td>
                                @if($prod->real_price == $prod->price)
                                {{$prod->real_price}}
                                @else
                                {{$prod->price}} {{$prod->real_price}}
                                @endif
                            </td>
                            <td>{{$totalPrice}}</td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
@else
    <img>
    @lang('main.no recent result')
@endif