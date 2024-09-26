<?php
namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\LineItem;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $invoices = Invoice::where('user_id', auth()->id()) 
            ->when($search, function ($query) use ($search) {
                $query->where('customer_name', 'like', "%{$search}%")
                      ->orWhere('invoice_number', 'like', "%{$search}%");
            })
            ->paginate(10); 
    
        return view('invoices.index', compact('invoices', 'search'));
    }
   public function create()
    {
        return view('invoices.create');
    }

    /**
     * Store a newly created invoice in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'invoice_number' => 'required|unique:invoices',
            'date' => 'required|date',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'line_items.*.description' => 'required|string',
            'line_items.*.quantity' => 'required|integer|min:1',
            'line_items.*.unit_price' => 'required|numeric|min:0',
        ]);
    
        $totalAmount = 0;
        foreach ($request->input('line_items', []) as $lineItem) {
            $totalAmount += $lineItem['quantity'] * $lineItem['unit_price'];
        }
    
        $invoice = new Invoice();
        $invoice->invoice_number = $request->input('invoice_number');
        $invoice->date = $request->input('date');
        $invoice->customer_name = $request->input('customer_name');
        $invoice->customer_email = $request->input('customer_email');
        $invoice->total_amount = $totalAmount;  
        $invoice->user_id = auth()->id();  
    
        $invoice->save();
    
        foreach ($request->input('line_items', []) as $lineItemData) {
            $lineItem = new LineItem();
            $lineItem->description = $lineItemData['description'];
            $lineItem->quantity = $lineItemData['quantity'];
            $lineItem->unit_price = $lineItemData['unit_price'];
            $lineItem->invoice_id = $invoice->id; 
    
            $lineItem->save();
        }
    
        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully!');
    }

    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        return view('invoices.edit', compact('invoice'));
    }

    public function update(Request $request, Invoice $invoice)
    {
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

        $totalAmount = collect($request->line_items)->sum(function ($lineItem) {
            return $lineItem['quantity'] * $lineItem['unit_price'];
        });

        $invoice->update(array_merge($validatedData, ['total_amount' => $totalAmount]));

        $invoice->lineItems()->delete();
        foreach ($request->line_items as $lineItemData) {
            $lineItemData['invoice_id'] = $invoice->id; 
            LineItem::create($lineItemData);
        }

        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully!');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully!');
    }
}
