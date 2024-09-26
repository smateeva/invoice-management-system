<form action="{{ route('line-items.update', ['invoice' => $lineItem->invoice_id, 'line_item' => $lineItem->id]) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="form-group">
        <label for="description">Description</label>
        <input type="text" class="form-control" name="description" value="{{ $lineItem->description }}" required>
    </div>
    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" class="form-control" name="quantity" value="{{ $lineItem->quantity }}" min="1" required>
    </div>
    <div class="form-group">
        <label for="unit_price">Unit Price</label>
        <input type="number" class="form-control" name="unit_price" value="{{ $lineItem->unit_price }}" step="0.01" min="0" required>
    </div>

    <button type="submit" class="btn btn-primary">Update Line Item</button>
</form>
