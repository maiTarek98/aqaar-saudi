@extends('admin.index')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid add-form-list">
            <div class="content-header">
                {{-- search part --}}
                @include('admin.partials.breadcrumb')
            </div>
            <div class="content">
                @include('admin.orders.order_upper_section',['order' => $order])
                <form method="post" action="{{route('orders.update',$order->id)}}">
                    @csrf @method('PUT')
                    <div id='orders'>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">المنتجات</h3>
                            </div>
                            <div class="card-body">
                                @foreach($order->carts as $val)
                                <div class="row py-2 g-2 align-items-end order-row">
                                    <div class="col">
                                      <label class="form-label">@lang('main.products.product_name')</label>
                                      <select class="chooseProduct form-control" name="product_id[]">
                                        <option value="{{$val->product_id}}" selected>
                                          {{$val->product?->name}}
                                        </option>
                                      </select>
                                    </div>
                                    
                                    <div class="col">
                                      <label class="form-label">@lang('main.products.qty')</label>
                                      <input
                                        type="number" @if($order->status == 'shipped' || $order->status == 'completed' || $order->status == 'canceled') disabled @endif
                                        value="{{$val->qty}}"
                                        min="1"
                                        name="quantity[]"
                                        class="form-control quantity-input"
                                      />
                                    </div>
                                    <div class="col prices">
                                      <label class="form-label">@lang('main.products.product_price')</label>
                                      <input
                                        type="text"
                                        name="price[]"
                                        value="{{$val->price}}"
                                        class="form-control price-input"
                                      />
                                    </div>
                                    <div class="col">
                                        <label class="form-label">@lang('main.products.total')</label>
                                        <input
                                          class="form-control total-price"
                                          type="number"
                                          disabled
                                          name="total_price"
                                          value="{{$val->total_price}}"
                                        />
                                    </div>
                                    @if($order->status == 'pending' || $order->status == 'accepted')
                                    <div class="col-auto">
                                        <span class="btn btn-danger btn-del-select">
                                            <i class="fas fa-trash-alt"></i>
                                        </span>
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                                <div class="row py-2 g-2 align-items-end order-row clone-row" style="display: none;">
                                    <div class="col ">
                                        <label class="form-label">@lang('main.products.product_name')</label>
                                        <select class="chooseProduct form-control"  name="product_id[]">
                                            <option value="">@lang('main.choose')</option>
                                            @foreach(\App\Models\Product::where('status','show')->get() as $key => $value)
                                                <option value="{{$value->id}}" @if( ($value->id == $order->product_id) || ($value->id == old('product_id')) ) selected @endif>{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label class="form-label">@lang('main.products.qty')</label>
                                        <input type="number" value="1" min="1" name="quantity[]" class="form-control quantity-input"  >
                                    </div>
                                    <div class="col prices">
                                        <label class="form-label">@lang('main.products.product_price')</label>
                                        <input type="text" name="price[]" value="0"  class="form-control price-input">
                                    </div>
                                    <div class="col">
                                        <label class="form-label">@lang('main.products.total')</label>
                                        <input class="form-control total-price" type="number" disabled name="total_price" value="">
                                    </div>
                                    <div class="col-auto">
                                        <span class="btn btn-danger btn-del-select">
                                            <i class="fas fa-trash-alt"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer py-3">
                            @if($order->status == 'pending' || $order->status == 'accepted')
                            <button type="button" class="btn btn-secondary px-4 rounded-pill add-select">@lang('main.orders.Add More')</button>
                        
                            <button type="submit" class="btn btn-warning px-4 rounded-pill add-select">@lang('main.orders.update order')</button>
                            @endif
                        </div>
                        </div>
                    </div>
                </form>                
                @include('admin.orders.order_down_section',['order' => $order])

                <!-- Order action -->
                <div class="order-action d-flex gap-4 justify-content-center">
                
                    <form method="DELETE" action="{{route('orders.destroy',$order->id)}}">
                        @csrf
                        <button type="submit" class="btn btn-danger px-4 show_confirm rounded-pill" data-toggle="tooltip" data-placement="top" title="" data-original-title="حذف"><i    class="fa fa-trash"></i>
                            <span>@lang('main.orders.delete order')</span>
                        </button>
                    </form>
                    <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle px-4 rounded-pill" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-printer"></i>
                        @lang('main.orders.download fatoorah')
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('download-pdf',['id' =>$order->id,'type' => 'admin']) }}">@lang('main.orders.download fatoorah')</a></li>
                    </ul>
                </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- Page end  -->
