@extends('admin.index')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
    <h3>Create Invoice</h3>
    <form method="post" action="{{route('invoices.store')}}">
        @csrf
        <!-- Invoice Number and Date -->
        <div class="mb-3">
            <label for="invoice_number" class="form-label">Invoice Number:</label>
            <input type="text" id="invoice_number" name="invoice_number" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="invoice_date" class="form-label">Date:</label>
            <input type="date" id="invoice_date" name="invoice_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="notes" class="form-label">notes:</label>
            <input type="text" id="notes" name="notes" class="form-control">
        </div>
        <div class="mb-3">
            <label for="customer_id" class="form-label">Customer:</label>
            <select name="customer_id" class="form-control" required>
                <option value="">@lang('main.select')</option>
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>

        <!-- Items Section -->
        <h4>Items</h4>
        <table class="table" id="items_table">
            <thead>
                <tr>
                    <th>product_id</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="items[0][product_id]" class="form-control product-select" required>
                            <option value="">@lang('main.select')</option>
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
                        <button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary" onclick="addRow()">Add Item</button>

        <!-- Coupon Discount -->
        <div class="mt-3">
            <label for="coupon_discount" class="form-label">Coupon Discount (%):</label>
            <input type="number" id="coupon_discount" name="coupon_discount" class="form-control" oninput="applyCoupon()" placeholder="Enter discount percentage (e.g., 10 for 10%)">
        </div>

        <!-- Total Amount -->
        <div class="mt-3">
            <label for="grand_total" class="form-label">Grand Total:</label>
            <input type="text" id="grand_total" name="grand_total" class="form-control" readonly>
        </div>

        <!-- Discounted Total -->
        <div class="mt-3">
            <label for="final_total" class="form-label">Final Total (After Discount):</label>
            <input type="text" id="final_total" name="final_total" class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-success mt-3">Save Invoice</button>
    </form>
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
                        <option value="">@lang('main.select')</option>
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
                    <button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button>
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
            fetch(`{{url('/api/products/${selectedProductId}/price')}}`)
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

@endsection
