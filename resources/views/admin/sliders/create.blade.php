@extends('admin.index')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="mb-0 fs-5 fw-bold" style="color: var(--main)">@lang('main.add new slider')</h1>
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
         @if(count($errors))
         <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        <div class="card">
          <div class="card-body">
            <form method="post" action="{{route('sliders.store')}}" enctype="multipart/form-data">
              @csrf
              <div class="row">
              <div class="form-group col-sm-6">
                <label for="title"> @lang('main.title')</label>
                <input type="text" name="title" value="{{old('title')}}" class="form-control" id="title" placeholder="@lang('main.enter title')">
              </div>
              <div class="form-group col-sm-6">
                <label for="description"> @lang('main.description')</label>
                <input type="text" name="description" value="{{old('description')}}" class="form-control" id="description" placeholder="@lang('main.enter description')">
              </div>
                {{--<div class="form-group col-sm-6">
                <label for="slider_image">@lang('main.slider_image')</label>
                <input type="file" name="slider_image" class="form-control" id="slider_image">
              </div>--}}
              <div class="form-group col-sm-6">
                <label for="status">@lang('main.status')</label>
                <select name="status" class="form-control" id="status">
                  <option value="show">@lang('main.show')</option>
                  <option value="hide">@lang('main.hide')</option>
                </select>
              </div>
              

              <div class="form-group col-sm-10">
                <button type="submit" class="btn btn-success">@lang('main.create')</button>
              </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
@endsection