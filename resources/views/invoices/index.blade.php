@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Invoices</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('invoices.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by customer name or invoice number" value="{{ request()->input('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <a href="{{ route('invoices.create') }}" class="btn btn-primary mb-3">Create Invoice</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Invoice Number</th>
                <th>Date</th>
                <th>Customer Name</th>
                <th>Total Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>{{ $invoice->date }}</td>
                    <td>{{ $invoice->customer_name }}</td>
                    <td>{{ number_format($invoice->total_amount, 2) }}</td>
                    <td>
                        <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No invoices found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $invoices->links() }}
</div>
@endsection
