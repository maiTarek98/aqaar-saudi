
<div class="form-group mb-3">
    <label for="label_name"> @lang('main.dynamic_features.label_name')</label>
    <input type="text" name="label_name" value="{{ old('label_name', $dynamic_feature->label_name) }}" class="form-control @error('label_name') is-invalid @enderror"
        id="label_name" placeholder="">
</div>

<button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm"><i class="fa-regular fa-floppy-disk"></i> @lang('main.save') </button>
