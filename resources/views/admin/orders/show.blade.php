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
                @include('admin.orders.order_summary',['order' => $order])
                
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
                <!-- Order history -->
                <div class="card order_history">
                    <div class="card-header">
                        <h4 class="card-title">سجل الطلب</h4>
                    </div>
                    <div class="card-body">
                        <div class="steps">
                            <ol>
                                @forelse($order_logs as $log)
                                <li>
                                    <div class="status-icon">
                                        <i class="bi bi-clock-history"></i>
                                    </div>
                                    <div class="history-step">
                                        <div>
                                            <h5>{{__('main.orders.'.$log->description)}}</h5>
                                            @if ($log->properties)
                                            @php
                                                $properties = json_decode($log->properties, true);
                                            @endphp
                                            @if (is_array($properties))
                                                @foreach ($properties as $key => $value)
                                            @if ($key == 'attributes' && isset($value['assign_to']))
                                                <p class="m-0">Attributes assign_to: {{ $value['assign_to'] }}</p>
                                            @elseif ( $key == 'old' && isset($value['assign_to']))
                                                <p class="m-0">old assign_to: {{ $value['assign_to'] }}</p>

                                            @elseif ($key == 'attributes' && isset($value['status']))
                                                <p class="m-0">Attributes status: {{ $value['status'] }}</p>
                                            @elseif ( $key == 'old' && isset($value['status']))
                                                <p class="m-0">old status: {{ $value['status'] }}</p>
                                            @elseif ($key == 'attributes' && isset($value['notes']))
                                                <p class="m-0">Attributes notes: {{ $value['notes'] }}</p>
                                            @elseif ( $key == 'old' && isset($value['notes']))
                                                <p class="m-0">old notes: {{ $value['notes'] }}</p>

                                            @endif
                                
                                            @endforeach
                                            @else
                                                <p class="m-0">{{ $log->properties }}</p> <!-- In case it's not a valid JSON -->
                                            @endif
                                            @else
                                                <p class="m-0">No properties available</p>
                                            @endif
                                            <p>{{ $log->created_at }}</p>
                                        </div>
                                        {{dd($properties['attributes']['status'])}}
                                        @if(isset($properties['attributes']['status']))
                                        <div class="status-tag {{$properties['attributes']['status']}}">
                                            <i class="highlight"></i>
                                            <p class="status-tag__txt">{{ __('main.orders.'.$properties['attributes']['status'])}}</p>
                                        </div>
                                        @else
                                        <div class="status-tag {{$order->status}}">
                                            <i class="highlight"></i>
                                            <p class="status-tag__txt">{{ __('main.orders.'.$order->status)}}</p>
                                        </div>
                                        @endif
                                    </div>
                                </li>                    
                                @empty
                                <span>@lang('main.no logs')</span>
                                @endforelse
                                {!! $order_logs->links() !!}
                            </ol>
                        </div>
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
                    <a href="{{ $order->status == 'completed' ? '#' : route('orders.edit', $order->id) }}" 
                       class="btn btn-warning px-4 rounded-pill {{ $order->status == 'completed' ? 'disabled' : '' }}" 
                       style="{{ $order->status == 'completed' ? 'pointer-events: none; opacity: 0.6;' : '' }}">
                        <i class="fa fa-edit"></i>
                        <span>تعديل الطلب</span>
                    </a>

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
@endpush