@if($sales['sales']->count() > 0)
            <div class="header">
                <p>{{__('main.'.$period)}}</p>
                <p>{{$sales['sales']->count()}}</p>
                <p>إجمالي المبيعات : {{$sales['grand_total']}}</p>
                <table class="table mb-0 tbl-server-info text-center">
                    <thead>
                        <tr>
                            <th>order_no</th>
                            <th>store_name</th>
                            <th>products count</th>
                            <th>grand_total</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales['sales'] as $val)
                        <tr>
                            <td>{{$val->order_no}}</td>
                            <td>{{$val->store?->name}}</td>
                            <td>{{$val->carts?->count()}}</td>
                            <td>{{$val->grand_total}}</td>
                            <td>{{$val->status}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
@else
    <img>
    @lang('main.no recent result')
@endif