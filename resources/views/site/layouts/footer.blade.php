<!-- footer section -->
    <footer>
      <!-- روابط الفوتر -->
      <div class="footer-links">
        <div class="container-fluid d-flex flex-column gap-4">
          <div class="footer-images">
            <img loading="lazy" class="img-fluid" src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->logo)}}" alt="{{app(App\Models\GeneralSettings::class)->site_name()}}" />
          </div>
          <nav class="navbarnavbar-expand-lg top-0">
            <ul class="d-flex gap-lg-5 flex-wrap gap-4 justify-content-center mb-0">
              <li class="nav-item">
                <a
                  class="nav-link {{ (Request::is('/') ? 'active' : '') }}"
                  href="{{route('home')}}"
                  aria-label="الذهاب إلى الصفحة الرئيسية"
                  >@lang('site.home')</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link {{ (Request::is('about-us') ? 'active' : '') }}"
                  href="{{route('aboutus')}}"
                  aria-label="الذهاب إلى صفحة من نحن"
                  >@lang('site.aboutus')</a
                >
              </li>
              <li class="nav-item">
                <a
                class="nav-link {{ (Request::is('app-features') ? 'active' : '') }}"
                href="{{route('appFeatures')}}"
                aria-label="الذهاب إلى صفحة مميزات التطيبق"
                >@lang('site.features')</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link {{ (Request::is('blogs') ? 'active' : '') }}"
                  href="{{route('blogs')}}"
                  aria-label="الذهاب إلى صفحة المدونة"
                  >@lang('site.blogs')</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link {{ (Request::is('contact-us') ? 'active' : '') }}"
                  href="{{route('contactus')}}"
                  aria-label="الذهاب إلى صفحة تواصل معنا"
                  >@lang('site.contactus')</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link {{ (Request::is('vendor-registeration') ? 'active' : '') }}"
                  href="{{route('vendorRegisteration')}}"
                  aria-label="الذهاب إلى صفحة طلب تسجيل كتاجر"
                  >@lang('site.add vendor')</a
                >
              </li>
            </ul>
          </nav>
          <div class="apps-btns d-flex align-items-center justify-content-center gap-1">
            @include('site.includes.social-f-section')
          </div>
        </div>
      </div>
    
      <!-- الفوتر الفرعي -->
      <div class="sub-footer py-2">
        <p class="text-center mb-0">
          <a href="https://smartvision4p.com" target="_blank" class="d-flex align-items-center gap-2 justify-content-center text-white text-decoration-none" aria-label="رابط إلى موقع شركة سمارت فيجن">
            <span>@lang('site.site rights')</span>
            <img loading="lazy" src="{{url('site')}}/images/smart-logo.svg" alt="شعار سمارت فيجن">
          </a>
        </p>
      </div>
    </footer>
    
    <!-- jQuery script -->
    <script src="{{url('site')}}/js/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
    @stack('custom-js')
    <!-- owl-carousel script -->
    <script src="{{url('site')}}/js/owl.carousel.min.js"></script>

    <!-- bootstrap script -->
    <script src="{{url('site')}}/js/bootstrap.min.js"></script>

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