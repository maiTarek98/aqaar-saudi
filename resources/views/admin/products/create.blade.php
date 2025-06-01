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
        
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form id="ajaxAddUserForm" method="POST">
              @csrf
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addUserModalLabel">إضافة مستخدم جديد</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger d-none" id="addUserErrors"></div>
                    <input type="hidden" name="account_type" value="users">
        
                    <div class="mb-3">
                        <label>الاسم</label>
                        <input type="text" id="main-name" name="name" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label>رقم الجوال</label>
                        <input type="text" id="main-mobile" name="mobile" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label>كلمة المرور</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-main">حفظ</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                </div>
              </div>
            </form>
          </div>
        </div>

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