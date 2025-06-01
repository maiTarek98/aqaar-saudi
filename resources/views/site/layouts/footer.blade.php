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
                @php
                  $pageExists1 = \App\Models\Page::where('status','show')->find(1);
                @endphp
                
                @if($pageExists1)
                <li>
                  <a
                    href="{{route('pages',['id'=>1])}}"
                    aria-label="الانتقال إلى صفحة سياسة الخصوصية"
                    >سياسة الخصوصية</a
                  >
                </li>
                @endif
                @php
                  $pageExists = \App\Models\Page::where('status','show')->find(3);
                @endphp
                
                @if($pageExists)
                  <li>
                    <a href="{{ route('pages', ['id' => 3]) }}" aria-label="الانتقال إلى صفحة الشروط والأحكام">
                      الشروط والأحكام
                    </a>
                  </li>
                @endif
                @php
                  $pageExists2 = \App\Models\Page::where('status','show')->find(2);
                @endphp
                
                @if($pageExists2)
                <li>
                  <a
                    href="{{route('pages',['id'=>2])}}"
                    aria-label="الانتقال إلى صفحة شرح اليات نظام"
                    >شرح اليات نظام</a
                  >
                </li>
                @endif
                @php
                  $pageExists4 = \App\Models\Page::where('status','show')->find(4);
                @endphp
                
                @if($pageExists4)
                <li>
                  <a
                    href="{{route('pages',['id'=>4])}}"
                    aria-label="الانتقال إلى صفحة المصداقية والخدمات المدفوعة"
                    >المصداقية والخدمات المدفوعة</a
                  >
                </li>
                @endif
              </ul>
            </div>

            <!-- الاشتراك وتحديثات العقارات -->
            <div class="col-12 col-md-5 col-lg-3 mt-3">
              <h4>اشترك لتلقي تحديثات العقارات</h4>
              <form action="{{route('subscriber.store')}}" method="post">
                  @csrf
                <div class="input-group border my-3">
                  <input
                    type="email" name="subscribe_email"
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
                class="social d-flex justify-content-lg-start justify-content-center flex-wrap gap-3"
              >
                  @include('site.includes.social-f-section')
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
@endif
    <!-- jQuery script -->
    <script src="{{url('site')}}/js/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
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
    
    <!-- tagsinput script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

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
        const userTypeSelect = document.querySelector('[name="represented_by"]');
        const agencyWrapper = document.getElementById('agency_number_wrapper');
        const sakWrapper = document.getElementById('sak_number_wrapper');
        const valWrapper = document.getElementById('val_number_wrapper');
        const allWrappers = [agencyWrapper, sakWrapper, valWrapper];
        function hideAllWrappers() {
            allWrappers.forEach(wrapper => {
                if (wrapper) wrapper.style.display = 'none';
            });
        }
        function toggleAgencyField() {
            hideAllWrappers();
            switch (userTypeSelect.value) {
                case 'agent':
                    agencyWrapper && (agencyWrapper.style.display = 'block');
                    break;
                case 'owner':
                    sakWrapper && (sakWrapper.style.display = 'block');
                    break;
                case 'co-owner':
                case 'other':
                    valWrapper && (valWrapper.style.display = 'block');
                    break;
            }
        }
        toggleAgencyField();
        userTypeSelect.addEventListener('change', toggleAgencyField);
        const niceSelect = document.querySelector('.nice-select');
        if (niceSelect) {
            niceSelect.addEventListener('click', function () {
                setTimeout(toggleAgencyField, 100);
            });
        }
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