@extends('admin.index')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid pt-4">
            <div class="content-header">
                {{-- search part --}}
                @include('admin.partials.breadcrumb')
            </div>
            <div class="row g-3">
                <div class="col-md-8">
                    <div class="add-form-list h-100">
                        <div class="card h-100">
                            <div class="card-header text-center">Create Offer</div>
                            @include('admin.layouts.alerts')
                            <div class="card-body">
                                <form action="{{ route('coupons.store') }}" method="POST">
                                    @csrf
                                            <div class="row">
                                                <!-- Offer Text -->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="text" class="form-label">Offer Text</label>
                                                        <input type="text" class="form-control" id="text" name="text" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="coupon_code" class="form-label">Offer coupon_code</label>
                                                        <input type="text" class="form-control" id="coupon_code" name="coupon_code" required>
                                                    </div>
                                                </div>
                    
                                                <!-- Start Date -->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="start_date" class="form-label">Start Date</label>
                                                        <input  min="<?php echo date('Y-m-d\TH:i'); ?>" type="datetime-local" class="form-control" id="start_date" name="start_date" required>
                                                    </div>
                                                </div>
                
                                                <!-- End Date -->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="end_date" class="form-label">End Date</label>
                                                        <input  min="<?php echo date('Y-m-d\TH:i'); ?>" type="datetime-local" class="form-control" id="end_date" name="end_date" required>
                                                    </div>
                                                </div>
                    
                                                <!-- Offer Type -->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="offer_type" class="form-label">Offer Type</label>
                                                        <select class="form-control" id="offer_type" name="offer_type" required>
                                                            <option value="">choose</option>
                                                            {{--<option value="buy_x_get_y">Buy X Get Y</option>--}}
                                                            <option value="fixed_amount">Fixed Amount</option>
                                                            <option value="percentage">Percentage</option>
                                                        </select>
                                                    </div>
                                                </div>
                
                                                <!-- Buy X -->
                                                <div class="col-md-6" id="buy_x_input" style="display: none;">
                                                    <div class="mb-3">
                                                        <label for="buy_x" class="form-label">Buy X (Optional)</label>
                                                        <input type="number" class="form-control" id="buy_x" name="buy_x" min="0">
                                                    </div>
                                                </div>
                                                <div class="col-md-6" id="choose_type" style="display: none;">
                                                    <div class="mb-3">
                                                        <label for="offer_type" class="form-label">Options Type</label>
                                                        <select class="form-control" id="choose_select_type" name="choose_type" required>
                                                            <option value="">choose</option>
                                                            <option value="by_categorys">by categories</option>
                                                            <option value="by_brands">by brands</option>
                                                            <option value="by_products">by products</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" id="by_categorys" style="display: none;">
                                                    <div class="mb-3">
                                                        <label for="category_id" class="form-label">Applicable Products</label>
                                                        <select class="form-control sel2" id="category_id" name="category_id" >
                                                            <option value="">@lang('main.choose')</option>
                                                            @foreach($categorys as $cat)
                                                            <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" id="by_brands" style="display: none;">
                                                    <div class="mb-3">
                                                        <label for="brand_id" class="form-label">Applicable Products</label>
                                                        <select class="form-control sel2" id="brand_id" name="brand_id" >
                                                            <option value="">@lang('main.choose')</option>
                                                            @foreach($brands as $brand)
                                                            <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>


                                                <!-- Applicable Products -->
                                                <div class="col-md-6" id="buy_product_ids_input" style="display: none;">
                                                    <div class="mb-3">
                                                        <label for="buy_product_ids" class="form-label">Applicable Products</label>
                                                        <select class="form-control sel2" id="buy_product_ids" name="buy_product_ids[]" multiple>
                                                            @foreach($products as $product)
                                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Get Y -->
                                                <div class="col-md-6" id="get_y_input" style="display: none;">
                                                    <div class="mb-3">
                                                        <label for="get_y" class="form-label">Get Y (Optional)</label>
                                                        <input type="number" class="form-control" id="get_y" name="get_y" min="0">
                                                    </div>
                                                </div>
                                                <!-- Applicable Products -->
                                                <div class="col-md-6" id="get_product_ids_input" style="display: none;">
                                                    <div class="mb-3">
                                                        <label for="get_product_ids" class="form-label">Applicable Products</label>
                                                        <select class="form-control sel2" id="get_product_ids" name="get_product_ids[]" multiple>
                                                            @foreach($products as $product)
                                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Discount Value -->
                                                <div class="col-md-6" id="discount_value_input" style="display: none;">
                                                    <div class="mb-3">
                                                        <label for="discount_value" class="form-label">Discount Value</label>
                                                        <input type="number" class="form-control" id="discount_value" name="discount_value" step="0.01" min="0" >
                                                    </div>
                                                </div>
                                                <!-- Discount Type -->
                                                <div class="col-md-6" id="discount_type_input" style="display: none;">
                                                    <div class="mb-3">
                                                        <label for="discount_type" class="form-label">Discount Type</label>
                                                        <select class="form-control" id="discount_type" name="discount_type" >
                                                            <option value="percentage">Percentage</option>
                                                            <option value="fixed">Fixed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                
                                    <!-- Submit Button -->
                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-primary">Create Offer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Offer Summary -->
                    <div class="summary-wrapper h-100">
                        <div class="card h-100">
                            <div class="card-header">
                                <p class="summary-title m-0">ملخص العرض</p>
                            </div>
                            <div class="card-body">
                                <div class="special-offer__offer-summary">
                                    <div class="summary-placeholder" style="display: none;">
                                        <p>قم باكمال خيارات العرض ليظهر لك الملخص هنا</p>
                                    </div>
                                    <div class="summary-inner-wrapper">
                                        <div class="summary summary-condition">
                                            <h5 class="fs-6">اذا اشترى العميل <b id="buy_quantity-text"></b> من <b>المنتجات</b> التالية</h5>
                                            <ul id="buy_product_summary" class="rec-list rec-list--vertical special-offer__product-list special-offer__product-summary"></ul>
                                        </div>
                                        <div class="summary summary-result">
                                            <h5 class="fs-6">يحصل  على <b> <b id="get_quantity-text"></b> <span>بخصم</span> <span id="discount_val"></span><span id="discount_typ">%</span></b> من <b>المنتجات</b> التالية</h5>
                                            <ul id="get_product_summary" class="rec-list rec-list--vertical special-offer__product-list special-offer__product-summary"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
