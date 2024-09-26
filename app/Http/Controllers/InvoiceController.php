<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\LineItem;
use Illuminate\Http\Request;

// Контролер за обработка на CRUD операции (създаване, четене, обновяване, изтриване) за фактури и свързаните с тях артикули.

class InvoiceController extends Controller
{
    
    //   Показва списък с фактури за текущия потребител.
    
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Извлича фактури, свързани с текущия потребител
        $invoices = Invoice::where('user_id', auth()->id()) 
            ->when($search, function ($query) use ($search) {
                // Филтрира по име на клиент или номер на фактура
                $query->where('customer_name', 'like', "%{$search}%")
                      ->orWhere('invoice_number', 'like', "%{$search}%");
            })
            ->paginate(10); // Страница с 10 фактури

        return view('invoices.index', compact('invoices', 'search'));
    }

    // Показва формата за създаване на нова фактура.
    
    public function create()
    {
        return view('invoices.create');
    }

    // Запазва новосъздадена фактура в базата данни.
     
    public function store(Request $request)
    {
        // Валидира входящите данни
        $request->validate([
            'invoice_number' => 'required|unique:invoices',
            'date' => 'required|date',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'line_items.*.description' => 'required|string',
            'line_items.*.quantity' => 'required|integer|min:1',
            'line_items.*.unit_price' => 'required|numeric|min:0',
        ]);

        // Изчислява общата сума на фактурата
        $totalAmount = 0;
        foreach ($request->input('line_items', []) as $lineItem) {
            $totalAmount += $lineItem['quantity'] * $lineItem['unit_price'];
        }

        // Създава нова фактура
        $invoice = new Invoice();
        $invoice->invoice_number = $request->input('invoice_number');
        $invoice->date = $request->input('date');
        $invoice->customer_name = $request->input('customer_name');
        $invoice->customer_email = $request->input('customer_email');
        $invoice->total_amount = $totalAmount;  
        $invoice->user_id = auth()->id();  

        // Записва фактурата в базата данни
        $invoice->save();

        // Записва свързаните с фактурата артикули
        foreach ($request->input('line_items', []) as $lineItemData) {
            $lineItem = new LineItem();
            $lineItem->description = $lineItemData['description'];
            $lineItem->quantity = $lineItemData['quantity'];
            $lineItem->unit_price = $lineItemData['unit_price'];
            $lineItem->invoice_id = $invoice->id; 

            // Записва артикула
            $lineItem->save();
        }

        // Пренасочва към списъка с фактури с успешен статус
        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully!');
    }

    // Показва подробности за избраната фактура.
     
    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    //Показва формата за редактиране на фактура.
     
    public function edit(Invoice $invoice)
    {
        return view('invoices.edit', compact('invoice'));
    }

    // Обновява съществуваща фактура в базата данни.
     
    public function update(Request $request, Invoice $invoice)
    {
        // Валидира входящите данни
        $validatedData = $request->validate([
            'invoice_number' => 'required|string|max:255',
            'date' => 'required|date',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'line_items' => 'required|array',
            'line_items.*.description' => 'required|string|max:255',
            'line_items.*.quantity' => 'required|integer|min:1',
            'line_items.*.unit_price' => 'required|numeric|min:0',
        ]);

        // Изчислява новата обща сума на фактурата
        $totalAmount = collect($request->line_items)->sum(function ($lineItem) {
            return $lineItem['quantity'] * $lineItem['unit_price'];
        });

        // Обновява фактурата
        $invoice->update(array_merge($validatedData, ['total_amount' => $totalAmount]));

        // Изтрива старите артикули и записва новите
        $invoice->lineItems()->delete();
        foreach ($request->line_items as $lineItemData) {
            $lineItemData['invoice_id'] = $invoice->id; 
            LineItem::create($lineItemData);
        }

        // Пренасочва към списъка с фактури
        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully!');
    }

    // Изтрива избраната фактура.
     
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully!');
    }
}
