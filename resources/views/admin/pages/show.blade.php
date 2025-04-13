@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-2 d-flex align-items-center justify-content-between">
                    <h1 class="mb-0 fs-5 fw-bold" style="color: var(--main)">@lang('main.Showcontact')</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('contacts.index') }}"
                                class="main-btn">@lang('main.ShowAllcontacts')</a></li>
                    </ol>
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
                                    <label> @lang('main.addedBy')</label>
                                    <span>{{ $page->admin?->name }}</span>
                                </div>

                                <div class="form-group col-sm-12">
                                    <label> @lang('main.title')</label>
                                    <input type="text" name="name"
                                        value="{{ $page->title }}"
                                        class="form-control" readonly>
                                </div>

                                <div class="form-group col-sm-12">
                                    <label> @lang('main.contactMessage')</label>
                                    <textarea class="form-control" readonly>{{ $page->content}}</textarea>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
