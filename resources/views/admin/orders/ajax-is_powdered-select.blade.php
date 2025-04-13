        <label >@lang('main.apply powder')</label>
        <select  name="is_powdered[]" class="form-control is_powdered-select" data-product="{{$is_powdered->id}}">
            <option value="1" data-product="{{$is_powdered->id}}">@lang('site.yes')</option>
            <option value="0" data-product="{{$is_powdered->id}}">@lang('site.no')</option>
        </select>