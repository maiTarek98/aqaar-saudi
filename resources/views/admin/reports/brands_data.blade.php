@if($sales['sales']->count() > 0)
<div class="card">
    <div class="card-header">
        <p class="m-0">
            <span>
                إجمالي المبيعات : {{$sales['sales']->sum('grand_total')}}
                {{__('main.'.$period)}}
            </span>
            <span>( {{$sales['sales']->count()}} )</span>
        </p>
    </div>
    <div class="card-body">
        <table class="table mb-0 tbl-server-info text-center">
                    <thead>
                        <tr>
                            <th>brand_name</th>
                            <th>grand_total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales['sales'] as $val)
                        <tr>
                            <td>{{ $val['brand_name'] }}</td>
                            <td>{{ number_format($val['grand_total'], 2) }} ريال</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
    </div>
</div>
@else
    <img>
    @lang('main.no recent result')
@endif