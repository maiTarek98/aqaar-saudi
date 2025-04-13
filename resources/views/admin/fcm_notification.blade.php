@extends('admin.index')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="mb-0 fs-5 fw-bold" style="color: var(--main)">@lang('main.notifications')</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
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
          <div class="card-body">
            <h2>Send notification</h2>
            <form method="post" action="{{route('fcm_notifications.store')}}">
              @csrf
              <div class="form-group col-sm-10">
                <label for="title"> @lang('main.title')</label>
                <input type="text" name ="title" value="{{old('title')}}" class="form-control" id="title" placeholder="@lang('main.enter title')">
              </div>

              <div class="form-group col-sm-10">
                <label for="body">@lang('main.body')</label>
                <input type="text" name="body" value="{{old('body')}}" class="form-control" id="body" placeholder="@lang('main.enter body')">
              </div>
              <div class="form-group col-sm-10">
                <label for="gender">@lang('main.gender')</label>
                <input type="radio" name="choose_user" value="0" class="form-control"> @lang('main.select all users')
                <input type="radio" name="choose_user" value="1" class="form-control"> @lang('main.select specific users')
                <select name="user_id[]" multiple class="form-control">  
                  @foreach($users as $user)
                  <option value="{{$user->id}}">{{$user->name}}</option> 
                  @endforeach
                </select>
              </div>

              <div class="form-group col-sm-10">
                <button type="submit" class="btn btn-success">@lang('main.create')</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
