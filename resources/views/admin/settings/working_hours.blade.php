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
    <section class="content">
        <div class="container-fluid">
            @include('admin.layouts.alerts')
            <form class="from-prevent-multiple-submits" method="post" action="{{ route('settings.updateWorkingHours',$user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>@lang('main.day')</th>
                            <th>@lang('main.day_type')</th>
                            <th>@lang('main.work_time')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(week_days() as $day)
                        <tr>
                            <td>{{ __("main.$day") }}</td>
                            <td>
                            <label for="type">@lang('main.day_type')</label>
                                <select name="type[{{$day}}]" onchange="change_type(this)" data-id="{{$day}}" class="form-select type" id="type{{$day}}">
                                    <option value="" hidden>@lang('main.day_type')</option>
                                    <option value="off" {{($user->hour($day) && $user->hour($day)->type == 'off') ? 'selected' : ''}}>@lang('main.off')</option>
                                    <option value="all_day" {{(!$user->hour($day) || ($user->hour($day) && $user->hour($day)->type == 'all_day')) ? 'selected' : ''}}>@lang('main.all_day')</option>
                                    <option value="periods" {{$user->hour($day) && $user->hour($day)->type == 'periods' ? 'selected' : ''}}>@lang('main.periods')</option>
                                </select>
                            </td>
                            
                            <!-- إجازة -->
                            <td id="off{{$day}}_cell" style="display: none;">@lang('main.off_day')</td>

                            <!-- متاح 24 ساعة -->
                            <td id="all_day{{$day}}_cell" style="display: none;">@lang('main.available_24_hours')</td>

                            <!-- الفترات -->
                            <td id="periods{{$day}}_cell" style="display: none;">
                                <div class="row g-2">
                                    <div class="col">
                                        <div class="form-group m-0">
                                            <label for="morning_from"> @lang('main.morning_from')</label>
                                            <input type="time" name="morning_from[{{$day}}]"  value="{{ old('morning_from', $user->hour($day)?->morning_from) }}"
                                            class="form-control  @error('morning_from') is-invalid @enderror" id="morning_from" placeholder="@lang('main.Entermorning_from')">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group m-0">
                                            <label for="morning_to"> @lang('main.morning_to')</label>
                                            <input type="time" name="morning_to[{{$day}}]" value="{{ old('morning_to', $user->hour($day)?->morning_to) }}"
                                            class="form-control  @error('morning_to') is-invalid @enderror" id="morning_to" placeholder="@lang('main.Entermorning_to')">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group m-0">
                                            <label for="evening_from"> @lang('main.evening_from')</label>
                                            <input type="time" name="evening_from[{{$day}}]" value="{{ old('evening_from', $user->hour($day)?->evening_from) }}"
                                            class="form-control  @error('evening_from') is-invalid @enderror" id="evening_from" placeholder="@lang('main.Enterevening_from')">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group m-0">
                                            <label for="evening_to"> @lang('main.evening_to')</label>
                                            <input type="time" name="evening_to[{{$day}}]" value="{{ old('evening_to', $user->hour($day)?->evening_to) }}"
                                            class="form-control  @error('evening_to') is-invalid @enderror" id="evening_to" placeholder="@lang('main.Enterevening_to')">
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="form-group col-sm-10">
                    <button type="submit" class="btn btn-success from-prevent-multiple-submits">@lang('main.save')</button>
                </div>
            </form>            
        </div>
    </section>
</div>
@endsection

@push('custom-js')
<script>
    function change_type(select) {
        const dayId = $(select).data('id');
        const type = $(select).val();

        // إخفاء جميع الحقول
        $('#off' + dayId + '_cell').hide();
        $('#all_day' + dayId + '_cell').hide();
        $('#periods' + dayId + '_cell').hide();

        // إظهار الحقول بناءً على نوع اليوم
        if (type === 'off') {
            $('#off' + dayId + '_cell').show(); // إظهار "إجازة"
        } else if (type === 'all_day') {
            $('#all_day' + dayId + '_cell').show(); // إظهار "متاح 24 ساعة"
        } else if (type === 'periods') {
            $('#periods' + dayId + '_cell').show(); // إظهار "الفترات"
        }
    }

    $(document).ready(function() {
        // تنفيذ الوظيفة عند تحميل الصفحة لجميع الأيام
        $('.type').each(function() {
            change_type(this); // تنفيذ الوظيفة عند التحميل
        });

        // إضافة الحدث عند تغيير القيمة في select
        $('.type').change(function() {
            change_type(this); // تنفيذ الوظيفة عند التغيير
        });
    });
</script>
@endpush
