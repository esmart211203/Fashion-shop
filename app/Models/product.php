<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand_id',
        'category_id',
        'price',
        'status',
        'quantity_in_stock',
        'description',
    ];
}
