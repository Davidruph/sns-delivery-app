<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'inventory_id',
        'quantity',
        'amount',
    ];

    /**
     * Relationships
     */

    // OrderItem belongs to an Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // OrderItem belongs to an Inventory (product)
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
