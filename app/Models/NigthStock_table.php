<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NigthStock_table extends Model
{
    use HasFactory;
    protected $table='nigth_stock_table';
    protected $fillable=[
        'stock',
        'production_date',
        'expired_date',
        'nigth_product_id',


    ];
    public function nigth_products()
    {
        return $this->belongsTo(NigthProduct::class);
    }
}
