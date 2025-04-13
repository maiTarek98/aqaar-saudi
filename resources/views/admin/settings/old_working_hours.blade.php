@extends('admin.index')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="mb-0 fs-5 fw-bold" style="color: var(--main)">@lang('main.edit') @lang('main.workingHour')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    @include('admin.layouts.alerts')
                    <div class="card">
                        <div class="card-body">
                            <form class="from-prevent-multiple-submits" method="post" action="{{ route('settings.updateWorkingHours',$user->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                @foreach(week_days() as $day)
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <h4>@lang('main.'.$day)</h4>
                                            <br>
                                            <div class="container">
                                                <input type="hidden" name="day[{{$day}}]" value="{{$day}}"/>
                                                <div class="form-group col-sm-6">
                                                    <label for="type">@lang('main.day_type')</label>
                                                    <select name="type[{{$day}}]" onchange="change_type(this)" data-id="{{$day}}" class="form-control type" id="type">
                                                        <option value="">@lang('main.day_type')</option>
                                                        <option value="off" {{($user->hour($day)&& $user->hour($day)->type=='off') ?'selected':''}}>
                                                            @lang('main.off')
                                                        </option>
                                                        <option value="all_day"{{!$user->hour($day)|| ($user->hour($day)&& $user->hour($day)->type=='all_day' )?'selected':''}} >
                                                            @lang('main.all_day')
                                                        </option>
                                                        <option value="periods"{{$user->hour($day)&& $user->hour($day)->type=='periods' ?'selected':''}} >
                                                            @lang('main.periods')
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="row" id="date{{$day}}">
                                                    <div class="form-group col-sm-6">
                                                        <label for="morning_from"> @lang('main.morning_from')</label><span class="star-import">*</span>
                                                        <input type="time" name="morning_from[{{$day}}]"  value="{{ old('morning_from', $user->hour($day)?->morning_from) }}"
                                                        class="form-control  @error('morning_from') is-invalid @enderror" id="morning_from" placeholder="@lang('main.Entermorning_from')">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="morning_to"> @lang('main.morning_to')</label><span class="star-import">*</span>
                                                        <input type="time" name="morning_to[{{$day}}]" value="{{ old('morning_to', $user->hour($day)?->morning_to) }}"
                                                        class="form-control  @error('morning_to') is-invalid @enderror" id="morning_to" placeholder="@lang('main.Entermorning_to')">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="evening_from"> @lang('main.evening_from')</label><span class="star-import">*</span>
                                                        <input type="time" name="evening_from[{{$day}}]" value="{{ old('evening_from', $user->hour($day)?->evening_from) }}"
                                                        class="form-control  @error('evening_from') is-invalid @enderror" id="evening_from" placeholder="@lang('main.Enterevening_from')">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="evening_to"> @lang('main.evening_to')</label><span class="star-import">*</span>
                                                        <input type="time" name="evening_to[{{$day}}]" value="{{ old('evening_to', $user->hour($day)?->evening_to) }}"
                                                        class="form-control  @error('evening_to') is-invalid @enderror" id="evening_to" placeholder="@lang('main.Enterevening_to')">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="form-group col-sm-10">
                                    <button type="submit" class="btn btn-success from-prevent-multiple-submits">@lang('main.save')</button>
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
@push('custom-js')
<script>

 function change_type(a){
    var type = $(a).val();
    if(type=="periods"){
        $("#date"+$(a).attr('data-id')).show();
    }else{
        $("#date"+$(a).attr('data-id')).hide(); 
    }
};

$(document).ready(function(){
    $(".type").map(function(){
        change_type($(this));
    });
});

</script>
@endpush