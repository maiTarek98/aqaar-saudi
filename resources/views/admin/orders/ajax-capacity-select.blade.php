        <label >@lang('main.capacity')</label>
        <select  name="capacity_id[]" class="form-control capacity-select" data-product="{{$capacitys[0]->product_id}}">
        @foreach($capacitys as $value)
            <option value="{{$value->amount}}" data-product="{{$value->product_id}}">{{$value->amount}}</option>
        @endforeach
        </select>