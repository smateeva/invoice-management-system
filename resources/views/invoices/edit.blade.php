@extends('layouts.app')

@section('content')
    <h1>Редактирай фактура</h1>

    <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="invoice_number">Номер на фактура</label>
            <input type="text" class="form-control" name="invoice_number" value="{{ $invoice->invoice_number }}" required>
        </div>
        <div class="form-group">
            <label for="date">Дата</label>
            <input type="date" class="form-control" name="date" value="{{ $invoice->date }}" required>
        </div>
        <div class="form-group">
            <label for="customer_name">Име на клиент</label>
            <input type="text" class="form-control" name="customer_name" value="{{ $invoice->customer_name }}" required>
        </div>
        <div class="form-group">
            <label for="customer_email">Имейл на клиент</label>
            <input type="email" class="form-control" name="customer_email" value="{{ $invoice->customer_email }}" required>
        </div>
        <div class="form-group">
            <label for="total_amount">Сума</label>
            <input type="number" class="form-control" name="total_amount" value="{{ $invoice->total_amount }}" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Редактирай</button>
        <a href="{{ route('invoices.index') }}" class="btn btn-danger mt-3">Откажи</a>
    </form>
@endsection
