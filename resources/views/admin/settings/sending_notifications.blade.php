@extends('admin.index')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <div>
                @include('admin.partials.breadcrumb')
            </div>
        </div>
    </div>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 card">
          <ul class="nav nav-pills mb-3 user-pills" id="pills-tab" role="tablist">
            <li class="nav-item mt-3 ms-3 mb-3">
              <a class="nav-link active" id="pills-user_notifies-tab" data-bs-toggle="pill" data-bs-target="#pills-user_notifies" type="button" role="tab" aria-controls="pills-user_notifies" aria-selected="true"><i class="fa fa-paperclip"></i> @lang('main.send user_notifies')</a>
            </li>
            <li class="nav-item mt-3 ms-3 mb-3">
              <a class="nav-link @if(auth('admin')->user()->account_type == 'operator') active @endif" id="pills-valet_notifies-tab" data-bs-toggle="pill" data-bs-target="#pills-valet_notifies" type="button" role="tab" aria-controls="pills-valet_notifies" aria-selected="true"> <i class="fa fa-blog"></i> @lang('main.send vendor_notifies')</a>
            </li>
          </ul>

          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="pills-user_notifies" role="tabpanel" aria-labelledby="pills-user_notifies-tab">
              <form method="post" action="{{route('fcm_notifications.store',['user_type' => 'user'])}}">
                @csrf
                <div class="form-group col-sm-10" id="user-choose" >
                  <label for="choose_user">@lang('main.choose')</label><br/>
                  <div class="form-group col-sm-10">
                      <input type="radio" checked name="choose_user" value="0" class=""> @lang('main.select all users')
                  
                  </div>
                  <div class="form-group col-sm-10">
                      
                  <input type="radio" name="choose_user" value="1" class=""> @lang('main.select specific users')
                  </div>
                  <select name="user_id[]" multiple class="form-control " id="show-case">  
                    @foreach($users as $user)
                    <option value="{{$user->id}}"> @lang('main.users.name'): {{$user->name}} / @lang('main.users.mobile'): {{$user->mobile}}</option> 
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-sm-10">
                  <label for="title"> @lang('main.title')</label><span class="text-danger">*</span>
                  <input type="text" name ="title" required value="{{old('title')}}" class="form-control" id="title" placeholder="">
                </div>

                <div class="form-group col-sm-10">
                  <label for="body">@lang('main.body')</label>
                  <textarea name="body" class="form-control" id="body" placeholder="@lang('main.enter body')">
                    {{old('body')}}
                  </textarea>
                </div>
                

                <div class="form-group col-sm-10">
                  <button type="submit" class="btn btn-success">@lang('main.send')</button>
                </div>
              </form>
            </div>
            <div class="tab-pane fade" id="pills-valet_notifies" role="tabpanel" aria-labelledby="pills-valet_notifies-tab">
              <form method="post" action="{{route('fcm_notifications.store',['user_type' => 'vendor'])}}">
                @csrf
                <div class="form-group col-sm-10" id="user-choose" >
                  <label for="choose_user">@lang('main.choose')</label><br/>
                  <div class="form-group col-sm-10">
                      <input type="radio" checked name="choose_user" value="0" class=""> @lang('main.select all vendors')
                  
                  </div>
                  <div class="form-group col-sm-10">
                      
                  <input type="radio" name="choose_user" value="1" class=""> @lang('main.select specific vendors')
                  </div>
                  <select name="user_id[]" multiple class="form-control " id="show-case">  
                    @foreach($subadmins as $subadmin)
                    <option value="{{$subadmin->id}}"> @lang('main.users.name'): {{$subadmin->name}} / @lang('main.users.mobile'): {{$subadmin->mobile}}</option> 
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-sm-10">
                  <label for="title"> @lang('main.title')</label><span class="text-danger">*</span>
                  <input type="text" name ="title" required value="{{old('title')}}" class="form-control" id="title" placeholder="">
                </div>

                <div class="form-group col-sm-10">
                  <label for="body">@lang('main.body')</label>
                  <textarea name="body" class="form-control" id="body" placeholder="">
                    {{old('body')}}
                  </textarea>
                </div>
                

                <div class="form-group col-sm-10">
                  <button type="submit" class="btn btn-success">@lang('main.send')</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

</div>
@endsection
