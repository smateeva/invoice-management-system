<?php

namespace App\Http\Controllers;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::where('user_id', auth()->id())->get();

        return view('invoices.index', compact('invoices'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'invoice_number' => 'required|string|max:255',
            'date' => 'required|date',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'total_amount' => 'required|numeric|min:0',
        ]);

        Invoice::create([
            'invoice_number' => $request->invoice_number,
            'date' => $request->date,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'total_amount' => $request->total_amount,
            'user_id' => auth()->id(), 
        ]);

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = Invoice::findOrFail($id);

        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = Invoice::findOrFail($id);

        return view('invoices.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'invoice_number' => 'required|string|max:255',
            'date' => 'required|date',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $invoice = Invoice::findOrFail($id);

        $invoice->update([
            'invoice_number' => $request->invoice_number,
            'date' => $request->date,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'total_amount' => $request->total_amount,
        ]);

        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $invoice = Invoice::findOrFail($id);

        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }
}
