@extends('site.index')
@section('title', trans('site.login') )
@section('content')
<main class="login py-5 p-md-5">
        <div class="container-fluid">
            <a class="navbar-brand m-0" href="{{route('home')}}">
                <img loading="lazy" src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->favicon)}}" alt="{{app(App\Models\GeneralSettings::class)->site_name}}" />
            </a>
            <div class="login-form">
                <img src="{{url('site')}}/images/svg_car.svg" alt="">
                <p class="welcome">@lang('site.hello again')</p>
                <p class="login_type">@lang('site.sign in')</p>
                <form method="post">
                @csrf
                    <div class="row gy-4 justify-content-center ">
                        <div class="col-md-6">
                            <label for="phone_num">@lang('site.mobile')</label>
                            <div class="input-group">
                                <span class="input-group-text" id="phone_num">+966</span>
                                <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control"  aria-label="Username" aria-describedby="phone_num">
                            </div>
                            <small class="text-danger mobile"></small> 
                        </div>
                        
                        <div class="col-md-6">
                            <label for="">@lang('site.password')</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control">
                                <button type="button" class="input-group-text" id="basic-addon2">
                                    <i class="pass bi bi-eye-slash"></i>
                                </button>
                            </div>
                            <small class="text-danger password d-block"></small>
                            <a href="{{route('site.forget')}}" class="forgot">@lang('site.forget password')</a>
                        </div>
                        <div class="col-auto">
                            <div class="loading-indicator">
                                <p>Loading...</p>  <!-- Optional: you can use a spinner here -->
                                <button type="submit" class="d-block main-btn px-5 send-login-form"> @lang('site.signin')</button>
                            </div>
                        </div>
                    </div>
                </form>
                <p class="login_replace"> @lang('site.do not have account') <a href="{{route('register')}}">@lang('site.new registeration')</a> </p>
            </div>
        </div>
    </main>
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
            $.ajax({
                url: "{{ route('clientSignin') }}",
                type:'POST',
                data: {_token:_token, mobile:mobile, password:password},
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
                        
                    location.reload();

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