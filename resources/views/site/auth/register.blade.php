@extends('site.index')
@section('title', trans('site.register') )
@section('content')
<main class="login py-5 p-md-5">
        <div class="container-fluid">
            <a class="navbar-brand m-0" href="{{route('home')}}">
                <img loading="lazy" src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->favicon)}}" alt="{{app(App\Models\GeneralSettings::class)->site_name}}" />
            </a>
            <div class="login-form">
                <img loading="lazy" src="{{url('site')}}/images/svg_car.svg" alt="svg_car">
                <p class="welcome">@lang('site.hello')</p>
                <p class="login_type">@lang('site.new registeration')</p>
                <form method="post">
                    @csrf
                    <div class="row gy-4 justify-content-center ">
                        <div class="col-12">
                            @if(app(App\Models\GeneralSettings::class)->site_account_verify == 'sms')
                            <label for="phone_num">@lang('site.mobile')</label>
                            <div class="input-group">
                                <span class="input-group-text" id="phone_num">+966</span>
                                <input type="text" name="identifier" value="{{old('identifier')}}" required class="form-control"  aria-label="Username" aria-describedby="phone_num">
                                <small class="text-danger identifier"></small>
                            </div>
                            @elseif(app(App\Models\GeneralSettings::class)->site_account_verify =='email')
                            <label for="email">@lang('site.email')</label>
                            <div class="input-group">
                                <input type="email" name="identifier" value="{{old('identifier')}}" required class="form-control"  aria-label="Username" aria-describedby="email">
                            </div>
                            <small class="text-danger identifier"></small>
                            @endif
                        </div>
                        
                        <div class="col-auto">
                            <div class="loading-indicator">
                                <p>Loading...</p>  <!-- Optional: you can use a spinner here -->
                            <button type="submit" class="d-block main-btn px-5 send-form">@lang('site.next')</button>
                            </div>
                        </div>
                    </div>
                </form>
                <p class="login_replace">@lang('site.do u have account') <a href="{{route('login')}}">@lang('site.sign in')</a> </p>
            </div>
        </div>
    </main>
@endsection
@push('custom-js')
<script type="text/javascript">
  var submitButton = $(".send-form");
var loadingIndicator = $(".loading-indicator p");
submitButton.prop("disabled", false);
loadingIndicator.hide();

$(".send-form").click(function(e){
    e.preventDefault();
    
    var _token = $("input[name='_token']").val();
    var identifier = $("input[name='identifier']").val();
    
    // Check if the identifier is an email or phone number
    var isEmail = identifier.includes('@'); // Simple email check (you can expand this check)
    
    // Prepare data for AJAX request
    var data = {
        _token: _token,
        identifier: identifier,
        isEmail: isEmail
    };
    
    $.ajax({
        url: "{{ route('clientSignup') }}",
        type: 'POST',
        data: data,
        beforeSend: function() {
            submitButton.prop("disabled", true);
            loadingIndicator.show(); // Show loading indicator
        },
        success: function(data) {
            if (data.errors) {
                if (data.errors['identifier']) {
                    $('.identifier').text(data.errors['identifier']);
                } else {
                    $(".identifier").text('');
                }
            } else {
                $(".identifier").text('');
            }
            if (data.data == 1) {
                $("input[name='identifier']").val('');
                setTimeout(function() {
                    window.location.href = "{{ route('site.otp') }}"; // Redirect to OTP page
                }, 2000); // 2 second delay
                toastr.success("@lang('site.registeration done')");
            }
            if (data.data == 0) {
                toastr.error("@lang('site.email already registerd')");
            }
        },
        error: function(data) {
            toastr.error("@lang('site.error')");
        },
        complete: function(xhr, status) {
            loadingIndicator.hide(); // Hide the loading indicator
            submitButton.prop("disabled", false); // Re-enable the submit button
        }
    });
});

</script>
@endpush