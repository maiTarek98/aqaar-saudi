@extends('admin.index')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="mb-0 fs-5 fw-bold" style="color: var(--main)">@lang('main.show slider') {{$slider->title}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="{{route('sliders.index')}}" class="btn btn-primary">@lang('main.show all sliders')</a></li>
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
                <label for="title"> @lang('main.title')</label>
                <input type="text" name="title" value="{{$slider->title}}" class="form-control" id="title" readonly>
              </div>
              <div class="form-group col-sm-10">
                <label for="description"> @lang('main.description')</label>
                <input type="text" name="description" value="{{$slider->description}}" class="form-control" id="description" readonly>
              </div>
              {{-- <div class="form-group col-sm-10">
                <label for="slider_image">@lang('main.slider_image')</label>
                <img src="{{$slider->getFirstMediaUrl('slider_image', 'thumb')}}" width="30%">
              </div>--}}
              <div class="form-group col-sm-10">
                <label for="status">@lang('main.status')</label>
                <input type="text" name="status" class="form-control" value="{{$slider->status}}" readonly>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
@endsection