@if($category->count() > 0)
<div class="form-group subcategory">
    <label for="subcategory_id"> @lang('main.products.subcategory')<span class="text-danger">*</span></label>
    <select name="subcategory_id" id="subcategoryid" onChange="getproducts(this.value);" class="form-control subcategory">
        <option value="">@lang('main.choose')</option>
        @foreach($category as $value)
            <option value="{{$value->id}}" @if(!$product) @if($value->id == old('subcategory_id')) selected @endif @else @if($value->id == old('subcategory_id', $product->subcategory_id)) selected @endif @endif >{{$value->title}}</option>
        @endforeach
    </select>
</div>
@endif