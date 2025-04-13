@if($sales['sales']->count() > 0)
            <div class="header">
                <p>{{__('main.'.$period)}}</p>
                <p>{{$sales['sales']->count()}}</p>
                <table class="table mb-0 tbl-server-info text-center">
                    <thead>
                        <th>اسم المتجر</th>
                        <th>اسم المنتج</th>
                        <th>إيرادات الدفع النقدي</th>
                        <th>إيرادات الدفع أونلاين</th>
                        <th>الإيرادات الإجمالية للمنتج</th>
                        <th>الإيرادات الإجمالية للمتجر (نقدي)</th>
                        <th>الإيرادات الإجمالية للمتجر (أونلاين)</th>
                        <th>الإيرادات الإجمالية للمتجر</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales['sales'] as $store)
                    <tr>
                        <td rowspan="{{ $store['products']->count() + 1 }}">{{ $store['store_name'] }}</td>
                    </tr>
                    @foreach($store['products'] as $product)
                    <tr>
                        <td>{{ $product['product_name'] }}</td>
                        <td>{{ number_format($product['cash_revenue'], 2) }} ريال</td>
                        <td>{{ number_format($product['online_revenue'], 2) }} ريال</td>
                        <td>{{ number_format($product['total_revenue'], 2) }} ريال</td>
                        @if ($loop->first)
                        <td rowspan="{{ $store['products']->count() }}">{{ number_format($store['cash_revenue'], 2) }} ريال</td>
                        <td rowspan="{{ $store['products']->count() }}">{{ number_format($store['online_revenue'], 2) }} ريال</td>
                        <td rowspan="{{ $store['products']->count() }}">{{ number_format($store['total_revenue'], 2) }} ريال</td>
                        @endif
                    </tr>
                    @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
@else
    <img>
    @lang('main.no recent result')
@endif