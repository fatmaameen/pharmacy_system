<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Suppliers_Phones_store extends Model
{
    use HasFactory;
    protected $table='suppliers_phones';
    protected $fillable=[

        'phone',
        'supplier_id'
    ];
    public function Suppliers()
    {
        return $this->belongsTo(Suppliers_store::class);
    }
}
