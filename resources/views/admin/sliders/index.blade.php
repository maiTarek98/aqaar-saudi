@extends('admin.index')
@push('custom-css')
<style type="text/css">
  .search{
    margin-top: 20px;
  }
  .btn-search{
    position: relative;
    top: -38px;
    left: 112%;
  }
</style>
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="mb-0 fs-5 fw-bold" style="color: var(--main)">@lang('main.show all sliders')  <small class="countModule">( {{$sliders->total()}} ) </small>
</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{route('sliders.create')}}" class="btn btn-primary">@lang('main.add new slider')</a></li>
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
          <div class="col-lg-12 col-md-12 card">
              <form>
                <div class="col-md-4">
                  <input type="text" name="search" class="form-control search" placeholder="@lang('main.search')">
                  <button type="submit" class="btn btn-success btn-search"><li class="fa fa-search"></li> @lang('main.search')  </button>
                </div>
              </form>

            <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <th>#</th>
                <th>@lang('main.title')</th>
                <!--<th>@lang('main.slider_image')</th>-->
                <th>@lang('main.actions')</th>

              </thead>
              <tbody>
                @foreach ($sliders as $key => $slider)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{$slider->title}}</td>
                    {{--<td><img src="{{$slider->getFirstMediaUrl('slider_image', 'thumb')}}" width="20%"></td> --}}
                  <td>
                      <a class="btn btn-info btn-sm" href="{{ route('sliders.show',$slider->id) }}"><i class="fa-solid fa-eye"></i></a>
                      @can('slider-edit')
                          <a class="btn btn-warning" href="{{ route('sliders.edit',$slider->id) }}">@lang('main.edit')</a>
                      @endcan
                      @can('slider-delete')
                          {!! Form::open(['method' => 'DELETE','route' => ['sliders.destroy', $slider->id],'style'=>'display:inline']) !!}
                          <button type="submit" class="btn btn-danger">@lang('main.delete')</button>
                          {!! Form::close() !!}
                      @endcan
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {!! $sliders->links() !!}
          </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection