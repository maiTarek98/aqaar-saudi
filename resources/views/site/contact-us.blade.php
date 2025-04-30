@extends('site.index')
@section('title', trans('site.contactus'))
@section('content')
<!-- contact us  -->
    <section class="contactUs py-5">
      <div class="container-fluid">
        <div class="row gy-3">
          <!-- contact form -->
          <div class="col-md-7 col-lg-8">
            <div class="contact-form h-100 py-4 px-4">
              <h5 class="fw-bold fs-3 mb-4">@lang('site.contactus')</h5>
              
              <form id="contactUsForm" class="form">
                        {{ csrf_field() }}
                        <div class="alert alert-danger print-contacterror-msg" style="display:none">
                            <ul></ul>
                        </div>
                    <input type="hidden" name="recaptcha_token" id="recaptcha_token">
                <div class="row gy-3 align-items-center">
                  <div class="col-lg-6">
                    <div class="form-floating">
                      <input
                        type="text"
                        class="form-control" name="name" value="{{old('name')}}" id="name" placeholder="@lang('site.name')"
                        id="floatingInputUserName"
                        required
                      />
                      <label for="floatingInputUserName">@lang('site.name')</label>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-floating">
                      <input
                        type="email"
                        class="form-control"
                        id="floatingUserEmail" name="email" value="{{old('email')}}" id="email" placeholder="@lang('site.email')"
                        required
                      />
                      <label for="floatingUserEmail">@lang('site.email')</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating">
                      <textarea
                        class="form-control"
                        style="height: 150px"
                        id="floatingContactText" name="message" id="message" placeholder="@lang('site.message')"
                        required
                      ></textarea>
                      <label for="floatingContactText">{{old('message')}}</label>
                    </div>
                  </div>
                </div>
                
                <button id="loadingIndicator" class="btn main-btn send-contact mt-3 px-5 py-2" type="submit">
                  <span class="spinner-border spinner-border-sm" aria-hidden="true"  style="display: none;"></span>
                  <span role="status">
                      @lang('site.send')
                  </span>
                </button>
                
                <!--<div class="loading-indicator">-->
                <!--    <p>@lang('site.loading')</p> -->
                <!--    <button-->
                <!--      type="submit"-->
                <!--      class="btn main-btn mt-3 px-5 py-2 send-contact"-->
                <!--    >-->
                <!--      @lang('site.send')-->
                <!--    </button>-->
                <!--</div>-->
              </form>
            </div>
          </div>
          <!-- contact data -->
          <div class="col-12 col-md-5 col-lg-4">
            <div class="contact-data">
              <div class="contact-info pb-4">
                <ul class="d-flex flex-column gap-4">
                  @if(app(App\Models\GeneralSettings::class)->email)
                  <li>
                    <i class="bi bi-envelope"></i>
                    <a href="mailto:{{app(App\Models\GeneralSettings::class)->email}}">{{app(App\Models\GeneralSettings::class)->email}}</a>
                  </li>
                  @endif
                  @if(app(App\Models\GeneralSettings::class)->phone)
                  <li>
                    <i class="bi bi-telephone-outbound"></i>
                    <a href="tel:{{app(App\Models\GeneralSettings::class)->phone}}">{{app(App\Models\GeneralSettings::class)->phone}}</a>
                  </li>
                  @endif
                  @if(app(App\Models\GeneralSettings::class)->whatsapp_phone)
                  <li>
                    <i class="bi bi-telephone-outbound"></i>
                    <a href="tel:{{app(App\Models\GeneralSettings::class)->whatsapp_phone}}">{{app(App\Models\GeneralSettings::class)->whatsapp_phone}}</a>
                  </li>
                  @endif
                  @if(app(App\Models\GeneralSettings::class)->address())
                  <li>
                    <i class="bi bi-geo-alt"></i>
                    <a href="">{{app(App\Models\GeneralSettings::class)->address()}}</a>
                  </li>
                  @endif
                </ul>
              </div>
              <!-- وسائل التواصل الاجتماعي -->
              <div class="social row row-cols-4 g-2">
                @if(app(App\Models\SocialSettings::class)->twitter_link)
                <a href="{{app(App\Models\SocialSettings::class)->twitter_link}}"  class="col" target="_blank" aria-label="رابط إلى تويتر">
                  <i class="fa-brands fa-x-twitter"></i>
                </a>
                @endif
                @if(app(App\Models\SocialSettings::class)->facebook_link)
                <a href="{{app(App\Models\SocialSettings::class)->facebook_link}}"  class="col" target="_blank" aria-label="رابط إلى فيسبوك">
                  <i class="fa-brands fa-facebook-f"></i>
                </a>
                @endif
                @if(app(App\Models\SocialSettings::class)->linkedin_link)
                <a href="{{app(App\Models\SocialSettings::class)->linkedin_link}}"  class="col" target="_blank" aria-label="رابط إلى لينكد إن">
                  <i class="fa-brands fa-linkedin-in"></i>
                </a>
                @endif
                @if(app(App\Models\SocialSettings::class)->snapchat_link)
                <a href="{{app(App\Models\SocialSettings::class)->snapchat_link}}"  class="col" target="_blank" aria-label="رابط إلى سناب شات">
                  <i class="fa-brands fa-snapchat"></i>
                </a>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
