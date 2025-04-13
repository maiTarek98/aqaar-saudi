<input type="number" name="admin_id" value="{{ Auth::guard('admin')->user()->id }}" class="form-control" hidden>

<div class="form-group col-sm-10">
    <label for="banner_name"> @lang('main.BannerName')</label>
    <input type="text" name="banner_name" value="{{ old('banner_name', $banner->banner_name) }}" class="form-control @error('banner_name') is-invalid @enderror"
        id="banner_name" placeholder="@lang('main.EnterBannerName')">
</div>


<div class="form-group col-sm-10">
    <label for="banner_image">@lang('main.BannerImage')</label>

    <div class="input-group mb-2">
        <input type="file" name="banner_image" id="banner_image" class="custom-file-input @error('banner_image') is-invalid @enderror"
            onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
        <label class="custom-file-label" for="banner_image">{{ trans('main.UploadBannerImage') }}</label>
    </div>
    <div class="col-sm-6">
        @if ($banner->banner_image != null)
            <img class="cursor-img" data-toggle="modal" data-target="#exampleModal{{ $banner->id }}" id="image"
                src="{{ url("$banner->banner_image") }}" style="width:7%;" alt="@lang('main.NoImageUploaded')">
            @include('admin.components.modal_photo', [
                'image' => url("$banner->banner_image"),
                'id' => $banner->id,
            ])
        @else
            <img id="image" src="{{ url('dashboard/dist/dist/img/no-photo.png') }}" style="height: 80px; width: 100px;">
        @endif
    </div>
</div>

<div class="form-group col-sm-10">

    <button type="submit" class="btn btn-success">@lang('main.save')</button>
</div>