@endsection

@push('custom-js')
<script>
   $('#offer_type').on('change', function () {
    const selectedValue = $(this).val();

    // Reset visibility and states
    $('#buy_x_input, #buy_product_ids_input, #get_y_input, #get_product_ids_input, #discount_value_input, #discount_type_input').hide();
    $('#discount_type').prop('disabled', false).val('');

    // Handle visibility and state changes based on selectedValue
    if (selectedValue === 'buy_x_get_y') {
        $('#buy_x_input').show();
        $('#buy_product_ids_input').show();
        $('#get_y_input').show();
        if ($('#get_y_input').is(':visible')) {
            $('#get_y').attr('required')
        }
        $('#get_product_ids_input').show();
        if ($('#get_product_ids_input').is(':visible')) {
            $('#get_product_ids').attr('required')
        }
        $('#discount_value_input').show();
        $('#discount_type_input').show();
    } else if (selectedValue === 'percentage') {
        $('#choose_type').show();
        // $('#buy_product_ids_input').show();
        $('#discount_value_input').show();
        if ($('#discount_value_input').is(':visible')) {
            $('#discount_value').attr('required')
        }
        $('#discount_type_input').show();
        if ($('#discount_type_input').is(':visible')) {
            $('#discount_type').attr('required')
        }
        $('#discount_type').val('percentage').find('option[value="percentage"]').prop('selected', true);  
        $('#discount_type_input').hide() 

    } else {
        $('#choose_type').show();
        // $('#buy_product_ids_input').show();
        $('#discount_value_input').show();
        if ($('#discount_value_input').is(':visible')) {
            $('#discount_value').attr('required')
        }
        $('#discount_type_input').show();
        if ($('#discount_type_input').is(':visible')) {
            $('#discount_type').attr('required')
        }
        $('#discount_type').val('fixed').find('option[value="fixed"]').prop('selected', true); 
        $('#discount_type_input').hide() 
    }
});
// Event listener for choose_type
$(document).on('change', '#choose_select_type', function () {
    const chooseTypeValue = $(this).val();
    if(chooseTypeValue === 'by_categorys'){
        $('#by_categorys').show();
        $('#buy_product_ids_input').hide();
        $('#by_brands').hide();
    }else if(chooseTypeValue === 'by_products'){
        $('#buy_product_ids_input').show();
        $('#by_brands').hide();
        $('#by_categorys').hide();
    }else{
        $('#by_brands').show();
        $('#buy_product_ids_input').hide();
        $('#by_categorys').hide();
    }
});
    // Function to handle input updates for quantities
    function updateTextInput(inputId, outputId, singular, plural) {
        const value = $(inputId).val();
        const output = value > 1 ? `${value} ${plural}` : value == 1 ? singular : '';
        $(outputId).text(output);
    }

    // Attach input event listeners
    $('#buy_x').on('input', () => updateTextInput('#buy_x', '#buy_quantity-text', 'قطعة واحدة', 'قطعة'));
    $('#get_y').on('input', () => updateTextInput('#get_y', '#get_quantity-text', 'قطعة واحدة', 'قطعة'));
    $('#discount_value').on('input', () => $('#discount_val').text($('#discount_value').val() || '%'));
    $('#discount_type').on('input', () => $('#discount_typ').text($('#discount_type').val()));

    // Update product lists dynamically
    function updateProductList(selectId, listId) {
        const selectedProducts = $(selectId).find('option:selected');
        const productList = $(listId);
        productList.empty();
        selectedProducts.each(function () {
            const productName = $(this).text();
            productList.append(`<li><span>${productName}</span></li>`);
        });
    }
    $('#by_brands').on('change', () => updateProductList('#by_brands', '#buy_product_summary'));
    $('#by_categorys').on('change', () => updateProductList('#by_categorys', '#buy_product_summary'));

    $('#buy_product_ids').on('change', () => updateProductList('#buy_product_ids', '#buy_product_summary'));
    $('#get_product_ids').on('change', () => updateProductList('#get_product_ids', '#get_product_summary'));
</script>
@endpush
