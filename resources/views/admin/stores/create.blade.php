@extends('admin.index')
@section('content')
  <div class="content-wrapper">
    <div class="container-fluid add-form-list">
      <div class="content-header">
        {{-- search part --}}
        @include('admin.partials.breadcrumb')
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            @include('admin.layouts.alerts')
            <div class="card-body">
              <form data-toggle="validator" class="from-prevent-multiple-submits" method="post" action="{{ route($model.'.store',['parent_id' => request('parent_id')]) }}" enctype="multipart/form-data">
                @csrf
                @include('admin.'.$model.'.form')
              </form>
                        
              <!-- Modal -->
              <div class="modal fade" id="acceptVendor" tabindex="-1" aria-labelledby="acceptVendorLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="acceptVendorLabel">@lang('main.stores.create new vendor')</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form method="post" action="{{ route('users.store') }}">
                      <div class="modal-body">
                          <div class="user-errors alert alert-danger d-none"></div>
                        @csrf
                        <input type="hidden" name="account_type" value="vendors">
                        <input type="hidden" name="added_by" value="{{auth('admin')->user()->id}}">

                        <div class="row g-3">
                          <div class="col-12">
                            <div class="form-group">
                              <label for="name"> @lang('main.vendors.name')</label><span class="text-danger">*</span>
                              <input type="text" name="name" value="{{ old('name') }}" class="form-control  @error('name') is-invalid @enderror" id="name" placeholder="@lang('main.users.name')">
                            </div>
  
                          </div>
                          <div class="col-12">
                            <div class="form-group">
                              <label for="mobile"> @lang('main.vendors.mobile')</label><span class="text-danger">*</span>
                              <input type="text" maxlength="10" name ="mobile" value="{{ old('mobile') }}" class="form-control  @error('mobile') is-invalid @enderror" id="mobile" placeholder="@lang('main.users.mobile')">
                            </div>
  
                          </div>
                          <div class="col-12">
                            <div class="form-group">
                              <label for="email"> @lang('main.vendors.email')</label><span class="text-danger">*</span>
                              <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="@lang('main.users.email')">
                            </div>
  
                          </div>
                        
                          <div class="col-12">
                            <div class="form-group">
                              <label for="password"> @lang('main.password')</label><span class="text-danger">*</span>
                              <div class="input-group">
                                <input type="password" name="password" value="" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="@lang('main.users.password')">
                                <button type="button" class="pass input-group-text" toggle="#password">
                                    <i class="bi bi-lock"></i>
                                </button>
                              </div>
                            </div>
  
                          </div>
                          
                        </div>

                        <input type="hidden" name="roles_name[0]" value="vendor"/>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('main.close')</button>
                        <button type="submit" class="btn btn-primary">@lang('main.save changes')</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            @if (Cache::get('store_created'))
              <script>
                document.addEventListener('DOMContentLoaded', function() {
                  new bootstrap.Modal(document.getElementById('storeCreatedModal')).show();
                });
              </script>
            @endif

            <!-- Modal HTML -->
            <div class="modal fade" id="storeCreatedModal" tabindex="-1" aria-labelledby="storeCreatedModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="storeCreatedModalLabel">@lang('main.stores.Store Created Successfully')</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" 
   onclick="clearCacheBeforeRedirect(event, '{{ route('stores.create') }}')"></button>
                        </div>
                        <div class="modal-body">
                            <p>@lang('main.stores.what would you like to do next')</p>
                            <div class="d-flex justify-content-around">
                                <a href="{{ route('products.create',['store_id' => session('store_id')]) }}" class="btn btn-primary">@lang('main.stores.Add New Product')</a>
<a href="{{ route('stores.create') }}" class="btn btn-secondary"
   onclick="clearCacheBeforeRedirect(event, '{{ route('stores.create') }}')">
   @lang('main.stores.Add Another Store')
</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    $('#acceptVendor form').on('submit', function (e) {
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
          $('#acceptVendor').modal('hide');
console.log(response)
          const newVendor = `<option value="${response.id}" selected>${response.name}</option>`;
          $('select[name="user_id"]').append(newVendor);
          alert('Vendor created and added to the list successfully!');
        },
        error: function (xhr) {
          if (xhr.status === 500) {
            let errors = xhr.responseJSON;
            
            console.log(errors)
            $('.user-errors').removeClass('d-none');
            $('.user-errors').html(${errors[message]})
          } else {
            alert('An error occurred. Please try again.');
          }
        }
      });
    });
  });
    function clearCacheBeforeRedirect(event, url) {
        event.preventDefault(); // منع الانتقال الفوري
        fetch("{{ route('cache.clear.store_created') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
        }).then(() => {
            window.location.href = url; // توجيه المستخدم بعد حذف الكاش
        }).catch(error => console.error("Error clearing cache:", error));
    }
</script>
@endpush