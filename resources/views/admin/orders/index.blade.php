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
        @include('admin.partials.search_part', ['route' => route($model.'.index')])
        <div class="owl-carousel">
            <div class="filter-op">
              <input type="radio" class="d-none" name="product_filter" id="pending">
              <label for="pending" class="info-box p-3">
                <span class="info-box-icon text-start">
                  <i class="bi bi-hourglass-split"></i>
                </span>
                <div class="d-flex align-items-center justify-content-between mt-3">
                  <div class="info-box-content">
                    <span class="info-box-text m-0">@lang('main.orders.pending')</span>
                  </div>
                  <span class="info-box-number fs-5">{{ $counts['pending'] }}</span>
                </div>
                <button type="button" class="op-close d-none" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
              </label>
            </div>  
            <div class="filter-op">
              <input type="radio" class="d-none" name="product_filter" id="accepted">
              <label for="accepted" class="info-box p-3">
                <span class="info-box-icon text-start">
                  <i class="bi bi-cart-check"></i>
                </span>
                <div class="d-flex align-items-center justify-content-between mt-3">
                  <div class="info-box-content">
                    <span class="info-box-text m-0">@lang('main.orders.accepted')</span>
                  </div>
                  <span class="info-box-number fs-5">{{ $counts['accepted'] }}</span>
                </div>
                <button type="button" class="op-close d-none" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
              </label>
            </div>
            <div class="filter-op">
              <input type="radio" class="d-none" name="product_filter" id="shipped">
              <label for="shipped" class="info-box p-3">
                <span class="info-box-icon text-start">
                  <i class="bi bi-truck"></i>
                </span>
                <div class="d-flex align-items-center justify-content-between mt-3">
                  <div class="info-box-content">
                    <span class="info-box-text m-0">@lang('main.orders.shipped')</span>
                  </div>
                  <span class="info-box-number fs-5">{{ $counts['shipped'] }}</span>
                </div>
                <button type="button" class="op-close d-none" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
              </label>
            </div>  
            <div class="filter-op">
              <input type="radio" class="d-none" name="product_filter" id="completed">
              <label for="completed" class="info-box p-3">
                <span class="info-box-icon text-start">
                  <i class="bi bi-check2-circle"></i>
                </span>
                <div class="d-flex align-items-center justify-content-between mt-3">
                  <div class="info-box-content">
                    <span class="info-box-text m-0">@lang('main.orders.completed')</span>
                  </div>
                  <span class="info-box-number fs-5">{{ $counts['completed'] }}</span>
                </div>
                <button type="button" class="op-close d-none" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
              </label>
            </div>
            <div class="filter-op">
              <input type="radio" class="d-none" name="product_filter" id="return">
              <label for="return" class="info-box p-3">
                <span class="info-box-icon text-start">
                  <i class="bi bi-hourglass-split"></i>
                </span>
                <div class="d-flex align-items-center justify-content-between mt-3">
                  <div class="info-box-content">
                    <span class="info-box-text m-0">@lang('main.orders.return')</span>
                  </div>
                  <span class="info-box-number fs-5">{{ $counts['return'] }}</span>
                </div>
                <button type="button" class="op-close d-none" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
              </label>
            </div>  
            <div class="filter-op">
              <input type="radio" class="d-none" name="product_filter" id="declined">
              <label for="declined" class="info-box p-3">
                <span class="info-box-icon text-start">
                  <i class="bi bi-cart-check"></i>
                </span>
                <div class="d-flex align-items-center justify-content-between mt-3">
                  <div class="info-box-content">
                    <span class="info-box-text m-0">@lang('main.orders.declined')</span>
                  </div>
                  <span class="info-box-number fs-5">{{ $counts['declined'] }}</span>
                </div>
                <button type="button" class="op-close d-none" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
              </label>
            </div>
          </div>
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    الطلبات
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
                <div id="crud-table-container" class="position:relative">
                    <x-crud-table :result="$result" :fields="$fields" :model="$model" :queryParameters="$queryParameters"/>
                </div>         
            </div> 
            <style>
            .custom-loader{
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 200px;
            }
                .loader {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  display: inline-block;
  border-top: 4px solid rgba(var(--mainOp),.5);
  border-right: 4px solid transparent;
  box-sizing: border-box;
  animation: rotation 1s linear infinite;
}
.loader::after {
  content: '';  
  box-sizing: border-box;
  position: absolute;
  left: 0;
  top: 0;
  width: 48px;
  height: 48px;
  border-radius: 50%;
  border-left: 4px solid var(--main);
  border-bottom: 4px solid transparent;
  animation: rotation 0.5s linear infinite reverse;
}
@keyframes rotation {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
} 
            </style>
        </div>
    </div>
  </div>
</div>
@endsection
@push('custom-js')
<script>
    $(document).ready(function () {
        $('input[name="product_filter"]').change(function () {
            let selectedFilter = $(this).attr('id');
            $.ajax({
                url: "{{ route($model.'.index') }}",
                type: "GET",
                data: {
                    filter: selectedFilter
                },
                beforeSend: function () {
                    $('#crud-table-container').html(`<div class="custom-loader"><span class="loader"></span></div>`);
                },
                success: function (response) {
                    $('#crud-table-container').html(response.html);
                },
                error: function (xhr) {
                    console.error("An error occurred:", xhr.responseText);
                }
            });
        });
    });
</script>
@endpush