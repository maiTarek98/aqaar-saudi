@extends('admin.index')
@push('custom-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css">
        
        .admin_price
        {
            color: red;
            font-weight: bolder;
            text-align: center !important;
        }
        .total_price{
            color: #fff;
            font-weight: bolder;  
            margin-bottom: 0; 
            width: 50%;
            text-align: end !important;
        }
        .card-style{
            background: transparent;
            border: none;
            box-shadow: none !important;
        }
        /* .card-style .card-body{
                padding: 10px;
    background: transparent linear-gradient(128deg, #1C608D 0%, #3192D9 100%) 0% 0% no-repeat;
    color: #fff;
    border-radius: 55px;
    display: flex;
    align-items: center;
        } */
        .card-style .card-body label{
            margin-bottom: 0;
            width: 50%;
        }
        .text-sucess{
            color: #0BC500;
            text-align: center !important;
        }
    </style>
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
<div class="content-header">
                {{-- search part --}}
            </div>        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row g-2">
                    <div class="col-sm-12">
                        {{--<a class="btn btn-warning" href="{{ route('generate-financial-pdf',['from_date' => request('from_date') ,'to_date' => request('to_date'), 'download'=>'pdf']) }}">Download PDF Transactions</a>--}}
    
                        <div class="float-end mb-4">
                            <h4>@lang('main.filter')</h4>
                        </div>
                        <div class="float-start mb-4">
                            @include('admin.partials.search_part', ['route' => route('financial_transactions.index')])
                        </div>
                    </div>
                    @if(empty(request()->from_date) && empty(request()->end_date))
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <label class="mb-0">@lang('main.total balance')</label>
                                <p class="total_price">20000 @lang('main.riyal')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card ">
                            <div class="card-body text-center">
                                <label>@lang('main.current balance')</label>
                                <p class="text-sucess">10000 @lang('main.riyal')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card text-center">
                            <div class="card-body text-center">
                                <label class="text-center">@lang('main.pending balance')</label>
                                <p class="admin_price">22222 @lang('main.riyal')</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @forelse($transactions as $key => $value)
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">   
                                <div class="row">
                                    <div class="col-sm-1">
                                        <img width="100%" src="{{url('/images/gold_coins.png')}}">
                                    </div>
                                    <div class="col-sm-7">
                                        <label>@lang('main.order_no')</label>
                                        <a href="{{url('admin/orders', $value->order_id)}}">#{{ $value->order?->order_no }} </a>
                                        <br>
                                        
                                    </div>
                                    <div class="col-sm-4">
                                        <label>@lang('main.status')</label>
                                        <span>{{$value->status}}</span>
                                        <br>
                                        <label>@lang('main.transaction_id')</label>
                                        <span class="transaction_id">{{$value->transaction_id}}</span>
                                        <br>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    @empty
                    <h3>@lang('main.nothing transactions to shown')</h3>
                    @endforelse
                    {{ $transactions->links() }}
                </div>
            </div>
        </section>

        <div class="container">
    <h2 class="mb-4">📊 تقرير الإيرادات الشهرية</h2>

    <!-- 🔹 عرض إجمالي إيرادات الإدارة -->
    <div class="card mb-4">
        <div class="card-body">
            <h4>💰 إجمالي إيرادات الإدارة: <strong>{{ number_format($adminRevenue, 2) }} $</strong></h4>
        </div>
    </div>

    <!-- 🔹 عرض إيرادات التجار -->
    <div class="card">
        <div class="card-header">🏪 إيرادات التجار</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم التاجر</th>
                        <th>إجمالي المبيعات (مكتملة)</th>
                        <th>الطلبات المرتجعة</th>
                        <th>💰 الإيراد الصافي</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($storesRevenue as $index => $store)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \App\Models\Store::find($store['store_id'])->name ?? 'غير معروف' }}</td>
                            <td>{{ number_format($store['total_completed'], 2) }} $</td>
                            <td>-{{ number_format($store['total_returned'], 2) }} $</td>
                            <td><strong>{{ number_format($store['total_revenue'], 2) }} $</strong></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

    </div>
@endsection
