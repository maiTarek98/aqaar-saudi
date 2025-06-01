@extends('admin.index')
@push('custom-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">
                                @lang('main.showAll') @lang('main.dynamic_features.dynamic_features')
                            </li>
                        </ol>
                    </div>
                    <a href="{{ route('dynamic_features.create') }}" class="btn btn-primary d-flex align-items-center gap-1 add-list">
                        <i class="fa-solid fa-plus"></i>
                        <span>@lang('main.add') @lang('main.dynamic_features.dynamic_feature')</span>
                    </a>
                </div>
            </div>
            <!-- /.content-header -->
            
            <!-- Main content -->
            <section class="content">
            <div class="">
                <div class="card">
                    @push('card_title')
                        @lang('main.dynamic_features.dynamic_features')            
                        <small class="countModule">( {{$dynamic_features->count()}} ) </small>

                    @endpush
                    @include('admin.partials.card_header_in_index')

                    <div class="card-body">
                        {{-- Buttons part --}}
                        <div class="btn-group flex-wrap float-end mb-4">
                            @include('admin.partials.button_group', [
                                'url' => url('admin/dynamic_featuresDeleteAll'),
                            ])
                        </div>
                        {{-- search part --}}
                        <div class="float-start mb-4">
                            @include('admin.partials.search_part', ['route' => route('dynamic_features.index')])
                        </div>

                        <table class="table table-bordered table-hover">
                            <thead>
                                <th width="50px"><input type="checkbox" id="master" class="sub_chk"></th>
                                <th>#</th>
                                <th>@lang('main.dynamic_features.label_name')</th>
                                <th>@lang('main.actions')</th>

                            </thead>
                            <tbody>
                                @forelse ($dynamic_features as $dynamic_feature)
                                    <tr>
                                        <td><input type="checkbox" class="sub_chk" data-id="{{ $dynamic_feature->id }}"></td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dynamic_feature->label_name }}</td>
                                        <td width="250px">
                                            <a href="{{ route('dynamic_features.edit', $dynamic_feature->id) }}" class="btn btn-outline-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="@lang('main.edit')"><i class="fa fa-edit mr-0"></i></a>
                                                        
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['dynamic_features.destroy', $dynamic_feature->id], 'style' => 'display:inline']) !!}
                                                <button type="submit" class="btn btn-outline-danger btn-sm show_confirm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="@lang('main.delete')"><i class="fa fa-trash mr-0"></i>
                                            </button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <td class="text-center text-muted" style="font-size: 25px" colspan="5">
                                        {{ trans('main.Nodynamic_features') }}
                                    </td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $dynamic_features->links() }}
        </section>
        </div>
    </div>
@endsection
