<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'name',
        'category',
        'quantity',
        'price',
        'description',
        'image',
        'user_id',
        'cost_price',
        'selling_price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
