<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    // Fillable fields
    protected $fillable = [
        'code',
        'discount',
        'expires_at',
    ];

    // Casts for proper data types
    protected $casts = [
        'discount'   => 'decimal:2',
        'expires_at' => 'datetime', // <-- ensures you can call ->format() safely
    ];
}
