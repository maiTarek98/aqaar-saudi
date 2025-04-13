@if($sales['sales']->count() > 0)
            <div class="header">
                <p>{{__('main.'.$period)}}</p>
                <p>{{$sales['sales']->count()}}</p>
                <table class="table mb-0 tbl-server-info text-center">
                    <thead>
                        <tr>
                            <th>store_name</th>
                            <th>product_name</th>
                            <th>product_price</th>
                            <th>total_qty</th>
                            <th>total_revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales['sales'] as $val)
                        <tr>
                            <td>{{$val['store_name']}}</td>
                            <td>{{$val['product_name']}}</td>
                            <td>{{$val['product_price']}}</td>
                            <td>{{$val['total_qty']}}</td>
                            <td>{{$val['total_revenue']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
@else
    <img>
    @lang('main.no recent result')
@endif