@endsection
@push('custom-js')
<script type="text/javascript">
$(document).ready(function () {
        $('#assign_to').on('change', function () {
            const selectedValue = $(this).val(); 
            const orderId = "{{$order->id}}"; 
            if (selectedValue) {
                $.ajax({
                    url: '{{ route("orders.updateAssignTo") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        assign_to: selectedValue,
                        order_id: orderId 
                    },
                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert('An error occurred while updating the order assignment.');
                    }
                });
            }
        });

        $('#add_notes').on('click', function () {
            const selectedValue = $(this).val();
            const notes = $('#order_notes').val(); 
            alert(notes)
            const orderId = "{{$order->id}}"; 
            if (notes) {
                $.ajax({
                    url: '{{ route("orders.updateNotesToOrder") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        add_notes: notes,
                        order_id: orderId 
                    },
                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert('An error occurred while updating the order assignment.');
                    }
                });
            }
        });
        $('#saveChangesButton').on('click', function () {
            const status = $('#status').val(); 
            const notes = $('#notes').val();  
            const orderId = '{{ $order->id }}'; 
            if (!status) {
                alert("@lang('main.orders.select_status')");
                return;
            }

            $.ajax({
                url: '{{ route("orders.updateStatus") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', 
                    status: status,
                    notes: notes,
                    order_id: orderId,
                },
                success: function (response) {
                    if (response.success) {
                        $('#status').val('')
                        $('#notes').val('')
                        $('#statusButton').text(response.statusText);
                        $('#orderStatusModal').modal('hide');
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert("@lang('main.orders.update_failed')");
                }
            });
        });
        $('#client_options').on('change', function () {
            const selectedValue = $(this).val(); 
            const userId = '{{ $order->user_id ?? null }}'; 

            if (!selectedValue) return;

            if (selectedValue === "1") {
                window.location.href = 
                '{{ route("users.show", ":id") }}'.replace(':id', userId) +'?account_type=users';
            } else if (selectedValue === "2") {
                if (confirm("هل تريد حظر العميل؟")) {
                    $.ajax({
                        url: '{{ route("users.block") }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            user_id: userId
                        },
                        success: function (response) {
                            if (response.success) {
                                toastr.success(response.message);
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function (xhr) {
                            console.error(xhr.responseText);
                            alert('حدث خطأ أثناء الحظر.');
                        }
                    });
                }
            } else if (selectedValue === "3") {
                $.ajax({
                    url: '{{ route("users.copyReviewLink") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: userId
                    },
                    success: function (response) {
                        if (response.success && response.link) {
                            const tempInput = document.createElement('input');
                            tempInput.value = response.link;
                            document.body.appendChild(tempInput);
                            tempInput.select();
                            document.execCommand('copy');
                            document.body.removeChild(tempInput);

                            alert('تم نسخ رابط التقييم بنجاح.');
                        } else {
                            alert('فشل في إنشاء رابط التقييم.');
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert('حدث خطأ أثناء نسخ الرابط.');
                    }
                });
            }
        });
    
    });
</script>
<script type="text/javascript">
$(document).ready(function () {
        $('#assign_to').on('change', function () {
            const selectedValue = $(this).val(); 
            const orderId = "{{$order->id}}"; 
            if (selectedValue) {
                $.ajax({
                    url: '{{ route("orders.updateAssignTo") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        assign_to: selectedValue,
                        order_id: orderId 
                    },
                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert('An error occurred while updating the order assignment.');
                    }
                });
            }
        });

        $('#add_notes').on('click', function () {
            const selectedValue = $(this).val();
            const notes = $('#order_notes').val(); 
            alert(notes)
            const orderId = "{{$order->id}}"; 
            if (notes) {
                $.ajax({
                    url: '{{ route("orders.updateNotesToOrder") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        add_notes: notes,
                        order_id: orderId 
                    },
                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert('An error occurred while updating the order assignment.');
                    }
                });
            }
        });
        $('#saveChangesButton').on('click', function () {
            const status = $('#status').val(); 
            const notes = $('#notes').val();  
            const orderId = '{{ $order->id }}'; 
            if (!status) {
                alert("@lang('main.orders.select_status')");
                return;
            }

            $.ajax({
                url: '{{ route("orders.updateStatus") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', 
                    status: status,
                    notes: notes,
                    order_id: orderId,
                },
                success: function (response) {
                    if (response.success) {
                        $('#status').val('')
                        $('#notes').val('')
                        $('#statusButton').text(response.statusText);
                        $('#orderStatusModal').modal('hide');
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert("@lang('main.orders.update_failed')");
                }
            });
        });
        $('#client_options').on('change', function () {
            const selectedValue = $(this).val(); 
            const userId = '{{ $order->user_id ?? null }}'; 

            if (!selectedValue) return;

            if (selectedValue === "1") {
                window.location.href = 
                '{{ route("users.show", ":id") }}'.replace(':id', userId) +'?account_type=users';
            } else if (selectedValue === "2") {
                if (confirm("هل تريد حظر العميل؟")) {
                    $.ajax({
                        url: '{{ route("users.block") }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            user_id: userId
                        },
                        success: function (response) {
                            if (response.success) {
                                toastr.success(response.message);
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function (xhr) {
                            console.error(xhr.responseText);
                            alert('حدث خطأ أثناء الحظر.');
                        }
                    });
                }
            } else if (selectedValue === "3") {
                $.ajax({
                    url: '{{ route("users.copyReviewLink") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: userId
                    },
                    success: function (response) {
                        if (response.success && response.link) {
                            const tempInput = document.createElement('input');
                            tempInput.value = response.link;
                            document.body.appendChild(tempInput);
                            tempInput.select();
                            document.execCommand('copy');
                            document.body.removeChild(tempInput);

                            alert('تم نسخ رابط التقييم بنجاح.');
                        } else {
                            alert('فشل في إنشاء رابط التقييم.');
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert('حدث خطأ أثناء نسخ الرابط.');
                    }
                });
            }
        });
    
    });
