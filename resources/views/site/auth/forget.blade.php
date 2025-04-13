@extends('site.index')
@section('title', trans('site.forget password') )
@section('content')
<main class="login py-5 p-md-5">
        <div class="container-fluid">
            <a class="navbar-brand m-0" href="{{route('home')}}">
                <img loading="lazy" src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->favicon)}}" alt="{{app(App\Models\GeneralSettings::class)->site_name}}" />
            </a>
            <div class="login-form">
                <img loading="lazy" src="{{url('site')}}/images/svg_car.svg" alt="svg_car">
                  <p class="welcome">@lang('site.forget password')</p>
                  @if(app(App\Models\GeneralSettings::class)->site_account_verify == 'sms')
                  <p class="login_type">@lang('site.enter ur mobile to verify')</p>
                  @elseif(app(App\Models\GeneralSettings::class)->site_account_verify =='email')
                  <p class="login_type">@lang('site.enter ur email to verify')</p>
                  @endif
                <form method="post">
                @csrf
                    <div class="row gy-4 justify-content-center ">
                        <div class="col-12">
                            @if(app(App\Models\GeneralSettings::class)->site_account_verify == 'sms')
                            <label for="phone_num">@lang('site.mobile')</label>
                            <div class="input-group">
                                <span class="input-group-text" id="phone_num">+966</span>
                                <input type="text" name="identifier" value="@if(auth('web')->check()) {{auth('web')->user()->mobile}} @else {{old('identifier')}} @endif" @if(auth('web')->check()) readonly @endif class="form-control"  aria-label="Username" aria-describedby="phone_num">
                                <small class="text-danger identifier"></small>
                            </div>
                            @elseif(app(App\Models\GeneralSettings::class)->site_account_verify =='email')
                            <label for="email">@lang('site.email')</label>
                            <div class="input-group">
                                <input type="email" name="identifier" value="@if(auth('web')->check()) {{auth('web')->user()->email}} @else {{old('identifier')}} @endif" @if(auth('web')->check()) readonly @endif class="form-control"  aria-label="Username" aria-describedby="email">
                                <small class="text-danger identifier"></small>
                            </div>
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
                var isEmail = identifier.includes('@'); // Simple email check (you can expand this check)

            $.ajax({
                url: "{{ route('clientSignup') }}",
                type:'POST',
                data: {_token:_token, identifier:identifier, isEmail:isEmail},
                beforeSend: function() {
                    submitButton.prop("disabled", true);
                    $(".loading-indicator p").show(); // Show loading indicator
                },
                success: function(data) {
                    if ((data.errors)) {
                        if(typeof data.errors['identifier'] !== 'undefined') {
                          $('.identifier').text(data.errors['identifier'])
                        }else{
                             $(".identifier").text('');                      
                        }
                    }
                    if (data.data == 1) {
                        $("input[name='identifier']").val('');
                         setTimeout(function() {
                            window.location.href = "{{ route('site.otp') }}"; // Use the route helper
                            }, 2000); // 2 second
                        toastr.success("@lang('site.redirect to otp')");                
                    } 

                    if (data.data == 0) {
                        $("input[name='mobile']").val('');
                         setTimeout(function() {
                            window.location.href = "{{ route('site.forget.otp') }}"; // Use the route helper
                            }, 2000); // 2 second
                        toastr.success("@lang('site.write otp')");                
                    }  

                    if (data.data == 4) {
                        $("input[name='mobile']").val('');
                        toastr.error("@lang('site.phone number not exist')");                
                    }      
                    
                    if (data.data == 5) {
                        toastr.error("@lang('site.account not found')");                
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