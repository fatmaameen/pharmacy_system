<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $table='stock_table';
    protected $fillable=[
        'stock',
        'production_date',
        'expired_date',
        'product_id',


    ];
    public function products()
    {
        return $this->belongsTo(Products::class);
    }
}
