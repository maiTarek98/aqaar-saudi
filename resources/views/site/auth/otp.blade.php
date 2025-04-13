@extends('site.index')
@section('title', trans('site.otp') )
@section('content')

<main class="login py-5 p-md-5">
      <div class="container-fluid">
        <a class="navbar-brand m-0" href="{{route('home')}}">
            <img loading="lazy" src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->favicon)}}" alt="{{app(App\Models\GeneralSettings::class)->site_name}}" />
        </a>
        <div class="login-form">
                <img src="{{url('site')}}/images/svg_car.svg" alt="">
          <p class="welcome">@lang('site.hello')</p>
          <p class="login_type">@lang('site.thanks for register')</p>
        <form method="post">
                @csrf
        @if(session()->has('register_mobile'))
         <input type="hidden" name="identifier" value="{{session()->get('register_mobile')}}">
        @elseif(session()->has('register_email'))
         <input type="hidden" name="identifier" value="{{session()->get('register_email')}}">
        @elseif(session()->has('forget_mobile'))
         <input type="hidden" name="identifier" value="{{session()->get('forget_mobile')}}">
        @elseif(session()->has('forget_email'))
         <input type="hidden" name="identifier" value="{{session()->get('forget_email')}}">
        @endif
            <div class="text-center">
              <label>  @lang('site.enter verify code')
              </label>
              <div id="verification-input">
                <input type="text" name="code[]" />
                <input type="text" name="code[]"/>
                <input type="text" name="code[]"/>
                <input type="text" name="code[]"/>
              </div>                                
              <small class="text-danger code"></small>

              <p class="login_replace mb-4">@lang('site.dont send')
                  <button id="sendOtpBtn">@lang('site.send again')</button></p>
    <div id="message"></div>
              <div class="row gy-4 justify-content-center">
                <div class="col-auto">
                      <div class="loading-indicator">
                                <p>Loading...</p>  <!-- Optional: you can use a spinner here -->
                    <button type="submit" class="d-block main-btn px-5 send-otp-form">@lang('site.next')</button>
                </div>

                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </main>
@endsection
@push('custom-js')
<script type="text/javascript">
     $('#sendOtpBtn').on('click', function() {
            $(this).prop('disabled', true);
            $.ajax({
                url: "{{ route('send.otp') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#message').text(response.message);
                    if (response.success) {
                        setTimeout(function() {
                            $('#sendOtpBtn').prop('disabled', false);
                            $('#message').text('@lang('site.You can request a new OTP now')');
                        }, 30000); // 30 seconds
                    } else {
                        setTimeout(function() {
                            $('#sendOtpBtn').prop('disabled', false);
                        }, 30000); // 30 seconds
                    }
                },
                error: function(xhr) {
                    $('#message').text('An error occurred. Please try again.');
                    $('#sendOtpBtn').prop('disabled', false);
                }
            });
        });
    var submitButton = $(".send-otp-form");
    var loadingIndicator = $(".loading-indicator p");
    submitButton.prop("disabled", false);
    loadingIndicator.hide();


           $(".send-otp-form").click(function(e){
            e.preventDefault();
       let values = [];

        $('input[name="code[]"]').each(function() {
            values.push($(this).val());
        });
            var _token = $("input[name='_token']").val();
            var code = values.join('');
            var identifier = $("input[name='identifier']").val();
            $.ajax({
                url: "{{ route('checkCodeActivate') }}",
                type:'POST',
                data: {_token:_token, identifier:identifier,code:code},
                beforeSend: function() {
                    submitButton.prop("disabled", true);
                    $(".loading-indicator p").show(); // Show loading indicator
                },
                success: function(data) {
                    if ((data.errors)) {
                        if(typeof data.errors['code'] !== 'undefined') {
                          $('.code').text(data.errors['code'])
                        }else{
                             $(".code").text('');                      
                        }
                    }
                    if (data.data == 1) {
                        $("input[name='code']").val('');
                         setTimeout(function() {
                            window.location.href = "{{ route('site.continue_registeration') }}"; // Use the route helper
                            }, 2000); // 2 second
                        toastr.success("@lang('site.registeration done')");                
                    }   else if (data.data == 0) {
                        toastr.error("@lang('site.error in code')");                
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