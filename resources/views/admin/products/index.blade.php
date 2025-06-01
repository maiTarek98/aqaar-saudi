@extends('admin.index')
@push('custom-css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                @include('admin.partials.breadcrumb')
            </div>
            <div class="content">
                
                <div class="owl-carousel">
                    <a href="{{url('/admin/products?form_type=add_property')}}" class="info-box @if(request('form_type') == 'add_property') active @endif">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="info-box-content d-flex align-items-center gap-2">
                                <span class="info-box-icon text-start">
                                    <i class="fa-solid fa-building"></i>
                                </span>
                                <span class="info-box-text m-0">العروض</span>
                            </div>
                            <span class="info-box-number fs-5">
                                {{\App\Models\Product::where('form_type','add_property')->count()}}
                            </span>
                        </div>
                    </a>
                    <a href="{{url('/admin/products?form_type=add_request')}}" class="info-box @if(request('form_type') == 'add_request') active @endif">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="info-box-content d-flex align-items-center gap-2">
                                <span class="info-box-icon text-start">
                                    <i class="fa-solid fa-building-user"></i>
                                </span>
                                <span class="info-box-text m-0">الطلبات</span>
                            </div>
                            <span class="info-box-number fs-5">
                                {{\App\Models\Product::where('form_type','add_request')->count()}}
                            </span>
                        </div>
                    </a>
                    <a href="{{url('/admin/products?form_type=site_property')}}" class="info-box @if(request('form_type') == 'site_property') active @endif">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="info-box-content d-flex align-items-center gap-2">
                                <span class="info-box-icon text-start">
                                    <i class="fa-solid fa-building-user"></i>
                                </span>
                                <span class="info-box-text m-0">عقارات داخل الموقع</span>
                            </div>
                            <span class="info-box-number fs-5">
                                {{\App\Models\Product::where('form_type','site_property')->count()}}
                            </span>
                        </div>
                    </a>
                 </div>
                
                @include('admin.partials.search_part', ['route' => route($model.'.index')])
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            @lang('main.products.products')
                            <b>({{$result->total()}})</b>
                        </h3>
                        @can($model.'-delete')
                        <div class="btn-group">
                            @include('admin.partials.button_group', [
                            'url' => route($model.'.deleteAll'),
                            ])
                        </div>
                        @endcan
                    </div>
                    <div class="card-body px-0">
                        <div id="crud-table-container">
                            <x-crud-table :result="$result" :fields="$fields" :model="$model" :queryParameters="$queryParameters"/>
                        </div>         
                    </div>         
                </div>
            </div>
        </div>
    </div>
@endsection