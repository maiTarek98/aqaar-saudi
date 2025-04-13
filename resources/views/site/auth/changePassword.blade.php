@extends('site.index')
@section('title', trans('site.login') )
@section('content')
<main class="login py-5 p-md-5">
        <div class="container-fluid">
            <a class="navbar-brand m-0" href="{{route('home')}}">
                <img loading="lazy" src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->favicon)}}" alt="{{app(App\Models\GeneralSettings::class)->site_name}}" />
            </a>
            <div class="login-form">
                <img loading="lazy" src="{{url('site')}}/images/svg_car.svg" alt="svg_car">
                <p class="login_type">@lang('site.forget password')</p>
                <label class="mb-5">@lang('site.reset new password')</label>
                <form method="post">
                @csrf
                    <div class="row gy-4 justify-content-center ">
                        <div class="col-md-6">
                            <label for="">@lang('site.password')</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control">
                                <button type="button" class="input-group-text" id="basic-addon2">
                                    <i class="pass bi bi-eye-slash"></i>
                                </button>
                                <small class="text-danger password"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">@lang('site.enter new password')</label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" class="form-control">
                                <button type="button" class="input-group-text" id="basic-addon2">
                                    <i class="pass bi bi-eye-slash"></i>
                                </button>
                                <small class="text-danger password_confirmation"></small>
                            </div>
                        </div>
                        <div class="col-auto">
                              <div class="loading-indicator">
                                <p>Loading...</p>  <!-- Optional: you can use a spinner here -->

                            <button type="submit" class="d-block main-btn px-5 send-change-pass-form"> @lang('site.signin')</button>
                        </div>                    </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
@push('custom-js')
<script type="text/javascript">
    var submitButton = $(".send-change-pass-form");
    var loadingIndicator = $(".loading-indicator p");
    submitButton.prop("disabled", false);
    loadingIndicator.hide();

            $(".send-change-pass-form").click(function(e){
            e.preventDefault();
       
            var _token = $("input[name='_token']").val();
            var password_confirmation = $("input[name='password_confirmation']").val();
            var password = $("input[name='password']").val();
            $.ajax({
                url: "{{ route('update_password_profile') }}",
                type:'POST',
                data: {_token:_token, password_confirmation:password_confirmation, password:password},
                beforeSend: function() {
                    submitButton.prop("disabled", true);
                    $(".loading-indicator p").show(); // Show loading indicator
                },
                success: function(data) {
                    if ((data.errors)) {
                    
                      if(typeof data.errors['password_confirmation'] !== 'undefined') {
                      $('.password_confirmation').text(data.errors['password_confirmation'])
                    }else{
                         $(".password_confirmation").text('');                      
                    }
                    
                    if(typeof data.errors['password'] !== 'undefined') {
                      $('.password').text(data.errors['password'])
                    }else{
                         $(".password").text('');                      
                    }
                    }else{
                        $(".password").text(''); 
                        $(".password_confirmation").text(''); 
                    }
                    if (data.data == 1) {
                         $("input[name='password']").val('');
                        $("input[name='password_confirmation']").val('');
                        
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

                    }  
                    else if(data.data == 3) {
                        
                     toastr.error('@lang('site.mismatch password')');

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