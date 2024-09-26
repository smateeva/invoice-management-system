<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'invoice_number',
        'date',
        'customer_name',
        'customer_email',
        'total_amount',
        'user_id',
    ];

    public function lineItems()
    {
        return $this->hasMany(LineItem::class);
    }
}