</script>
<script>
$('#body').summernote({
        height: 200,
    });
    document.addEventListener('DOMContentLoaded', function() {
    // Function to update the total price of a single product
    function updateTotalPrice(row) {
        const quantityInput = row.querySelector('.quantity-input');
        const priceInput = row.querySelector('.price-input');
        const totalPriceInput = row.querySelector('.total-price');
        
        const quantity = parseFloat(quantityInput.value) || 0;
        const price = parseFloat(priceInput.value) || 0;
        const total = quantity * price;
        
        totalPriceInput.value = total.toFixed(2);
        
        updateGrandTotal();
        updateFinalPrice();
    }
    
    // Function to update the total price of all products
    function updateGrandTotal() {
        const orderRows = document.querySelectorAll('.order-row');
        let grandTotal = 0;

        orderRows.forEach(function(row) {
            const totalPriceInput = row.querySelector('.total-price');
            const total = parseFloat(totalPriceInput.value) || 0;
            grandTotal += total;
        });
        // $('#productsPrice').html(grandTotal)
        document.getElementById('productsPrice').innerHTML  = grandTotal.toFixed(2)+ ' L.E';
    }
    
    // Function to update Final price of all products after applying shipping & discount
    function updateFinalPrice() {
        const productsPriceElement = document.getElementById('productsPrice');
        const shippingElement = document.getElementById('shipping');
        const discountElement = document.getElementById('discount');
        const finalPriceElement = document.getElementById('finalPrice');
        
        const productsPrice = parseFloat(productsPriceElement.textContent.replace(' L.E', '')) || 0;
        const shipping = parseFloat(shippingElement.textContent.replace(' L.E', '')) || 0;
        const discount = parseFloat(discountElement.textContent.replace(' L.E', '')) || 0;
        
        const finalPrice = (productsPrice + shipping) - discount;
        
        finalPriceElement.textContent = finalPrice.toFixed(2) + ' L.E';
    }

    // Get all order rows
    const orderRows = document.querySelectorAll('.order-row');
    
    // A function that waits for event feedback to a specific row
    function addEventListeners(row) {
        const elementsToWatch = [
            row.querySelector('.chooseProduct'),
            row.querySelector('.quantity-input'),
            row.querySelector('.price-input'),
        ];
    
        // دالة لإضافة مستمع الحدث 'change' لجميع العناصر في القائمة
        function addChangeListeners(elements) {
            elements.forEach(element => {
                if (element) {
                    element.addEventListener('change', function() {
                        updateTotalPrice(row);
                    });
                }
            });
        }
    
        // استدعاء الدالة لإضافة مستمع الحدث لجميع العناصر المحددة
        addChangeListeners(elementsToWatch);
    
        // إضافة مستمع الحدث لزر الحذف إذا كان موجودًا
        const delBtn = row.querySelector('.btn-del-select');
        if (delBtn) {
            delBtn.addEventListener('click', function() {
                row.remove();
                updateTotalPrice(row);
                updateFinalPrice();
            });
        }
    }
    
    // Iterate over all rows and call the function to add event listeners
    orderRows.forEach(function(row) {
        addEventListeners(row);
    });


    function addRow() {
        // Find the ideal row and copy it
        const cloneRow = document.querySelector('.clone-row').cloneNode(true);
        cloneRow.classList.remove('clone-row');
        
        // delete clone product id
        const selectElement = cloneRow.querySelector('.chooseProduct');
        const dataProductValue = selectElement.getAttribute('data-product');
        selectElement.setAttribute('data-product', '');

        // Remove the selection element from the copied row
        const select = cloneRow.querySelector('.chooseProduct');
        select.removeAttribute('selected');
        
        // Add the copied row to the rest of the products
        document.querySelector('#orders .card-body').appendChild(cloneRow);
        
        // Show the copied row
        cloneRow.style.display = 'flex';
        
        // Get all order rows after cloning
        const orderRows = document.querySelectorAll('.order-row');
        
        // Watch all rows again to ensure that all functions will work after cloning
        orderRows.forEach(function(row) {
            addEventListeners(row);
        });
    }
    
    // call add row function 
    const addButton = document.querySelector('.add-select');
    addButton.addEventListener('click', addRow);
    
    var idproduct ;
    $(document).on('change', 'select[name="product_id[]"]' , function () {
        idproduct = this.value;
        var parent = $(this).closest('.row')[0];
        var priceParent = $(parent).find('.price-input')[0];

        $.ajax({
            url: "{{url('admin/fetch-prices')}}",
            type: "POST",
            async: true,
            data: {
                product_id:idproduct,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (data) {
                $(priceParent).val(data.prices );
                setTimeout(function() {
                    updateTotalPrice(parent);
                }, 100);
            }
        });
    });
    
});
</script>
@endpush