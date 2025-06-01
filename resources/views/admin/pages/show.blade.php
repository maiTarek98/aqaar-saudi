@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="container-fluid">
            <div class="content-header">
                {{-- search part --}}
                @include('admin.partials.breadcrumb')
            </div>            
            <!-- Main content -->
            <section class="content">
                <div class="main-section row g-3">
                    <div class="sticky-side col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="customer-avatar-section border-bottom pb-3">
                                    <div class="d-flex align-items-center flex-column">
                                        <img src="{{ url('/dashboard') }}/dist/img/landing-page.png" class="img-fluid rounded-circle mb-3" width="120" height="" alt="Colette Moore">
                                        <div type="button" class="status-tag {{ $page->status == 'show' ? 'accepted' : 'declined' }} border-0">
                                            <i class="highlight"></i>
                                            <p class="status-tag__txt">{{ $page->status }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="customer-details py-3">
                                    <div class="d-flex flex-column gap-2">
                                        <div class="d-flex gap-2">
                                            <i class="bi bi-tag"></i>
                                            <div>
                                                <small class="fw-bold mb-1">                @lang('main.pages.title')
                                                </small>
                                                <p class="m-0">{{ $page->title}}         </p>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-side col-md-8">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title">@lang('main.pages.title')</h4>
                            </div>
                            <div class="card-body">
                               <p>{{ $page->title }}</p> 
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">@lang('main.pages.content')</h4>
                            </div>
                            <div class="card-body">
                               <p>{{ $page->content }}</p> 
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div><!-- /.container-fluid -->
    </div>
@endsection
