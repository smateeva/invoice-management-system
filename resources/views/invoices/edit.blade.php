@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Invoice #{{ $invoice->invoice_number }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('invoices.update', $invoice->id) }}" method="POST" class="m-3">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="invoice_number">Invoice Number</label>
            <input type="text" name="invoice_number" class="form-control" value="{{ $invoice->invoice_number }}" required>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" class="form-control" value="{{ $invoice->date }}" required>
        </div>
        <div class="form-group">
            <label for="customer_name">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" value="{{ $invoice->customer_name }}" required>
        </div>
        <div class="form-group">
            <label for="customer_email">Customer Email</label>
            <input type="email" name="customer_email" class="form-control" value="{{ $invoice->customer_email }}" required>
        </div>

        <h4>Line Items</h4>
        <div id="line-items-container">
            @foreach ($invoice->lineItems as $index => $lineItem)
                <div class="line-item">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="line_items[{{ $index }}][description]" class="form-control" value="{{ $lineItem->description }}" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="line_items[{{ $index }}][quantity]" class="form-control" value="{{ $lineItem->quantity }}" required>
                    </div>
                    <div class="form-group">
                        <label for="unit_price">Unit Price</label>
                        <input type="number" name="line_items[{{ $index }}][unit_price]" class="form-control" value="{{ $lineItem->unit_price }}" required step="0.01">
                    </div>
                </div>
            @endforeach
        </div>
        <button type="button" id="add-line-item" class="btn btn-primary">Add Line Item</button>
        <button type="submit" class="btn btn-success">Update Invoice</button>
    </form>
</div>

<script>
    let lineItemCount = {{ $invoice->lineItems->count() }};

    document.getElementById('add-line-item').addEventListener('click', function() {
        const lineItemsContainer = document.getElementById('line-items-container');
        const newLineItem = document.createElement('div');
        newLineItem.classList.add('line-item');
        newLineItem.innerHTML = `
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="line_items[${lineItemCount}][description]" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="line_items[${lineItemCount}][quantity]" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="unit_price">Unit Price</label>
                <input type="number" name="line_items[${lineItemCount}][unit_price]" class="form-control" required step="0.01">
            </div>
        `;
        lineItemsContainer.appendChild(newLineItem);
        lineItemCount++;
    });
</script>
@endsection
