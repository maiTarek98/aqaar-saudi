@extends('admin.index')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-right:0px;">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <p class="welcome">أهلًأ بكـ</p>
      <p class="login_type">@lang('main.choose type')</p>
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
    <style>
        .content-wrapper{
            align-content: center;
        }
        .navbar{
            margin: 0 !important;
        }
        [data-widget="pushmenu"]{
            display: none !important;
        }
        .card {
            align-items: center;
            justify-content: space-around;
            gap: 1rem;
            border: unset;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: -10px 10px 20px #bcbcbc19;
            padding: 2rem;
            text-align: center;
            height: 100%;
        }
        .card-img-top img {
            object-fit: contain;
            max-width: 100px;
            margin: auto;
            display: block;
        }
        .welcome {
           color: #6B6B6B;
           font-size: 28px;
           margin-bottom: .5rem;
           text-align: center !important;
        }
        
        .login_type {
           color: #1c608d;
           font-size: 30px;
           font-weight: bold;
           margin-bottom: 1.35rem;
           text-align: center !important;
        }
        .footer-i h5{
            font-weight: bold;
        }
        
    </style>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center gap-4">
            <div class="col-sm-4 text-center">
                <div class="card">
                    <div class="card-img-top">
                        <img src="{{ url('/dashboard') }}/dist/img/data-analytics.png">
                    </div>
                    <div class="footer-i">
                        <h5 class="text-center">@lang('main.website dashboard')</h5>
                    </div>
                    <a href="{{route('chooseTypeChange',['type'=> 'website'])}}" class="main-btn">
                        للدخول اضغط هنا
                    </a>
                </div>  
            </div>

            <div class="col-sm-4 text-center">
                <div class="card">
                    <div class="card-img-top">
                        <img src="{{ url('/dashboard') }}/dist/img/mobile-analytics.png">
                    </div>
                    <div class="footer-i">
                        <h5 class="text-center">@lang('main.application dashboard')</h5>
                    </div>
                    <a href="{{route('chooseTypeChange',['type'=> 'application'])}}" class="main-btn">
                        للدخول اضغط هنا
                    </a>
                </div>  
            </div>
        </div>
   </div>
  </section>
</div>               
@endsection