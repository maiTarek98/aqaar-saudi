@extends('site.index')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', $job->job_title)
@section('content')
@include('site.includes.breadcrumb-section',['title' => $job->job_title ])
<section class="mb-5 pb-md-4">
      <div class="container-fluid">
        <div class="jobs">
          <div class="job_item">
              <p class="jobTitle mb-2 mb-md-3">{{$job->job_title}}</p>
              <div class="d-flex flex-column flex-md-row gap-1 gap-md-3 gap-lg-5 align-items-md-center">
                <div class="job_info">
                  <i class="bi bi-geo-alt-fill"></i>
                  <p>{{$job->location}}</p>
                </div>
                <div class="job_info">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="bi bi-buildings-fill"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M15 .5a.5.5 0 0 0-.724-.447l-8 4A.5.5 0 0 0 6 4.5v3.14L.342 9.526A.5.5 0 0 0 0 10v5.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14h1v1.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5zM2 11h1v1H2zm2 0h1v1H4zm-1 2v1H2v-1zm1 0h1v1H4zm9-10v1h-1V3zM8 5h1v1H8zm1 2v1H8V7zM8 9h1v1H8zm2 0h1v1h-1zm-1 2v1H8v-1zm1 0h1v1h-1zm3-2v1h-1V9zm-1 2h1v1h-1zm-2-4h1v1h-1zm3 0v1h-1V7zm-2-2v1h-1V5zm1 0h1v1h-1z"
                    />
                  </svg>
                  <p>{{__('main.'.$job->job_type)}}</p>
                </div>
                <div class="job_info">
                  <i class="bi bi-briefcase-fill"></i>
                  <p>{{$job->job_experience}}</p>
                </div>
              </div>
          </div>

          <div class="job-description">
            <p class="fw-bold m-4">@lang('site.details')</p>
            {!! $job->job_description !!}
            <button class="d-block w-100 main-btn" data-bs-toggle="modal" data-bs-target="#applayJob_modal" >
              @lang('site.hire')
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- confirm applay Job modal -->
    <div class="modal fade" id="applayJob_modal" tabindex="-1" aria-labelledby="applayJob_modalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="job_id" value="{{$job->id}}">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="applayJob_modalLabel"> @lang('site.hire now') </h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row justify-content-center">
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label for="app-fname" class="col-form-label">@lang('site.name') <span class="text-danger">*</span></label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" id="app-fname">
                    <span class="text-danger name"></span>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label for="app-lname" class="col-form-label"> @lang('site.job_title') <span class="text-danger">*</span></label>
                    <input type="text" name="job_title" value="{{old('job_title')}}" class="form-control" id="app-lname">
                    <span class="text-danger job_title"></span>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label for="app-mail" class="col-form-label">@lang('site.email') <span class="text-danger">*</span></label>
                    <input type="email" name="email" value="{{old('email')}}" class="form-control" id="app-mail">
                    <span class="text-danger email"></span>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label for="app-phone" class="col-form-label">@lang('site.mobile') <span class="text-danger">*</span></label>
                    <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control" id="app-phone">
                    <span class="text-danger mobile"></span>
                  </div>
                </div>
                <div class="col-lg-12">
                  <label for="CV" class="col-form-label">@lang('site.upload_cv') <span class="text-danger">*</span></label>
                  <div class="file-input form-control position-relative">
                      <input name="upload_cv" type="file" id="CV" accept=".pdf,.doc,.docx,.txt">
                      <span class="button">
                        <i class="bi bi-paperclip"></i>
                      </span>
                      <span class="label" data-js-label="">
                       @lang('site.upload ur cv here')
                    </span></div>
                    <span class="text-danger upload_cv"></span>
                </div>
              </div>
            </div>
            <div class="modal-footer gap-1">
                <div class="loading-indicator">
                    <p>Loading...</p>  <!-- Optional: you can use a spinner here -->
                     <button type="submit" class="main-btn m-0 send-form">@lang('site.send')</button>
                </div>
              <button type="button" class="main-outline-btn px-4 m-0" data-bs-dismiss="modal">@lang('site.close')</button>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection
@push('custom-js')
<script type="text/javascript">
  $(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
})
    var submitButton = $(".send-form");
    var loadingIndicator = $(".loading-indicator p");
    submitButton.prop("disabled", false);
    loadingIndicator.hide();

    $(".send-form").click(function(e){
      e.preventDefault();
        var formData = new FormData();
            formData.append('_token', $("input[name='_token']").val());
            formData.append('job_id', $("input[name='job_id']").val());
            formData.append('name', $("input[name='name']").val());
            formData.append('job_title', $("input[name='job_title']").val());
            formData.append('mobile', $("input[name='mobile']").val());
            formData.append('email', $("input[name='email']").val());

            // Correctly access the file input
            var fileInput = $("input[name='upload_cv']")[0];
            if (fileInput.files.length > 0) {
                formData.append('upload_cv', fileInput.files[0]);
            } else {
                console.error('No file selected'); 
            }
          $.ajax({
                url: "{{ route('storeJob') }}",
                type:'POST',
                contentType: false, // Important for file uploads
                processData: false, // Important for file uploads
                data: formData,
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
                        if(typeof data.errors['email'] !== 'undefined') {
                          $('.email').text(data.errors['email'])
                        }else{
                             $(".email").text('');                      
                        }
                        if(typeof data.errors['job_title'] !== 'undefined') {
                          $('.job_title').text(data.errors['job_title'])
                        }else{
                             $(".job_title").text('');                      
                        }
                        if(typeof data.errors['name'] !== 'undefined') {
                          $('.name').text(data.errors['name'])
                        }else{
                             $(".name").text('');                      
                        }
                        if(typeof data.errors['upload_cv'] !== 'undefined') {
                          $('.upload_cv').text(data.errors['upload_cv'])
                        }else{
                             $(".upload_cv").text('');                      
                        }
                    }else{
                        $(".mobile").text(''); 
                        $(".job_title").text(''); 
                        $(".name").text(''); 
                        $(".email").text(''); 
                        $(".upload_cv").text(''); 
                    }
                    if (data.data == 1) {
                        $("input[name='name']").val('');
                        $("input[name='mobile']").val('');
                        $("input[name='job_title']").val('');
                        $("input[name='email']").val('');
                        $("input[name='upload_cv']").val('');
                        $('span.label').remove();
                        toastr.success("@lang('site.job apply done')");            
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