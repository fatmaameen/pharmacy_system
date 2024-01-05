<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier_withproduct extends Model
{
    use HasFactory;
    protected $table='supplier_withproduct';
    protected $fillable=[
        'stock',
        'supplier_id',
        'product_id',
        'image_file',
        'pdf_file',

    ];
}
