@if(\Request::route()->getName() != 'site.signin' && \Request::route()->getName() != 'login' && \Request::route()->getName() != 'register' && \Request::route()->getName() != 'site.otp' && \Request::route()->getName() != 'site.continue_registeration' && \Request::route()->getName() != 'site.forget' && \Request::route()->getName() != 'site.forget.otp' && \Request::route()->getName() != 'site.changePassword') 
 <!-- footer section -->
    <footer>
      <!-- روابط الفوتر -->
      <div class="footer-links bg-card py-4">
        <div class="container-fluid">
          <div class="row justify-content-between">
            <!-- الشركة -->
            <div class="col-12 col-lg-3">
              <div class="footer-info">
                <img loading="lazy"
                  src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->logo)}}"
                  alt="شعار الشركة"
                  class="img-fluid"
                />
                <p>
                  نحن منصة إلكترونية متخصصة في عرض العقارات داخل المملكة، نقدم حلولاً ذكية ومبتكرة للبحث عن عقارات للبيع أو الإيجار بما يتناسب مع احتياجاتك وطموحاتك
                </p>
              </div>
            </div>

            <!-- خريطة الموقع -->
            <div class="col-6 col-md-3 col-lg-auto mt-3">
              <h4>خريطة الموقع</h4>
              <ul class="list-unstyled">
                <li>
                  <a
                    href="{{route('home')}}"
                    class="active"
                    aria-label="الانتقال إلى الصفحة الرئيسية"
                    >الرئيسية</a
                  >
                </li>
                <li>
                  <a href="{{route('aboutus')}}" aria-label="الانتقال إلى صفحة من نحن"
                    >من نحن</a
                  >
                </li>
                <li>
                  <a href="{{route('blogs')}}" aria-label="الانتقال إلى صفحة المدونة"
                    >المدونة</a
                  >
                </li>
                <li>
                  <a href="{{route('contactus')}}" aria-label="الانتقال إلى اتصل بنا"
                    >اتصل بنا</a
                  >
                </li>
              </ul>
            </div>

            <!-- روابط سريعة -->
            <div class="col-6 col-md-3 col-lg-auto mt-3">
              <h4>روابط سريعة</h4>
              <ul class="list-unstyled">
                <li>
                  <a
                    href="policy.html"
                    aria-label="الانتقال إلى صفحة سياسة الخصوصية"
                    >سياسة الخصوصية</a
                  >
                </li>
                <li>
                  <a
                    href="terms.html"
                    aria-label="الانتقال إلى صفحة الشروط والأحكام"
                    > الشروط والأحكام</a
                  >
                </li>
                <li>
                  <a
                    href="system.html"
                    aria-label="الانتقال إلى صفحة شرح اليات نظام"
                    >شرح اليات نظام</a
                  >
                </li>
                <li>
                  <a
                    href="paid-servics.html"
                    aria-label="الانتقال إلى صفحة المصداقية والخدمات المدفوعة"
                    >المصداقية والخدمات المدفوعة</a
                  >
                </li>
              </ul>
            </div>

            <!-- الاشتراك وتحديثات العقارات -->
            <div class="col-12 col-md-5 col-lg-3 mt-3">
              <h4>اشترك لتلقي تحديثات العقارات</h4>
              <form action="">
                <div class="input-group border my-3">
                  <input
                    type="email"
                    class="form-control border-0"
                    placeholder="البريد الإلكتروني"
                    aria-label="إدخال البريد الإلكتروني"
                    required
                  />
                </div>
                <button
                  type="submit"
                  class="main-btn ms-auto mb-4"
                  aria-label="إرسال البريد الإلكتروني"
                >
                  إرسال
                </button>
              </form>


              <!-- وسائل التواصل الاجتماعي -->
               <h4>تابعنا</h4>
              <div
                class="social d-flex justify-content-lg-start justify-content-center gap-3"
              >
                <a href="#" target="_blank" aria-label="رابط إلى تويتر">
                  <i class="fa-brands fa-x-twitter"></i>
                </a>
                <a href="#" target="_blank" aria-label="رابط إلى فيسبوك">
                  <i class="fa-brands fa-facebook-f"></i>
                </a>
                <a href="#" target="_blank" aria-label="رابط إلى لينكد إن">
                  <i class="fa-brands fa-linkedin-in"></i>
                </a>
                <a href="#" target="_blank" aria-label="رابط إلى سناب شات">
                  <i class="fa-brands fa-snapchat"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- الفوتر الفرعي -->
      <div class="sub-footer py-2">
        <p class="text-center mb-0">
          <a
            href="https://smartvision4p.com"
            target="_blank"
            class="d-flex align-items-center gap-2 justify-content-center text-white text-decoration-none"
            aria-label="رابط إلى موقع شركة سمارت فيجن"
          >
            <span>تصميم وبرمجة شركة سمارت فيجن للبرمجيات</span>
            <img loading="lazy" src="{{url('site')}}/images/smart-logo.svg" alt="شعار سمارت فيجن" />
          </a>
        </p>
      </div>
    </footer>
