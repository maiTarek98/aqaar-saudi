@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="container-fluid">
            <div class="content-header">
                <div class="content-header">
                    {{-- search part --}}
                    @include('admin.partials.breadcrumb')
                </div>            
            </div><!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                @include('admin.layouts.alerts')
                <div class="row g-3">
                    <div class="{{ ($user->id == auth('admin')->user()->id) ? 'col-md-8' : 'col-12' }}">
                        <form method="post" action="{{ route('users.update', ['account_type' => request('account_type'),$user->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('admin.users.form')
                        </form>
                    </div>
                
                 @if( $user->id == auth('admin')->user()->id)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">تغيير كلمة السر</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('changePassword')}}">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="password"> @lang('main.password') الحالية</label><span class="text-danger">*</span>
                                        <div class="input-group">
                                            <input type="password" name="password" value=""
                                                class="form-control @error('password') is-invalid @enderror" id="password"
                                                placeholder="@lang('main.users.password')">
                                            <button type="button" class="pass input-group-text" toggle="#password">
                                                <i class="bi bi-lock"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="password"> @lang('main.password') الجديدة</label><span class="text-danger">*</span>
                                        <div class="input-group">
                                            <input type="password" name="password" value=""
                                                class="form-control @error('password') is-invalid @enderror" id="password"
                                                placeholder="@lang('main.users.password')">
                                            <button type="button" class="pass input-group-text" toggle="#password">
                                                <i class="bi bi-lock"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="password"> تأكيد @lang('main.password') الجديدة</label><span class="text-danger">*</span>
                                        <div class="input-group">
                                            <input type="password" name="password" value=""
                                                class="form-control @error('password') is-invalid @enderror" id="password"
                                                placeholder="@lang('main.users.password')">
                                            <button type="button" class="pass input-group-text" toggle="#password">
                                                <i class="bi bi-lock"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-action mt-3 d-flex gap-3">                
                                    <button type="submit" class="btn btn-primary px-5 shadow-sm"><i class="fa-regular fa-floppy-disk"></i> @lang('main.save')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            </section>

        </div><!-- /.container-fluid -->
    </div>
@endsection