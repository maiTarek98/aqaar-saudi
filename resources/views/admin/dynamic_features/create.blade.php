@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">
                                @lang('main.add') @lang('main.dynamic_features.dynamic_feature')
                            </li>
                        </ol>
                    </div>
                    <a href="{{ route('dynamic_features.index') }}" class="btn btn-primary d-flex align-items-center gap-1 add-list">
                        <i class="fa-solid fa-plus"></i>
                        <span>@lang('main.showAll') @lang('main.dynamic_features.dynamic_features')</span>
                    </a>
                </div>
            </div>
            <!-- /.content-header -->
            
    
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        @include('admin.layouts.alerts')
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="{{ route('dynamic_features.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    @include('admin.dynamic_features.form')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
