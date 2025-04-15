@extends('admin.index')
@section('content')
<style>
    .bg-opacity-10 th,
    .bg-opacity-10 td{
        background-color: transparent;
    }
</style>
<div class="content-wrapper">
    <div class="container-fluid add-form-list">
        <div class="content-header">
            {{-- search part --}}
            @include('admin.partials.breadcrumb')
        </div>
        <div class="content">
            @include('admin.orders.order_upper_section',['order' => $order])
            @include('admin.orders.order_summary',['order' => $order])
            @include('admin.orders.order_down_section',['order' => $order])

            <!-- Order action -->
            <div class="order-action d-flex gap-4 justify-content-center">
                <a href="{{ $order->status == 'completed' ? '#' : route('orders.edit', $order->id) }}" 
                   class="btn btn-warning px-4 rounded-pill {{ $order->status == 'completed' ? 'disabled' : '' }}" 
                   style="{{ $order->status == 'completed' ? 'pointer-events: none; opacity: 0.6;' : '' }}">
                    <i class="fa fa-edit"></i>
                    <span>@lang('main.orders.update order now')</span>
                </a>

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
@endpush