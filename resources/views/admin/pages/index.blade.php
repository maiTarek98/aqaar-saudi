@extends('admin.index')
@push('custom-css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                {{-- search part --}}
                @include('admin.partials.breadcrumb', ['currentRoute' => route($model.'.index'), 'newRoute' => route($model.'.create')])
                <b>({{$result->total()}})</b>
            </div>
            <div class="content">
                @include('admin.partials.search_part', ['route' => route($model.'.index')])
                <div class="mb-3">
                    @can($model.'-delete')
                    <div class="btn-group float-end ">
                        @include('admin.partials.button_group', [
                        'url' => route($model.'.deleteAll'),
                        ])
                    </div>
                    @endcan
                    <div id="crud-table-container">
                        <x-crud-table :result="$result" :fields="$fields" :model="$model" :queryParameters="$queryParameters"/>
                    </div>         
                </div>
            </div>
        </div>
    </div>
@endsection