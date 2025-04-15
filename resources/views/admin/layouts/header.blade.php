<!DOCTYPE html>
@if (App::getLocale() == 'ar')
<html lang="ar" dir="rtl">
@else
<html lang="en" dir="ltr">
@endif
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ app(App\Models\GeneralSettings::class)->site_name() }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- fav icon -->
    <link rel="icon" type="image/x-icon" href="{{ url('/storage/' . app(App\Models\GeneralSettings::class)->favicon) }}">

    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    
    <!-- summernote -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.9.1/summernote-bs5.min.css">  

    <!-- bootstrap -->
    @if (App::getLocale() == 'ar')
    <link rel="stylesheet" href="{{ url('/dashboard') }}/plugins/bootstrap/css/bootstrap.rtl.min.css">
    @else
    <link rel="stylesheet" href="{{ url('/dashboard') }}/plugins/bootstrap/css/bootstrap.min.css">
    @endif
    
    <!-- select2 -->
    <link rel="stylesheet" href="{{ url('/dashboard') }}/plugins/select2/css/select2.min.css">
    
    <!-- fancybox -->
    <link rel="stylesheet" href="{{ url('/dashboard') }}/plugins/fancybox/css/jquery.fancybox.min.css">

    <!-- carousel -->
    <link rel="stylesheet" href="{{ url('/dashboard') }}/dist/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ url('/dashboard') }}/dist/css/owl.theme.default.min.css">

    <!-- toastr -->
    <link href="{{ url('/dashboard/') }}/dist/css/toastr.css" rel="stylesheet" />
     
    @stack('custom-css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300&display=swap" rel="stylesheet">

    <!-- daterangepicker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.css">

    <!-- tagsinput -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">

    <!-- datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>

    <!-- dashboard -->
    <link rel="stylesheet" href="{{ url('/dashboard') }}/dist/css/admin.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('/dashboard') }}/dist/css/custom.css">
    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="fixed-icon">
            <a href="{{ url('/admin/videos/how-to-use') }}" class="videos" target="_blank" aria-label="الإنتقال إلى رابط الفيديوهات">
                <i class="bi bi-collection-play"></i>
            </a>
        </div>
