<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nigth_supplier_withproduct extends Model
{
    use HasFactory;
    protected $table='nigth_supplier_withproduct';
    protected $fillable=[
        'stock',
        'supplier_id',
        'nigth_product_id',
        'image_file',
        'pdf_file',

    ];
}