@endif

    <!-- jQuery script -->
    <script src="{{url('site')}}/js/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
    @stack('custom-js')

    <!-- owl-carousel script -->
    <script src="{{url('site')}}/js/owl.carousel.min.js"></script>

    <!-- bootstrap script -->
    <script src="{{url('site')}}/js/bootstrap.min.js"></script>

    <!-- nice select script -->
    <script src="{{url('site')}}/js/jquery.nice-select.min.js"></script>

    <!-- fancybox script -->
    <script src="{{url('site')}}/js/jquery.fancybox.min.js"></script>

    <!-- custom js file link  -->
    <script src="{{url('site')}}/js/script.js"></script>
    <script>
      function changeLanguage(lang) {
        window.location = '{{ url('/change-language') }}/' + lang;
      }

       $(document).ready(function() {
        
         toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-center",  // Positioning at the top center
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": 10000,
            "extendedTimeOut": 1000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr.options.timeOut = 10000;
        @if (Session::has('error'))
            toastr.error('{{ Session::get('error') }}');
        @endif
        @if (Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
        @endif
            });
        document.addEventListener('DOMContentLoaded', function () {
            let userTypeSelect = document.querySelector('[name="user_type"]');
            let agencyWrapper = document.getElementById('agency_number_wrapper');

            function toggleAgencyField() {
                if (userTypeSelect.value === 'agent') {
                    agencyWrapper.style.display = 'block';
                } else {
                    agencyWrapper.style.display = 'none';
                }
            }
            toggleAgencyField();
            userTypeSelect.addEventListener('change', toggleAgencyField);
            document.querySelector('.nice-select').addEventListener('click', function () {
                setTimeout(toggleAgencyField, 100);
            });
        });

</script>

<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#userForm').on('submit', function(e) {
        e.preventDefault(); 
        let formData = new FormData(this);
        $('.error-message').text('');
        $('.spinner-border').show();
        $.ajax({
            url: '{{route("storeVendor")}}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false, 
            success: function(response) {
                $('#responseMessage').text('@lang('site.Data saved successfully')');
                $('#responseMessage').css('color', 'green');
                $('#userForm')[0].reset();
                toastr.success('@lang('site.Data saved successfully')');
            },
            error: function(xhr, status, error) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    for (let key in errors) {
                        $(`#error-${key}`).text(errors[key][0]);
                    }
                } else {
                    $('#responseMessage').text('Failed to save data. Please try again.');
                    $('#responseMessage').css('color', 'red');
                }
            },
            complete: function () {
                $('.spinner-border').hide();
            }
        });
    });
   $(document).on('submit', '#updateForm', function (e) {
    e.preventDefault();
    var $form = $(this);
    var $button = $form.find('button.submit-btn');
    
    $button.prop('disabled', true);

    $.ajax({
        method: "POST",
        url: $form.prop('action'),
        data: new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            $('.text-danger').text(''); 

            if (data.errors) {
                $.each(data.errors, function (key, messages) {
                    $('#' + key + '_error').text(messages[0]);  
                });
            } else if (data.success) {
                toastr.success('@lang('site.updated-done')');
            } else {
                toastr.error('@lang('site.error')');
            }

            $button.prop('disabled', false);
        },
        error: function (xhr) {
            toastr.error('@lang('site.error')');
            $button.prop('disabled', false);
        }
    });
});

        $(document).on('submit', '#updatePassword', function (e) {
          e.preventDefault();
          var $this = $(this).parent();
          $.ajax({
            method: "POST",
            url: $(this).prop('action'),
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
              if ((data.errors)) {
                // console.log(data.errors)
                // $('#current_password_error').text(data.errors[0])
                $('#password_error').text(data.errors[0])
                $('#password_confirmation_error').text(data.errors[1])
              }
              else if (data == 1) {
                $(".print-pass-error-msg").fadeOut();
                $this.find('button.submit-btn').prop('disabled', false);
                Toast.fire({
                  icon: 'success',
                  title: '@lang('site.updated-done')',
                })
                // location.reload();
    
              }
              else if (data == 2) {
                $this.find('button.submit-btn').prop('disabled', false);
                Toast.fire({
                  icon: 'error',
                  title: '@lang('site.error')',
                })
    
              }
              else if (data == 3) {
                $this.find('button.submit-btn').prop('disabled', false);
                Toast.fire({
                  icon: 'error',
                  title: '@lang('site.error_in_current_pass')',
                })
              }
    
            }
          });
        });

    
    $(document).ajaxStart(function () {
        $('.spinner-border').show();
    });

    $(document).ajaxStop(function () {
        $('.spinner-border').hide();
    });
});
</script>
  </body>
</html>