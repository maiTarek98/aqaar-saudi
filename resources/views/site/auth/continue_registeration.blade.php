@extends('site.index')
@section('title', trans('site.login') )
@section('content')
<main class="login py-5 p-md-5">
        <div class="container-fluid">
            <a class="navbar-brand m-0" href="{{route('home')}}">
              <img src="{{url('site')}}/images/logo2.svg" alt="logo"/>
            </a>
            <div class="login-form">
                <img src="{{url('site')}}/images/svg_car.svg" alt="logo">
                <p class="welcome">@lang('site.hello')</p>
                <p class="login_type">@lang('site.new registeration')</p>
                <form method="post">
                @csrf
                    <div class="row gy-4 justify-content-center ">
                        @if(app(App\Models\GeneralSettings::class)->site_account_verify == 'email')
                            <label for="phone_num">@lang('site.mobile')</label>
                            <div class="input-group">
                                <span class="input-group-text" id="phone_num">+966</span>
                                <input type="text" name="identifier" value="{{old('identifier')}}" class="form-control"  aria-label="Username" aria-describedby="phone_num">
                                <small class="text-danger identifier"></small>
                            </div>
                            @elseif(app(App\Models\GeneralSettings::class)->site_account_verify =='sms')
                            <label for="email">@lang('site.email')</label>
                            <div class="input-group">
                                <input type="email" name="identifier" value="{{old('identifier')}}" class="form-control"  aria-label="Username" aria-describedby="email">
                                <small class="text-danger identifier"></small>
                            </div>
                            @endif
                        <div class="col-md-6">
                            <label for="">@lang('site.name')</label>
                            <div class="input-group">
                                <input type="text" name="name" class="form-control">
                                <small class="text-danger name"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">@lang('site.city')</label>
                            <div class="input-group">
                                <select name="city_id" class="form-control">
                                    @foreach(\App\Models\City::where('city_status','enable')->get() as $val )
                                    <option value="{{$val->id}}">{{$val->city_name}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger city_id"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">@lang('site.password')</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control">
                                <button type="button" class="input-group-text" id="basic-addon2">
                                    <i class="pass bi bi-eye-slash"></i>
                                </button>
                                <small class="text-danger password"></small>
                            </div>
                            <div class="approve_terms">
                                <input class="form-check-input" type="checkbox" name="agree" value="" id="agree">
                                <a role="button" class="forgot terms"  data-bs-toggle="modal" data-bs-target="#Term_modal">@lang('site.terms agree')</a>
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
                            <button type="submit" class="d-block main-btn px-5 send-register-form"> @lang('site.signin')</button>
                        </div>
                        </div>
                    </div>
                </form>
                <p class="login_replace">@lang('site.do u have account')<a href="{{route('login')}}">@lang('site.sign in')</a> </p>
            </div>
        </div>
    </main>
@endsection
@push('custom-js')
<script type="text/javascript">
    var submitButton = $(".send-register-form");
    var loadingIndicator = $(".loading-indicator p");
    submitButton.prop("disabled", false);
    loadingIndicator.hide();

            $(".send-register-form").click(function(e){
            e.preventDefault();
            if (!$('#agree').is(':checked')) {
                toastr.error('@lang('site.plz agree')');
            }
            var _token = $("input[name='_token']").val();
            var name = $("input[name='name']").val();
                        var identifier = $("input[name='identifier']").val();
    var isEmail = identifier.includes('@'); // Simple email check (you can expand this check)

            var city_id = $("select[name='city_id']").val();
            var password_confirmation = $("input[name='password_confirmation']").val();
            var password = $("input[name='password']").val();
            $.ajax({
                url: "{{ route('continueRegisterationForm') }}",
                type:'POST',
                data: {_token:_token,agree: $('#agree').is(':checked') ,city_id:city_id ,name:name,password_confirmation:password_confirmation ,password:password,identifier:identifier,isEmail:isEmail},
                beforeSend: function() {
                    submitButton.prop("disabled", true);
                    $(".loading-indicator p").show(); // Show loading indicator
                },
                success: function(data) {
                    if ((data.errors)) {
                    
                      if(typeof data.errors['name'] !== 'undefined') {
                      $('.name').text(data.errors['name'])
                    }else{
                         $(".name").text('');                      
                    }
                    
                      if(typeof data.errors['identifier'] !== 'undefined') {
                      $('.identifier').text(data.errors['identifier'])
                    }else{
                         $(".identifier").text('');                      
                    }
                    if(typeof data.errors['password'] !== 'undefined') {
                      $('.password').text(data.errors['password'])
                    }else{
                         $(".password").text('');                      
                    }
                    }else{
                        $(".password").text(''); 
                        $(".name").text(''); 
                    }
                    if (data.data == 1) {
                         $("input[name='password']").val('');
                         $("input[name='password_confirmation']").val('');
                        $("input[name='name']").val('');
                         $("input[name='identifier']").val('');
                         setTimeout(function() {
                            location.reload();
                          }, 2000); // 2 second                          
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
                        toastr.error('@lang('site.activate ur name')');                     
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