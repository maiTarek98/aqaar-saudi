@extends('admin.index')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            </div>
            <div class="content">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create Invoice</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('invoices.store')}}">
                            @csrf
                            <div class="row g-3">
                                <!-- Invoice Number and Date -->
                                <div class="col-lg-4">
                                    <label for="invoice_number" class="form-label">@lang('main.orders.order_no'):</label>
                                    <input type="text" id="invoice_number" value="{{\App\Models\Order::orderBy('id','desc')->value('order_no') + 1}}" name="invoice_number" class="form-control" required>
                                </div>
                                <div class="col-lg-4">
                                    <label for="invoice_date" class="form-label">@lang('main.orders.order_date'):</label>
                                    <input type="date" id="invoice_date" value="{{ \Carbon\Carbon::now()->format('Y-d-m')}}" name="invoice_date" class="form-control" required>
                                </div>
                                <div class="col-lg-4">
                                    <label for="customer_id" class="form-label">@lang('main.orders.username'):</label>
                                    <select name="customer_id" class="form-control" required>
                                        <option value="">@lang('main.orders.choose user')</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}-{{$user->mobile}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="notes" class="form-label">@lang('main.orders.notes'):</label>
                                    <input type="text" id="notes" name="notes" class="form-control">
                                </div>
                                
                                <div class="col-12">
                                    <div class="card basic">
                                        <div class="card-header">
                                            <h4 class="card-title">@lang('main.orders.items')</h4>
                                        </div>
                                        <div class="card-body">
                                            <!-- Items Section -->
                                            <table class="table" id="items_table">
                                                <thead>
                                                    <tr>
                                                        <th>@lang('main.products.products')</th>
                                                        <th>@lang('main.products.qty')</th>
                                                        <th>@lang('main.products.price')</th>
                                                        <th>@lang('main.products.total')</th>
                                                        <th>@lang('main.actions')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <select name="items[0][product_id]" class="form-control product-select" required>
                                                                <option value="">@lang('main.select product')</option>
                                                                @foreach($products as $prod)
                                                                    <option value="{{$prod->id}}">{{$prod->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="number" min="1" value="1" name="items[0][quantity]" class="form-control quantity" required>
                                                        </td>
                                                        <td>
                                                            <input type="number" min="1" step="0.01" name="items[0][price]" class="form-control price" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="items[0][total]" class="form-control total" readonly>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger" onclick="removeRow(this)"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="@lang('main.remove')">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card-footer py-2">
                                            <button type="button" class="btn btn-primary" onclick="addRow()">Add Item</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Total Amount -->
                                <div class="col-md-6">
                                    <label for="grand_total" class="form-label">Grand Total:</label>
                                    <input type="text" id="grand_total" name="grand_total" class="form-control" readonly>
                                </div>
                        
                                <!-- Coupon Discount -->
                                <div class="col-md-6">
                                    <label for="coupon_discount" class="form-label">Coupon Discount (%):</label>
                                    <input type="number" id="coupon_discount" name="coupon_discount" class="form-control" oninput="applyCoupon()" placeholder="Enter discount percentage (e.g., 10 for 10%)">
                                </div>
                        
                        
                                <!-- Discounted Total -->
                                <div class="col-12">
                                    <label for="final_total" class="form-label">Final Total (After Discount):</label>
                                    <input type="text" id="final_total" name="final_total" class="form-control" readonly>
                                </div>
                                
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Save Invoice</button>
                                </div>
                            </div>
                    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function addRow() {
            const table = document.getElementById("items_table").getElementsByTagName("tbody")[0];
            const rowCount = table.rows.length;
            const newRow = `
                <tr>
                    <td>
                        <select name="items[${rowCount}][product_id]" class="form-control product-select" required>
                            <option value="">@lang('main.select product')</option>
                            @foreach($products as $prod)
                                <option value="{{$prod->id}}">{{$prod->name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" min="1" value="1" name="items[${rowCount}][quantity]" class="form-control quantity" required>
                    </td>
                    <td>
                        <input type="number" min="1" step="0.01" name="items[${rowCount}][price]" class="form-control price" required readonly>
                    </td>
                    <td>
                        <input type="text" name="items[${rowCount}][total]" class="form-control total" readonly>
                    </td>
                    <td>
                        <button class="btn btn-danger" onclick="removeRow(this)"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="@lang('main.remove')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>`;
            table.insertAdjacentHTML("beforeend", newRow);
            bindEventListeners();
        }
    
        function removeRow(button) {
            button.closest("tr").remove();
            calculateGrandTotal();
        }
    
        function calculateTotal(row) {
            const quantity = parseFloat(row.querySelector(".quantity").value) || 0;
            const price = parseFloat(row.querySelector(".price").value) || 0;
            const total = quantity * price;
            row.querySelector(".total").value = total.toFixed(2);
            calculateGrandTotal();
        }
    
        function calculateGrandTotal() {
            let grandTotal = 0;
            document.querySelectorAll(".total").forEach(totalInput => {
                grandTotal += parseFloat(totalInput.value) || 0;
            });
            document.getElementById("grand_total").value = grandTotal.toFixed(2);
            applyCoupon();
        }
    
        function applyCoupon() {
            const grandTotal = parseFloat(document.getElementById("grand_total").value) || 0;
            const discountPercentage = parseFloat(document.getElementById("coupon_discount").value) || 0;
            const discountAmount = (grandTotal * discountPercentage) / 100;
            const finalTotal = grandTotal - discountAmount;
            document.getElementById("final_total").value = finalTotal.toFixed(2);
        }
    
        function bindEventListeners() {
            // Bind change event to product-select dropdowns
            document.querySelectorAll(".product-select").forEach(select => {
                select.addEventListener("change", function () {
                    handleProductChange(this);
                });
            });
    
            // Bind input events for quantity and price fields
            document.querySelectorAll(".quantity, .price").forEach(input => {
                input.addEventListener("input", function () {
                    calculateTotal(this.closest("tr"));
                });
            });
        }
    
        function handleProductChange(selectElement) {
            const selectedProductId = selectElement.value;
            const row = selectElement.closest("tr");
            const priceInput = row.querySelector(".price");
    
            if (selectedProductId) {
                fetch(`{{url('/products/${selectedProductId}/price')}}`)
                    .then(response => response.json())
                    .then(data => {
                        priceInput.value = data.price || 0;
                        calculateTotal(row);
                    })
                    .catch(error => {
                        console.error("Error fetching product price:", error);
                    });
            } else {
                priceInput.value = 0;
                calculateTotal(row);
            }
        }
    
        // Initialize event listeners for the first row
        bindEventListeners();
    </script>
    <style>
        td,th{
            background: transparent !important;
        }
    </style>
@endsection