@push('custom-js')
<script type="text/javascript">
$(document).ready(function() {
    var submitButton = $(".send-contact");
    var loadingIndicator = $(".loading-indicator p");
    submitButton.prop("disabled", false);
    loadingIndicator.hide();

        // Add reCAPTCHA token and submit the form via AJAX
        $('form').on('submit', function(event) {
            event.preventDefault(); // Prevent form submission to generate the token first
            
            // Execute reCAPTCHA and get the token
            // grecaptcha.ready(function() {
            //     grecaptcha.execute('{{ env('RECAPTCHA_SITE_KEY') }}', { action: 'submit' }).then(function(token) {
            //         // Set the token in the hidden input field
            //         $('#recaptcha_token').val(token);
                    
            //         // Trigger the form submit after the token is added
            //         handleFormSubmission();
            //     });
            // });
            handleFormSubmission();

        });

        // Function to handle the form submission via AJAX
        function handleFormSubmission() {
            var submitButton = $(".send-contact");
            var loadingIndicator = $(".loading-indicator p");
            var _token = $("input[name='_token']").val();
            var name = $("input[name='name']").val();
            var email = $("input[name='email']").val();
            var message = $("textarea[name='message']").val();
            var recaptcha_token = $("input[name='recaptcha_token']").val();

            $.ajax({
                url: "{{ route('storeContact') }}",
                type: 'POST',
                data: {
                    _token: _token,
                    name: name,
                    email: email,
                    message: message,
                    // recaptcha_token: recaptcha_token
                },
                beforeSend: function() {
                    submitButton.prop("disabled", true);
                    loadingIndicator.show(); // Show loading indicator
                },
                success: function(data) {
                    if (data.errors) {
                        printContactErrorMsg(data.errors);
                    }
                    if (data == 1) {
                        // Reset form fields
                        $("input[name='name']").val('');
                        $("input[name='email']").val('');
                        $("textarea[name='message']").val('');
                        $(".print-contacterror-msg").css('display', 'none');
                        toastr.success('@lang('site.message-sent')');
                    }
                },
                error: function (data) {
                    toastr.error("@lang('site.error')");
                },
                complete: function() {
                    loadingIndicator.hide(); // Hide the loading indicator
                    submitButton.prop("disabled", false); // Re-enable the submit button
                }
            });
        }

        // Function to print error messages
        function printContactErrorMsg(msg) {
            $(".print-contacterror-msg").find("ul").html('');
            $(".print-contacterror-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-contacterror-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
    });
</script>

@endpush