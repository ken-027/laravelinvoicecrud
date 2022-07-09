<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    protected $fillable = [
        'customer_name',
        'invoice_date',
        'invoice_number',
        'product_name',
        'product_price',
        'product_quantity',
        'amount'
    ];
    use HasFactory;
}
