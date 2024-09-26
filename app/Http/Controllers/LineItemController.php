<?php

namespace App\Http\Controllers;

use App\Models\LineItem;
use App\Models\Invoice;
use Illuminate\Http\Request;

//Контролер за  CRUD операциите (създаване, редактиране, изтриване) за артикули, свързани с фактурите.
 
class LineItemController extends Controller
{
    // Запазва нов артикул в указаната фактура.
     
    public function store(Request $request, $invoiceId)
    {
        // Валидира входящите данни
        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
        ]);

        // Намира фактурата по ID
        $invoice = Invoice::findOrFail($invoiceId);
        
        // Създава нов артикул и го свързва с фактурата
        $lineItem = new LineItem($validatedData);
        $invoice->lineItems()->save($lineItem);

        // Пренасочва към детайлите на фактурата с успешно съобщение
        return redirect()->route('invoices.show', $invoiceId)
                         ->with('success', 'Line item added successfully.');
    }

    // Показва формата за редактиране на указан артикул.
    
    public function edit(LineItem $lineItem)
    {
        return view('line-items.edit', compact('lineItem'));
    }

    //Обновява артикула в базата данни.
     
    public function update(Request $request, $invoiceId, $lineItemId)
    {
        // Валидира входящите данни
        $request->validate([
            'description' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
        ]);

        // Намира артикула по ID
        $lineItem = LineItem::findOrFail($lineItemId);
        
        // Актуализира артикула
        $lineItem->update($request->only('description', 'quantity', 'unit_price'));

        // Пренасочва към детайлите на фактурата с успешно съобщение
        return redirect()->route('invoices.show', $invoiceId)
                         ->with('success', 'Line item updated successfully.');
    }

    // Изтрива указан артикул от базата данни.
     
    public function destroy(LineItem $lineItem)
    {
        $invoiceId = $lineItem->invoice_id; // Запомня ID на фактурата
        $lineItem->delete(); // Изтрива артикула
        
        // Пренасочва към детайлите на фактурата с успешно съобщение
        return redirect()->route('invoices.show', $invoiceId)
                         ->with('success', 'Line item deleted successfully.');
    }
}
