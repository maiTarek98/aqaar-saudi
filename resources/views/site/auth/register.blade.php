@extends('site.index')
@section('title', trans('site.register'))
@section('content')
<!-- login  -->
    <section class="login">
      <div class="main-section row g-0">
        <div class="sticky-side col-md-5">
          <div class="container-fluid">
            <div class="py-4">
              <div class="login-logo">
                <img loading="lazy" src="{{ url('/storage/' . app(App\Models\GeneralSettings::class)->favicon) }}"
                alt="{{ app(App\Models\GeneralSettings::class)->site_name() }}" />

              </div>
  
              <h5 class="fw-bold fs-4 my-5 secondary">
                إنشاء حساب 
              </h5>
  
            <form method="POST" id="register-form">
                @csrf
                <div class="form-group mb-4">
                    <label for="">الاسم <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="@lang('site.name')" value="{{ old('name') }}">
                    <span class="text-danger error-msg name"></span>
                </div>
                <div class="form-group mb-4">
                    <label for="">رقم الهاتف <span class="text-danger">*</span></label>
                    <input type="text" name="mobile" class="form-control" placeholder="@lang('site.mobile')" value="{{ old('mobile') }}">
                    <span class="text-danger error-msg mobile"></span>
                </div>
                <div class="form-group mb-4">
                    <label for="">نوع المستخدم <span class="text-danger">*</span></label>
                    <select name="user_type" class="form-select" placeholder="@lang('site.user_type')" value="{{ old('user_type') }}">
                        <option value="owner">@lang('main.users.owner')</option>
                        <option value="agent">@lang('main.users.agent')</option>
                        <option value="co-owner">@lang('main.users.co-owner')</option>
                        <option value="other">@lang('main.users.other')</option>
                    </select>
                    <span class="text-danger error-msg user_type"></span>
                </div>
                <div class="form-group mb-4">
                    <label for="">رقم الهوية <span class="text-danger">*</span></label>
                    <input type="text" maxlength="10" pattern="[1-2][0-9]{9}" name="id_number" value=""class="form-control @error('id_number') is-invalid @enderror" id="id_number" placeholder="@lang('main.users.id_number')">
                    <span class="text-danger error-msg id_number"></span>
                </div>

                <div class="form-group mb-4" id="agency_number_wrapper" style="display:none">
                    <label for="">@lang('main.users.agency_number') <span class="text-danger">*</span></label>
                    <input type="text" maxlength="10" pattern="[1-2][0-9]{9}" name="agency_number" value=""class="form-control @error('agency_number') is-invalid @enderror" id="agency_number" placeholder="@lang('main.users.agency_number')">
                    <span class="text-danger error-msg agency_number"></span>
                </div>


                <div class="form-group mb-4">
                  <label for="">كلمة المرور <span class="text-danger">*</span></label>
                  <div class="input-group border mb-3">
                    <input type="password" id="InputPassword" name="password" class="form-control" placeholder="@lang('site.password')">
                    <button
                      type="button"
                      class="input-group-text fs-4 pass"
                      title="show pass"
                      aria-label="اظهار كلمة المرور"
                    >
                      <i class="bi bi-lock"></i>
                    </button>
                    <span class="text-danger error-msg password"></span>
                  </div>
                </div>

                <div class="form-group mb-4">
                  <label for="">تأكيد كلمة المرور <span class="text-danger">*</span></label>
                  <div class="input-group border mb-3">
                    <input
                    type="password" name="password_confirmation"
                    class="form-control"
                    id="InputConfirmPassword"
                    placeholder="تأكيد كلمة المرور"
                    required
                    />
                    <button
                      type="button"
                      class="input-group-text fs-4 pass"
                      title="show pass"
                      aria-label="اظهار كلمة المرور"
                    >
                      <i class="bi bi-lock"></i>
                    </button>
                    <span class="text-danger error-msg password_confirmation"></span>
                  </div>
                </div>
                
                <!-- ارسال -->
                <button
                  type="submit"
                  class="btn main-outline-btn w-100 mb-3 send-form"
                  aria-label="ارسال نموذج إنشاء حساب "
                >
                إنشاء حساب
                </button>
                <p class="fw-semibold  text-center">
                  هل لديك حساب؟
                  <a
                  href="login.html"
                  class="main fw-bold px-1"
                  aria-label="الذهاب الى صفحة تسجيل الدخول في حالة اذا كان لديك حساب مسبق"
                  >
                   تسجيل دخول
                  </a>
                </p>
              </form>
            </div>
          </div>
        </div>
        <div class="main-side col-md-7">
          <div class="login-img">
            <img src="{{url('site')}}/images/login.webp" loading="lazy" class="w-100" alt="login bg image" />
          </div>
        </div>
      </div>
    </section>
@endsection

@push('custom-js')
<script>
    $(document).ready(function () {
        $('#register-form').on('submit', function (e) {
            e.preventDefault();
            $('.error-msg').text('');
            let formData = $(this).serialize();
            $.ajax({
                url: "{{ route('clientSignup') }}",
                type: "POST",
                data: formData,
                success: function (response) {
                    if (response.errors) {
                        $.each(response.errors, function (key, val) {
                            $('.' + key).text(val);
                        });
                    }
                    if (response.data === 1) {
                        $('#register-form')[0].reset();
                        setTimeout(function() {
                            window.location.href = "{{ route('home') }}";
                        }, 2000); // 2 second delay
                        toastr.success("@lang('site.registeration done')");
                    }
                },
                error: function () {
                    toastr.error("@lang('site.error')");
                }
            });
        });
    });
</script>
@endpush