@extends('admin.index')
@push('custom-css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="content">
                <div class="mb-3"> 
                    <div id="crud-table-container">
                        <x-crud-table :result="$result" :fields="$fields" :model="$model" :queryParameters="$queryParameters"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection