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
    <h2>@lang('main.invoice for reserv service')</h2>
    <p>{{__('main.invoice_date')}} : <span>@php $date = Carbon\Carbon::parse($request->created_at, 'UTC') ; @endphp
                    {{$date->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</span></p>
	<table class="table table-bordered">
		<thead>
            <th>{{__('main.request_no')}}</th>
            <th>{{__('main.username')}}</th>
            <th>{{__('main.vendorname')}}</th>
            <th>{{__('main.servicename')}}</th>
            @if($request->type == 'predefined_service')
            <th>{{__('main.description')}}</th>
            @endif
            <th>{{__('main.servicelocation')}}</th>
            <th>{{__('main.phone')}}</th>
            <th>{{__('main.status')}}</th>
            <th>{{__('main.price')}}</th>
		</thead>
		<tbody>
			<tr>
				<td>{{$request->request_no}}</td>
                <td>{{$request->user->name}}</td>
                <td>{{$request->vendor->name}}</td>
                @if($request->type == 'predefined_service')
                <td>{{$request->predefined_service?->category?->category_name }}</td>
                <td>{{$request->description}} </td>
                @elseif($request->type == 'offer')
                <td>{{$request->offer?->offer_title}}</td>
                @endif
                <td>{{$request->vendor->city?->city}}</td>
                <td>{{$request->phone}}</td>
                <td>{{status_requests_trans($request->status)}}</td>
                <td>{{abs($request->price)}} @lang('main.riyal')</td>	
             </tr>
		</tbody>
	</table>
</div>
</body>
</html>
