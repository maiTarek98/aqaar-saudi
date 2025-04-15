@extends('admin.index')
@section('content')
 <div class="content-wrapper">
    <div class="container-fluid">
        <div class="content-header">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div>
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">
                                    <a href="{{url('/')}}" class="fs-6 fw-bold">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item">
                                    @lang('main.videos.how to use')
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content">
            
            <a href="{{url('storage/dash_videos/dash_spirint1.mp4')}}" data-fancybox="videos" class="info-box d-flex align-items-center gap-3 mb-3">
                <span class="info-box-icon">
                    <i class="bi bi-play-circle fs-2"></i>
                </span>
                <div class="info-box-content">
                    <h2 class="info-box-text fs-6 fw-bold mb-1">Video 1 </h2>
                    <small>(فيديو شرح لوحة التحكم جزء "الأقسام، العلامات التجارية، المديرين، المستخدمين، التجار، المتاجر، التجار المتقدمين، المنتجات")</small>
                </div>
            </a>
            
            
            <a href="{{url('storage/dash_videos/dash_spirint2.mp4')}}" data-fancybox="videos" class="info-box d-flex align-items-center gap-3 mb-3">
                <span class="info-box-icon">
                    <i class="bi bi-play-circle fs-2"></i>
                </span>
                <div class="info-box-content">
                    <h2 class="info-box-text fs-6 fw-bold mb-1">Video 2 </h2>
                    <small>(فيديو شرح التطبيق جزء "تسجيل حساب جديد، تسجيل دخول، حذف حساب ، تغيير كلمة المرور، الرئيسية، اسكرينة المنتجات ، سنجل المنتجات ، اضافة المنتج الي السلة و المفضلة والمقارنه")</small>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection