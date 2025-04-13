@extends('admin.index')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid add-form-list">
            <div class="content-header">
                {{-- search part --}}
                @include('admin.partials.breadcrumb')
            </div>
            <div class="content">
                <!-- pagination -->
                <div class="custom-pagination">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination gap-5 justify-content-between">
                        @php
                            $prev = (\App\Models\Order::where('id', '<', $order->id)->orderBy('id', 'desc')->pluck('id')->first());
                            $next = (\App\Models\Order::where('id', '>', $order->id)->orderBy('id', 'asc')->pluck('id')->first());
                        @endphp
                        @if($prev)
                        <li class="page-item">
                            <a
                            class="page-link"
                            href="{{route('orders.show',[$prev])}}"
                            aria-label="@lang('main.goto')   @lang('main.orders.previous')"
                            >
                                <i class="bi bi-arrow-right"></i>
                                <p class="m-0"> @lang('main.orders.previous')</p>
                            </a>
                        </li>
                        @endif
                        @if($next)
                        <li class="page-item">
                            <a
                            class="page-link"
                            href="{{route('orders.show',[$next])}}"
                            aria-label="@lang('main.goto')  @lang('main.orders.next')"
                            >
                                <p class="m-0">@lang('main.orders.next')</p>
                                <i class="bi bi-arrow-left"></i>
                            </a>
                        </li>
                        @endif
                        </ul>
                    </nav>
                </div>
                <!-- Order Officer  -->
                <div class="card mb-3">
                    @if(auth()->user()->hasRole(3)) 
                    <div class="card-header d-flex gap-2">
                        <h4 class="card-title">@lang('main.orders.assign_to') </h4>
                        <p>{{$order->subadmin?->name}}</p>
                    </div>
                    @else
                    <div class="card-header d-flex gap-2">
                        <h4 class="card-title">@lang('main.orders.assign_to') </h4>
                        <select name="assign_to" id="assign_to" class="select2 form-select w-auto">
                            <option value="">@lang('main.search for an employee')</option>
                            @foreach(getSubAdmins(3) as $value)
                            <option value="{{$value->id}}" @if($value->id == $order->assign_to) selected @endif>{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="order-number-wrapper text-center">
                                <label for="">
                                <i class="fa-solid fa-hashtag"></i>
                                    @lang('main.orders.order_no')
                                </label>
                                <p>#{{$order->order_no}}</p>
                            </div>
                            <div class="order-date-wrapper text-center">
                                <label for="">
                                    <i class="bi bi-calendar-event"></i>
                                    تاريخ الطلب
                                </label>
                                <div class="d-flex align-items-center gap-2">
                                    <p class="mb-1"><i class="bi bi-calendar4-event"></i> 
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}
                                    </p>
                                    <p class="mb-1"><i class="bi bi-clock"></i> 
                                        {{ \Carbon\Carbon::parse($order->created_at)->format('h:i A') }}
                                    </p>
                                </div>
                            </div>
                            <div class="order-status-wrapper text-center">
                                <label for="status"><i class="bi bi-flag"></i>@lang('main.orders.status')</label>
                                <button type="button" id="statusButton" class="status-tag pending border-0" data-bs-toggle="modal" data-bs-target="#orderStatusModal">
                                <i class="highlight" style="--iteration-count: infinite;"></i>
                                    <p class="status-tag__txt">{{__('main.orders.'.$order->status)}}</p>
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                                <div class="modal fade" id="orderStatusModal" tabindex="-1" aria-labelledby="orderStatusModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="orderStatusModalLabel">#{{$order->order_no}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <div class=" d-flex gap-2">
                                            <h4 class="card-title">@lang('main.orders.choose status') </h4>
                                            <select name="status" id="status" class="select2 form-select">
                                                <option value="">@lang('main.choose')</option>
                                                <option value="pending">{{__('main.orders.pending')}}</option>
                                                <option value="accepted">{{__('main.orders.accepted')}}</option>
                                                <option value="shipped">{{__('main.orders.shipped')}}</option>
                                                <option value="completed">{{__('main.orders.completed')}}</option>
                                                <option value="return">{{__('main.orders.return')}}</option>
                                                <option value="declined">{{__('main.orders.declined')}}</option>
                                            </select>
                                        </div>
                                        <div class=" d-flex gap-2">
                                            <h4 class="card-title">@lang('main.orders.notes') </h4>
                                            <textarea name="notes" placeholder="@lang('main.orders.write notes')" class="form-control"></textarea>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('main.close')</button>
                                        <button type="button" id="saveChangesButton" class="btn btn-primary">@lang('main.save changes')</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Order main info -->
                
                @include('admin.orders.order_info',['order' => $order])
 <form method="post" action="">
                            @csrf
                            <div id='orders'>
                                @foreach($order->carts as $val)
                                <div class="row py-3 gy-2 border-bottom order-row">
                                    <div class="col-md-4">
                                      <label class="form-label">@lang('main.product')</label>
                                      <select class="chooseProduct form-control" name="product_id[]">
                                        <option value="{{$val->product_id}}" selected>
                                          {{$val->product?->name}}
                                        </option>
                                      </select>
                                    </div>
                                    
                                    <div class="col-md-4">
                                      <label class="form-label">@lang('main.quantity')</label>
                                      <input
                                        type="number" @if($order->status == 'shipped' || $order->status == 'completed' || $order->status == 'canceled') disabled @endif
                                        value="{{$val->qty}}"
                                        min="1"
                                        name="quantity[]"
                                        class="form-control quantity-input"
                                      />
                                    </div>
                                    <div class="col-md-4 prices">
                                      <label class="form-label">@lang('main.price')</label>
                                      <input
                                        type="text"
                                        name="price[]"
                                        value="{{$val->price}}"
                                        class="form-control price-input"
                                      />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">الاجمالي</label>
                                        <input
                                          class="form-control total-price"
                                          type="number"
                                          disabled
                                          name="total_price"
                                          value="{{$val->total_price}}"
                                        />
                                    </div>
                                    @if($order->status == 'pending' || $order->status == 'accepted')
                                    <span class="btn btn-danger pull-right btn-del-select py-2 ">
                                        <i class="fas fa-trash-alt"></i>
                                    </span>
                                    @endif
                                </div>
                                @endforeach
                                <div class="row py-3 gy-2 border-bottom order-row clone-row" style="display: none;">
                                    <div class="col-md-4 ">
                                        <label class="form-label">@lang('main.product')</label>
                                        <select class="chooseProduct form-control"  name="product_id[]">
                                            <option value="">@lang('main.choose')</option>
                                            @foreach(\App\Models\Product::where('status','show')->get() as $key => $value)
                                                <option value="{{$value->id}}" @if( ($value->id == $order->product_id) || ($value->id == old('product_id')) ) selected @endif>{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                  
                                    
                                    <div class="col-md-4 ">
                                        <label class="form-label">@lang('main.quantity')</label>
                                        <input type="number" value="1" min="1" name="quantity[]" class="form-control quantity-input"  >
                                    </div>
                                    <div class="col-md-4  prices">
                                        <label class="form-label">@lang('main.price')</label>
                                        <input type="text" name="price[]" value="0"  class="form-control price-input">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">الاجمالي</label>
                                        <input class="form-control total-price" type="number" disabled name="total_price" value="">
                                    </div>
                                    <span class="btn btn-danger pull-right btn-del-select py-2 ">
                                        <i class="fas fa-trash-alt"></i>
                                    </span>
                                </div>
                            </div>
                            @if($order->status == 'pending' || $order->status == 'accepted')
                            <button type="button" class="col-md-4 btn btn-secondary add-select py-1 my-3">@lang('main.Add More')</button>
                        
                            <button type="submit" class="col-md-4 btn btn-warning add-select py-1 my-3">@lang('main.update order')</button>
                            @endif
                        </form>                
                <!-- Order notes -->
                <div class="card my-3">
                    <div class="card-header">
                        <h4 class="card-title">ملاحظات العميل</h4>
                    </div>
                    <div class="card-body">
                        @if($order->notes)
                        <p class="mb-2">{{$order->notes}}</p>
                        @else
                        <p class="mb-2">لا توجد ملاحظات</p>
                        @endif
                        <form method="post">
                            @csrf
                            <textarea class="form-control" id="order_notes" placeholder="" required name="notes"></textarea>
                            <button type="button" id="add_notes" class="btn btn-primary mt-2">@lang('main.save changes')</button>
                        </form>
                    </div>
                </div>
                
                <!-- pagination -->
                <div class="custom-pagination mt-3">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination gap-5 justify-content-between">
                        @php
                            $prev = (\App\Models\Order::where('id', '<', $order->id)->orderBy('id', 'desc')->pluck('id')->first());
                            $next = (\App\Models\Order::where('id', '>', $order->id)->orderBy('id', 'asc')->pluck('id')->first());
                        @endphp
                        @if($prev)
                        <li class="page-item">
                            <a
                            class="page-link"
                            href="{{route('orders.show',[$prev])}}"
                            aria-label="@lang('main.goto')   @lang('main.orders.previous')"
                            >
                                <i class="bi bi-arrow-right"></i>
                                <p class="m-0"> @lang('main.orders.previous')</p>
                            </a>
                        </li>
                        @endif
                        @if($next)
                        <li class="page-item">
                            <a
                            class="page-link"
                            href="{{route('orders.show',[$next])}}"
                            aria-label="@lang('main.goto')  @lang('main.orders.next')"
                            >
                                <p class="m-0">@lang('main.orders.next')</p>
                                <i class="bi bi-arrow-left"></i>
                            </a>
                        </li>
                        @endif
                        </ul>
                    </nav>
                </div>
                <!-- Order action -->
                <div class="order-action d-flex gap-4 justify-content-center">
                
                    <form method="DELETE" action="{{route('orders.destroy',$order->id)}}">
                        @csrf
                        <button type="submit" class="btn btn-danger px-4 show_confirm rounded-pill" data-toggle="tooltip" data-placement="top" title="" data-original-title="حذف"><i    class="fa fa-trash"></i>
                            <span>حذف الطلب</span>
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
        document.getElementById('orders').appendChild(cloneRow);
        
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