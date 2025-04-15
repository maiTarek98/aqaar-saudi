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
                @if(\Route::currentRouteName() == 'orders.show')
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
                                            <h5>{{$log->description}}</h5>
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
                                        @if(optional($properties['attributes'])['status'])
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
                @endif
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