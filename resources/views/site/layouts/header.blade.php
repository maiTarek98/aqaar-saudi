<!DOCTYPE html> 
<html lang="ar" @if(App::getLocale() == 'en') dir="ltr" @else dir="rtl" @endif>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') </title>
    <link rel="shortcut icon" type="image/x-icon" href="{{url('/storage/'.app(App\Models\GeneralSettings::class)->favicon)}}" sizes="65x65" />
    @include('site.includes.meta-section')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- font awesome cdn link  -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
      integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <!-- Bootstrap link  -->
    <link
      rel="stylesheet"
      href="{{url('site')}}/css/bootstrap.rtl.min.css"
      id="bootstrap-style"
    />
    <link rel="stylesheet" href="{{url('site')}}/css/bootstrap-icons.min.css" />

    <!-- owl-carousel link -->
    <link rel="stylesheet" href="{{url('site')}}/css/owl.theme.default.min.css" />
    <link rel="stylesheet" href="{{url('site')}}/css/owl.carousel.min.css" />

    <!-- nice select link -->
    <link rel="stylesheet" href="{{url('site')}}/css/nice-select.css" />

    <!-- fancybox link -->
    <link rel="stylesheet" href="{{url('site')}}/css/jquery.fancybox.min.css" />

    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{url('site')}}/css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <style type="text/css">
    .error-message{
        color:red;
        font-weight:bolder;
    }
  </head>

  <body>