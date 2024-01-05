<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ahmetsabri\FatihLaravelSearch\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orders_Details extends Model
{
    use HasFactory,Searchable ;

    protected $table='order_details';
    protected $fillable=[
        'order_id',
        'product_id',
        'amount',

    ];

    public function product(){
        return $this->belongsTo(Products::class);
    }
}
