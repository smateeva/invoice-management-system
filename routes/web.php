<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LineItemController;
use App\Models\Invoice; 

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $invoices = Invoice::where('user_id', auth()->id())->paginate(10); 
    return view('invoices.index', compact('invoices')); 
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('invoices', InvoiceController::class);
});

require __DIR__.'/auth.php';
