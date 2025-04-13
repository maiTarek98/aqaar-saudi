@extends('site.index')
@section('title', trans('site.vendorRegisteration') )
@push('custom-css')
@endpush
@section('content')
<!-- register -->
@include('site.includes.vendor-form')

@endsection
@push('custom-js')
@endpush