<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
	<title>{{__('main.fatoorah')}} - PDF</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300&display=swap" rel="stylesheet">
     <style type="text/css">
        body {
            font-family: 'Almarai', sans-serif;
            text-transform: capitalize;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>@lang('main.invoice for financial transactions') @if(request('from_date') || request('to_date') ) {{request('from_date')}} - {{request('to_date')}} @else {{\Carbon\Carbon::now()}}
        @endif
    </h2>
	<table class="table table-bordered">
		<thead>
            <th>{{__('main.request_no')}}</th>
            <th>{{__('main.adminname')}}</th>
            <th>{{__('main.vendorname')}}</th>
            <th>{{__('main.status')}}</th>
            <th>{{__('main.total_price')}}</th>
            <th>{{__('main.admin_price')}}</th>
            <th>{{__('main.vendor_price')}}</th>
            <th>{{__('main.created_at')}}</th>

		</thead>
		<tbody>
			<tr>
                @forelse($request as $value)
    				<td>{{$value->request->request_no}}</td>
                    <td>{{$value->admin->name}}</td>
                    <td>{{$value->vendor->name}}</td>
                    <td>{{('main'.$value->status)}}</td>
                    <td>{{abs($value->total_price)}} @lang('main.riyal')</td>
                    <td>{{abs($value->admin_price)}} @lang('main.riyal')</td>
                    <td>{{abs($value->vendor_price)}} @lang('main.riyal')</td>
                    <td>@php $date = Carbon\Carbon::parse($value->created_at, 'UTC') ; @endphp
                        {{$date->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</td>
                @empty
                    <td class="text-center text-muted" colspan="8">
                        <h4>@lang('main.nothing transactions to shown')</h4>
                    </td>
                @endforelse
             </tr>
		</tbody>
	</table>
</div>
</body>
</html>
