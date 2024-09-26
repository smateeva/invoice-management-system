@extends('layouts.app')

@section('content')
    <h1 class="text-center">Фактури</h1>
    <a href="{{ route('invoices.create') }}" class="btn btn-primary mb-3">Добави фактура</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped ">
        <thead>
            <tr>
                <th>Номер на фактура</th>
                <th>Дата</th>
                <th>Име на клиент</th>
                <th>Сума</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>{{ $invoice->date }}</td>
                    <td>{{ $invoice->customer_name }}</td>
                    <td>{{ $invoice->total_amount }}</td>
                    <td>
                        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-info">Детайли</a>
                        <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning">Редактирай</a>
                        <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Изтрий</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
