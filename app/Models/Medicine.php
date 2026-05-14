<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_name',
        'generic_name',
        'category',
        'quantity',
        'expiration_date',
        'price',
        'status'
    ];

    protected $casts = [
        'expiration_date' => 'date',
        'price' => 'decimal:2'
    ];
}