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
                @include('admin.partials.breadcrumb')
            </div>
            <div class="content">
                @include('admin.partials.search_part', ['route' => route($model.'.index')])
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            التجار المتقدمين
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