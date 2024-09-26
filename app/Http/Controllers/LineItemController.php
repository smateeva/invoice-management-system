<?php

namespace App\Http\Controllers;

use App\Models\LineItem;
use App\Models\Invoice;
use Illuminate\Http\Request;

class LineItemController extends Controller
{
    public function store(Request $request, $invoiceId)
    {
        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $invoice = Invoice::findOrFail($invoiceId);
        $lineItem = new LineItem($validatedData);
        $invoice->lineItems()->save($lineItem);

        return redirect()->route('invoices.show', $invoiceId)->with('success', 'Line item added successfully.');
    }

    public function edit(LineItem $lineItem)
    {
        return view('line-items.edit', compact('lineItem'));
    }

    public function update(Request $request, $invoiceId, $lineItemId)
{
    $request->validate([
        'description' => 'required|string|max:255',
        'quantity' => 'required|integer|min:1',
        'unit_price' => 'required|numeric|min:0',
    ]);

    $lineItem = LineItem::findOrFail($lineItemId);
    $lineItem->update($request->only('description', 'quantity', 'unit_price'));

    return redirect()->route('invoices.show', $invoiceId)
                     ->with('success', 'Line item updated successfully.');
}

    public function destroy(LineItem $lineItem)
    {
        $invoiceId = $lineItem->invoice_id; 
        $lineItem->delete();
        return redirect()->route('invoices.show', $invoiceId)->with('success', 'Line item deleted successfully.');
    }
}
