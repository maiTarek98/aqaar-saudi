<div class="row g-3"> 
 
<div class="col-md-6">                      
        <div class="form-group">
            <label class="float-start">@lang('main.locations.name') (@lang('main.ar')) <span class="text-danger">*</span></label>
            <input type="text" name="name_ar" value="{{ old('name_ar', $item->name_ar) }}" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar" placeholder="" required>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-6">                      
        <div class="form-group">
            <label class="float-start">@lang('main.locations.name') (@lang('main.en')) <span class="text-danger">*</span></label>
            <input type="text" name="name_en" value="{{ old('name_en', $item->name_en) }}" class="form-control @error('name_en') is-invalid @enderror" id="name_en" placeholder="" required>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    @if(request()->route()->getName() == 'locations.create')
    <div class="col-md-6">                      
        <div class="form-group">
            <label class="float-start">@lang('main.locations.type') <span class="text-danger">*</span></label>
            <select class="form-control" id="type" name="type" required>
                <option value="governorate" {{ old('type') == 'governorate' ? 'selected' : '' }}>@lang('main.locations.governorate')</option>
                <option value="city" {{ old('type') == 'city' ? 'selected' : '' }}>@lang('main.locations.city')</option>
                <option value="district" {{ old('type') == 'district' ? 'selected' : '' }}>@lang('main.locations.district')</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">                      
        <div class="form-group">
            <label for="parent_id"> @lang('main.locations.belongs to') :</label>
            <select class="form-control" name="parent_id">
                <option value="">@lang('main.choose')</option>
                @foreach(\App\Models\Location::get() as $value)
                <option value="{{$value->id}}" @if($value->id == $item->parent_id) selected @endif>{{$value->name}}</option>
                @endforeach
            </select>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    @endif
    @if(request()->route()->getName() == 'locations.edit')
    <div class="col-md-12">
        <h5 class="fs-6 fw-bold mb-3">المدن التابعة:</h5>
        @foreach($cities as $city)
        <div class="card basic mb-3">
            <div class="card-body">
                <div class="form-group">
                    <div class="row g-3"> 
                        <div class="col-md-6">
                            <label>اسم المدينة: (@lang('main.ar'))</label>
                            <input type="text" name="cities[{{ $city->id }}][name_ar]" class="form-control" value="{{ $city->name_ar }}">
                        </div>
                        <div class="col-md-6">
                            <label>اسم المدينة: (@lang('main.en'))</label>
                            <input type="text" name="cities[{{ $city->id }}][name_en]" class="form-control" value="{{ $city->name_en }}">
                        </div>
                    </div>
                </div>
                
                @if ($districts->where('parent_id', $city->id)->count() > 0)
                <h6 class="fs-6 fw-bold my-3">المناطق التابعة للمدينة:</h6>
                <div>
                    <span>(@lang('main.ar'))</span>
                    <ul class="d-flex align-items-center gap-1 mt-1">
                        @foreach($districts->where('parent_id', $city->id) as $district)
                            <li>
                                <input type="text" name="districts[{{ $district->id }}][name_ar]" class="form-control" value="{{ $district->name_ar }}">
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <span>(@lang('main.en'))</span>
                    <ul class="d-flex align-items-center gap-1 mt-1">
                        @foreach($districts->where('parent_id', $city->id) as $district)
                            <li>
                                <input type="text" name="districts[{{ $district->id }}][name_en]" class="form-control" value="{{ $district->name_en }}">
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>                            
<div class="order-action mt-4 d-flex gap-3">                
    <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm"><i class="fa-regular fa-floppy-disk"></i> @lang('main.save')</button>
    <button type="reset" class="btn btn-danger px-5 rounded-pill shadow-sm"><i class="fa-solid fa-rotate-left"></i> @lang('main.reset')</button>
</div>

@push('custom-js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const typeSelect = document.getElementById('type');
        const parentDiv = document.querySelector('select[name="parent_id"]').closest('.form-group');
        const parentSelect = document.querySelector('select[name="parent_id"]');

        const allOptions = [...parentSelect.options];
        const location = @json(\App\Models\Location::all()->keyBy('id')); 

        function filterParentOptions(type) {
            if (type === 'governorate') {
                parentDiv.style.display = 'none';
                parentSelect.innerHTML = '';
                parentSelect.removeAttribute('required');
            } else {
                parentDiv.style.display = 'block';
                parentSelect.innerHTML = '<option value="">اختر</option>';
                parentSelect.setAttribute('required', 'required');

                allOptions.forEach(option => {
                    if (option.value === '') return;

                    let item = location[option.value];
                    if (!item) return;

                    if (type === 'city' && item.type === 'governorate') {
                        parentSelect.appendChild(option.cloneNode(true));
                    } else if (type === 'district' && item.type === 'city') {
                        parentSelect.appendChild(option.cloneNode(true));
                    }
                });
            }
        }

        filterParentOptions(typeSelect.value);
        typeSelect.addEventListener('change', function () {
            filterParentOptions(this.value);
        });
    });
</script>

@endpush
