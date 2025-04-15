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
    @elseif(auth()->user()->hasRole(4))
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
                <button type="button" id="statusButton" class="status-tag {{$order->status}} border-0" data-bs-toggle="modal" data-bs-target="#orderStatusModal">
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
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <label> @lang('main.orders.choose status') </label>
                                <select name="status" id="status" class="form-select">
                                    <option value="">@lang('main.choose')</option>
                                    <option value="pending">{{__('main.orders.pending')}}</option>
                                    <option value="accepted">{{__('main.orders.accepted')}}</option>
                                    <option value="shipped">{{__('main.orders.shipped')}}</option>
                                    <option value="completed">{{__('main.orders.completed')}}</option>
                                    <option value="return">{{__('main.orders.return')}}</option>
                                    <option value="declined">{{__('main.orders.declined')}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label> @lang('main.orders.notes') </label>
                                <textarea name="notes" placeholder="@lang('main.orders.write notes')" class="form-control"></textarea>
                            </div>
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
