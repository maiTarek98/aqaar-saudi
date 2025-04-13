@extends('admin.index')
@push('custom-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .progress_switch{
            transform: rotate(90deg);
            display: flex;
            width: 105px;
        }
        .day_name{
            width: 130px;
            position: relative;
            transform: rotate(90deg);
            right: 33px;
            top: 56px;
        }
    </style>
@endpush
@section('content')
 <div class="content-page">
<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('admin.partials.breadcrumb', ['currentRoute' => route('products.index'), 'newRoute' => null])
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    @can('product-delete')
                            <div class="btn-group flex-wrap float-left mb-4">
                                @include('admin.partials.button_group', [
                                    'url' => url('admin/product_wishlistsDeleteAll'),
                                ])
                            </div>
                            @endcan
                            {{-- search part --}}
                            <div class="float-right mb-4">
                                @include('admin.partials.search_part', ['route' => route('products.index')])
                            </div>
                <table class="data-table table mb-0 tbl-server-info">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th width="50px"><input type="checkbox" id="master"></th>
                            <th>#</th>
                            <th>@lang('main.product_name')</th>
                            <th>@lang('main.username')</th>
                            <th>@lang('main.createdAt')</th>
                            <th>@lang('main.actions')</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @forelse ($product_wishlists as $product_wishlist)
                                        <tr>
                                            <td><input type="checkbox" class="sub_chk" data-id="{{ $product_wishlist->id }}"></td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{route('products.show',$product_wishlist->product_id)}}">{{ $product_wishlist->product?->name }}</a></td>
                                            <td>{{ $product_wishlist->user?->name }}</td>
                                            <td>{{ $product_wishlist->created_at->diffForHumans() }}</td>
                                            <td width="250px">
                                                @can('product-delete')
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['product_wishlists.destroy',$product_wishlist->id], 'style' => 'display:inline']) !!}
                                                    <button type="submit" class="border-0 badge bg-warning me-2 show_confirm" data-toggle="tooltip" data-placement="top" title="" data-original-title="@lang('main.delete')"><i class="ri-delete-bin-line mr-0"></i></button>
                                                    {!! Form::close() !!}
                                                @endcan

                                            </td>
                                        </tr>
                                    @empty
                                        <td class="text-center text-muted" style="font-size: 25px" colspan="7">
                                            {{ trans('main.Noproduct_wishlists') }}
                                        </td>
                                    @endforelse
                    </tbody>
                </table>
                                {{ $product_wishlists->links() }}
            </div>
        </div>
    </div>
        <!-- Page end  -->
    </div>
    </div>
@endsection