@extends('site.index')
@section('title', trans('site.login') )
@section('content')
 <section class="login">
      <div class="row align-items-center g-0">
        <div class="col-md-5">
          <div class="container-fluid">
            <div class="py-4">
              <div class="login-logo">
                <img src="images/logo.png" alt="" />
              </div>

              <h5 class="fw-bold fs-4 my-5 secondary">تسجيل دخول</h5>

              <form method="post">
                @csrf
                <input type="hidden" name="redirect_to" value="{{ url()->previous() }}">

                <div class="form-group mb-4">
                  <label for=""> رقم الهاتف <span class="text-danger">*</span></label>
                  <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control" id="InputPhone" aria-label="Username" aria-describedby="phone_num">
                  <small class="text-danger mobile"></small> 
                </div>
                <div class="form-group mb-4">
                  <label for="">كلمة المرور <span class="text-danger">*</span></label>
                  <div class="input-group border mb-3">
                    <input
                      type="password" name="password"
                      class="form-control"
                      id="InputPassword"
                      placeholder="كلمة المرور"
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
                    <small class="text-danger password d-block"></small>
                  </div>

                  <a
                    href="forgot-pass.html"
                    class="text-decoration-underline"
                    aria-label="هل نسيت كلمة المرور؟ الذهاب لاعادة التعيين"
                  >
                    هل نسيت كلمة المرور؟
                  </a>
                </div>
                <div class="loading-indicator">
                    <p>Loading...</p> 
                <!-- ارسال -->
                    <button
                      type="submit"
                      class="btn main-outline-btn w-100 mb-3 send-login-form" 
                      aria-label="ارسال نموذج تسجيل الدخول "
                    >
                      دخول
                    </button>
                </div>
                <p class="fw-semibold text-center">
                  ليس لديك حساب؟
                  <a
                    href="register.html"
                    class="main fw-bold px-1"
                    aria-label="الذهاب الى صفحة انشاء حساب جديد في حالة اذا لم يكن لديك حساب مسبق"
                  >
                    إنشاء حساب جديد
                  </a>
                </p>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="login-img">
            <img src="{{url('site')}}/images/login.webp" class="w-100" alt="login bg image" />
          </div>
        </div>
      </div>
    </section>
@endsection
@push('custom-js')
<script type="text/javascript">
    var submitButton = $(".send-login-form");
    var loadingIndicator = $(".loading-indicator p");
    submitButton.prop("disabled", false);
    loadingIndicator.hide();

            $(".send-login-form").click(function(e){
            e.preventDefault();
           var $button = $(this); // Reference to the clicked button
            $button.prop('disabled', true); // Disable the button

            var _token = $("input[name='_token']").val();
            var mobile = $("input[name='mobile']").val();
            var password = $("input[name='password']").val();
            var redirect_to = $("input[name='redirect_to']").val();
            $.ajax({
                url: "{{ route('clientSignin') }}",
                type:'POST',
                data: {_token:_token, mobile:mobile, password:password, redirect_to: redirect_to},
                beforeSend: function() {
                    submitButton.prop("disabled", true);
                    $(".loading-indicator p").show(); // Show loading indicator
                },
                success: function(data) {
                    if ((data.errors)) {
                    
                      if(typeof data.errors['mobile'] !== 'undefined') {
                      $('.mobile').text(data.errors['mobile'])
                    }else{
                         $(".mobile").text('');                      
                    }
                    
                    if(typeof data.errors['password'] !== 'undefined') {
                      $('.password').text(data.errors['password'])
                    }else{
                         $(".password").text('');                      
                    }
                    }else{
                        $(".mobile").text('');
                        $(".password").text('');
                    }
                    if (data.data == 1) {
                         $("input[name='password']").val('');
                        $("input[name='mobile']").val('');
                        
                        // if($(location).attr("href").split('/').pop() == 'cart'){
                        //                   $(".cart-order").load('{{url('/')}}/cart');
                        // }else{
                         setTimeout(function() {
                            window.location.href = data.redirect; // إعادة التوجيه
                            }, 2000); // 2 second
                       // }
                          
                     toastr.success('@lang('site.login done')');

                    }else if(data.data == 2) {
                        
                     toastr.error('@lang('site.error data')');

                    }  else if(data.data == 3) {
                         toastr.error('@lang('site.account not found')');
                    }   
                    else if(data.data == 4) {
                        toastr.error('@lang('site.activate account')');
                    } 
                    else if(data.data == 5) {
                        toastr.error('@lang('site.activate ur mobile')');                     
                        window.location.href = "{{ route('site.otp') }}"; // Use the route helper
                    }          
                },
                error: function (data) {
                  toastr.error("@lang('site.error')");                

                },
                complete: function(xhr, status) {
                    console.log("Request completed.");
                    $(".loading-indicator p").hide(); // Hide the loading indicator
                    submitButton.prop("disabled", false); // Re-enable the submit button
                }
            });
       
        });

</script>
@endpush