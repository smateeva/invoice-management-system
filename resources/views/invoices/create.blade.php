@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Invoice</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('invoices.store') }}" method="POST" class="m-3">
        @csrf
        <div class="form-group">
            <label for="invoice_number">Invoice Number</label>
            <input type="text" name="invoice_number" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="customer_name">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="customer_email">Customer Email</label>
            <input type="email" name="customer_email" class="form-control" required>
        </div>

        <h4>Line Items</h4>
        <div id="line-items-container">
            <div class="line-item">
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="line_items[0][description]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="line_items[0][quantity]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="unit_price">Unit Price</label>
                    <input type="number" name="line_items[0][unit_price]" class="form-control" required step="0.01">
                </div>
            </div>
        </div>
        <button type="button" id="add-line-item" class="btn btn-primary">Add Line Item</button>
        <button type="submit" class="btn btn-success">Create Invoice</button>
    </form>
</div>

<script>
    let lineItemCount = 1;

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
