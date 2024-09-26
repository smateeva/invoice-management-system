@extends('layouts.app')

@section('content')
    <h1>Детайли</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Номер на фактура: {{ $invoice->invoice_number }}</h5>
            <p class="card-text"><strong>Дата:</strong> {{ $invoice->date }}</p>
            <p class="card-text"><strong>Име на клиент:</strong> {{ $invoice->customer_name }}</p>
            <p class="card-text"><strong>Имейл на клиент:</strong> {{ $invoice->customer_email }}</p>
            <p class="card-text"><strong>Сума:</strong> {{ $invoice->total_amount }}</p>
        </div>
    </div>

    <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning mt-3">Редактиране</a>
    <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mt-3">Изтриване</button>
    </form>
    <a href="{{ route('invoices.index') }}" class="btn btn-secondary mt-3">Назад</a>
@endsection
