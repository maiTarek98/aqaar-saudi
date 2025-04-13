@extends('admin.index')
@section('content')
    <div class="content-wrapper">
     <div class="container-fluid add-form-list">
        <div class="content-header">
                {{-- search part --}}
                @include('admin.partials.breadcrumb')
            </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <h1 class="card-header text-center">Edit Offer</h1>
                    @include('admin.layouts.alerts')
                    <div class="card-body">
                        <form action="{{ route('coupons.update', $coupon->id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Use PUT method for update -->

                            <div class="row">
                                <!-- Offer Text -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="text" class="form-label">Offer Text</label>
                                        <input type="text" value="{{ old('text', $coupon->text) }}" class="form-control" id="text" name="text" required>
                                    </div>
                                </div>

                                <!-- Start Date -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">Start Date</label>
                                        <input min="{{ now()->format('Y-m-d\TH:i') }}" type="datetime-local" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $coupon->start_date) }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- End Date -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input min="{{ now()->format('Y-m-d\TH:i') }}" type="datetime-local" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $coupon->end_date) }}" required>
                                    </div>
                                </div>
                                <!-- Offer Type -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="offer_type" class="form-label">Offer Type</label>
                                        <select class="form-control" id="offer_type" name="offer_type" required>
                                            <option value="">choose</option>
                                            <option value="buy_x_get_y" {{ $coupon->offer_type == 'buy_x_get_y' ? 'selected' : '' }}>Buy X Get Y</option>
                                            <option value="fixed_amount" {{ $coupon->offer_type == 'fixed_amount' ? 'selected' : '' }}>Fixed Amount</option>
                                            <option value="percentage" {{ $coupon->offer_type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Buy X -->
                                <div class="col-md-6" id="buy_x_input" style="display: {{ $coupon->offer_type == 'buy_x_get_y' ? 'block' : 'none' }}">
                                    <div class="mb-3">
                                        <label for="buy_x" class="form-label">Buy X (Optional)</label>
                                        <input type="number" value="{{ old('buy_x', $coupon->condition->buy_x ?? '') }}" class="form-control" id="buy_x" name="buy_x" min="0">
                                    </div>
                                </div>
                                <!-- Applicable Products -->
                                <div class="col-md-6" id="buy_product_ids_input" style="display: {{ $coupon->offer_type == 'buy_x_get_y' ? 'block' : 'none' }}">
                                    <div class="mb-3">
                                        <label for="buy_product_ids" class="form-label">Applicable Products</label>
                                        <select class="form-control" id="buy_product_ids" name="buy_product_ids[]" multiple required>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" {{ in_array($product->id, $coupon->products->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Get Y -->
                                <div class="col-md-6" id="get_y_input" style="display: {{ $coupon->offer_type == 'buy_x_get_y' ? 'block' : 'none' }}">
                                    <div class="mb-3">
                                        <label for="get_y" class="form-label">Get Y (Optional)</label>
                                        <input type="number" value="{{ old('get_y', $coupon->condition->get_y ?? '') }}" class="form-control" id="get_y" name="get_y" min="0">
                                    </div>
                                </div>
                                <!-- Applicable Products -->
                                <div class="col-md-6" id="get_product_ids_input" style="display: {{ $coupon->offer_type == 'buy_x_get_y' ? 'block' : 'none' }}">
                                    <div class="mb-3">
                                        <label for="get_product_ids" class="form-label">Applicable Products</label>
                                        <select class="form-control" id="get_product_ids" name="get_product_ids[]" multiple>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" {{ in_array($product->id, $coupon->products->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Discount Value -->
                                <div class="col-md-6" id="discount_value_input" style="display: {{ $coupon->offer_type == 'percentage' || $coupon->offer_type == 'fixed_amount' ? 'block' : 'none' }}">
                                    <div class="mb-3">
                                        <label for="discount_value" class="form-label">Discount Value</label>
                                        <input type="number" value="{{ old('discount_value', $coupon->coupon_discount?->discount_value ?? '') }}" class="form-control" id="discount_value" name="discount_value" step="0.01" min="0">
                                    </div>
                                </div>
                                <!-- Discount Type -->
                                <div class="col-md-6" id="discount_type_input" style="display: {{ $coupon->offer_type == 'percentage' || $coupon->offer_type == 'fixed_amount' ? 'block' : 'none' }}">
                                    <div class="mb-3">
                                        <label for="discount_type" class="form-label">Discount Type</label>
                                        <select class="form-control" id="discount_type" name="discount_type">
                                            <option value="percentage" {{ $coupon->coupon_discount?->discount_type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                            <option value="fixed" {{ $coupon->coupon_discount?->discount_type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
  <!-- Offer Summary -->
                                <div class="summary-wrapper">
                                    <h5 class="summary-title">ملخص العرض</h5>
                                    <div class="special-offer__offer-summary">
                                        <div class="summary-placeholder" style="display: none;">
                                            <p>قم باكمال خيارات العرض ليظهر لك الملخص هنا</p>
                                        </div>
                                        <div class="summary-inner-wrapper">
                                            <div class="summary summary-condition">
                                                <h5>اذا اشترى العميل <b id="buy_quantity-text"></b> من <b>المنتجات</b> التالية</h5>
                                                <ul id="buy_product_summary" class="rec-list rec-list--vertical special-offer__product-list special-offer__product-summary"></ul>
                                            </div>
                                            <div class="summary summary-result">
                                                <h5>يحصل <b> <span id="discount_typ">%</span><span id="discount_val"></span> خصم </b> على <b id="get_quantity-text"></b>:</h5>
                                                <ul id="get_product_summary" class="rec-list rec-list--vertical special-offer__product-list special-offer__product-summary"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- Submit Button -->
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary">Update Offer</button>
                            </div>
                        </form>
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
        $('#buy_x_input, #buy_product_ids_input, #get_y_input, #get_product_ids_input, #discount_value_input, #discount_type_input').hide();
        
        if (selectedValue === 'buy_x_get_y') {
            $('#buy_x_input, #buy_product_ids_input, #get_y_input, #get_product_ids_input, #discount_value_input, #discount_type_input').show();
        } else if (selectedValue === 'percentage') {
            $('#buy_product_ids_input, #discount_value_input, #discount_type_input').show();
            $('#discount_type').val('percentage');
        } else {
            $('#buy_product_ids_input, #discount_value_input, #discount_type_input').show();
            $('#discount_type').val('fixed');
        }
    });

    // Initialize the form with the correct visibility
    $('#offer_type').trigger('change');

// Function to handle input updates for quantities
function updateTextInput(inputId, outputId, singular, plural) {
    const value = $(inputId).val();
    const output = value > 1 ? `${value} ${plural}` : value == 1 ? singular : '';
    $(outputId).text(output);
}

// Function to initialize pre-filled values on page load
function initializeForm() {
    // Update the quantity texts if the inputs have values
    updateTextInput('#buy_x', '#buy_quantity-text', 'قطعة واحدة', 'قطعة');
    updateTextInput('#get_y', '#get_quantity-text', 'قطعة واحدة', 'قطعة');
    $('#discount_val').text($('#discount_value').val() || '%');
    $('#discount_typ').text($('#discount_type').val());

    // Update product lists if they were pre-selected
    updateProductList('#buy_product_ids', '#buy_product_summary');
    updateProductList('#get_product_ids', '#get_product_summary');
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

// Initialize form with pre-selected values on page load
$(document).ready(function () {
    initializeForm();
});

// Update product lists when selection changes
$('#buy_product_ids').on('change', () => updateProductList('#buy_product_ids', '#buy_product_summary'));
$('#get_product_ids').on('change', () => updateProductList('#get_product_ids', '#get_product_summary'));

</script>
@endpush
