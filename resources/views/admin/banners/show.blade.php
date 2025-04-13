@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="mb-0 fs-5 fw-bold" style="color: var(--main)">@lang('main.ShowBanner') {{ $banner->banner_name }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('banners.index') }}"
                                    class="btn btn-primary">@lang('main.ShowAllBanners')</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group col-sm-10">
                                    <label for="name"> @lang('main.AdminName')</label>
                                    <span>{{ $banner->admin->name }}</span>
                                </div>

                                <div class="form-group col-sm-10">
                                    <label for="name"> @lang('main.BannerName')</label>
                                    <input type="text" name="name" value="{{ $banner->banner_name }}"
                                        class="form-control" id="name" readonly>
                                </div>

                                <div class="form-group col-sm-10">
                                    <label for="email">@lang('main.BannerImage')</label>
                                    <img class="cursor-img" data-toggle="modal" data-target="#exampleModal{{$banner->id}}" src="{{ url("$banner->banner_image") }}" width="7%">
                                      <!-- Modal -->
                            @include('admin.components.modal_photo',['image' => url("$banner->banner_image"), 'id' => $banner->id])
    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
