<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreSetting extends Model
{
    protected $fillable = [
        'group_id',
        'store_name',
        'logo',
        'currency',
        'currency_symbol',
    ];
}
