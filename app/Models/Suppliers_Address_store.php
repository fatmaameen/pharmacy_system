<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Suppliers_Address_store extends Model
{
    use HasFactory;
    protected $table='supplier_location';
    protected $fillable=[
       
        'location',
        'supplier_id'
    ];

}
