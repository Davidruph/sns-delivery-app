<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'group_id',
        'store_name',
        'store_phone',
        'store_currency',
        'store_currency_symbol',
        'store_address',
        'store_logo',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'group_id', 'group_id');
    }
}
