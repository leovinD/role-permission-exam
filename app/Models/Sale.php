<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_date',
        'product_name',
        'region',
        'category_name',
        'salesperson_name',
        'units_sold',
        'unit_price'
    ];
}

