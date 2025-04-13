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
    <section class="content">
      <b>اجمالي عدد الصفوف :  ({{$result->total()}})</b>
      {{-- search part --}}
      @include('admin.partials.search_part', ['route' => route($model.'.index')])
      <!-- <div class="draggable">
        <div class="drag-content d-flex my-3 gap-2">
        </div>
      </div> -->
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
      
      <div class="mb-3">
        @can($model.'-delete')
        <div class="btn-group flex-wrap float-end mt-2">
          @include('admin.partials.button_group', [
          'url' => route($model.'.deleteAll'),
          ])
        </div>
        @endcan
        <div id="crud-table-container">
          <x-crud-table :result="$result" :fields="$fields" :model="$model" :queryParameters="$queryParameters"/>
        </div>
      </div>
    </section>
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
                    $('#crud-table-container').html('loading');
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