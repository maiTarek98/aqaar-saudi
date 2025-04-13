@extends('admin.index')
@section('content')
  <div class="content-wrapper">
    <div class="container-fluid add-form-list">
      <div class="content-header">
        {{-- search part --}}
        @include('admin.partials.breadcrumb')
      </div>
      <div class="content">
        @include('admin.layouts.alerts')
        <!-- <div class="card-body"> -->
        <form data-toggle="validator" class="from-prevent-multiple-submits"  method="post" action="{{ route('products.store',['parent_id' => request('parent_id')]) }}" enctype="multipart/form-data">
          @csrf
          @include('admin.products.form')
        </form>
        @if(auth('admin')->user()->account_type != 'vendors' && auth('admin')->user()->account_type != 'subadmins')
        <!-- Modal -->
        <div class="modal fade" id="addNewCategory" tabindex="-1" aria-labelledby="addNewCategoryLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addNewCategoryLabel">@lang('main.add new category')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="post" action="{{ route('categorys.store') }}">
                <div class="modal-body">
                  @csrf
                  <input type="number" name="added_by" value="{{ id('admin') }}" class="form-control" hidden>
                  <input type="text" name="status" value="show" class="form-control" hidden>
                  <input type="text" name="in_home" value="yes" class="form-control" hidden>
                  <input type="text" name="title_en" value="add_{{id('admin') + 1}}" class="form-control" hidden>
                  <div class="form-group">
                    <label>@lang('main.categorys.title') (@lang('main.ar')) <span class="text-danger">*</span></label>
                    <input type="text" name="title_ar" value="{{ old('title_ar') }}" class="form-control @error('title_ar') is-invalid @enderror" id="title_ar" placeholder="" required>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('main.close')</button>
                  <button type="submit" class="btn btn-primary">@lang('main.save changes')</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNewBrand" tabindex="-1" aria-labelledby="addNewBrandLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addNewBrandLabel">@lang('main.add new brand')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
                      <form method="post" action="{{ route('brands.store') }}">

              <div class="modal-body">
                    @csrf
              <input type="number" name="added_by" value="{{ id('admin') }}" class="form-control" hidden>
              <input type="text" name="status" value="show" class="form-control" hidden>
              <input type="text" name="in_home" value="yes" class="form-control" hidden>
              <input type="text" name="title_en" value="add_{{id('admin') + 1}}" class="form-control" hidden>

            <div class="col-md-6">                      
                <div class="form-group">
                    <label>@lang('main.brands.title') (@lang('main.ar')) <span class="text-danger">*</span></label>
                    <input type="text" name="title_ar" value="{{ old('title_ar') }}" class="form-control @error('title_ar') is-invalid @enderror" id="title_ar" placeholder="" required>
                    <div class="help-block with-errors"></div>
                </div>
            </div>


              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('main.close')</button>
                <button type="submit" class="btn btn-primary">@lang('main.save changes')</button>
              </div>
                      </form>

            </div>
          </div>
        </div>
        @endif

      </div>
      <!-- Page end  -->
    </div>
  </div>
@endsection

@push('custom-js')
<script>
  $(document).ready(function () {
    $('#addNewCategory form').on('submit', function (e) {
      e.preventDefault();
      let formData = new FormData(this);
      $(this).find('.is-invalid').removeClass('is-invalid');
      $(this).find('.invalid-feedback').remove();
      $.ajax({
        url: $(this).attr('action'), 
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          $('#addNewCategory').modal('hide');
          console.log(response)
          const newCategory = `<option value="${response.id}" selected>${response.title}</option>`;
          $('select[name="category_id"]').append(newCategory);
          alert('Vendor created and added to the list successfully!');
        },
        error: function (xhr) {
          if (xhr.status === 422) {
            let errors = xhr.responseJSON.errors;
            for (let key in errors) {
              let input = $(`[name="${key}"]`);
              input.addClass('is-invalid');
              input.after(`<div class="invalid-feedback">${errors[key][0]}</div>`);
            }
          } else {
            alert('An error occurred. Please try again.');
          }
        }
      });
    });

    $('#addNewBrand form').on('submit', function (e) {
      e.preventDefault();
      let formData = new FormData(this);
      $(this).find('.is-invalid').removeClass('is-invalid');
      $(this).find('.invalid-feedback').remove();
      $.ajax({
        url: $(this).attr('action'), 
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          $('#addNewBrand').modal('hide');
          console.log(response)
          const newBrand = `<option value="${response.id}" selected>${response.title}</option>`;
          $('select[name="brand_id"]').append(newBrand);
          alert('Vendor created and added to the list successfully!');
        },
        error: function (xhr) {
          if (xhr.status === 422) {
            let errors = xhr.responseJSON.errors;
            for (let key in errors) {
              let input = $(`[name="${key}"]`);
              input.addClass('is-invalid');
              input.after(`<div class="invalid-feedback">${errors[key][0]}</div>`);
            }
          } else {
            alert('An error occurred. Please try again.');
          }
        }
      });
    });
  });
</script>
@endpush