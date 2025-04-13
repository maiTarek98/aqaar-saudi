@extends('admin.index')
@push('custom-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="mb-0 fs-5 fw-bold" style="color: var(--main)">@lang('main.ShowAllBanners')
            <small class="countModule">( {{$banners->total()}} ) </small>

                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('banners.create') }}"
                                    class="btn btn-primary">@lang('main.AddBanner')</a></li>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="">
                    <div class="card">
                        @push('card_title')
                            @lang('main.Banners')            <small class="countModule">( {{$banners->count()}} ) </small>

                        @endpush
                        @include('admin.partials.card_header_in_index')

                        <div class="card-body">
                            {{-- Buttons part --}}
                            <div class="btn-group flex-wrap float-end mb-4">
                                @include('admin.partials.button_group', [
                                    'url' => url('admin/bannersDeleteAll'),
                                ])
                            </div>
                            {{-- search part --}}
                            <div class="float-start mb-4">
                                @include('admin.partials.search_part', ['route' => route('banners.index')])
                            </div>

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <th width="50px"><input type="checkbox" id="master"></th>
                                    <th>#</th>
                                    <th>@lang('main.BannerImage')</th>
                                    <th>@lang('main.BannerName')</th>
                                    <th>@lang('main.actions')</th>

                                </thead>
                                <tbody>
                                    @forelse ($banners as $banner)
                                        <tr>
                                            <td><input type="checkbox" class="sub_chk" data-id="{{ $banner->id }}"></td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img class="cursor-img" data-toggle="modal"
                                                    data-target="#exampleModal{{ $banner->id }}"
                                                    src="{{ url($banner->banner_image) }}" height="80" width="80">
                                                @include('admin.components.modal_photo', [
                                                    'image' => url("$banner->banner_image"),
                                                    'id' => $banner->id,
                                                ])
                                            </td>
                                            <td>{{ $banner->banner_name }}</td>

                                            <td width="250px">
                                                @can('banner-list')
                                                    <a class="btn btn-info btn-sm"
                                                        href="{{ route('banners.show', $banner->id) }}"><i class="fa-solid fa-eye"></i></a>
                                                @endcan
                                                @can('banner-edit')
                                                    <a class="btn btn-warning"
                                                        href="{{ route('banners.edit', $banner->id) }}">@lang('main.edit')</a>
                                                @endcan
                                                @can('banner-delete')
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['banners.destroy', $banner->id], 'style' => 'display:inline']) !!}
                                                    <button type="submit"
                                                        class="btn btn-danger show_confirm">@lang('main.delete')</button>
                                                    {!! Form::close() !!}
                                                @endcan

                                            </td>
                                        </tr>
                                    @empty
                                        <td class="text-center text-muted" style="font-size: 25px" colspan="5">
                                            {{ trans('main.NoBanners') }}
                                        </td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{ $banners->links() }}
            </div>
        </section>
    </div>
@endsection
