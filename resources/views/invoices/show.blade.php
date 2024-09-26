@extends('layouts.app')

@section('content')
<div class="card p-5 shadow p-3 mb-5 bg-body-tertiary rounded">
    <div class="row">
        <div class="col-md-12 ">
            <h1>Invoice Details</h1> 

            <!-- Показване на основните данни на фактурата -->
            <p><strong>Invoice Number:</strong> {{ $invoice->invoice_number }}</p>
            <p><strong>Date:</strong> {{ $invoice->date }}</p>
            <p><strong>Customer Name:</strong> {{ $invoice->customer_name }}</p>
            <p><strong>Customer Email:</strong> {{ $invoice->customer_email }}</p>
            <p><strong>Total Amount:</strong> ${{ number_format($invoice->total_amount, 2) }}</p>

            <h4>Line Items</h4> 
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Description</th> 
                        <th>Quantity</th>    
                        <th>Unit Price</th>   
                        <th>Total</th>         
                    </tr>
                </thead>
                <tbody>
                    @if($invoice->lineItems->isEmpty()) <!-- Проверка за наличието на редове -->
                        <tr>
                            <td colspan="4" class="text-center">No line items found for this invoice.</td> 
                        </tr>
                    @else
                        @foreach ($invoice->lineItems as $lineItem) 
                            <tr>
                                <td>{{ $lineItem->description }}</td> 
                                <td>{{ $lineItem->quantity }}</td>    
                                <td>${{ number_format($lineItem->unit_price, 2) }}</td> 
                                <td>${{ number_format($lineItem->quantity * $lineItem->unit_price, 2) }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <a href="{{ route('invoices.index') }}" class="btn btn-primary">Back to Invoices</a> 
        </div>
    </div>
</div>
@endsection
