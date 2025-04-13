@extends('admin.index')
@section('content')
    <h3>Invoice {{ $invoice->order_no }}</h3>
    <p>Date: {{ $invoice->order_date }}</p>
    <p>Total: {{ $invoice->total_amount }}</p>

    <h4>Items</h4>
    <ul>
        @foreach($invoice->carts as $item)
            <li>{{ $item->product?->name }} - {{ $item->qty }} x {{ $item->price }} = {{ $item->total }}</li>
        @endforeach
    </ul>

    <h4>Actions</h4>
    <a href="{{ route('invoices.generatePDF', ['id' => $invoice->id, 'templateId' => 1]) }}">Download PDF</a>
@endsection
