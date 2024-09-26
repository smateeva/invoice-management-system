@extends('layouts.app')

@section('content')
    <h1>Добави фактура</h1>

    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="invoice_number">Номер на фактура</label>
            <input type="text" class="form-control" name="invoice_number" required>
        </div>
        <div class="form-group">
            <label for="date">Дата</label>
            <input type="date" class="form-control" name="date" required>
        </div>
        <div class="form-group">
            <label for="customer_name">Име на клиент</label>
            <input type="text" class="form-control" name="customer_name" required>
        </div>
        <div class="form-group">
            <label for="customer_email">Имейл на клиент</label>
            <input type="email" class="form-control" name="customer_email" required>
        </div>
        <div class="form-group">
            <label for="total_amount">Сума</label>
            <input type="number" class="form-control" name="total_amount" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Създай</button>
        <a href="{{ route('invoices.index') }}" class="btn btn-danger mt-3">Откажи</a>
    </form>
@endsection
