@extends('admin.index')
@push('custom-css')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">الاعدادات</a></li>
                <li class="breadcrumb-item active">Timeline</li>
                </ol>

            </div>
            <div class="content">
                <div class="filters mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col">
                                    <select class="form-control form-select">
                                        <option>All Users</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Keyword">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Date Range">
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="timeline">
                    @php
                        $currentDateLabel = null;
                    @endphp
                    @forelse($result as $key => $value)
                        @php
                            $createdAt = \Carbon\Carbon::parse($value->created_at);
                            $dateLabel = '';
                            if ($createdAt->isToday()) {
                                $dateLabel = 'Today';
                            } elseif ($createdAt->isTomorrow()) {
                                $dateLabel = 'Tomorrow';
                            } elseif ($createdAt->isYesterday()) {
                                $dateLabel = 'Yesterday';
                            } elseif ($createdAt->diffInDays(\Carbon\Carbon::now()) == 2) {
                                $dateLabel = 'The day before yesterday';
                            } elseif ($createdAt->isLastWeek()) {
                                $dateLabel = 'Last Week';
                            } elseif ($createdAt->isLastMonth()) {
                                $dateLabel = 'Last Month';
                            } elseif ($createdAt->isLastYear()) {
                                $dateLabel = 'Last Year';
                            } else {
                                $dateLabel = $createdAt->format('F j, Y');
                            }
                            $causer = \App\Models\User::where('id', $value->causer_id)->first();
                        @endphp

                        @if ($dateLabel !== $currentDateLabel)
                            <div class="timeline-date">{{ $dateLabel }}</div>
                            @php
                                $currentDateLabel = $dateLabel;
                            @endphp
                        @endif

                        <div>
                            <i class="fa fa-edit"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header">
                                    <div class="user">
                                        <div class="user-icon">{{ ucfirst(mb_substr($causer->name, 0, 1)) }}</div>
                                        <a href="#" class="user-name fw-bold ms-1">{{ $causer->name }}</a>
                                    </div>
                                    <span class="time"><i class="fas fa-clock"></i> {{$value->created_at->diffForHumans()}}</span>
                                </h3>
                                
                                <div class="timeline-body">
                                    @php
                                        $order = \App\Models\Order::where('id', $value->subject_id)->first();
                                    @endphp

                                    <span>@if($value->event == 'created') created @elseif($value->event == 'updated') updated @endif order with number ({{ $order->order_no }})</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <img src="">
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

{{--
 <div class="timeline-item">
    <!-- <div class="timeline-icon"><i class="fa fa-edit"></i></div> -->
    <div class="timeline-content">
        @if($value->log_name =='order')
            @php
                $order = \App\Models\Order::where('id',$value->subject_id)->first();
            @endphp

        <p>@if($value->event == 'created') created @elseif($value->event == 'updated') updated @endif order with number ({{$order->order_no}})</p>
        @else

        @endif
        <div class="user">
            <div class="user-icon">{{ucfirst(mb_substr($causer->name,0,1))}}</div>
            <span class="user-name">{{$causer->name}}</span>


            <div class="user-icon"><i class="fa fa-clock"></i></div>
            <span class="user-name">{{$value->created_at->format('H:i')}}</span>
        </div>
    </div>
</div> 
--}}