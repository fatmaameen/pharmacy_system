<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers_Medicine extends Model
{
    use HasFactory;
    protected $table='suppliers_medicine';
    protected $fillable=[
        'medicine_id',
        'amount',
        'supplier_id',
        'image',
        'pdf'

    ];


}
